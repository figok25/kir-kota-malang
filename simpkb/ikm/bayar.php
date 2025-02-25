<?php
session_start();
include "pagehead.php";
include "koneksi.php";

$nVer=rand(1000,9999);
?>
<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
<div class="ui-corner-all custom-corners" style="margin-top:-20px">

  <div class="ui-bar ui-bar-a">
    <h3>Status Pembayaran</h3>
  </div>
	<div class="ui-body ui-body-a" >

		<?php
			$str="select * from vWajibUjiList where IdWajibUji=1363";
			$rs = sqlsrv_query($conn,$str);	
			$r=sqlsrv_fetch_array($rs);
		
		  echo "
		  <p style='margin-top:0px;margin-bottom:-12px;font-size:140%'>Kode Pendaftaran:<br><span style='background-color:green;color:white;padding:2px'><b>A1WREQZ</b></span></p><br>
		  <p style='margin-top:10px;margin-bottom:0px;font-size:140%'><span style='background-color:green;color:white;padding:2px'>LUNAS</span></p>
		  
		  <p style='margin-bottom:-12px'>Nomor Uji Berkala:<br><span style='color:#0073e6'><b>- $r[NoUji]</b></span></p>
		  <p style='margin-bottom:-12px'>Nomor Kendaraan:<br><span style='color:#0073e6'><b>- $r[NoKendaraan]</b></span></p>
		  <p style='margin-bottom:-12px'>Jenis Kendaraan:<br><span style='color:#0073e6'><b>- $r[NmJenis]/$r[NmSubJenis]</b></span></p>
		  <p style='margin-bottom:-12px'>Nama Pemilik Kendaraan:<br><span style='color:#0073e6'><b>- $r[NmPemilik]</b></span></p>
		  <p style='margin-bottom:0px'>Alamat Pemilik Kendaraan:<br><span style='color:#0073e6'><b>- $r[Alamat], $r[NmKecamatan]</b></span></p>
		  <hr>
		  <p style='margin-bottom:-12px'>Tanggal Pengujian:<br><span style='color:red'><b>- $tgl</b></span></p>
		  <p style='margin-bottom:-12px'>Total Bayar:<br><span style='color:red'><b>- $r[Tarif]</b></span></p>
		  <p style='margin-bottom:-12px'>Rekening Bank BJB:<br><span style='color:red'><b>- xxx</b></span></p>
		  ";
		  ?>
		  <br>
		  <a href="http://localhost/simpkb" data-icon="tag" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-tag ui-btn-icon-right ui-shadow ui-corner-all">Halaman Depan</a>
	</div>


</div>
</div>
<?php
include "pagefoot.php";
?>