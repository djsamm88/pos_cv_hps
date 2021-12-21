
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
<div class="table-responsive">
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
                            
              <th>tanggal/S.d</th>                            
              
              
              <th>pelanggan</th>              
              <th>alamat</th>
              <th>harga_total</th>
              <th>bayar</th>
              <th>hutang</th>
              <th>keterangan</th>
              
              <th>status</th>
              <th>group_trx</th>
              <th>Action</th>
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          
           if($x->status=="pinjam")
          {
            $status =  "<font color='red'>$x->status</font>";
            $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='update_status(\"$x->group_trx\");return false;'>Barang Kembali</button>";

          }else{
            $status =  "<font color='green'>$x->status</font>";
            $btn = "-";

          }

          $btn .= "<a href='".base_url()."index.php/barang_pinjam/struk_pinjam/$x->group_trx' class='btn btn-block btn-primary btn-xs' target='blank'>Print</a>";

          $no++;

            echo (" 
              
              <tr>
                <td>$no</td>
                          
                <td>$x->tgl_mulai <br>s/d<br> $x->tgl_selesai <br> <span class='badge badge-warning'>$x->lama_pinjam Hari</badge></td>
                
                
                
                
                
                <td>$x->nama_pelanggan <br> <b>$x->hp_pembeli</b></td>
                
                <td>$x->alamat</td>                
                <td>".rupiah($x->harga_total)."</td>
                <td>".rupiah($x->bayar)."</td>
                <td>".rupiah($x->hutang)."</td>                
                <td>$x->keterangan</td>       
                <td>$status</td>
                <td>$x->group_trx</td>         
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
        <h4 class="modal-title">Form</h4>
      </div>
      <div class="modal-body">
          <form id="form_data_barang_pinjam">
            <div class="col-sm-4 judul">id_cabang</div>
<div class="col-sm-8">
  <input class="form-control" name="id_cabang" id="id_cabang" required readonly value="<?php echo $this->session->userdata('id_cabang')?>">
  </div>
  <div style="clear:both"></div><br>

            <div class="col-sm-4 judul">id_barang_pinjam</div>
<div class="col-sm-8">
  <input class="form-control" name="id_barang_pinjam" id="id_barang_pinjam"  readonly>
  </div>
  <div style="clear:both"></div><br>

<div class="col-sm-4 judul">nama_barang</div>
<div class="col-sm-8">
  <input class="form-control" name="nama_barang" id="nama_barang" required>
  </div>
  <div style="clear:both"></div><br>

<div class="col-sm-4 judul">code_barcode</div>
<div class="col-sm-8">
  <input class="form-control" name="code_barcode" id="code_barcode" >
  </div>
  <div style="clear:both"></div><br>

<div class="col-sm-4 judul">stok_barang</div>
<div class="col-sm-8">
  <input class="form-control nomor" name="stok_barang" id="stok_barang" required>
  </div>
  <div style="clear:both"></div><br>

<div class="col-sm-4 judul">harga_sewa/bulan</div>
<div class="col-sm-8">
  <input class="form-control nomor" name="harga_sewa" id="harga_sewa" required>
  </div>
  <div style="clear:both"></div><br>





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

function update_status(group_trx)
{
  if(confirm("Anda yakin melakukan aksi ini?"))
  {
    $.post("<?php echo base_url()?>index.php/barang_pinjam/update_status",{group_trx:group_trx},function(x){
      
      eksekusi_controller('<?php echo base_url()?>index.php/barang_pinjam/status_barang_pinjam','Data barang_pinjam');
      
    })
  }
}

function edit_admin(id_barang_pinjam)
{
  $.get("<?php echo base_url()?>index.php/barang_pinjam/by_id/"+id_barang_pinjam,function(e){
    //console.log(e[0].id_desa);
    $("#id_barang_pinjam").val(e[0].id_barang_pinjam);
    $("#nama_barang").val(e[0].nama_barang);
    $("#code_barcode").val(e[0].code_barcode);
    $("#stok_barang").val(e[0].stok_barang);
    $("#harga_sewa").val(e[0].harga_sewa);    
    $("#id_cabang").val(e[0].id_cabang);   
    
  })
  $("#myModal").modal('show');
}

function tambah_admin()
{
  
  
  
  $("#myModal").modal('show');
}

function hapus_admin(id_barang_pinjam)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/barang_pinjam/hapus/"+id_barang_pinjam,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/barang_pinjam/data');
    })  
  }
  
}

$("#form_data_barang_pinjam").on("submit",function(){
  $("#t4_info_form").html('Loading...');
  

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/barang_pinjam/simpan",ser,function(x){
    console.log(x);
    
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    
  })

  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/barang_pinjam/data','Data barang_pinjam');
});
</script>
