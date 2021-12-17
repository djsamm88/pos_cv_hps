<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {
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
		$this->load->model('m_karyawan');
		$this->load->model('m_cabang');
		
	}


	public function data()
	{
		$data['all'] = $this->m_karyawan->m_data();	
		$this->load->view('data_karyawan',$data);
	}

	public function by_id($id)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_karyawan->m_by_id($id);
		echo json_encode($data['all']);
	}


	public function detail_hutang_karyawan($id_karyawan)
	{
		$data['all'] = $this->m_karyawan->hutang_by_karyawan($id_karyawan);
		$data['all_terbayar'] = $this->m_karyawan->hutang_terbayar_by_karyawan($id_karyawan);
		$data['id']=$id_karyawan;
		$this->load->view('detail_hutang_karyawan',$data);
	}

	public function detail_hutang_xl($id_karyawan)
	{
		$file="detail_hutang_karyawan.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	
		$data['all'] = $this->m_karyawan->hutang_by_karyawan($id_karyawan);
		$data['all_terbayar'] = $this->m_karyawan->hutang_terbayar_by_karyawan($id_karyawan);
		$data['id']=$id_karyawan;
		$this->load->view('detail_hutang_karyawan',$data);

	}

	public function go_bayar_hutang()
	{

		$serialize = $this->input->post();

		$data['id_referensi'] = $serialize['id'];
		$data['jumlah'] = hanya_nomor($serialize['jumlah']);
		$data['url_bukti'] = upload_file('url_bukti');
		$data['keterangan'] = $serialize['keterangan'] . " - Dari: ". $serialize['nama'];
		$data['id_group'] = 21;// pembayaran ke suplier
		$data['id_cabang'] = $this->session->userdata('id_cabang');

		$this->db->set($data);
		$this->db->insert('tbl_transaksi');
		$id_ret = $this->db->insert_id();
		
	}

	public function simpan()
	{
		$id = $this->input->post('id');		
		$serialize = $this->input->post();
		

		if($id=='')
		{
			$this->m_karyawan->insert($serialize);
			die('1');
		}else{

			$this->m_karyawan->update($serialize,$id);
		}

	}

	public function hapus($id)
	{
		$this->db->query("DELETE FROM tbl_karyawan WHERE id='$id'");
	}


}
