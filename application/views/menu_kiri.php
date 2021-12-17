
        <li>
          <a href="<?php echo base_url()?>index.php/welcome">
            <i class="fa fa-home"></i> <span>Beranda</span>
          </a>
        </li>

 

        <?php 
        if($this->session->userdata('level')=='1')
        {
        ?>
        <!--
        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/cabang/data_cabang','Master Cabang');return false;">
            <i class="fa fa-lock"></i> <span>Master Cabang</span>
          </a>
        </li>
      -->


        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/admin/data_admin','Master Admin');return false;">
            <i class="fa fa-lock"></i> <span>Master Admin</span>
          </a>
        </li>

         <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/karyawan/data','Karyawan');return false;">
            <i class="fa fa-users"></i> <span>Karyawan</span>
          </a>
        </li>




        
        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Modal</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_penambahan_saldo','Penambahan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penambahan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_penarikan_saldo','Penarikan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penarikan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_koreksi','Koreksi Keuangan');return false;">
                <i class="fa fa-link"></i> <span>Koreksi Keuangan</span>
              </a>
            </li>


            
          </ul>
        </li>
        <!--
         <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data_sales_admin','Trx Sales Hasil');return false;">
                <i class="fa fa-link"></i> <span>Trx Sales</span>
              </a>
            </li>
        -->



        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Pengeluaran Bulanan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/data','Master Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Data Pengeluaran</span>
              </a>
            </li>

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/form_pengeluaran_bulanan','Form Transaksi');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/trx_pengeluaran_bulanan','Transaksi Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Lap.Pengeluaran</span>
              </a>
            </li>

            
          </ul>
        </li>



        


        <li class="treeview">
          
          <a href="#"><i class="fa fa-database"></i> <span>Master Barang <span class="label label-danger pull-right badge_barang"></span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data','Master Barang');return false;">
                <i class="fa fa-link"></i> <span>Data Barang</span>
              </a>
            </li>

             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data_barcode','Generate Barcode Barang');return false;">
                <i class="fa fa-link"></i> <span>Barcode Generator</span>
              </a>
            </li>

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data_beli','Pembelian Barang');return false;">
                <i class="fa fa-link"></i> <span>Barang Masuk <span class="label label-danger pull-right badge_barang_baru"></span></span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/barang_transaksi/?mulai=<?php echo date( 'Y-m-d', strtotime(' -1 day' ))?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Transaksi Barang');return false;">
                <i class="fa fa-link"></i> <span>Lap.Transaksi</span>
              </a>
            </li>

            <!--
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_penjualan','Transaksi Penjualan');return false;">
                <i class="fa fa-link"></i> <span>Lap.Penjualan</span>
              </a>
            </li>
          -->



           <li>
            <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_penjualan/?mulai=<?php echo date( 'Y-m-')?>1&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Transaksi Penjualan');return false;">
              <i class="fa fa-link"></i> <span>Lap.Penjualan</span>
            </a>
          </li>


           <li>
            <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_penjualan_hapus/?mulai=<?php echo date( 'Y-m-d', strtotime(' -1 day' ))?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Transaksi Penjualan');return false;">
              <i class="fa fa-link"></i> <span>Hapus Trx</span>
            </a>
          </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_pending/?id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Transaksi Pending');return false;">
                <i class="fa fa-link"></i> <span>Pending  <span class="label label-danger pull-right badge_pending"></span></span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/return_barang','Return Barang');return false;">
                <i class="fa fa-link"></i> <span>Return Barang</span>
              </a>
            </li>

            
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/return_list_suplier','Return Barang');return false;">
                <i class="fa fa-link"></i> <span>Return Suplier</span>
              </a>
            </li>


           <li>
            <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_barang/?mulai=<?php echo date( 'Y-m-d', strtotime(' -1 day' ))?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Transaksi Detail Penjualan');return false;">
              <i class="fa fa-link"></i> <span>Lap.Barang</span>
            </a>
          </li>


            
          </ul>
        </li>



         <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/pesanan_member','Pesanan Member');return false;">
            <i class="fa fa-link"></i> <span>Pesanan  Member<span class="label label-danger pull-right badge_pesanan_member"></span></span>
          </a>
        </li>



           <li>
            <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_penjualan_pelanggan/?id_pelanggan=6&mulai=<?php echo date( 'Y-m-d', strtotime(' -1 day' ))?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Transaksi Penjualan');return false;">
              <i class="fa fa-link"></i> <span>Penjualan Member</span>
            </a>
          </li>


        <li class="treeview">
          
          <a href="#"><i class="fa fa-users"></i> <span>Pelanggan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/Pelanggan/data','Master Pelanggan');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>
            
            
              <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_penjualan/?mulai=<?php echo date( 'Y-m-')?>1&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Transaksi Barang');return false;">
                <i class="fa fa-link"></i> <span>Lap.Transaksi</span>
              </a>
            </li>
            
            
            <!--
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/Pelanggan/transaksi','Utang/Piutang');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>              
            </li>
          -->


            
            
          </ul>
        </li>



        <li class="treeview">
          
          <a href="#"><i class="fa fa-users"></i> <span>Penjual</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/penjual/data','Master Penjual');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/penjual/transaksi','Utang/Piutang');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>


            
            
          </ul>
        </li>


        <!--
        <li class="treeview">
          
          <a href="#"><i class="fa fa-car"></i> <span>Ekspedisi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/ekspedisi/data','Master Ekspedisi');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>

            
          </ul>
        </li>
      -->




        <li class="treeview">
          
          <a href="#"><i class="fa fa-institution"></i> <span>Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/gudang/data','Master Gudang');return false;">
                <i class="fa fa-link"></i> <span>Master</span>
              </a>
            </li>
            
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/?id_gudang=1&id_cabang=<?php echo $this->session->userdata('id_cabang')?>','Stok Gudang');return false;">
                <i class="fa fa-link"></i> <span>Stok Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/log_pindah_gudang/?mulai=<?php echo date('Y-m-').'01'?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Log Gudang');return false;">
                <i class="fa fa-link"></i> <span>Log Perpindahan </span>
              </a>
            </li>

            
            
          </ul>
        </li>



        

        <!--
        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pembatalan/data_paket','Data Pembatalan');return false;">
            <i class="fa fa-remove"></i> <span>Pembatalan</span>
          </a>
        </li>
        -->



        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Laporan Keuangan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/kas','Saldo');return false;">
                <i class="fa fa-link"></i> <span>Saldo</span>
              </a>
            </li>

           

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Jurnal');return false;">
                <i class="fa fa-link"></i> <span>Jurnal</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/arus_kas','Laporan Arus Kas');return false;">
                <i class="fa fa-link"></i> <span>Arus Kas</span>
              </a>
            </li>



             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_laba/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Laba Rugi');return false;">
                <i class="fa fa-link"></i> <span>Laba Rugi</span>
              </a>
            </li>



                        
          </ul>
        </li>

        



        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Kasir</span>
          </a>
        </li>


        



        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Suplier</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">



        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_pembelian',' Order Suplier');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Order Suplier</span>
          </a>
        </li>


        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang?mulai=<?php echo date('Y-m-').'01'?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>','History Order');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Status Order</span>
          </a>
        </li>

        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/history_tbl_pembelian_barang?mulai=<?php echo date('Y-m-').'01'?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>','History Order');return false;">
            <i class="fa fa-shopping-cart"></i> <span>History Order</span>
          </a>
        </li>

        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/hutang_ke_penjual','Hutang Order');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Hutang Order</span>
          </a>
        </li>



          </ul>
        </li>

        

        
        


        <li class="treeview">
          
          <a href="#"><i class="fa fa-institution"></i> <span>User Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
            
        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang?mulai=<?php echo date('Y-m-').'01'?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>','History Order');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Status Order</span>
          </a>
        </li>

             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_barang_sementara','Barang Masuk');return false;">
                <i class="fa fa-lock"></i> <span>Barang Masuk</span>
              </a>
            </li>
            
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/1','Stok Gudang');return false;">
                <i class="fa fa-link"></i> <span>Stok Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
              </a>
            </li>

            
            

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/log_pindah_gudang','Log Gudang');return false;">
                <i class="fa fa-link"></i> <span>Log Perpindahan </span>
              </a>
            </li>
          </ul>
        </li>
        <?php 
          }

          if($this->session->userdata('level')=='2')
          {?>

            


        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Laporan Keuangan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/kas','Saldo');return false;">
                <i class="fa fa-link"></i> <span>Saldo</span>
              </a>
            </li>

           

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Jurnal');return false;">
                <i class="fa fa-link"></i> <span>Jurnal</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/arus_kas','Laporan Arus Kas');return false;">
                <i class="fa fa-link"></i> <span>Arus Kas</span>
              </a>
            </li>





                        
          </ul>
        </li>

        






         <?php 
          }
        ?>




        <?php 
          //kasir
          if($this->session->userdata('level')=='3')
          {?>



        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_penjualan',' Kasir');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Kasir</span>
          </a>
        </li>


         <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/pesanan_member','Pesanan Member');return false;">
            <i class="fa fa-link"></i> <span>Pesanan  Member<span class="label label-danger pull-right badge_pesanan_member"></span></span>
          </a>
        </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_pending','Transaksi Pending');return false;">
                <i class="fa fa-link"></i> <span>Pending  <span class="label label-danger pull-right badge_pending"></span></span>
              </a>
            </li>
         <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data','Master Barang');return false;">
                <i class="fa fa-link"></i> <span>Data Barang</span>
              </a>
            </li>

            
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/return_barang','Return Barang');return false;">
                <i class="fa fa-link"></i> <span>Return Barang</span>
              </a>
            </li>



         <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/lap_penjualan/?mulai=<?php echo date( 'Y-m-d', strtotime(' -1 day' ))?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Transaksi Penjualan');return false;">
            <i class="fa fa-link"></i> <span>Lap.Penjualan</span>
          </a>
        </li>

        
        <li class="treeview">
          
          <a href="#"><i class="fa fa-users"></i> <span>Pelanggan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/Pelanggan/transaksi','Utang/Piutang');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>

            
            
          </ul>
        </li>



        

        <?php }?>


        


        <?php 
          if($this->session->userdata('level')=='4')
          {?>




        <li class="treeview">
          
          <a href="#"><i class="fa fa-institution"></i> <span>User Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/tbl_pembelian_barang',' Order Suplier');return false;">
                <i class="fa fa-shopping-cart"></i> <span>Status Order</span>
              </a>
            </li>

             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_barang_sementara','Barang Masuk');return false;">
                <i class="fa fa-lock"></i> <span>Barang Masuk</span>
              </a>
            </li>
            
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/1','Stok Gudang');return false;">
                <i class="fa fa-link"></i> <span>Stok Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
              </a>
            </li>


            
            
          </ul>
        </li>



        

        <?php }?>



        <?php 
          //member
          if($this->session->userdata('level')=='5')
          {?>


        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/kasir',' Kasir Belanja');return false;">
            <i class="fa fa-link"></i> <span>Belanja</span>
          </a>
        </li>



         <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/pesanan_member','Pesanan Member');return false;">
            <i class="fa fa-link"></i> <span>Pesanan<span class="label label-danger pull-right badge_pesanan_ku"></span></span>
          </a>
        </li>


        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/lap_penjualan_pelanggan/?mulai=<?php echo date( 'Y-m-d', strtotime(' -1 day' ))?>&selesai=<?php echo date('Y-m-d',strtotime('+1 days'));?>',' History Belanja');return false;">
            <i class="fa fa-link"></i> <span>History Belanja</span>
          </a>
        </li>



         <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pelanggan/master_barang','Master Barang');return false;">
            <i class="fa fa-link"></i> <span>Master Barang</span>
          </a>
        </li>


        <?php }?>



        <?php 
          //customer service
          if($this->session->userdata('level')=='6')
          {?>
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data','Master Barang');return false;">
                <i class="fa fa-link"></i> <span>Data Barang</span>
              </a>
            </li>




        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Return Barang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
            <ul class="treeview-menu">
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/return_barang','Return Barang');return false;">
                <i class="fa fa-link"></i> <span>Return Barang</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/return_list_suplier','Return Barang');return false;">
                <i class="fa fa-link"></i> <span>Return Suplier</span>
              </a>
            </li>



          </ul>
        </li>






        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Pengeluaran Bulanan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/data','Master Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Data Pengeluaran</span>
              </a>
            </li>

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/form_pengeluaran_bulanan','Form Transaksi');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/trx_pengeluaran_bulanan','Transaksi Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Lap.Pengeluaran</span>
              </a>
            </li>

            
          </ul>
        </li>





        
        <?php }?>




        <?php 
          //sales
          if($this->session->userdata('level')=='7')
          {?>
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data','Master Barang');return false;">
                <i class="fa fa-link"></i> <span>Data Barang</span>
              </a>
            </li>




        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Persenan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
            <ul class="treeview-menu">
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data_sales/<?php echo $this->session->userdata('id_admin')?>','Sales Hasil');return false;">
                <i class="fa fa-link"></i> <span>Data Hasil</span>
              </a>
            </li>




          </ul>
        </li>







        
        <?php }?>

        
        <li>
          <a href="#">
             &nbsp;
          </a>
        </li>


            
           