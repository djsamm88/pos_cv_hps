<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_pinjam extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');				
		$this->load->helper('custom_func');
		if ($this->session->userdata('id_admin')=="") {
			redirect(base_url().'index.php/login');
		}
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
		//$this->load->library('datatables');
		$this->load->model('m_barang_pinjam');
		$this->load->model('m_cabang');
		$this->load->model('m_pelanggan');
		
	}


	public function struk_pinjam($group_trx)
	{
		$data['data'] = $this->m_barang_pinjam->m_detail($group_trx);		
		$this->load->view('struk_pinjam',$data);
	}


	public function status_barang_pinjam()
	{
		$data['all'] = $this->m_barang_pinjam->m_status_barang_pinjam();	
		$this->load->view('status_barang_pinjam',$data);	
	}

	public function update_status()
	{
		$data = $this->input->post();
		$group_trx = $data['group_trx'];
		$serialize['status']="kembali";
		$this->db->set($serialize);
		$this->db->where('group_trx',$group_trx);
		$this->db->update('tbl_barang_pinjam_trx');
	}

	public  function go_jual()
	{
		$data = $this->input->post();
		//var_dump($data);
		//die();
		$serialize['bayar'] = hanya_nomor($data['bayar']);
		$serialize['hutang'] = hanya_nomor($data['hutang']);
		
		$serialize['nama_pelanggan'] = ($data['nama_pembeli']);
		$serialize['id_pelanggan'] = ($data['id_pelanggan']);
		$serialize['hp_pembeli'] = ($data['hp_pembeli']);
		$serialize['alamat'] = ($data['alamat']);
		$serialize['group_trx'] = date('ymdHis')."_".$this->session->userdata("id_admin");
		$serialize['id_cabang'] = $this->session->userdata("id_cabang");
		$serialize['id_admin'] = $this->session->userdata("id_admin");
		$serialize['tgl_mulai'] = date('Y-m-d');

		$serialize['keterangan'] = ($data['keterangan']);
		$serialize['harga_total'] = $serialize['bayar']+$serialize['hutang'];


		for ($i=0; $i < count($data['id_barang_pinjam']); $i++) { 
			
			$serialize['id_barang_pinjam'] = $data['id_barang_pinjam'][$i];
			$serialize['nama_barang'] = $data['nama_barang'][$i];
			$serialize['jumlah'] = hanya_nomor($data['jumlah'][$i]);
			$serialize['lama_pinjam'] = hanya_nomor($data['lama_pinjam'][$i]);
			$serialize['sub_total'] = hanya_nomor($data['sub_total'][$i]);

			$serialize['tgl_selesai'] = date('Y-m-d', strtotime("+".$serialize['lama_pinjam']." months", strtotime(date('Y-m-d'))));
		
			$serialize['harga_per_bulan'] = hanya_nomor($data['harga_per_bulan'][$i]);
			
			$this->db->set($serialize);
			$this->db->insert('tbl_barang_pinjam_trx');

			/** kurangi stok **/	
			$jum = $data['jumlah'][$i];
			$id_barang_pinjam = $data['id_barang_pinjam'][$i];
			$this->db->query("
					UPDATE tbl_barang_pinjam 
					SET stok_barang=stok_barang-'$jum' 
					WHERE id_barang_pinjam='$id_barang_pinjam' 
				");
			/** kurangi stok **/

		}

		/***** tbl_trx *****/
		
		$trx['id_referensi'] = $serialize['id_pelanggan'];
		$trx['jumlah'] = hanya_nomor($serialize['bayar']);
		//$trx['url_bukti'] = upload_file('url_bukti');
		$trx['keterangan'] = "Sewa Barang - DP ".$serialize['keterangan'] . 
							  " <br>- Dari: ". $serialize['nama_pelanggan'].
							  " <br>- Total: ". rupiah($serialize['harga_total']).
							  " <br>- bayar: ". rupiah($serialize['bayar']).
							  " <br>- hutang: ". rupiah($serialize['hutang']);
		$trx['id_group'] = 18;// pembayaran 
		$trx['id_cabang'] = $this->session->userdata('id_cabang');

		$this->db->set($trx);
		$this->db->insert('tbl_transaksi');
		$id_ret = $this->db->insert_id();
		/***** tbl_trx *****/

		echo $serialize['group_trx'];

	}

	public	function json_barang()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$query = $this->input->get('cari'); 
		$data['all'] = $this->m_barang_pinjam->m_data_autocomplete($query);
		echo json_encode($data['all']);
	}


	public function form_peminjaman()
	{
		$data['all'] = $this->m_barang_pinjam->m_data();
		$data['pelanggan'] = $this->m_pelanggan->m_data($this->session->userdata('id_cabang'));	
		
		$this->load->view('form_peminjaman_barang',$data);
	}


	public function data()
	{
		$data['all'] = $this->m_barang_pinjam->m_data();	
		$this->load->view('data_barang_pinjam',$data);
	}

	public function by_id($id_barang_pinjam)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_barang_pinjam->m_by_id($id_barang_pinjam);
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id_barang_pinjam = $this->input->post('id_barang_pinjam');		
		$serialize = $this->input->post();
		

		$serialize['stok_barang'] = hanya_nomor($serialize['stok_barang']);
		$serialize['harga_sewa'] = hanya_nomor($serialize['harga_sewa']);

		if($id_barang_pinjam=='')
		{
			$this->m_barang_pinjam->insert($serialize);
			die('1');
		}else{

			$this->m_barang_pinjam->update($serialize,$id_barang_pinjam);
		}

	}

	public function hapus($id_barang_pinjam)
	{
		$this->db->query("DELETE FROM tbl_barang_pinjam WHERE id_barang_pinjam='$id_barang_pinjam'");
	}


}
