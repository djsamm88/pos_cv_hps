Mulai <?php echo $mulai?> s.d <?php echo $selesai?>         
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Barang</th>                     
              <th>Kepada</th>                                             
              <th>Jumlah</th>                                               
              <th>Harga</th>                                               
              <th>Kode Trx.</th>                     
              
              <th>Kasir</th>                     
              <th>Tanggal</th>                                               
                           
              <th>Struk</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total_all=0;         
        $no = 0;
        foreach($all as $x)
        {
          //$total = $x->total-$x->saldo-$x->diskon+($x->harga_ekspedisi+$x->transport_ke_ekspedisi);
          //$total_all+=$total;
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                <td>$x->nama_barang - $x->id_barang</td>                                
                <td>$x->nama_pembeli -[$x->id_pelanggan]</td>                                        
                <td>".($x->qty_jual)."</td>
                <td>".rupiah($x->harga_jual)."</td>
                <td>$x->grup_penjualan</td>                
                
                <td>".($x->nama_admin)." <br>".($x->email_admin)."</td>
                <td>".($x->tgl_transaksi)."</td>
                                
                <td><a href='".base_url()."index.php/barang/struk_penjualan/".$x->grup_penjualan."' target='blank'>Print</a></td>                                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       
  </table>
