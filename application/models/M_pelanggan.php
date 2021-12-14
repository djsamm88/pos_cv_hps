<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class M_pelanggan extends CI_Model {
		
	function __construct() {
		parent::__construct();
	
		$this->load->helper('custom_func');
	}



	public function cek_email_user($email)
	{
		$query = $this->db->query("SELECT * FROM tbl_pelanggan WHERE email_pembeli='$email'");
		return $query->num_rows();
	}

	public function m_data()
	{
		$q = $this->db->query("SELECT a.*,b.hutang,c.terbayar
								FROM tbl_pelanggan a 
									LEFT JOIN(
										SELECT SUM(hutang) as hutang,id_pelanggan FROM tbl_transaksi 										 WHERE id_pelanggan<>0 GROUP BY id_pelanggan
									    )b ON a.id_pelanggan=b.id_pelanggan
									LEFT JOIN (

										SELECT SUM(jumlah) AS terbayar,id_referensi AS id_pelanggan,tgl_update FROM tbl_transaksi WHERE id_group=18 GROUP BY id_referensi
											
									)c ON a.id_pelanggan=c.id_pelanggan
			");
		return $q->result();
	}



	public function hutang_by_pelanggan($id_pelanggan)
	{
		$q = $this->db->query("SELECT a.*,b.nama_pembeli,b.hp_pembeli,a.id_referensi AS group_trx FROM `tbl_transaksi` a 
										LEFT JOIN tbl_pelanggan b ON a.id_pelanggan=b.id_pelanggan
									WHERE a.hutang > 0 AND a.id_pelanggan='$id_pelanggan' ");
		return $q->result();
	}


	public function hutang_terbayar_by_pelanggan($id_pelanggan)
	{
		$q = $this->db->query("SELECT 
								a.jumlah AS terbayar,
								a.id_referensi AS id_pelanggan,
								a.tgl_update ,
								b.nama_pembeli,
								b.hp_pembeli,
								a.url_bukti
								FROM `tbl_transaksi` a 
								LEFT JOIN tbl_pelanggan b ON a.id_referensi=b.id_pelanggan
								WHERE id_group=18 AND id_referensi='$id_pelanggan'");
		return $q->result();
	}


	public function m_data_autocomplete($cari)
	{
		$q = $this->db->query("SELECT a.* FROM tbl_pelanggan a WHERE nama_pembeli LIKE '%$cari%'");
		return $q->result();
	}
	

	public function m_by_id($id_pelanggan)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_pelanggan a 
									
									WHERE a.id_pelanggan='$id_pelanggan'
							  ");
		return $q->result();
	}

	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_pelanggan');
		return $this->db->insert_id();
	}

	public function update($serialize,$id_pelanggan)
	{
		$this->db->set($serialize);
		$this->db->where('id_pelanggan',$id_pelanggan);
		$this->db->update('tbl_pelanggan');
	}




	public function trx_by_pengguna($id_pelanggan)
	{
		$q = $this->db->query("SELECT * FROM `tbl_transaksi` WHERE id_group='8' AND id_pelanggan='$id_pelanggan'");
		return $q->result();
	}

	public function insert_trx($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_transaksi');
		return $this->db->insert_id();
	}


}