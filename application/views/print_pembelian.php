<link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<style>
body{
  font-size: 12px;
}

table tr td, th  { 
  
  font-size: 12px; padding:5px;
  

}
table th{
      text-align: center;
      
    }

td {
      
      padding:5px;
      
    }


</style>

    
    <div class="text-center" style="font-weight:bold;font-size: 14">      
        SLIP ORDER BARANG (PRE ORDER)                       
    </div>
    <br>


<table class="table table-bordered">
	<tr>
		<td width="30%">Nama Penjual</td><td><?php echo $trx[0]->nama_penjual?></td>
	</tr><tr>
		<td>No.HP</td><td><?php echo $trx[0]->hp_penjual?></td>
	</tr><tr>
		<td>Alamat</td><td><?php echo $trx[0]->alamat?></td>
	</tr><tr>
    <td>Tgl Trx</td><td><?php echo $trx[0]->tgl?></td>
  </tr><tr>  
    <td>Admin</td><td><?php echo $trx[0]->nama_admin?></td>    
  </tr><tr>  
    
    <td>Keterangan</td><td><?php echo $trx[0]->keterangan?></td>
    
  </tr>
</table>

<div class="text-center" style="font-weight:bold;font-size: 14">
      
        DETAIL PEMBELIAN BARANG                        

    <br>
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th width="10px">No</th>                    
              <th>Barang</th>                                   
              <th>Qty</th>   
              <th>Satuan</th>   
              <th>Harga</th>   
              <th>sub_total</th>   
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($trx as $h)
        {
          
          $no++;
            
            echo ("               
              <tr>
                <td>$no</td>                
                <td>$h->nama_barang</td>                                
                <td>$h->jumlah</td>                
                <td>$h->satuan</td>                
                <td align=right>".rupiah($h->harga)."</td>                
                <td align=right>".rupiah($h->sub_total)."</td>                
                         
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>

      <tfoot>
        
          <tr>
          <td colspan="5" align="right"><b>Total</b></td>
          <td  align="right" >
            <?php echo rupiah($trx[0]->total)?>
          </td>
          <td></td>
        </tr>


          <tr>
          <td colspan="5" align="right"><b>Bayar</b></td>
          <td  align="right" >
            <?php echo rupiah($trx[0]->bayar)?>
          </td>
          <td></td>
        </tr>


          <tr>
          <td colspan="5" align="right"><b>Hutang</b></td>
          <td  align="right" >
            <b><?php echo rupiah($trx[0]->hutang)?></b>
          </td>
          <td></td>
        </tr>

      </tfoot>
  </table>


