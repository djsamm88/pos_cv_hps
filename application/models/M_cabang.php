<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_cabang extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}

	public function kode_cabang()
	{
		$q = $this->db->query("SELECT id_cabang FROM tbl_cabang ORDER BY id_cabang DESC LIMIT 1");
		
		$a = $q->result();
		$b = @$a[0]->id_cabang;

		if($b==0)
		{
			$kode_cabang = "TAM001";
		}else{
			$angka_terakhir = $b;
			$int_angka = $angka_terakhir+1;
			$kode_cabang_angka = sprintf("%03d", $int_angka);
			$kode_cabang = "TAM".$kode_cabang_angka;
		}

		return $kode_cabang;
	}

 
	public function m_data_cabang()
	{
		$id_cabang 	= $this->session->userdata('id_cabang');
		$id_admin 	= $this->session->userdata('id_admin');

		if($id_cabang=='1')
		{
			$where='';
		}else{
			$where=" WHERE a.id_cabang='$id_cabang'";
		}

		$q = $this->db->query("SELECT a.* FROM tbl_cabang a $where");
		return $q->result();
	}


	public function m_data_cabang_by_id($id_cabang)
	{
		$id_cabang = preg_replace('/\D/', '', $id_cabang);
		
		$id_cabang = $id_cabang*1;
		$q = $this->db->query("SELECT a.*
									FROM tbl_cabang a 
									
									WHERE a.id_cabang='$id_cabang'
							  ");
		return $q->result();
	}

 
	public function cek_email_user($user,$email)
	{
		$query = $this->db->query("SELECT * FROM tbl_cabang WHERE user_cabang='$user' OR email_cabang='$email'");
		return $query->num_rows();
	}


	public function tambah_cabang($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_cabang');
	}

	public function cek_pass($id_cabang)
	{
		$query = $this->db->query("SELECT pass_cabang FROM tbl_cabang WHERE id_cabang='$id_cabang'");
		$x = $query->result();
		return $x[0]->pass_cabang;
	}
	


	public function update_cabang($serialize,$id_cabang)
	{
		$this->db->set($serialize);
		$this->db->where('id_cabang',$id_cabang);
		$this->db->update('tbl_cabang');
	}

	public function m_data_desa()
	{
		$q = $this->db->query("SELECT a.*,b.id AS id_kecamatan,b.kecamatan FROM tbl_desa a LEFT JOIN tbl_kecamatan b ON a.id_kecamatan=b.id");
		return $q->result();
	}
}