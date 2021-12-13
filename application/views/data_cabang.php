
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di Sistem Informasi 
        
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
          <h3 class="box-title">Aplikasi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              <button class="btn btn-primary" id="tambah_data"  onclick="tambah_cabang()">Tambah Data</button> 
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th>Kode Cabang</th>
              <th>nama_cabang</th>
              <th>alamat</th>
              <th>tgl</th>
              <th>Action</th>
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all_cabang as $x)
        {
          $btn = $x->id_cabang=='1'?"<button class='btn btn-warning btn-xs' onclick='edit_cabang($x->id_cabang);return false;'>Edit</button>
                  ":"<button class='btn btn-warning btn-xs' onclick='edit_cabang($x->id_cabang);return false;'>Edit</button>
                  <button class='btn btn-danger btn-xs' onclick='hapus_cabang($x->id_cabang);return false;'>Hapus</button>    ";
          $no++;


            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->kode_cabang</td>
                <td>$x->nama_cabang</td>
                <td>$x->alamat</td>
                <td>$x->tgl</td>
                
                <td>
                  $btn
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


        </div>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah cabang</h4>
      </div>
      <div class="modal-body">
          <form id="form_tambah_cabang">
            <input type="hidden" name="id_cabang" id="id_cabang" class="form-control" readonly="readonly">
            


            <div class="col-sm-4">Nama Cabang</div>
            <div class="col-sm-8"><input type="text" class="form-control" id="nama_cabang" name="nama_cabang"></div>
            <div style="clear: both;"></div><br>

            <div class="col-sm-4">Alamat</div>
            <div class="col-sm-8"><input type="text" class="form-control" id="alamat" name="alamat"></div>
            <div style="clear: both;"></div><br>



            <div id="t4_info_form"></div>
            <button type="submit" class="btn btn-primary"> Simpan </button>
          </form>

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})


$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});

function edit_cabang(id_cabang)
{
  $.get("<?php echo base_url()?>index.php/cabang/data_cabang_by_id/"+id_cabang,function(e){
    //console.log(e[0].id_desa);
    $("#id_cabang").val(e[0].id_cabang);
    $("#nama_cabang").val(e[0].nama_cabang);
    $("#alamat").val(e[0].alamat);
    $("#tgl").val(e[0].tgl);



  })
  $("#myModal").modal('show');
}

function tambah_cabang()
{
  
  $("#myModal").modal('show');
}

function hapus_cabang(id_cabang)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/cabang/hapus_cabang_by_id/"+id_cabang,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/cabang/data_cabang');
    })  
  }
  
}

$("#form_tambah_cabang").on("submit",function(){
  $("#t4_info_form").html('Loading...');
  if($("#pass_cabang").val() != $("#conf_pass_cabang").val())
  {
    
    $("#t4_info_form").html("<div class='alert alert-warning'>Password dan Confirm Password tidak sama.</div>").fadeIn().delay(3000).fadeOut();
    return false;
  }

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/cabang/simpan_form",ser,function(x){
    console.log(x);
    if(x==0)
    {
      $("#t4_info_form").html("<div class='alert alert-warning'>Email atau Username sudah digunakan.</div>").fadeIn().delay(3000).fadeOut();
    }else if(x=='1')
    {
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    }
  })

  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/cabang/data_cabang','Data cabang');
});
</script>
