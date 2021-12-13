
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di POS
        <small></small>
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content container-fluid" >

      <!--------------------------
        | Your Page Content Here |
        -------------------------->    
<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" id="judul2"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="alert alert-info">
          <form id="go_trx_jurnal">
              
              <div class="col-sm-3">
                  <input type="text" class="form-control datepicker" name="mulai" id="mulai"  value="<?php echo $mulai ?>" autocomplete="off">
              </div>
              <div class="col-sm-3">
                <input type="text" class="form-control datepicker" name="selesai" id="selesai"  value="<?php echo $selesai ?>" autocomplete="off">
              </div>

              <div class="col-sm-3">
                <select name="id_cabang" id="id_cabang" class="form-control">
                  <option value=""> --- pilih Cabang --- </option>
                  <?php 
                    $data_cabang = $this->m_cabang->m_data_cabang();
                    foreach($data_cabang as $cabang)
                    {
                      if($cabang->id_cabang==$this->session->userdata('id_cabang'))
                      {
                        $sel="selected";
                      }else{
                        $sel="";
                      }
                      echo "
                        <option value='$cabang->id_cabang' $sel>$cabang->kode_cabang - $cabang->nama_cabang</option>
                      ";
                    }
                  ?>                  
              </select>
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary btn-block" value="Go">
              </div>
          
          </form>          
          <div style="clear: both"></div>
          </div>

<div class="table-responsive">              
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
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
          
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='print_pembelian(\"$x->group_trx\")'>Detail</button>";
          
          if($x->status=='Mulai')
          {
            $btn .= "<button class='btn btn-danger btn-xs btn-block' onclick='update_pembelian(\"$x->group_trx\")'>Update Status</button>";
            
          }

          if($x->status=='Gudang')
          {
          
            $btn .= "<button class='btn btn-info btn-xs btn-block' onclick='selesai_pembelian(\"$x->group_trx\")'>Set Selesai</button>";
          }
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$x->nama_penjual</td>                
                <td>$x->hp_penjual</td>                
                <td>$x->group_trx</td>                
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
</div>


        </div>






<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Data</h4>
      </div>
      <div class="modal-body">
          <form id="form_update_status">
            <input type="hidden" name="group_trx" id="group_trx" class="form-control" readonly="readonly" >            

            <div class="col-sm-4">Posisi Barang</div>
            <div class="col-sm-8">
              <select name="status" id="status" required="required" class="form-control" placeholder="status">
                <option value="Gudang">Gudang</option>
              </select>
            </div>
            <div style="clear: both;"></div><br>
        
        <div class="col-sm-4">Sopir</div>
            <div class="col-sm-8"><input type="text" name="nama_supir" id="nama_supir" required="required" class="form-control " placeholder="nama_supir" ></div>
            <div style="clear: both;"></div><br>

          <div class="col-sm-4">Plat Mobil</div>
            <div class="col-sm-8"><input type="text" name="plat_mobil" id="plat_mobil" required="required" class="form-control " placeholder="plat_mobil" ></div>
            <div style="clear: both;"></div><br>

        
        

            <div id="t4_info_form"></div>
            <button type="submit" class="btn btn-primary" id="simpan_btn"> Simpan </button>
          </form>

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



        <input type="button" class="btn btn-primary" value="Download" id="download_pdf">

      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<script>
console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})


$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});

$("#go_trx_jurnal").on("submit",function(){
    var mulai   = $("#mulai").val();
    var selesai  = $("#selesai").val();
    var id_cabang  = $("#id_cabang").val();
    if( (new Date(mulai).getTime() > new Date(selesai).getTime()))
    {
      alert("Perhatikan pengisian tanggal. Ada yang salah.");
      return false;
    }

    eksekusi_controller('<?php echo base_url()?>index.php/barang/history_tbl_pembelian_barang/?mulai='+mulai+'&selesai='+selesai+'&id_cabang='+id_cabang,'Status Order');
  return false;
})

function print_pembelian(group_trx)
{
  var url="<?php echo base_url()?>index.php/barang/print_pembelian/?group_trx="+group_trx;
  window.open(url);
}

function update_pembelian(group_trx)
{
  
  //var url="<?php echo base_url()?>index.php/barang/update_pembelian/?group_trx="+group_trx;
  //window.open(url);
  $("#group_trx").val(group_trx);
  $("#myModal").modal('show');
}

$("#form_update_status").on("submit",function(){
  var ser = $(this).serialize();
  if(confirm("Anda yakin?"))
  {
    $.post("<?php echo base_url()?>index.php/barang/update_status_order",ser,function(){
      $("#t4_info_form").html("Berhasil di update!");
      $("#simpan_btn").hide();
    })  
  }
  
  return false;
})

 
function selesai_pembelian(group_trx)
{
  if(confirm("Anda yakin selesai? Sudah cek semua barang?"))
  {
    $.post("<?php echo base_url()?>index.php/barang/selesai_status_order/"+group_trx,function(x){
      console.log(x);
      alert("Berhasil.")
    })  
  }
  
  return false;
}

$("#download_pdf").on("click",function(){
  var ser = $("#go_trx_jurnal").serialize();
  var url="<?php echo base_url()?>index.php/barang/tbl_pembelian_barang_xl/?"+ser;
  window.open(url);

  return false;
})

$(document).ready(function(){

  //$('#tbl_datanya_barang').dataTable();

});
$("#judul2").html("DataTable "+document.title);

$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang_history',document.title);
});


</script>
