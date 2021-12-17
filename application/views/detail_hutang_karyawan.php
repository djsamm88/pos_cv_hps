Detail Hutang:
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Id </th>                     
              <th>Nama </th>                     
                        
              <th>Pengeluaran </th>                     
              <th>Keterangan </th>                     
              <th>tgl </th>                     
              <th>Jumlah</th>           
                                  
                                   
              
              

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
            $btn = "<a href='".base_url()."uploads/$x->url_bukti' target='blank' class='btn btn-xs btn-primary'>Bukti</a>";
            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$x->id</td>                
                <td>$x->nama</td>                
                              
                <td>$x->nama_pengeluaran</td>                
                <td>$x->keterangan</td>                
                <td>$x->tgl_trx</td>                
                <td align=right>".rupiah($x->hutang)."</td>  
                
                
                 <td>$btn</td>                             
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>

       <tfoot>
        
          <tr>
          <td colspan="6" align="right"><b>Total Hutang</b></td>
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
              <th>Nama </th>                     
              <th>Jabatan </th>                     
                                
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
                
                <td>$y->nama</td>                
                <td>$y->jabatan</td>                                            
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
  <tr><td>Total Hutang </td><td align="right"><?php echo rupiah($total_hutang)?></td></tr>
  <tr><td>Total Terbayar </td><td align="right"><?php echo rupiah($total_terbayar)?></td></tr>
  <tr><td> - </td><td align="right"><?php echo rupiah($total_hutang-$total_terbayar)?></td></tr>
</table>


          <a href="<?php echo base_url()?>index.php/karyawan/detail_hutang_xl/<?php echo $id?>" target="blank" class="btn btn-primary" > Download </a>
