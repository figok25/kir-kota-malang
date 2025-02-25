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
<div class="ui-bar ui-bar-a"><h3>Riwayat Pengujian</h3>
</div>
<div class="ui-body ui-body-a">
	<form id="datapengujian" method="get" action="datapengujian.php"><label for="tanggal">Tanggal:</label>
	<input type="date" data-clear-btn="true" name="tanggal" id="tanggal" value="<?php echo $tgl; ?>" >
	<a href="javascript:mySubmit()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-shadow ui-corner-all">Tampil</a>
	</form>
<hr>
		<?php
		
		if(isset($_GET["tanggal"])){
			$tgl=$_GET["tanggal"];

			$str="select * from vPengujian where IdTipeUji<4 and TglUji='$tgl' and NoReg<>'REG.' order by IdTipeUji,NoReg asc";
			$rs = sqlsrv_query($conn,$str);
			$no=0;
			$trHasil="";
			while($ru=sqlsrv_fetch_array($rs)){
				//$date1=date_format(date_create($ru["strTglUji"]),"Y_m_d");
				$no++;
				$trHasil=$trHasil."<tr>
				<td valign=middle >$no</td>
				<td valign=middle >$ru[NoReg]<br>$ru[NoUji]</td>
				<td valign=middle >$ru[NmPetugasUji]<br>$ru[NIKPetugasUji]</td>
				<td valign=middle><a href='hasiluji.php?noreg=$ru[NoReg]&lajur=$ru[IdLajurUji]' data-rel='external'>$ru[NmStatusUji]</a></td>
				</tr>";
			};
			echo "
			<p>Jumlah baris: $no</p>
			<table id='riwayatuji' style='font-size:11px' >
			<tr><th>No.</th>
			<th>No. Reg.<br>No. Uji</th>
			<th>Penguji</th>
			<th>Hasil Uji</th>
			
			</tr>
			$trHasil
			</table>";
		}
		
		
		  ?>
<script>
function mySubmit() {
	try{
		document.getElementById("datapengujian").submit();
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