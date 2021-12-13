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
          <h3 class="box-title" id="judul2">Form Order Penjual</h3>

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
  
  <div class="col-sm-2">
    <input type="text" name="id_penjual" id="id_penjual" value="" class="form-control" required placeholder="id Penjual" readonly>
    
    <small><i>id Penjual</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="nama_penjual" id="nama_penjual" value="" class="form-control" required placeholder="Nama Penjual">
    <small><i>Nama Penjual</i></small>
  </div>

  <div class="col-sm-3">
    <input type="text" name="hp_penjual" id="hp_penjual" value="" class="form-control" readonly placeholder="HP Penjual">
    <small><i>HP Penjual</i></small>
  </div>
  
  <div class="col-sm-4">
    <input type="text" name="alamat" id="alamat" value="" class="form-control" readonly placeholder="alamat Penjual">
    <small><i>alamat Penjual</i></small>
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
              <th>Harga</th> 
              <th>Sub Total</th>
              <th>-</th>                                          
                              
              
              
        </tr>
      </thead>
      <tbody id="t4_order">
      </tbody>


        <tr>
          <td colspan="6" align="right"><b>Total</b></td>
          <td  align="right" >
            <input id="t4_total" type="text" name="total" readonly class="form-control nomor" value="0" style="text-align:right;">
          </td>
          <td></td>
        </tr>

        <tr>
          <td colspan="6" align="right"><b>Jenis Pembayaran</b></td>
          <td  align="right" >
            <select id="jenis_pembayaran" type="text" name="jenis_pembayaran"  class="form-control nomor" value="0" required>
              <option value=""> -- pilih --</option>
              <option value="hutang">hutang</option>
              <option value="lunas">lunas</option>
            </select>
          </td>
          <td></td>
        </tr>

          <tr>
          <td colspan="6" align="right"><b>Bayar</b></td>
          <td  align="right" >
            <input id="bayar" type="text" name="bayar"  class="form-control nomor" value="0" style="text-align:right;">
          </td>
          <td></td>
        </tr>


          <tr>
          <td colspan="6" align="right"><b>Hutang</b></td>
          <td  align="right" >
            <input id="hutang" type="text" name="hutang" readonly class="form-control nomor" value="0" style="text-align:right;">
          </td>
          <td></td>
        </tr>


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


$("#jenis_pembayaran").on("change",function(){
    var jenis = $(this).val();
    if(jenis=="hutang")
    {
      $("#bayar").val("0");
    }else{
      $("#bayar").val($("#t4_total").val());
    }
    cekHutang();
})

$("body").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
  cekHutang();
})

function cekHutang()
{
  var total = buang_titik($("#t4_total").val());
  var bayar = buang_titik($("#bayar").val());

  $("#hutang").val(formatRupiah(total-bayar));
}

$(function(){

    var semuaPenjual = function(request,response){
            console.log(request.term);
            var serialize = {cari:request.term};
            $.get("<?php echo base_url()?>index.php/penjual/json_penjual",serialize,
              function(data){
                /*
                response(data);
                console.log(data);
                */
                response($.map(data, function(obj) {
                    return {
                        label: obj.nama_penjual,
                        value: obj.id_penjual,
                        hp_penjual: obj.hp_penjual,
                        alamat: obj.alamat
                    };
                }));
                
            })
          }
  $("#nama_penjual").autocomplete({
      source:semuaPenjual,
      minLength:1,
      select:function(ev,ui){
        console.log(ui.item.alamat);
        $("#id_penjual").val(ui.item.value);
        $("#hp_penjual").val(ui.item.hp_penjual);
        $("#nama_penjual").val(ui.item.nama_penjual);
        $("#alamat").val(ui.item.alamat);
        $(this).val(ui.item.label);
        return false;
      }
  })
})




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
                         label: obj.nama_barang +" - "+obj.id,
                        value: obj.id,
                        stok: obj.qty,
                        harga_retail: obj.harga_retail, 
                        harga_lusin: obj.harga_lusin, 
                        harga_koli: obj.harga_koli, 
                        jum_per_koli: obj.jum_per_koli, 
                        jum_per_lusin: obj.jum_per_lusin, 
                        reminder: obj.reminder, 
                        berat:obj.berat,
                        nama_barang:obj.nama_barang +" - "+obj.id,
                        id:obj.id,
                        qty:obj.qty,
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

        total();
      

        console.log(ui.item);
      


        var template = "<tr>"+                
                "<td><input id='id_barang' name='id_barang[]' type='hidden' value='"+ui.item.value+"'>"+ui.item.value+"</td>"+
                "<td id='stoknya'>"+ui.item.stok+"</td>"+
                "<td id='nama_barang'>"+ui.item.label+"</td>"+                
                
                "<td><select class='form-control' name='satuan[]'><option value='retail'>Retail</option>"+
                
                "<td>"+
                "<input class='form-control' type='number' id='jumlah_beli' name='jumlah[]'  placeholder='qty' required value='1' >"+
                "</td>"+

                "<td>"+
                "<input class='form-control' type='text' id='harga_pokok' name='harga_pokok[]'  required readonly value='"+formatRupiah(ui.item.harga_pokok)+"' >"+
                "</td>"+

                 "<td>"+
                "<input class='form-control' type='text' id='sub_total' name='sub_total[]'  required readonly value='"+formatRupiah(ui.item.harga_pokok)+"' >"+
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

$("body").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
  total();
})


$("#tbl_datanya").on("keydown keyup mousedown mouseup select contextmenu drop","tbody tr td input#jumlah_beli",function(){ 

  console.log($(this).parent().parent().find("#stoknya").html());
  
  var dibeli        = parseInt($(this).val());
  
  sub_total($(this));  
  total();


})


function sub_total(ini)
{
    var qty = ini.val();
    if(qty=="")
    {
      qty=0;
    }
    var harga = buang_titik(ini.parent().parent().find("#harga_pokok").val());

    var sub_total = parseInt(qty)*parseInt(harga);

    ini.parent().parent().find("#sub_total").val(formatRupiah(sub_total));  
    
    total();
}




function total()
{
  var total=0;
  $("tbody#t4_order tr td input#sub_total").each(function(){
     total+= parseInt(buang_titik($(this).val())) || 0;

  })

  $("#t4_total").val(formatRupiah(total));

}


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
        var mulai="<?php echo date('Y-m-').'01'?>";
        var selesai="<?php echo date('Y-m-d',strtotime('+1 days'));?>";
        
        eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang/?mulai='+mulai+'&selesai='+selesai+'&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Status Order');

        //console.log("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);
        
        //notif();   
        
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