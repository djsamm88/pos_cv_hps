
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
          $sisa = $x->hutang-$x->terbayar;
          $total_hutang +=$x->hutang;

          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='detail_hutang(\"$x->id_penjual\")'>Detail</button>";
          
          $btn .= "<button class='btn btn-info btn-xs btn-block' onclick='form_bayar_hutang(\"$x->id_penjual\",\"$x->nama_penjual\",\"$sisa\",)'>Bayar</button>";
          
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
          <form id="form_bayar_hutang">
            <input type="" name="id_penjual" id="id_penjual" class="form-control" readonly="readonly" >            <br>
        
          <div class="col-sm-4">Kepada</div>
            <div class="col-sm-8">
                <input type="text" name="nama_penjual" id="nama_penjual" readonly class="form-control " placeholder="nama_penjual" >
            </div>
            <div style="clear: both;"></div><br>



          <div class="col-sm-4">Jumlah Bayar</div>
            <div class="col-sm-8"><input type="text" name="jumlah" id="jumlah" required="required" class="form-control nomor" placeholder="jumlah" ></div>
            <div style="clear: both;"></div><br>

        
        <div class="col-sm-4">keterangan</div>
            <div class="col-sm-8">
                <textarea type="text" name="keterangan" id="keterangan"  class="form-control " placeholder="keterangan" ></textarea>
            </div>
            <div style="clear: both;"></div><br>

            

            <div class="col-sm-4" style="text-align:right">Bukti</div>
            <div class="col-sm-8">
              <input class="form-control" name="url_bukti" id="url_bukti" type="file" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" required>
            </div>
            <div style="clear:both"></div><br>


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

hanya_nomor(".nomor");

$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});



function form_bayar_hutang(id_penjual,nama_penjual,hutang)
{
  $("#id_penjual").val(id_penjual);
  $("#nama_penjual").val(nama_penjual);
  $("#jumlah").val(hutang);
  $("#myModal").modal('show');
}



$("#form_bayar_hutang").on("submit",function(){
  var ser = $(this).serialize();

      $.ajax({
            url: "<?php echo base_url()?>index.php/barang/go_bayar_hutang",
            type: "POST",
            contentType: false,
            processData:false,
            data:  new FormData(this),
            beforeSend: function(){
                //alert("sedang uploading...");
            },
            success: function(e){
                console.log(e);
                $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();
                  setTimeout(function(){
                    eksekusi_controller('<?php echo base_url()?>index.php/barang/hutang_ke_penjual',document.title);
                  },3000);

                
            },
            error: function(er){
                $("#t4_info_form").html("<div class='alert alert-warning'>Ada masalah! "+er+"</div>");
            }           
       });

  return false;
})


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
  eksekusi_controller('<?php echo base_url()?>index.php/barang/hutang_ke_penjual?mulai='+mulai+'&selesai='+selesai+'&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Status Order');
});


</script>
