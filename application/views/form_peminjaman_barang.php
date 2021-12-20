
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Kasir Peminjaman
        
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
          <h3 class="box-title" id="judul2">Penjualan</h3>

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
    <input type="text" name="nama_pembeli" id="nama_pembeli" value="" class="form-control" required placeholder="Nama pembeli" autocomplete='off'>
    <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="">
    <small><i>Nama Pembeli</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="hp_pembeli" id="hp_pembeli" readonly value="" class="form-control" required placeholder="HP pembeli">
    <small><i>HP Pembeli</i></small>
  </div>
  <div class="col-sm-3">
    <textarea name="alamat" value="" readonly class="form-control" placeholder="alamat" id="alamat"></textarea>
    <small><i>Alamat</i></small>
  </div>
  <div class="col-sm-3">
    <input type="text" name="tgl_trx_manual" value="<?php echo date('Y-m-d H:i:s')?>" class="form-control datepicker">
    <small><i>Format Y-m-d H:i:s</i></small>
    <input type="hidden" name="grup_penjualan" value="<?php echo date('ymdHis')?>_<?php echo $this->session->userdata('id_admin')?>" class="form-control " readonly>
  </div>

</div>
<br>
<div class="col-sm-3">Lama Peminjaman (Bulan)</div>
<div class="col-sm-3">
<input class='form-control nomor'  type='text' id='lama_pinjam_id'   placeholder='lama_pinjam_id' required value='1' autocomplete='off' >
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
              <th>Harga/Bulan</th>                      
              <th>Jumlah</th>                                   
              <th>lama Sewa/bulan</th>                                   
              
              <th>Sub Total</th>
              
              <th>-</th>                                          
                              
              
              
        </tr>
      </thead>
      <tbody id="t4_order">
        
      </tbody>
      <tfoot>


        <tr>
          <td colspan="6" align="right"><b>Total</b></td>
          <td id="t4_total" align="right" style="font-weight: bold;"></td><td></td>
        </tr>

        <tr>
          <td colspan="6" align="right"><b>Bayar</b></td>
          <td  align="right" >
          <input id="t4_bayar" type="text"  class="form-control nomor" name="bayar" value="" autocomplete="off" required style="text-align:right;">
          </td>
          <td></td>
        </tr>



        <tr>
          <td colspan="6" align="right"><b>Hutang</b></td>
          <td  align="right" >
            <input type="text" id="t4_kembali" name="hutang" class="form-control" readonly>
          </td>
          <td></td>
        </tr>




      </tfoot>
  </table>
</div>
  <textarea class="form-control" name="keterangan" placeholder="keterangan"></textarea><br>
  <!--
<div class="col-sm-6" style="text-align: left;">
    <input type="button" value="Pending" class="btn btn-warning" id="simpan_pending"> 
</div>
-->

<div class="col-sm-6" style="text-align: right;">
    <input type="submit" value="Pinjam" class="btn btn-primary" id="simpan"> 
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

total();



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



