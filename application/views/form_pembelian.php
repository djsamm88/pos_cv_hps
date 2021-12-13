<?php
$all_template = ""; 
$keterangan = ""; 
$saldo = 0;
$total_berat=0;
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Order
        
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
          <h3 class="box-title" id="judul2">Form Order Suplier</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">


<form id="penjualan_barang">
  <div class="row">
  
  <div class="col-sm-3">
    <input type="text" name="nama_suplier" id="nama_suplier" value="" class="form-control" required placeholder="Nama Suplier">
    
    <small><i>Nama Suplier</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="hp_suplier" id="hp_suplier" value="" class="form-control" required placeholder="HP Suplier">
    <small><i>HP Suplier</i></small>
  </div>
  <div class="col-sm-3">
    <textarea name="alamat_suplier" value="" class="form-control" placeholder="alamat_suplier" id=""></textarea>
    <small><i>Alamat Suplier</i></small>
  </div>
  

</div>
  <div style="clear: both;"></div>
  <br>
<input type="text"   class="form-control barang" placeholder="Barang">
<br>
<div class="table-responsive">
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th width="10px">Id</th>           
              <th width="10px">Stok</th>                                   
              <th>Barang</th>              
                     
              <th>Satuan</th>                                   
              
              <th>Qty</th>
              
              <th>-</th>                                          
                              
              
              
        </tr>
      </thead>
      <tbody id="t4_order">
      </tbody>
      <tfoot>
        




      </tfoot>
  </table>
</div>
  <textarea class="form-control" name="keterangan" placeholder="keterangan"></textarea><br>

<div style="clear: both;"></div>
<div class="col-sm-12" style="text-align: right;">
    <input type="submit" value="Order" class="btn btn-primary" id="simpan"> 
</div>
<div style="clear: both;"></div>





</form>


      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->





<script type="text/javascript">
var classnya = "<?php echo $this->router->fetch_class();?>";
$(".barang").focus();

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd <?php echo date('H:i:s')?>' 
})
notif(); 







$( function() {

    var semuaBarang = function(request,response){
            console.log(request.term);
            var serialize = {cari:request.term};
            $.get("<?php echo base_url()?>index.php/barang/json_barang_order",serialize,
              function(data){
                /*
                response(data);
                console.log(data);
                */
                response($.map(data, function(obj) {
                    return {
                        label: obj.nama_barang,
                        value: obj.id,
                        stok: obj.qty,
                        harga_retail: obj.harga_retail, 
                        harga_lusin: obj.harga_lusin, 
                        harga_koli: obj.harga_koli, 
                        jum_per_koli: obj.jum_per_koli, 
                        jum_per_lusin: obj.jum_per_lusin, 
                        reminder: obj.reminder, 
                        berat:obj.berat,
                        harga_pokok:obj.harga_pokok
                    };
                }));
                
            })
          }

    var ii=0;
    $( ".barang" ).autocomplete({
      source: semuaBarang,
      minLength: 1,

      select: function(event, ui) {
        console.log(ui);        
        $(this).val('');


       if(ui.item.stok<ui.item.reminder)
       {
        //notif();//notif ini dari footer welcome
       }

      

      

        console.log(ui.item);
      


        var template = "<tr>"+                
                "<td><input id='id_barang' name='id_barang[]' type='hidden' value='"+ui.item.value+"'>"+ui.item.value+"</td>"+
                "<td id='stoknya'>"+ui.item.stok+"</td>"+
                "<td id='nama_barang'>"+ui.item.label+"</td>"+                
                "<td><select class='form-control' name='satuan[]'><option value='koli'>Koli</option>"+
                      "<option value='lusin'>Lusin</option>"+
                      "<option value='retail'>Retail</option></select></td>"+
                
                "<td>"+
                "<input class='form-control' type='number' id='jumlah_beli' name='jumlah[]'  placeholder='qty' required value='1' >"+
                "</td>"+
                
                          
                          
                  "<td><button class='btn btn-danger btn-xs' id='remove_order' type='button'>Hapus</button></td></tr>"
                          ;
                  $("#t4_order").append(template);
                  $(".barang").val("");
                  
                  //console.log(template);
              ii++;
              //alert(ii);
              return false;
        }

    });


});




$("#tbl_datanya").on("click","tbody tr td button#remove_order",function(x){
  $(this).parent().parent().remove();
  total();
  return false;
})




$('#penjualan_barang').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

$("#penjualan_barang").on("submit",function(){
  

  if(confirm("Anda yakin selesai?"))
  {

    $.post("<?php echo base_url()?>index.php/barang/go_beli_suplier",$(this).serialize(),function(x){
      console.log(x);
      
        //window.open("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);
        var mulai="";
        var selesai="";
        eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang/?mulai='+mulai+'&selesai='+selesai+'&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Status Order');

        //console.log("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);

        notif();   
    })
  
  }

return false;  
})



hanya_nomor(".nomor");
function buang_titik(mystring)
{
  try{
    return mystring.replace(/\./g,'');
  }catch{
    return 0;
  }
  
}

function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


</script>