
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        
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
          <h3 class="box-title">Data</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              <button class="btn btn-primary" id="tambah_data"  onclick="tambah_admin()">Tambah Data</button> 

<div class="table-responsive">
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">id_penjual</th>
                <th>nama_penjual</th>
                <th>email_penjual</th>
                <th>alamat</th>
                <th>hp_penjual</th>
                <th>tgl_daftar</th>
                <th>tgl_trx_terakhir</th>
                <th>saldo</th>
                
              <th>Action</th>
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='edit_admin($x->id_penjual);return false;'>Edit</button>
                  <button class='btn btn-danger btn-xs btn-block' onclick='hapus_admin($x->id_penjual);return false;'>Hapus</button>    ";

          
          $no++;

          $x->status = $x->status=="member"?"<span class='label label-success badge'>$x->status</span>":$x->status;

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id_penjual</td>
                <td>$x->nama_penjual</td>
                <td>$x->email_penjual</td>
                <td>$x->alamat</td>
                <td>$x->hp_penjual</td>
                <td>$x->tgl_daftar</td>
                <td>$x->tgl_trx_terakhir</td>
                <td>".rupiah($x->saldo)."</td>
                
                

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
        <h4 class="modal-title">Tambah Admin</h4>
      </div>
      <div class="modal-body">
          <form id="form_penjual">
            <input type="hidden" name="id_penjual" id="id_penjual" class="form-control" readonly="readonly">
            
            <div class="col-sm-4 judul">nama_penjual</div>
            <div class="col-sm-8">
              <input class="form-control" name="nama_penjual" id="nama_penjual" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">hp_penjual</div>
            <div class="col-sm-8">
              <input class="form-control" name="hp_penjual" id="hp_penjual" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">email_penjual</div>
            <div class="col-sm-8">
              <input class="form-control" name="email_penjual" id="email_penjual" type="text" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">alamat</div>
            <div class="col-sm-8">
              <input class="form-control" name="alamat" id="alamat" type="text" required>
            </div>
            <div style="clear:both"></div>
            <br>




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
hanya_nomor(".nomor");
/***** menghapus garis bawah ******/
$('.judul,th').text(function(i, text) {    
    return text.replace(/_/g, ' ');
});
/***** menghapus garis bawah ******/

/***** membesarkan ******/
$('.judul,th').text(function(i, text) {
    return text.toUpperCase();    
});
/***** membesarkan ******/



$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});

function edit_admin(id_penjual)
{
  $.get("<?php echo base_url()?>index.php/penjual/by_id/"+id_penjual,function(e){
    //console.log(e[0].id_desa);
    $("#id_penjual").val(e[0].id_penjual);
    $("#nama_penjual").val(e[0].nama_penjual);
    $("#email_penjual").val(e[0].email_penjual);
    $("#password").val(e[0].password);
    $("#hp_penjual").val(e[0].hp_penjual);

    
  })
  $("#myModal").modal('show');
}

function jadikan_member(id_penjual)
{
  if(confirm("Anda yakin menjadikan member?"))
  {
    $.get("<?php echo base_url()?>index.php/penjual/by_id/"+id_penjual,function(e){
      if(e[0].email_penjual=="" || e[0].password=="")
      {
        alert("Untuk member, lengkapi dulu email dan password");
        $("#id_penjual").val(e[0].id_penjual);
        $("#nama_penjual").val(e[0].nama_penjual);
        $("#email_penjual").val(e[0].email_penjual);
        $("#password").val(e[0].password);
        $("#hp_penjual").val(e[0].hp_penjual);
        $("#myModal").modal('show');
        return false;
      }

      $.get("<?php echo base_url()?>index.php/penjual/jadikan_member/"+id_penjual,function(x){

        alert("Berhasil");
        eksekusi_controller('<?php echo base_url()?>index.php/penjual/data','Data penjual');
      })
    })
  }
}

function tambah_admin()
{
  $("#id_penjual").val("");
  $("#nama_penjual").val("");
  $("#email_penjual").val("");
  $("#hp_penjual").val("");
  
  
  $("#myModal").modal('show');
}

function hapus_admin(id_penjual)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/penjual/hapus/"+id_penjual,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/penjual/data');
    })  
  }
  
}

$("#form_penjual").on("submit",function(){
  $("#t4_info_form").html('Loading...');

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/penjual/simpan",ser,function(x){
    console.log(x);
      if(x=="2")
      {
        $("#t4_info_form").html("<div class='alert alert-warning'>email sudah terdaftar, gunakan email lain.</div>").fadeIn();;  
        return false; 
      }    
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    
  })

  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/penjual/data','Data penjual');
});
</script>
