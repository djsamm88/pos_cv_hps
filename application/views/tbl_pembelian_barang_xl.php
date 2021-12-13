           
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Penjual</th>                     
              <th>Hp Suplier</th>                                               
              <th>Kode Trx.</th>                     
              <th>Total</th>                     
              <th>Bayar</th>                     
              <th>Hutang</th>                     
              
              <th>Tgl Trx.</th>                     
              <th>Update Trx.</th>                     
              <th>Status.</th>                     
              <th>Sopir.</th>                     
              <th>Plat Mobil.</th>                     
              <th>Keterangan</th>                     
              <th>Admin</th>                     
              
              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total_all=0;         
        $no = 0;
        foreach($all as $x)
        {
          
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='print_pembelian(\"$x->grup_trx\")'>Detail</button>";
          
          if($x->status=='Mulai')
          {
            $btn .= "<button class='btn btn-danger btn-xs btn-block' onclick='update_pembelian(\"$x->grup_trx\")'>Update Status</button>";
            
          }

          if($x->status=='Gudang')
          {
          
            $btn .= "<button class='btn btn-info btn-xs btn-block' onclick='selesai_pembelian(\"$x->grup_trx\")'>Set Selesai</button>";
          }
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$x->nama_penjual</td>                
                <td>$x->hp_penjual</td>                
                <td>$x->grup_trx</td>                
                <td>".rupiah($x->total)."</td>                
                <td>".rupiah($x->bayar)."</td>                
                <td>".rupiah($x->hutang)."</td>                
                <td>$x->tgl</td>                
                <td>$x->tgl_update</td>                
                <td>$x->status</td>                
                <td>$x->nama_supir</td>                
                <td>$x->plat_mobil</td>                
                <td>$x->keterangan</td>                
                <td>$x->nama_admin</td>

                <td>$btn</td>                                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       
  </table>
