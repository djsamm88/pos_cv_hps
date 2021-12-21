<title><?php echo config_item('app_name')?></title>
<style>
html,body{
	margin:0px;
	padding:0px;
}
body,table{
	    text-transform: uppercase;
		font-size:8px;
		font-family:verdana;
}

font-size:10px;
</style>

<body onload='window.print();'>
<center>
	<?php //echo config_item('app_name')?>
	<?php echo config_item('app_client1')?>
	<br>
	<?php echo config_item('app_client2')?>
	<br>
	<?php echo config_item('app_client3')?>
	
</center>

<hr style="border-top: dotted 1px;" />
<?php $x=$data?>
<table>

<tr><td>group_trx</td> <td><?php echo $x[0]->group_trx?></td></tr>

<tr><td>nama_pelanggan</td> <td><?php echo $x[0]->nama_pelanggan?></td></tr>
<tr><td>hp_pembeli</td> <td><?php echo $x[0]->hp_pembeli?></td></tr>
<tr><td>alamat</td> <td><?php echo $x[0]->alamat?></td></tr>
<tr><td>keterangan</td> <td><?php echo $x[0]->keterangan?></td></tr>

</table>
<hr style="border-top: dotted 1px;" />
<center>Daftar Pinjam Barang</center>
<table class="table" width="100%">
<tr>
	<td>id</td>
	<td>Id Barang</td>
	<td>lama_pinjam</td>
	<td>tgl_mulai</td>
	<td>tgl_selesai</td>
	<td>harga_per_hari</td>
	<td>group_trx</td>
	<td>jumlah</td>
	<td>nama_barang</td>
	
	<td>sub_total</td>
	<td>status</td>
</tr>
<?php 
	$tot = 0;

	foreach ($data as $key ) 
	{
	
		echo "
				<tr>
					
					<td>$key->id</td>
					<td>$key->id_barang_pinjam</td>
					<td>$key->lama_pinjam</td>
					<td>$key->tgl_mulai</td>
					<td>$key->tgl_selesai</td>
					<td>$key->harga_per_bulan</td>
					<td>$key->group_trx</td>
					<td>$key->jumlah</td>
					<td>$key->nama_barang</td>
					
					<td>$key->sub_total</td>
					<td>$key->status</td>
					
				</tr>
		";

	}
	

?>
</table>
<hr style="border-top: dotted 1px;" />

<table>

<tr><td>lama_pinjam</td> <td><?php echo $x[0]->lama_pinjam?> Hari</td></tr>
<tr><td>tgl_mulai</td> <td><?php echo $x[0]->tgl_mulai?></td></tr>
<tr><td>tgl_selesai</td> <td><?php echo $x[0]->tgl_selesai?></td></tr>
<tr><td>harga_total</td> <td><?php echo rupiah($x[0]->harga_total)?></td></tr>
<tr><td>bayar</td> <td><?php echo rupiah($x[0]->bayar)?></td></tr>
<tr><td>hutang</td> <td><?php echo rupiah($x[0]->hutang)?></td></tr>
<tr><td>keterangan</td> <td><?php echo $x[0]->keterangan?></td></tr>

</table>

<hr style="border-top: dotted 1px;" />
<?php echo $data[0]->keterangan?>
<hr style="border-top: dotted 1px;" />
<center>
	Selamat Belanja!
</center>
</body>

<script type="text/javascript">
	setTimeout(function(){window.close();},100);
</script>