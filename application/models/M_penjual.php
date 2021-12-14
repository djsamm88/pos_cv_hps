<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class M_penjual extends CI_Model {
		
	function __construct() {
		parent::__construct();
	
		$this->load->helper('custom_func');
	}



	public function cek_email_user($email)
	{
		$query = $this->db->query("SELECT * FROM tbl_penjual WHERE email_penjual='$email'");
		return $query->num_rows();
	}

	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_penjual a ");
		return $q->result();
	}

	public function hutang_all()
	{
		$q = $this->db->query("SELECT 
										a.id_penjual,
										a.nama_penjual,
										a.hp_penjual,
										SUM(a.hutang) as hutang,
										b.terbayar



								FROM (
										SELECT * 
											FROM tbl_pembelian_barang 
											WHERE hutang > 0
											GROUP BY group_trx
									) a 
								LEFT JOIN (
										SELECT SUM(jumlah) AS terbayar,id_referensi AS id_penjual,tgl_update FROM `tbl_transaksi` WHERE id_group=17 GROUP BY id_penjual
									)b ON a.id_penjual=b.id_penjual
								 GROUP BY id_penjual
							");
		return $q->result();
	}


	

	public function hutang_by_penjual($id_penjual)
	{
		$q = $this->db->query("SELECT * FROM `tbl_pembelian_barang` WHERE hutang > 0 AND id_penjual='$id_penjual' GROUP BY group_trx");
		return $q->result();
	}

	public function hutang_terbayar_by_penjual($id_penjual)
	{
		$q = $this->db->query("SELECT 
								a.jumlah AS terbayar,
								a.id_referensi AS id_penjual,
								a.tgl_update ,
								b.nama_penjual,
								b.hp_penjual,
								a.url_bukti
								FROM `tbl_transaksi` a 
								LEFT JOIN tbl_penjual b ON a.id_referensi=b.id_penjual
								WHERE id_group=17 AND id_penjual='$id_penjual'");
		return $q->result();
	}


	public function m_data_autocomplete($cari)
	{
		$q = $this->db->query("SELECT a.* FROM tbl_penjual a WHERE nama_penjual LIKE '%$cari%'");
		return $q->result();
	}
	

	public function m_by_id($id_penjual)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_penjual a 
									
									WHERE a.id_penjual='$id_penjual'
							  ");
		return $q->result();
	}

	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_penjual');
		return $this->db->insert_id();
	}

	public function update($serialize,$id_penjual)
	{
		$this->db->set($serialize);
		$this->db->where('id_penjual',$id_penjual);
		$this->db->update('tbl_penjual');
	}




	public function trx_by_pengguna($id_penjual)
	{
		$q = $this->db->query("SELECT * FROM `tbl_transaksi` WHERE id_group='8' AND id_penjual='$id_penjual'");
		return $q->result();
	}

	public function insert_trx($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_transaksi');
		return $this->db->insert_id();
	}


}