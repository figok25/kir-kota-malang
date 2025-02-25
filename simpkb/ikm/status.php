<?php
session_start();
include "pagehead.php";
include "koneksi.php";
$NoUji=$_POST['txtCari'];
$s=$_POST["s"];
$nVer=rand(1000,9999);
	$_SESSION['staDaftar']=1;

	if(isset($_POST["s"])){

	$str="select top 1 NoKendaraan,NoUji,TglUji,NoReg,BiayaRetribusi,BiayaDenda,BiayaBuku,case when JATIM_REF is null then 'BELUM BAYAR' else 'SUDAH BAYAR' end as staBayar from vpengujian where noUji='$NoUji'  order by tglUji desc";
	//echo $str;
	$rs = sqlsrv_query($conn,$str);	
	$r=sqlsrv_fetch_array($rs);
	$NoUji=$r["NoUji"];
	$JBB=$r["JBB"];
	$NoKendaraan=$r["NoKendaraan"];
	$NmPemilik=$r["NmPemilik"];
	$Alamat=$r["Alamat"];
	$Tarif=$r["Tarif"];
	$TglJatuhTempo=$r["TglJatuhTempo"];
	$IdWajibUji=$r["IdWajibUji"];
	$penerbitan=$r["keterangan"];
	$NoReg=$r["NoReg"];
	$TglUji=$r["TglUji"];
	$staBayar=$r["staBayar"];
	$TglUji=date_format($TglUji,"Y-m-d");
	$TotalBayar=$r["BiayaRetribusi"]+$r["BiayaDenda"]+$r["BiayaBuku"];
	$strChar="";
	$setBrivaNo = "";
	$lNoUji=strlen($NoUji);

?>
		<script>
		function submitCekBayar() {
			try{
				document.getElementById("frmCekBayar").submit();
			}catch(err){
				alert(err.message);
			}
		}
		</script> 
	<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
	<div class="ui-corner-all custom-corners" style="margin-top:-20px">
			
	  <div class="ui-bar ui-bar-a">
	    <h3>Status Pembayaran</h3>
	  </div>
		<div class="ui-body ui-body-a" >

			<?php
			$str="select NmHari from NamaHari where IdHari=datepart(weekday, '$TglUji')";
			$rsHari = sqlsrv_query($conn,$str);	
			$rHari=sqlsrv_fetch_array($rsHari);
			$NmHari=$rHari["NmHari"];
			$TglUji=date_create($TglUji);
			$TglUji=$NmHari.", ". date_format($TglUji,"d/m/Y");

				echo "<p style='margin-top:0px;margin-bottom:-12px;font-size:110%'>No. Pendaftaran:<br><span style='background-color:green;color:white;padding:2px'>$NoReg</span></p>";
				echo "<br><center><img alt='NoRegBarcode' src='barcode.php?text=$NoReg&size=40'/></center>";
				echo "<p style='margin-top:10px;margin-bottom:0px;font-size:140%'><span style='background-color:green;color:white;padding:2px'>- $staBayar</span></p>";
				echo "<p style='margin-bottom:-12px'>Nomor Uji Berkala :<br><span style='color:#0073e6'><b>- $NoUji</b></span></p>";
				echo "<p style='margin-bottom:-12px'>Nomor Kendaraan :<br><span style='color:#0073e6'><b>- $NoKendaraan</b></span></p>";
				echo "<p style='margin-bottom:-12px'>Tanggal Pengujian:<br><span style='color:red'><b>- $TglUji</b></span></p>";
				echo "<p style='margin-bottom:-12px'>Total Bayar:<br><span style='color:red'><b>- Rp. $TotalBayar</b></span></p>";
				echo "<p style='margin-bottom:-12px'>Nomor Virtual Account:<br><span style='color:red'><b>- 10029 $NoReg</b></span></p>";
				echo "<p style='margin-bottom:-12px'><img src='master.jpg' width=80%></p>";
				?>
							  <br>
			  
				<?php

			  ?>

			  <hr>
			  

			  
			  <a href="http://ujikirkotamalang.ip-dynamic.com/simpkb/daftar/" data-icon="tag" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-tag ui-btn-icon-right ui-shadow ui-corner-all">Halaman Depan</a>
		</div>
	</div>
	</div>
	<?php

	}else{
	?>


		<script>
		function submitCekStatus() {
			try{
				document.getElementById("frmCekStatus").submit();
			}catch(err){
				alert(err.message);
			}
		}
		</script> 


		<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
		<div class="ui-corner-all custom-corners" style="margin-top:-20px">

					<form style="margin-top:-10px" id="frmCekStatus" name="frmCekStatus" method="post" action="status.php">
				<input type="hidden" name="s" value="6">

					<div>
		     		<label for="search-1" style="text-shadow:0 0px 0 black">Pencarian Berdasarkan:</label>
						<div class="ui-field-contain" style="margin-top:-30px">
						    <select name="keyid" id="keyid" data-native-menu="false">
						        <option value="NoUji" selected="selected">Nomor Uji</option>
						        <option value="NoKendaraan">Nomor Kendaraan</option>
						    </select>
						</div>	
					</div>

					<div style="margin-top:-36px">
		     		<input type="search" name="txtCari" id="txtCari" value="">

						<a href="javascript:submitCekStatus()" data-icon="search" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-search ui-btn-icon-right ui-shadow ui-corner-all">Cek Status</a>

					</div>
					</form>

		</div>
		</div>


<?php
	}
include "pagefoot.php";
?>