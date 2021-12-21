Detail Hutang:
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Penjual</th>                     
              <th>HP Penjual</th>                     
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
          
          $total_hutang +=$x->total;
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$x->nama_penjual</td>                
                <td>$x->hp_penjual</td>                
                <td>$x->group_trx</td>                
                <td>".tanggalindo($x->tgl)."</td>                                
                <td align=right>".rupiah($x->total)."</td>                
                
                 <td><a href='".base_url()."index.php/barang/print_pembelian/?group_trx=$x->group_trx' target='blank' class='btn btn-xs btn-primary'>Bukti</a></td>                             
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
Detail Terbayar:

<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Penjual</th>                     
              <th>HP Penjual</th>                     
                                
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
                
                <td>$y->nama_penjual</td>                
                <td>$y->hp_penjual</td>                                            
                <td>".tanggalindo($y->tgl_update)."</td>                                
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
  <tr><td>Total Hutang </td><td align="right"><?php echo rupiah($total_hutang)?></td></tr>
  <tr><td>Total Terbayar </td><td align="right"><?php echo rupiah($total_terbayar)?></td></tr>
  <tr><td> - </td><td align="right"><?php echo rupiah($total_hutang-$total_terbayar)?></td></tr>
</table>


          <a href="<?php echo base_url()?>index.php/barang/detail_hutang_xl/<?php echo $id_penjual?>" target="blank" class="btn btn-primary" > Download </a>


<script type="text/javascript">
    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
</script>