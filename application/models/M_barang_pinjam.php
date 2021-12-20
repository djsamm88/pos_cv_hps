<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_barang_pinjam extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}




	public function m_data_autocomplete($q=null)
	{
		
		
		if($q==null)
		{
			$where="";
		}else{
			
			$where="WHERE a.nama_barang LIKE '%$q%' OR a.code_barcode LIKE '%$q%'";
		}
		
		$q = $this->db->query("SELECT a.*,b.* FROM tbl_barang_pinjam a LEFT JOIN tbl_cabang b ON a.id_cabang=b.id_cabang $where");
		return $q->result();
	}





	public function m_status_barang_pinjam($id_cabang=null)
	{
		
		
		if($id_cabang==null)
		{
			$where="";
		}else{
			
			$where="WHERE a.id_cabang='$id_cabang'";
		}
		
		$q = $this->db->query("SELECT * FROM `tbl_barang_pinjam_trx` $where GROUP BY group_trx");
		return $q->result();
	}

	public function m_detail($group_trx)
	{
		$q = $this->db->query("SELECT * FROM `tbl_barang_pinjam_trx` WHERE group_trx='$group_trx'");
		return $q->result();	
	}

	public function m_data($id_cabang=null)
	{
		
		
		if($id_cabang==null)
		{
			$where="";
		}else{
			
			$where="WHERE a.id_cabang='$id_cabang'";
		}
		
		$q = $this->db->query("SELECT a.*,b.* FROM tbl_barang_pinjam a LEFT JOIN tbl_cabang b ON a.id_cabang=b.id_cabang $where");
		return $q->result();
	}

	

	public function m_by_id($id_barang_pinjam)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_barang_pinjam a 
									LEFT JOIN tbl_cabang b ON a.id_cabang=b.id_cabang
									WHERE a.id_barang_pinjam='$id_barang_pinjam'
							  ");
		return $q->result();
	}


	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_barang_pinjam');
	}

	public function update($serialize,$id_barang_pinjam)
	{
		$this->db->set($serialize);
		$this->db->where('id_barang_pinjam',$id_barang_pinjam);
		$this->db->update('tbl_barang_pinjam');
	}
}