$(function(){

    var semuaPelanggan = function(request,response){
            console.log(request.term);
            var serialize = {cari:request.term};
            $.get("<?php echo base_url()?>index.php/barang/json_pelanggan",serialize,
              function(data){
                /*
                response(data);
                console.log(data);
                */
                response($.map(data, function(obj) {
                    return {
                        label: obj.nama_pembeli,
                        value: obj.id_pelanggan,
                        hp_pembeli: obj.hp_pembeli,
                        alamat: obj.alamat,
                        saldo: obj.saldo
                    };
                }));
                
            })
          }
  $("#nama_pembeli").autocomplete({
      source:semuaPelanggan,
      minLength:1,
      select:function(ev,ui){
        console.log(ui.item.value);
        $("#id_pelanggan").val(ui.item.value);
        $("#hp_pembeli").val(ui.item.hp_pembeli);
        $("#t4_saldo").val(ui.item.saldo);
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
            $.get("<?php echo base_url()?>index.php/barang_pinjam/json_barang",serialize,
              function(data){
                
                //response(data);
                console.log(data);
                
                response($.map(data, function(obj) {
                    return {
                        label: obj.nama_barang +" - "+obj.code_barcode,
                        value: obj.id_barang_pinjam,
                        stok_barang: obj.stok_barang,
                        harga_sewa: obj.harga_sewa,
                        nama_barang:obj.nama_barang +" - "+obj.code_barcode,
                        id_barang_pinjam:obj.id_barang_pinjam
                    };
                }));
                
            })
          }

    var ii=0;

    var templatenya = function(event, ui) {
        console.log(ui);        
        $(this).val('');
      template_auto(ui.item);
              ii++;
              //alert(ii);
              return false;
        }


    $( ".barang" ).autocomplete({
      source: semuaBarang,
      minLength: 1,
      select: templatenya

    });




});



function template_auto(abc)
{

       if(abc.stok=="0")
       {
        alert("Stok gudang KOSONG. Item : "+abc.label);
        return false;
       }

              
              var hiddennya  = "<input type='hidden' name='id_barang_pinjam[]' value='"+abc.id_barang_pinjam+"'>"+
                                "<input type='hidden' name='nama_barang[]' value='"+abc.nama_barang+"'>"+
                                "<input type='hidden' name='harga_per_bulan[]' value='"+abc.harga_sewa+"'>"+
                                "<input type='hidden' name='nama_barang[]' value='"+abc.nama_barang+"'>";
                  
        var lama_pinjams = $("#lama_pinjam_id").val();

        var template = "<tr>"+                
                "<td id='id_barang_pinjam'>"+hiddennya+abc.id_barang_pinjam+"</td>"+
                "</td>"+
                "<td id='stok_barang'>"+abc.stok_barang+"</td>"+
                "<td id='nama_barang'>"+abc.nama_barang+"</td>"+
                "<td id='harga_sewa'>"+formatRupiah(abc.harga_sewa)+"</td>"+
                
               
                "<td>"+
                "<input class='form-control nomor' type='text' id='jumlah' name='jumlah[]'  placeholder='stok_barang' required value='1' autocomplete='off'>"+
                "</td>"+
                

                "<td>"+
                "<input class='form-control nomor lama_pinjamnya'  type='text' id='lama_pinjam' name='lama_pinjam[]'  placeholder='stok_barang' required value='"+lama_pinjams+"' autocomplete='off' readonly >"+
                "</td>"+


                "<td>"+
                "<input class='form-control nomor' type='text' id='sub_total' name='sub_total[]'  placeholder='sub_total' required value='"+formatRupiah(abc.harga_sewa)+"' autocomplete='off'>"+
                "</td>"+
                          
                          
                  "<td><button class='btn btn-danger btn-xs' id='remove_order' type='button'>Hapus</button></td></tr>"
                          ;
                  $("#t4_order").append(template);
                  $(".barang").val("");
                  
                  //console.log(template);
              

}


$("#tbl_datanya").on("click","tbody tr td button#remove_order",function(x){
  $(this).parent().parent().remove();
  total();
  return false;
})

$("#lama_pinjam_id").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
  $(".lama_pinjamnya").val($(this).val());
})


$("#tbl_datanya").on("keydown keyup mousedown mouseup select contextmenu drop","tbody tr td input#jumlah",function(){ 

  console.log($(this).parent().parent().find("#stok_barang").html());
  
  var jumlah        = parseInt(buang_titik($(this).val()));
  var stok_barang   = parseInt(buang_titik($(this).parent().parent().find("#stok_barang").html()));
  
  var harga_sewa   = parseInt(buang_titik($(this).parent().parent().find("#harga_sewa").html()));

  var lama_pinjam   = parseInt(buang_titik($(this).parent().parent().find("#lama_pinjam").val()));

  if(lama_pinjam=="")
  {
    lama_pinjam=1;
  }

  if(jumlah=="")
  {
    jumlah=1;
  }

   console.log(harga_sewa);

  if(jumlah>stok_barang)
  {
    console.log('jika dipinjam lebih besar dari stok');
    alert("Maksimal stok barang = "+$(this).parent().parent().find("#stok_barang").html());
    $(this).val($(this).parent().parent().find("#stok_barang").html());
    
  }  

   var sub_total = parseFloat(lama_pinjam)*parseFloat(jumlah)*parseFloat(harga_sewa);

  
  $(this).parent().parent().find("#sub_total").val(formatRupiah(sub_total));  


})


