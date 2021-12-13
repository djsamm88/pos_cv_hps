
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
          


<div class="table-responsive">              
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Penjual</th>                     
              <th>Hp Penjual</th>                                               
              <th>Hutang</th>                                               
              

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
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='detail_hutang(\"$x->id_penjual\")'>Detail</button>";
          
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                
                <td>$x->nama_penjual</td>                
                <td>$x->hp_penjual</td>                
                <td align=right>".rupiah($x->hutang)."</td>                
               
               
                <td>$btn</td>                                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>

       <tfoot>
        
          <tr>
          <td colspan="3" align="right"><b>Total Hutang</b></td>
          <td  align="right" >
            <b><?php echo rupiah($total_hutang)?></b>
          </td>
          <td></td>
        </tr>

      </tfoot>
       
  </table>
</div>

  
  <div id="t4_detail_hutang"></div>
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

    eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang/?mulai='+mulai+'&selesai='+selesai+'&id_cabang='+id_cabang,'Status Order');
  return false;
})

function detail_hutang(id_penjual)
{
  $.get("<?php echo base_url()?>index.php/barang/detail_hutang/"+id_penjual,function(e){
    $("#t4_detail_hutang").html(e);
  })
}


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
      alert("Berhasil.");
      var mulai="<?php echo date('Y-m-').'01'?>";
        var selesai="<?php echo date('Y-m-d',strtotime('+1 days'));?>";
  eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang?mulai='+mulai+'&selesai='+selesai+'&id_cabang='+id_cabang,'Status Order');
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
        var mulai="<?php echo date('Y-m-').'01'?>";
        var selesai="<?php echo date('Y-m-d',strtotime('+1 days'));?>";
  eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang?mulai='+mulai+'&selesai='+selesai+'&id_cabang='+id_cabang,'Status Order');
});


</script>
