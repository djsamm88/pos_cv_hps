Detail Hutang:
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Pelanggan</th>                     
              <th>HP Pelanggan</th>                     
              <th>group_trx </th>                     
              <th>tgl </th>                     
              <th>total </th>                     
                                   
              
              

              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total_hutang=0;         
        $no = 0;
        foreach($all as $x)
        {
          
          $total_hutang +=$x->hutang;
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$x->nama_pembeli</td>                
                <td>$x->hp_pembeli</td>                
                <td>$x->group_trx</td>                
                <td>$x->tgl_update</td>                                
                <td align=right>".rupiah($x->hutang)."</td>                
                
                 <td><a href='".base_url()."index.php/barang/struk_penjualan/$x->group_trx' target='blank' class='btn btn-xs btn-primary'>Bukti</a></td>                             
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>

       <tfoot>
        
          <tr>
          <td colspan="5" align="right"><b>Total Hutang</b></td>
          <td  align="right" >
            <b><?php echo rupiah($total_hutang)?></b>
          </td>
          <td></td>
        </tr>

      </tfoot>
       
  </table>

<br><hr>

Detail Hutang Pinjam Barang:
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Pelanggan</th>                     
              <th>HP Pelanggan</th>                     
              <th>group_trx </th>                     
              <th>tgl </th>                     
              <th>total </th>                     
                                   
              
              

              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total_hutang_pinjam=0;         
        $no = 0;
        foreach($all_hutang_pinjam as $z)
        {
          
          $total_hutang_pinjam +=$z->hutang;
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$z->nama_pelanggan</td>                
                <td>$z->hp_pembeli</td>                
                <td>$z->group_trx</td>                
                <td>$z->tgl_update</td>                                
                <td align=right>".rupiah($z->hutang)."</td>                
                
                 <td><a href='".base_url()."index.php/barang_pinjam/struk_pinjam/$z->group_trx' target='blank' class='btn btn-xs btn-primary'>Bukti</a></td>                             
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>

       <tfoot>
        
          <tr>
          <td colspan="5" align="right"><b>Total Hutang</b></td>
          <td  align="right" >
            <b><?php echo rupiah($total_hutang_pinjam)?></b>
          </td>
          <td></td>
        </tr>

      </tfoot>
       
  </table>

<br><hr>
Detail Terbayar:

<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Pelanggan</th>                     
              <th>HP Pelanggan</th>                     
                                
              <th>tgl </th>                     
              <th>Terbayar </th>                     
              
              

              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total_terbayar=0;         
        $no = 0;
        foreach($all_terbayar as $y)
        {
          
          $total_terbayar +=$y->terbayar;
          $no++;
            
          if($y->url_bukti=="")
          {
            $btn = "DP";
          }else{
            $btn = "<a href='".base_url()."uploads/$y->url_bukti' target='blank' class='btn btn-xs btn-primary'>Bukti</a>";
          }

            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$y->nama_pembeli</td>                
                <td>$y->hp_pembeli</td>                                            
                <td>$y->tgl_update</td>                                
                <td align=right>".rupiah($y->terbayar)."</td>                
                
                <td>$btn</td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>

       <tfoot>
        
          <tr>
          <td colspan="4" align="right"><b>Total Terbayar</b></td>
          <td  align="right" >
            <b><?php echo rupiah($total_terbayar)?></b>
          </td>
          <td></td>
        </tr>

      </tfoot>
       
  </table>


<table class="table">
  <tr><td>Total Hutang </td><td align="right"><?php echo rupiah(($total_hutang_pinjam+$total_hutang))?></td></tr>
  <tr><td>Total Terbayar </td><td align="right"><?php echo rupiah($total_terbayar)?></td></tr>
  <tr><td> - </td><td align="right"><?php echo rupiah(($total_hutang_pinjam+$total_hutang)-$total_terbayar)?></td></tr>
</table>


          <a href="<?php echo base_url()?>index.php/pelanggan/detail_hutang_pelanggan_xl/<?php echo $id_pelanggan?>" target="blank" class="btn btn-primary" > Download </a>


<script type="text/javascript">
    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
</script>
