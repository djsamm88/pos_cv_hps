
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
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">id</th>
                <th>nama</th>                
                <th>jabatan</th>                
                <th>hutang</th>                
                <th>bayar</th>                
                <th>sisa</th>                
              <th>Action</th>
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;

        foreach($all as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs' onclick='edit_admin($x->id);return false;'>Edit</button>
                 <!-- 
                 <button class='btn btn-danger btn-xs' onclick='hapus_admin($x->id);return false;'>Hapus</button>
                 -->
                 ";
          $sisa=$x->hutang-$x->terbayar;

          if($sisa>0)
          {
            $btn .= "<button class=' btn btn-xs  btn-info' onclick='detail_hutang($x->id);return false;'>Detail Hutang</button>";
            $btn .= " <button class='btn btn-success btn-xs ' onclick='form_bayar_hutang(\"$x->id\",\"$x->nama\",\"$sisa\",)'>Bayar</button>";;
          }

          $no++;

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id</td>
                <td>$x->nama</td>                          
                <td>$x->jabatan</td>                          
                <td>".rupiah($x->hutang)."</td>                          
                <td>".rupiah($x->terbayar)."</td>                          
                <td>".rupiah($sisa)."</td>                          
                <td>
                  $btn
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


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
        <h4 class="modal-title">Form</h4>
      </div>
      <div class="modal-body">
          <form id="form_pelanggan">
            <input type="hidden" name="id" id="id" class="form-control" readonly="readonly">
            
            <div class="col-sm-4 judul">nama</div>
            <div class="col-sm-8">
              <input class="form-control" name="nama" id="nama" required>
            </div>
            <div style="clear:both"></div>
            <br>
          <div class="col-sm-4 judul">jabatan</div>
            <div class="col-sm-8">
              <input class="form-control" name="jabatan" id="jabatan" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4">Cabang</div>
            <div class="col-sm-8">
              <select name="id_cabang" id="id_cabang" class="form-control">
                  <option value=""> --- pilih Cabang --- </option>
                  <?php 
                    $data_cabang = $this->m_cabang->m_data_cabang();
                    foreach($data_cabang as $cabang)
                    {
                      $sel = $cabang->id_cabang==$this->session->userdata('id_cabang')?"selected":"";
                      echo "
                        <option value='$cabang->id_cabang' $sel>$cabang->kode_cabang - $cabang->nama_cabang</option>
                      ";
                    }
                  ?>                  
              </select>
            </div>
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
            <input type="" name="id" id="id_karyawan_bayar" class="form-control" readonly="readonly" >            <br>
        
          <div class="col-sm-4">Dari</div>
            <div class="col-sm-8">
                <input type="text" name="nama" id="nama_karyawan_bayar" readonly class="form-control " placeholder="nama_pembeli" >
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



function form_bayar_hutang(id_pelanggan,nama_pembeli,hutang)
{
  console.log(id_pelanggan)
  $("#id_karyawan_bayar").val(id_pelanggan);
  $("#nama_karyawan_bayar").val(nama_pembeli);
  $("#jumlah").val(hutang);
  $("#myModalBayar").modal('show');
}



$("#form_bayar_hutang").on("submit",function(){
  var ser = $(this).serialize();

      if(confirm("Anda yakin?"))
      {


      $.ajax({
            url: "<?php echo base_url()?>index.php/karyawan/go_bayar_hutang",
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
    }

  return false;
})





function detail_hutang(id)
{
  $.get("<?php echo base_url()?>index.php/karyawan/detail_hutang_karyawan/"+id,function(e){
    $("#t4_detail_hutang").html(e);
  })
}

function edit_admin(id)
{
  $.get("<?php echo base_url()?>index.php/karyawan/by_id/"+id,function(e){
    //console.log(e[0].id_desa);
    $("#id").val(e[0].id);
    $("#nama").val(e[0].nama);    
    $("#jabatan").val(e[0].jabatan);    
    
  })
  $("#myModal").modal('show');
}

function tambah_admin()
{
  $("#id").val("");
  $("#nama").val("");
  $("#jabatan").val("");
  
  
  $("#myModal").modal('show');
}

function hapus_admin(id)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/karyawan/hapus/"+id,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/karyawan/data');
    })  
  }
  
}

$("#form_pelanggan").on("submit",function(){
  $("#t4_info_form").html('Loading...');
  

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/karyawan/simpan",ser,function(x){
    console.log(x);
    
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    
  })

  return false;
})


$("#myModal,#myModalBayar").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/karyawan/data','Data karyawan');
});
</script>
