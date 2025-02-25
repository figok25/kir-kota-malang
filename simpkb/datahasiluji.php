<?php

include "pagehead.php";
include "koneksi.php";

if(isset($_GET["cari"])){
	$NoUji=$_GET["cari"];
}else{
	$NoUji="";
}
?>


<div  style="padding:8 8 8 8" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
<div class="ui-corner-all custom-corners">
<div class="ui-bar ui-bar-a"><h3>Data Hasil Uji</h3>
</div>
<div class="ui-body ui-body-a">
	<form id="datahasiluji" method="get" action="datahasiluji.php"><label for="cari">No.Uji/No.Kendaraan:</label>
	<input type="text" data-clear-btn="true" name="cari" id="cari" value="<?php echo $NoUji; ?>" >
	<a href="javascript:mySubmit()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-shadow ui-corner-all">Tampil</a>
	</form>
<hr>

<label>Riwayat Hasil Uji:</label><br>
		<?php
		echo "<table id='riwayatuji' style='margin-top:-14px;font-size:90%'>
			<th>Tgl. Uji<br>Jt. Tempo</th>
			<th>Penguji</th>
			<th>Hasil Uji</th>
			
			</tr>
		";
		$str="select *,case when (JmhBulanBulat<0) then 0 else (JmhBulanBulat/6+ case JmhBulanBulat%6 when 0 then 0 else 1 end) end as JmhPeriode,cast(TglUji as varchar) as  strTglUji from vPengujian where NoUji='$NoUji' order by TglUji desc";		
$rs = sqlsrv_query($conn,$str);
		while($ru=sqlsrv_fetch_array($rs)){
			$date1=date_format(date_create($ru["strTglUji"]),"Y_m_d");
			$date2=date_format(date_create($ru["TglJatuhTempo"]),"Y_m_d");
			echo "<tr>
			<td valign=middle class='isian-nilai'>$date1<br>$date2</td>
			<td valign=middle class='isian-nilai'>$ru[NmPetugasUji]<br>$ru[NIKPetugasUji]</td>
			<td valign=middle class='isian-nilai'><a href='hasiluji.php?noreg=$ru[NoReg]&lajur=$ru[IdLajurUji]' data-rel='external'>$ru[NmStatusUji]</a></td>
			</tr>";
			
		};
		  
		
		echo "</table>";
		  ?>
<script>
function mySubmit() {
	try{
		document.getElementById("datahasiluji").submit();
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