<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjual extends CI_Controller {
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
		$this->load->model('m_laporan_keuangan');
		$this->load->model('m_penjual');
		$this->load->model('m_barang');
		$this->load->model('m_ambil');		
		$this->load->model('m_ekspedisi');
		$this->load->model('m_gudang');

		
	}


	public function pesanan_penjual()
	{
		
		$data['all'] = $this->m_barang->m_pesanan_penjual($this->session->userdata('id_admin'));	
		$this->load->view('data_pesanan',$data);

	}

	public function master_barang()
	{
		
		$data['all'] = $this->m_barang->m_data_barang_penjual();	
		$this->load->view('data_barang_penjual',$data);
	}

	public	function json_barang_penjual()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$query = $this->input->get('cari'); 
		$data['all'] = $this->m_barang->m_data_barang_penjual_autocomplete($query)->result();
		echo json_encode($data['all']);
	}

	public function go_upload_bukti()
	{
		$bukti_transfer = upload_file('gambar');
		$grup_penjualan = $this->input->post('grup_penjualan');
		$this->db->query("UPDATE tbl_barang_transaksi SET bukti_transfer='$bukti_transfer' WHERE grup_penjualan='$grup_penjualan'");
		echo "OK";
	}

	public function go_pesan()
	{
		$data = $this->input->post();

		$data['alamat'] = $data['alamat_lengkap']." - ".$data['alamat'];
		unset($data['alamat_lengkap']);
		/********* insert penjual ************/
		$arrpenjual = array(				
				"tgl_daftar" 	=>date('Y-m-d H:i:s')
		);
		
		$id_penjual 	= $data['id_penjual'];
		$arrUpdate 		= array(
							"tgl_trx_terakhir"=>date('Y-m-d H:i:s')
						  );
		$this->m_penjual->update($arrUpdate,$id_penjual);
	
		/********* insert penjual ************/

		//var_dump($data);
		$total_tanpa_diskon =0; 
		$total_harga_beli 	=0; 
		$id_barang = $data['id_barang'];

		for($i=0;$i<count($id_barang);$i++) {
			//$data['harga_jual'] as $key => $harga_jual
			$key=$i;
			$id = $id_barang[$i];
			$harga_jual = $data['harga_jual'][$i];
			# code...
			//echo $key;
			/********** mengambil detail barang dari db***********/
			$q_detail_barang = $this->m_barang->m_by_id($id);
			$barang = $q_detail_barang[0];
			/********** mengambil detail barang dari db***********/


			
			$serialize['id_barang'] 	= $id;
			$serialize['harga_jual'] 	= hanya_nomor($harga_jual);
			$serialize['satuan_jual'] 	= $data['satuan_jual'][$key];
			$serialize['jenis'] 		= 'pending_penjual';
			$serialize['grup_penjualan'] = $data['grup_penjualan'];		

			$serialize['id_penjual'] 	= $id_penjual;
			$serialize['nama_penjual'] 	= $data['nama_penjual'];
			$serialize['hp_penjual'] 	= $data['hp_penjual'];
			
			
			$serialize['tgl_trx_manual']= $data['tgl_trx_manual'];
			$serialize['keterangan']	= $data['keterangan'];

			
			$serialize['saldo'] 		= hanya_nomor($data['saldo']);

			
			$serialize['sub_total_jual']= $serialize['harga_jual']*$data['jumlah'][$key];
			$serialize['sub_total_beli']= $barang->harga_pokok*$data['jumlah'][$key];
			$serialize['qty_jual']		= $data['jumlah'][$key];
			$serialize['jum_per_koli']	= $barang->jum_per_koli;
			$serialize['harga_beli']	= $barang->harga_pokok;
			$serialize['id_gudang']		= '1';

			$serialize['harga_ekspedisi']		= hanya_nomor($data['ongkir']);
			$serialize['nama_ekspedisi']		= $data['nama_ekspedisi'];
			$serialize['alamat']				= $data['alamat'];
			
			$serialize['province_id']		= $data['province_id'];
			$serialize['city_id']			= $data['city_id'];
			$serialize['subdistrict_id']	= $data['subdistrict_id'];
			$serialize['courier']			= $data['courier'];
			$serialize['service']			= $data['service'];
			$serialize['berat_total']		= hanya_nomor($data['total_berat']);
			

			$serialize['jumlah'] = $data['jumlah'][$key];

			/************ insert ke tbl_barang_transaksi *************/
			$this->m_barang->insert_trx_barang($serialize);
			/************ insert ke tbl_barang_transaksi *************/

			$total_tanpa_diskon	+=$serialize['sub_total_jual'];
			$total_harga_beli	+=$serialize['sub_total_beli'];
		}


		echo $data['grup_penjualan'];
	}

	public function kasir()
	{
		
		$data['penjual'] = $this->m_penjual->m_by_id($this->session->userdata('id_admin'))[0];
		$data['eksepedisi'] = $this->m_ekspedisi->m_data();	

		$this->load->view('form_penjualan_penjual',$data);
	}

	public function lap_penjualan_penjual()
	{
		$id_penjual = $this->session->userdata('id_admin');
		$mulai = $this->input->get('mulai');
		$selesai = $this->input->get('selesai');
		$data['mulai'] = $mulai;
		$data['selesai'] = $selesai;
		$data['all'] = $this->m_barang->m_lap_penjualan_penjual($mulai,$selesai,$id_penjual);	
		$this->load->view('lap_penjualan_penjual',$data);
	
	}


	public function lap_penjualan_penjual_excel()
	{
		$mulai = $this->input->get('mulai');
		$selesai = $this->input->get('selesai');

		$file = "laporan_penjualan-$mulai-$selesai.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	

		$id_penjual = $this->session->userdata('id_admin');

		$data['mulai'] = $mulai;
		$data['selesai'] = $selesai;

		$data['all'] = $this->m_barang->m_lap_penjualan_penjual($mulai,$selesai,$id_penjual);	
		$this->load->view('lap_penjualan_xl',$data);
	}


	public function data()
	{
		$data['all'] = $this->m_penjual->m_data();	
		$this->load->view('data_penjual',$data);
	}

	public function json_penjual()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$data['all'] = $this->m_penjual->m_data();	
		echo json_encode($data['all']);
	}

	public function transaksi()
	{
		$data['all'] = $this->m_penjual->m_data();			
		$this->load->view('transaksi_penjual.php',$data);
	}

	public function jadikan_penjual($id_penjual)
	{
		$this->db->query("UPDATE tbl_penjual SET status='penjual' WHERE id_penjual='$id_penjual'");
	}
	public function trx_by_id($id_penjual)
	{		
		
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$data['all'] = $this->m_penjual->trx_by_pengguna($id_penjual);
		echo json_encode($data['all']);
	}

	public function simpan_trx()
	{
		$serialize = $this->input->post();
		$serialize['url_bukti'] = upload_file('url_bukti');

		//var_dump($serialize);
		$serialize['jumlah'] = hanya_nomor($serialize['jumlah']);
		$serialize['keterangan'] = $serialize['keterangan']." - A.n : ".$serialize['nama_penjual']." - ID :".$serialize['id_penjual'];

		unset($serialize['nama_penjual']);
		$this->m_penjual->insert_trx($serialize);

		$jumlah = $serialize['jumlah'];
		$id_penjual = $serialize['id_penjual'];
		if($serialize['id_group']=='17')
		{
			//tambah utang
			$this->db->query("UPDATE tbl_penjual SET saldo=saldo-$jumlah WHERE id_penjual='$id_penjual'");
		}

		if($serialize['id_group']=='18')
		{
			//bayar utang
			$this->db->query("UPDATE tbl_penjual SET saldo=saldo+$jumlah WHERE id_penjual='$id_penjual'");
		}

	}


	public function by_id($id_penjual)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_penjual->m_by_id($id_penjual);
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id_penjual = $this->input->post('id_penjual');		
		$serialize = $this->input->post();
		$serialize['tgl_daftar'] = date('Y-m-d H:i:s');
		if($id_penjual=='')
		{
			if($this->m_penjual->cek_email_user($serialize['email_penjual'])>0)
			{
				echo "2";
				die();
			}

			$this->m_penjual->insert($serialize);
			die('1');
		}else{

			$this->m_penjual->update($serialize,$id_penjual);
		}

	}

	public function hapus($id_penjual)
	{
		$this->db->query("DELETE FROM tbl_penjual WHERE id_penjual='$id_penjual'");
	}


}
