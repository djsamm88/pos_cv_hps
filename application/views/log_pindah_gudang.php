
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
          <h3 class="box-title">Data Perpindahan <?php echo $mulai?> s/d <?php echo $selesai?></h3>

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
          <form id="form_log">
              <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mulai" id="mulai"  value="<?php echo $mulai ?>" >
              </div>
              <div class="col-sm-5">
                <input type="text" class="form-control datepicker" name="selesai" id="selesai"  value="<?php echo $selesai ?>">
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary btn-block" value="Go">
              </div>
          </form>          
          <div style="clear: both"></div>
          </div>

<div class="table-responsive">
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">Tgl</th>
                <th>Nama Barang</th>
                <th>Gudang Lama</th>
                <th>Gudang Baru</th>
                <th>Jumlah</th>
                <th>Oleh</th>
                <th>Catatan</th>
                <th>Aksi</th>
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {

          $no++;

          $btn = "<a href='".base_url()."index.php/barang/struk_log_pindah_gudang/$x->id' target='_blank'>Cetak</a>";

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->tgl</td>
                <td>$x->nama_barang</td>
                <td>$x->kode_cabang_lama - $x->cabang_lama - $x->nama_gudang_lama</td>
                <td>$x->kode_cabang_baru - $x->cabang_baru - $x->nama_gudang_baru</td>
                <td>$x->jumlah</td>
                <td>$x->nama_admin</td>
                <td>$x->catatan</td>
                <td>$btn</td>
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
  <input type="button" class="btn btn-primary" value="Download" id="download_pdf">
</div>


        </div>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->

<?php 
if($out=='excel')
die();
?>
<script>
$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})


$("#form_log").on("submit",function(){
    var mulai   = $("#mulai").val();
    var selesai  = $("#selesai").val();
    if( (new Date(mulai).getTime() > new Date(selesai).getTime()))
    {
      alert("Perhatikan pengisian tanggal. Ada yang salah.");
      return false;
    }

    eksekusi_controller('<?php echo base_url()?>index.php/barang/log_pindah_gudang/?mulai='+mulai+'&selesai='+selesai,'Laporan Penjualan');
  return false;
})


$("#download_pdf").on("click",function(){
  var ser = $("#form_log").serialize();
  var url="<?php echo base_url()?>index.php/barang/log_pindah_gudang_excel/?"+ser;
  window.open(url);

  return false;
})

$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});
</script>
