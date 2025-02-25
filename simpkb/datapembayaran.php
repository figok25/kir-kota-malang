<?php

include "pagehead.php";
include "koneksi.php";

if(isset($_GET["tanggal"])){
	$tgl=$_GET["tanggal"];
}else{
	$tgl=date('Y-m-d');
}
?>


	<div  style="padding:8 8 8 8" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
<div class="ui-corner-all custom-corners">
<div class="ui-bar ui-bar-a"><h3>Data Pembayaran Harian</h3>
</div>
<div class="ui-body ui-body-a">
	<form id="datapembayaran" method="get" action="datapembayaran.php"><label for="tanggal">Tanggal:</label>
	<input type="date" data-clear-btn="true" name="tanggal" id="tanggal" value="<?php echo $tgl; ?>" >
	<a href="javascript:mySubmit()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-shadow ui-corner-all">Tampil</a>
	</form>
<hr>
		<?php
		
		if(isset($_GET["tanggal"])){
			$tgl=$_GET["tanggal"];

			$str="select NoReg, NoUji,NoKendaraan,BiayaTotal from vPembayaran where Aktif=1 and (IdJenisBayar=1 or IdJenisBayar=2) and IdStatusBayar=1 and TglUji ='$tgl' order by TglUji, NoReg";
			$rs = sqlsrv_query($conn,$str);
			$no=0;
			$JumlahBayar=0;
			$trHasil="";
			while($ru=sqlsrv_fetch_array($rs)){
				//$date1=date_format(date_create($ru["strTglUji"]),"Y_m_d");
				$no++;
				$JumlahBayar=$JumlahBayar+$ru["BiayaTotal"];
				$Biaya=number_format($ru["BiayaTotal"]);
				$trHasil=$trHasil."<tr>
				<td valign=middle >$no</td>
				<td valign=middle >$ru[NoReg]</td>
				<td valign=middle >$ru[NoUji]<br>$ru[NoKendaraan]</td>
				<td valign=middle >$Biaya</td>
				</tr>";
			};
			$TotalRp=number_format($JumlahBayar);
			echo "
			<p>Jumlah Baris: $no<br>Jumlah Pembayaran : Rp. $TotalRp</p>
			<table id='riwayatuji' style='font-size:11px' >
			<tr><th>No.</th><th>No. Reg</th>
			<th>No. Uji<br>No. Kendaraan</th>
			<th>Biaya Rp.</th>
			
			</tr>
			$trHasil
			</table>";
		}
		
		
		  ?>
<script>
function mySubmit() {
	try{
		document.getElementById("datapembayaran").submit();
	}catch(err){
		alert(err.message);
	}
}
</script>
</div>
</div>	
	


	  
		  
		</div>
	



<?php
include "pagefoot.php";
?>