$("#tbl_datanya").on("keydown keyup mousedown mouseup select contextmenu drop","tbody tr td input#lama_pinjam",function(){ 

  console.log($(this).parent().parent().find("#stok_barang").html());
  
  var lama_pinjam        = parseInt(buang_titik($(this).val()));
  var stok_barang   = parseInt(buang_titik($(this).parent().parent().find("#stok_barang").html()));
  var jumlah        = parseInt(buang_titik($(this).parent().parent().find("#jumlah").val()));
  var harga_sewa   = parseInt(buang_titik($(this).parent().parent().find("#harga_sewa").html()));

if(lama_pinjam=="")
  {
    lama_pinjam=1;
  }

  if(jumlah=="")
  {
    jumlah=1;
  }
  



  
   var sub_total = parseFloat(lama_pinjam)*parseFloat(jumlah)*parseFloat(harga_sewa);

  
  $(this).parent().parent().find("#sub_total").val(formatRupiah(sub_total));  



})






$("body").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
  total();
})


$("#t4_diskon,#nama_ekspedisi,#t4_transport_ke_ekspedisi,#t4_ekspedisi,.barang,#nama_pembeli").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
    total();
})


$("#t4_bayar").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
    var tot = parseInt(buang_titik($("#t4_total").text()));
    var bayar = parseInt(buang_titik($(this).val()));

    var kembalian = tot-bayar;
    $("#t4_kembali").val(formatRupiah(kembalian));
    console.log(tot);

})  

function sub_total(lama_pinjam,jumlah,harga_sewa)
{
    
    

    return sub_total;
    
    total();
}


function sub_total_berat(ini)
{
  var stok_barang = ini.val() || 0;
  var berat = buang_titik(ini.parent().parent().find("#t4_berat").text()) || 0;
  var sub_total_berat = parseInt(stok_barang)*parseInt(berat);
  ini.parent().parent().find("#t4_sub_berat").html(formatRupiah(sub_total_berat)); 
  total();
}



function total()
{
  var total=0;
  $("tbody#t4_order tr td input#sub_total").each(function(){
     total+= parseInt(buang_titik($(this).val())) || 0;

  })
  console.log(total);

  
  $("#t4_total").html(formatRupiah(total));

  jika_ada_stok_kurang();


}

function total_berat()
{
  //berat
  var tot_berat = 0;
  $("tbody#t4_order tr td#t4_sub_berat").each(function(){
     tot_berat+= parseInt(buang_titik($(this).text()));

  })
  $("#total_berat").val(formatRupiah(tot_berat));
}


function jika_ada_stok_kurang()
{
  var jumlah_baris=0;
  var tidak_cukup =0;
  var beli_minus  =0;
  $('#tbl_datanya > tbody  > tr').each(function(index, tr) {      
     //console.log($(tr).find("#stoknya"));
     jumlah_baris++;
     var stok = parseInt(buang_titik($(tr).find("#stoknya").html()));
     var beli = parseInt(buang_titik($(tr).find("#jumlah_beli").val()));
     
     var nama_barang = $(tr).find("#nama_barang").html();
     console.log(stok+"-"+beli);     

     if(stok<beli)
     {
      //alert("Stok "+nama_barang+" tidak cukup!!!");
      tidak_cukup++;
      
     }

     if(beli<0)
     {
        beli_minus++;
     }
  });


  if(jumlah_baris==0 || tidak_cukup>0 || beli_minus>0)
   {
      $("#simpan").hide();
      
   }else{
      $("#simpan").show();
   }




}

$('#penjualan_barang').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

$("#penjualan_barang").on("submit",function(){
  if($("#t4_total").html()=="")
  {
    total();
    return false;
  }
  if(confirm("Anda yakin selesai?"))
  {
    
    $.post("<?php echo base_url()?>index.php/barang_pinjam/go_jual",$(this).serialize(),function(x){
      console.log(x);
        
        window.open("<?php echo base_url()?>index.php/barang_pinjam/struk_pinjam/"+x);

        eksekusi_controller('<?php echo base_url()?>index.php/barang_pinjam/form_peminjaman',' Kasir Pinjam');
    })
  
  }

return false;  
})



$("#simpan_pending").on("click",function(){
  if($("#nama_pembeli").val()=="")
  {
    alert("Nama harus isi");
    $("#nama_pembeli").focus();
    return false;
  }

  console.log($("#penjualan_barang").serialize());
  
  if(confirm("Anda yakin pending penjualan?"))
  {

    $.post("<?php echo base_url()?>index.php/"+classnya+"/go_pending_jual",$("#penjualan_barang").serialize(),function(x){
      console.log(x);
      
        eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');

        console.log("<?php echo base_url()?>index.php/barang/struk_penjualan/"+x);

        notif();   
    })
  
  }
  
return false;  
})




parseInt(".nomor");
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