
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
               <th width="100px">ID</th>
                <th>nama_pembeli</th>
                <th>email / HP</th>
                <th>Hutang Beli</th>        
                <th>Hutang Pinjam </th>        
                <th>Terbayar</th>        
                <th>Sisa</th>        
                <th>tgl_daftar</th>
                <th>tgl_trx_terakhir</th>
                        
                <th>Status</th>
                <th>password</th>
              <th>Action</th>
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {

          $sisa = (($x->hutang_kasir+$x->hutang_pinjam_barang) - $x->terbayar);

          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='edit_admin($x->id_pelanggan);return false;'>Edit</button>
                  <!--<button class='btn btn-danger btn-xs btn-block' onclick='hapus_admin($x->id_pelanggan);return false;'>Hapus</button>  -->  ";

          $btnStatus = $x->status=="biasa"?"<button class='btn btn-xs btn-block btn-primary' onclick='jadikan_member($x->id_pelanggan)'>Jadikan member</button>":"";
          $no++;

          $x->status = $x->status=="member"?"<span class='label label-success badge'>$x->status</span>":$x->status;


          $btnHutang = "<button class='btn btn-xs btn-block btn-primary' onclick='detail_hutang($x->id_pelanggan)'>Detail Hutang</button>";

          $btnHutang .= "<button class='btn btn-info btn-xs btn-block' onclick='form_bayar_hutang(\"$x->id_pelanggan\",\"$x->nama_pembeli\",\"$sisa\",)'>Bayar</button>";

          $x->status="-";
          $x->password="-";
          $btnStatus="-";

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id_pelanggan</td>
                <td>$x->nama_pembeli</td>
                <td>$x->email_pembeli <br> $x->hp_pembeli</td>
                
                <td><b>".rupiah($x->hutang_kasir)."</b>  </td>
                <td><b>".rupiah($x->hutang_pinjam_barang)."</b>  </td>
                <td><b>".rupiah($x->terbayar)."</b> </td>
                <td><b>".rupiah($sisa)."</b> </td>
                <td>$x->tgl_daftar</td>
                <td>$x->tgl_trx_terakhir</td>
                
                <td>$x->status <br> $btnStatus</td>
                <td>$x->password</td>
                

                <td>
                  $btn $btnHutang
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
</div>


        <div id="t4_detail_hutang"></div>
        
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
        <h4 class="modal-title">Tambah Pelanggan</h4>
      </div>
      <div class="modal-body">
          <form id="form_pelanggan">
            <input type="hidden" name="id_pelanggan" id="id_pelanggan" class="form-control" readonly="readonly">
            
            <div class="col-sm-4 judul">nama_pembeli</div>
            <div class="col-sm-8">
              <input class="form-control" name="nama_pembeli" id="nama_pembeli" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">hp_pembeli</div>
            <div class="col-sm-8">
              <input class="form-control" name="hp_pembeli" id="hp_pembeli" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">email_pembeli</div>
            <div class="col-sm-8">
              <input class="form-control" name="email_pembeli" id="email_pembeli" type="email" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">password</div>
            <div class="col-sm-8">
              <input class="form-control" name="password" id="password" type="text" required>
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









<!-- Modal -->
<div id="myModalBayar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Data</h4>
      </div>
      <div class="modal-body">
          <form id="form_bayar_hutang">
            <input type="" name="id_pelanggan" id="id_pelanggan_bayar" class="form-control" readonly="readonly" >            <br>
        
          <div class="col-sm-4">Dari</div>
            <div class="col-sm-8">
                <input type="text" name="nama_pembeli" id="nama_pembeli_bayar" readonly class="form-control " placeholder="nama_pembeli" >
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


            <div id="t4_info_form_bayar"></div>
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



function detail_hutang(id_pelanggan)
{
  $.get("<?php echo base_url()?>index.php/pelanggan/detail_hutang_pelanggan/"+id_pelanggan,function(e){
    $("#t4_detail_hutang").html(e);
  })
}


function form_bayar_hutang(id_pelanggan,nama_pembeli,hutang)
{
  console.log(id_pelanggan)
  $("#id_pelanggan_bayar").val(id_pelanggan);
  $("#nama_pembeli_bayar").val(nama_pembeli);
  $("#jumlah").val(hutang);
  $("#myModalBayar").modal('show');
}



$("#form_bayar_hutang").on("submit",function(){
  var ser = $(this).serialize();

      $.ajax({
            url: "<?php echo base_url()?>index.php/pelanggan/go_bayar_hutang",
            type: "POST",
            contentType: false,
            processData:false,
            data:  new FormData(this),
            beforeSend: function(){
                //alert("sedang uploading...");
            },
            success: function(e){
                console.log(e);
                $("#t4_info_form_bayar").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();
                  setTimeout(function(){
                    //eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/data',document.title);
                    $("#myModalBayar").modal('hide');
                  },3000);

                
            },
            error: function(er){
                $("#t4_info_form_bayar").html("<div class='alert alert-warning'>Ada masalah! "+er+"</div>");
            }           
       });

  return false;
})










function edit_admin(id_pelanggan)
{
  $.get("<?php echo base_url()?>index.php/pelanggan/by_id/"+id_pelanggan,function(e){
    //console.log(e[0].id_desa);
    $("#id_pelanggan").val(e[0].id_pelanggan);
    $("#nama_pembeli").val(e[0].nama_pembeli);
    $("#email_pembeli").val(e[0].email_pembeli);
    $("#password").val(e[0].password);
    $("#hp_pembeli").val(e[0].hp_pembeli);

    
  })
  $("#myModal").modal('show');
}

function jadikan_member(id_pelanggan)
{
  if(confirm("Anda yakin menjadikan member?"))
  {
    $.get("<?php echo base_url()?>index.php/pelanggan/by_id/"+id_pelanggan,function(e){
      if(e[0].email_pembeli=="" || e[0].password=="")
      {
        alert("Untuk member, lengkapi dulu email dan password");
        $("#id_pelanggan").val(e[0].id_pelanggan);
        $("#nama_pembeli").val(e[0].nama_pembeli);
        $("#email_pembeli").val(e[0].email_pembeli);
        $("#password").val(e[0].password);
        $("#hp_pembeli").val(e[0].hp_pembeli);
        $("#myModal").modal('show');
        return false;
      }

      $.get("<?php echo base_url()?>index.php/pelanggan/jadikan_member/"+id_pelanggan,function(x){

        alert("Berhasil");
        eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/data','Data pelanggan');
      })
    })
  }
}

function tambah_admin()
{
  $("#id_pelanggan").val("");
  $("#nama_pembeli").val("");
  $("#email_pembeli").val("");
  $("#hp_pembeli").val("");
  
  
  $("#myModal").modal('show');
}

function hapus_admin(id_pelanggan)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/pelanggan/hapus/"+id_pelanggan,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/data');
    })  
  }
  
}

$("#form_pelanggan").on("submit",function(){
  $("#t4_info_form").html('Loading...');

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/pelanggan/simpan",ser,function(x){
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


$("#myModal,#myModalBayar").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/data','Data Pelanggan');
});
</script>
