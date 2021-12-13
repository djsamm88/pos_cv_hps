
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Penjual</th>                     
              <th>HP Penjual</th>                     
              <th>group_trx </th>                     
              <th>tgl </th>                     
              <th>total </th>                     
              <th>bayar </th>                     
              <th>hutang </th>                     
              
              

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
                
                <td>$x->nama_penjual</td>                
                <td>$x->hp_penjual</td>                
                <td>$x->group_trx</td>                
                <td>$x->tgl</td>                                
                <td align=right>".rupiah($x->total)."</td>                
                <td align=right>".rupiah($x->bayar)."</td>                
                <td align=right>".rupiah($x->hutang)."</td>                
                
                                             
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>

       <tfoot>
        
          <tr>
          <td colspan="7" align="right"><b>Total Hutang</b></td>
          <td  align="right" >
            <b><?php echo rupiah($total_hutang)?></b>
          </td>
          <td></td>
        </tr>

      </tfoot>
       
  </table>

          <input type="button" class="btn btn-primary" value="Download" id="download_pdf">
