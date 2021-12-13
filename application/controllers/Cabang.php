<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {
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
		$this->load->model('m_cabang');

		
	}


	public function data_cabang()
	{
		$data['all_cabang'] = $this->m_cabang->m_data_cabang();	
		$this->load->view('data_cabang',$data);
	}

	public function data_cabang_by_id($id_cabang)
	{
		header('Content-Type: application/json');
		$data['all_cabang'] = $this->m_cabang->m_data_cabang_by_id($id_cabang);
		echo json_encode($data['all_cabang']);
	}

	public function data_desa()
	{
		header('Content-Type: application/json');
		$data['all_desa'] = $this->m_cabang->m_data_desa();
		echo json_encode($data['all_desa']);
	}


	public function simpan_form()
	{
		$id_cabang = $this->input->post('id_cabang');		

		$serialize = $this->input->post();

		//var_dump($serialize["user_cabang"]);



		if($id_cabang=='')
		{
			$serialize['kode_cabang'] = $this->m_cabang->kode_cabang();

			$this->m_cabang->tambah_cabang($serialize);
			die('1');
		}else{
			$kode_cabang_angka = sprintf("%03d", $id_cabang);
			$kode_cabang = "CAB".$kode_cabang_angka;
			$serialize['kode_cabang'] = $kode_cabang;

				$this->m_cabang->update_cabang($serialize,$id_cabang);
				die('1');
			}


		
		
		

	}

	public function hapus_cabang_by_id($id_cabang)
	{
		$this->db->query("DELETE FROM tbl_cabang WHERE id_cabang='$id_cabang'");
	}


}
