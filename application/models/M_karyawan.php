<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_karyawan extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}




	public function m_data($id_cabang=null)
	{
		
		
		if($id_cabang==null)
		{
			$where="";
		}else{
			
			$where="WHERE a.id_cabang='$id_cabang'";
		}
		
		$q = $this->db->query("SELECT 	
										a.*,
										b.*,
										c.hutang,
										d.terbayar 
										FROM tbl_karyawan a 
										LEFT JOIN tbl_cabang b ON a.id_cabang=b.id_cabang 
										LEFT JOIN (
											SELECT SUM(jumlah) as hutang,id_karyawan FROM `tbl_pengeluaran_bulanan_transaksi` WHERE nama_pengeluaran='Hutang Karyawan' GROUP BY id_karyawan
											)c ON a.id=c.id_karyawan
										LEFT JOIN (
											SELECT SUM(jumlah) AS terbayar,id_referensi AS id_karyawan,tgl_update FROM tbl_transaksi WHERE id_group=21 GROUP BY id_referensi												
										)d ON a.id=d.id_karyawan
										$where
								");
		return $q->result();
	}

	public function hutang_by_karyawan($id)
	{
		
		
		$where="WHERE a.id='$id'";
	
		
		$q = $this->db->query("SELECT 	
										a.*,
										b.*,
										c.* 
										FROM tbl_karyawan a 
										LEFT JOIN tbl_cabang b ON a.id_cabang=b.id_cabang 
										LEFT JOIN (
											SELECT (jumlah) as hutang,id_karyawan,tgl_update AS tgl_trx, nama_pengeluaran,url_bukti,keterangan,id AS id_trx FROM `tbl_pengeluaran_bulanan_transaksi` WHERE nama_pengeluaran='Hutang Karyawan' 
											)c ON a.id=c.id_karyawan
										$where
								");
		return $q->result();
	}


	public function hutang_terbayar_by_karyawan($id_karyawan)
	{
		$q = $this->db->query("SELECT 
								a.jumlah AS terbayar,
								a.id_referensi AS id_karyawan,
								a.tgl_update ,
								b.nama,								
								b.jabatan,								
								a.url_bukti
								FROM `tbl_transaksi` a 
								LEFT JOIN tbl_karyawan b ON a.id_referensi=b.id
								WHERE id_group=21 AND id_referensi='$id_karyawan'");
		return $q->result();
	}



	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_karyawan a 
									LEFT JOIN tbl_cabang b ON a.id_cabang=b.id_cabang
									WHERE a.id='$id'
							  ");
		return $q->result();
	}


	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_karyawan');
	}

	public function update($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('tbl_karyawan');
	}
}