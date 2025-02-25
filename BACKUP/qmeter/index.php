<?php
session_start();

include "pagehead.php";
include "koneksi.php";
	function setNamaBulan($idBulan){
		switch($idBulan){
		case 1:
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
		default:
			echo "";
			break;
		}
		
	}
?>
<script>
function myFunction() {
	try{
		document.getElementById("myFunction").submit();
	}catch(err){
		alert(err.message);
	}
}
</script>

<div style="padding:8px" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">

        <div class="ui-corner-all custom-corners">

<?php

if($_GET["add"]==1){

	?>
	 <div class="ui-bar ui-bar-a">
		<h3>Tambah Data</h3>
	</div>
	<div class="ui-body ui-body-a">
	<form action="submit.php" id="myFunction" method="post">

	<table width=100%>
	<tr>
	<td>Nama</td><td>
	<div class="ui-field-contain"><select name="NamaQori" id="NamaQori" data-native-menu="false" data-mini="true">
	<option value="-1">-</option>
	<?php
	$q = "select * from qori order by IdQori";

	$qrs = sqlsrv_query($conn, $q);
	while ($ru = sqlsrv_fetch_array($qrs)) {
		echo "<option value=$ru[IdQori]>$ru[NamaQori]</option>";

	}

	?></select>
	</div>
	</td></tr>
	<tr><td>Tanggal</td>
	<td>
	<input type="date" min="2022-01-01" max="2050-12-31" data-clear-btn="true" name="tanggal" id="tanggal" 
	value="<?php echo date("Y-m-d");?>">
	</td></tr>
	<tr><td>Jam</td>
	<td>
	<input type="time" data-clear-btn="true" name="jam" id="jam" value="<?php echo date("H:i");?>">
	</td></tr>
	<tr><td>Hal. Mulai</td>
	<td>
	<input type="Text" name="mulai">
	</td></tr>
	<tr><td>Hal. Selesai</td>
	<td>
	<input type="Text" name="selesai">
	</td></tr>
	</table>

	</form>
	
	<a href="javascript:myFunction()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-check ui-btn-icon-right ui-shadow ui-corner-all">Simpan</a>
	</div>
  </div>
<?php
}elseif($_GET["detail"]>0){
	?>
	 <div class="ui-bar ui-bar-a">
		<h3>Detail: <?php echo $_GET["nama"];  ?></h3>
	</div>
	<div class="ui-body ui-body-a">	
	<table >
	<tr ><th>Waktu</th><th>Juz</th><th>Mulai</th><th>Selesai</th><th>Jumlah</th><th></th></tr>
		<?php

			$q = "select * from vqmeter_juz where IdQori=$_GET[detail] and month(RecDate)=month(getdate()) and year(RecDate)=year(getdate()) order by RecDate";
			$qrs = sqlsrv_query($conn, $q);

			while ($ru = sqlsrv_fetch_array($qrs)) {
				if($ru["HalJum"]>=10){
					$star="<img src='themes/images/star_full.png'>";
				}elseif($ru["HalJum"]>=7){
					$star="<img src='themes/images/star_empty.png'>";
				}elseif($ru["HalJum"]>=4){
					$star="<img src='themes/images/jempol1.png'>";
				}else{
					$star="<img src='themes/images/jempol0.png'>";
				}
				echo "<tr><td>".$ru["RecDate"]->format('d-M-Y H:i')."</td><td align=right>$ru[IdJuz]</td><td align=right>$ru[HalMulai]</td><td align=right>$ru[HalSelesai]</td><td align=right>$ru[HalJum]</td><td>$star</td></tr>";
			}
					
		?>
	</table>
<script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	animationEnabled: true,  	
	title:{
		text: "Resume"
	},
	axisY: {
		suffix: ""
	},
	toolTip: {
		shared: true,
		reversed: true
	},
	legend: {
		reversed: true,
		verticalAlign: "center",
		horizontalAlign: "right"
	},
	data: [
	<?php
			$q = "select IdHalQuran,sum(isnull(Hitung,0)) as Hitung, case when sum(isnull(Hitung,0))>6 then 'blue' when sum(isnull(Hitung,0))>3 then 'green' when sum(isnull(Hitung,0))>0 then 'gold' else 'lightgrey' end as warna 
				from halquran_detail  
					left join vcount_triwulan on halquran_detail.IdHalQuran=vcount_triwulan.halaman and IdQori=$_GET[detail] and vcount_triwulan.bulan=1 and vcount_triwulan.tahun= 2024 
					where idhalquran between 582 and 604 
					group by IdHalQuran
					order by IdHalQuran ";
/* 			$q="select IdHalQuran,
				'Fatih' as Nama2, 
				'Umar' as Nama3, 
				'Jabar' as Nama4, 
				isnull(Jum2,0) as Jum2, 
				isnull(Jum3,0) as Jum3, 
				isnull(Jum4,0) as Jum4, 
				case when Jum2>5 then '#41663A' when Jum2=5 then '#528048' when Jum2=4 then '#629957' when Jum2=3 then '#72B365' when Jum2=2 then '#83CC73' when Jum2=1 then '#A4FF90'   else 'lightgrey' end as warna2,
				case when Jum3>5 then '#41663A' when Jum3=5 then '#528048' when Jum3=4 then '#629957' when Jum3=3 then '#72B365' when Jum3=2 then '#83CC73' when Jum3=1 then '#A4FF90'   else 'lightgrey' end as warna3,
				case when Jum4>5 then '#41663A' when Jum4=5 then '#528048' when Jum4=4 then '#629957' when Jum4=3 then '#72B365' when Jum4=2 then '#83CC73' when Jum4=1 then '#A4FF90'   else 'lightgrey' end as warna4
			from halquran_detail  
				left join vcount_triwulan on halquran_detail.IdHalQuran=vcount_triwulan.halaman and triwulan=4 and tahun=2023
				where idhalquran between 582 and 604"; */
			$qrs = sqlsrv_query($conn, $q);

			$ru = sqlsrv_fetch_array($qrs);
		
	
	?>
	{
		type: "stackedColumn100",
		name: "<?php echo $ru["IdHalQuran"]; ?>",
		yValueFormatString: "<?php if($ru["Hitung"]==0){echo '-';}else{echo $ru["Hitung"].'x';}; ?>",
		dataPoints: [
		{ label: "<?php echo $_GET["nama"]; ?>", y: 100/23 ,color:"<?php echo $ru["warna"]; ?>"}
		]
	}
	<?php
	
	while($ru = sqlsrv_fetch_array($qrs)){
	?>
	,{
		type: "stackedColumn100",
		name: "<?php echo $ru["IdHalQuran"]; ?>",
		yValueFormatString: "<?php if($ru["Hitung"]==0){echo '-';}else{echo $ru["Hitung"].'x';}; ?>",
		dataPoints: [
		{ label: "<?php echo $_GET["nama"]; ?>", y: 100/23 ,color:"<?php echo $ru["warna"]; ?>"}
		]
	}
	<?php
	}
	?>
	]
};

$("#chartContainer").CanvasJSChart(options);

}
</script>
<div id="chartContainer" style="height: 420px; width: 100%;"></div>	
		</div>
	  </div>	
	<?php
}else{
	$Tahun= date("Y");
	$Bulan= date("m");
	$NmBulan=setNamaBulan($Bulan);
	?>
	<div class="ui-bar ui-bar-a">
		<h3>Peringkat Bulan : <?php echo $NmBulan." - ".$Tahun;?></h3>
	</div>
	<div class="ui-body ui-body-a">	

	<table>
	<tr  ><th>No.</th><th>Nama</th><th>Terakhir</th><th>Hal.</th><th>Jumlah</th><th></th></tr>
	<?php

	$q = "select * from vrekapqmeter_last where month(TglSelesai)=month(getdate()) and year(TglSelesai)=year(getdate()) order by Jumlah DESC";
	$qrs = sqlsrv_query($conn, $q);
	$i=0;
	while ($ru = sqlsrv_fetch_array($qrs)) {
		$i++;

		echo "<tr>
		<td>$i</td>
		<td><a>$ru[NamaQori]</a></td>

		<td>".$ru["TglSelesai"]->format('d-M-Y H:i')."</td>
		<td align=right>$ru[HalTerakhir]</td>
		<td align=right>$ru[Jumlah]</td>
		<td><a href='http://besmarty.net/qmeter/?detail=$ru[IdQori]&nama=$ru[NamaQori]'>...</a></td>
		</tr>";
	}
	echo "</table>";
	if($i==0){
		echo "NO DATA";
	}		
	?>

	</div>
	<hr>
	<?php

	?>
	<div class="ui-bar ui-bar-a">
		<h3>Bonus Bulan : </h3>
	</div>
	<div class="ui-body ui-body-a">	

	<table>
		<tr  ><th>No.</th><th>Nama</th><th></th><th>Jumlah</th><th></th><th>Rp.</th><th></th></tr>
		<?php
		$Tahun= '2024';//date("Y");
		$Bulan= '2';//date("m")-1;
		$NmBulan=setNamaBulan($Bulan);
		echo "<tr ><td colspan=7><hr><i>$NmBulan - $Tahun</i><hr></td></tr>";
		$q = "select *,Jumlah*1000 as JumRp from vrekapqmeter_perbulan where bulan=$Bulan and tahun=$Tahun order by Jumlah DESC";
		$qrs = sqlsrv_query($conn, $q);
		$i=0;
		$bon=0;

		while ($ru = sqlsrv_fetch_array($qrs)) {
			$i++;
			$imgStart="";
			for($j=1;$j<=$ru["Hafalan"];$j++){
				$imgStart=$imgStart."<img src='themes/images/red_heart.png'>";
			}
			$bonBintang=$ru["RpB1"]+$ru["RpB0"]+$ru["RpJ1"]+$ru["RpJ0"];
			$Bintang="";
			for($j=1;$j<=$ru["JumBintang1"];$j++){
				$Bintang.="<img src='themes/images/star_full.png'>";
			}
			for($j=1;$j<=$ru["JumBintang0"];$j++){
				$Bintang.="<img src='themes/images/star_empty.png'>";
			}
			for($j=1;$j<=$ru["JumJempol1"];$j++){
				$Bintang.="<img src='themes/images/jempol1.png'>";
			}
			for($j=1;$j<=$ru["JumJempol0"];$j++){
				$Bintang.="<img src='themes/images/jempol0.png'>";
			}
			echo "<tr>
			<td>$i</td>
			<td><a>$ru[NamaQori]</a></td>
			<td>".$imgStart."</td>
			<td align=right>$ru[Jumlah]</td>
			<td>$Bintang</td>
			<td align=right>".str_replace(",",".",number_format($ru["JumRp"]+$bonBintang))."</td>
			</tr>";
		}
		
		$Tahun= '2024';//date("Y");
		$Bulan= '1';//date("m")-2;
		$NmBulan=setNamaBulan($Bulan);
		echo "<tr ><td colspan=7><hr><i>$NmBulan - $Tahun</i><hr></td></tr>";
		$q = "select * from vrekapqmeter_perbulan where bulan=$Bulan and tahun=$Tahun order by Jumlah DESC";
		$qrs = sqlsrv_query($conn, $q);
		$i=0;
		$bon=0;

		while ($ru = sqlsrv_fetch_array($qrs)) {
			$i++;
			$imgStart="";
			for($j=1;$j<=$ru["Hafalan"];$j++){
				$imgStart=$imgStart."<img src='themes/images/red_heart.png'>";
			}
			$bonBintang=$ru["RpB1"]+$ru["RpB0"]+$ru["RpJ1"]+$ru["RpJ0"];
			$Bintang="";
			for($j=1;$j<=$ru["JumBintang1"];$j++){
				$Bintang.="<img src='themes/images/star_full.png'>";
			}
			for($j=1;$j<=$ru["JumBintang0"];$j++){
				$Bintang.="<img src='themes/images/star_empty.png'>";
			}
			for($j=1;$j<=$ru["JumJempol1"];$j++){
				$Bintang.="<img src='themes/images/jempol1.png'>";
			}
			for($j=1;$j<=$ru["JumJempol0"];$j++){
				$Bintang.="<img src='themes/images/jempol0.png'>";
			}
			echo "<tr>
			<td>$i</td>
			<td><a>$ru[NamaQori]</a></td>
			<td>".$imgStart."</td>
			<td align=right>$ru[Jumlah]</td>
			<td>$Bintang</td>
			<td align=right>".str_replace(",",".",number_format($ru["JumRp"]+$bonBintang))."</td>
			</tr>";
		}		
		
		?>
		</table>
		<hr>	
	<p>
	1 Halaman : Rp. 1.000
	<br>
	<img src='themes/images/star_full.png'> : Rp. 12.000
	<br>
	<img src='themes/images/star_empty.png'> : Rp. 9.000
	<br>
	<img src='themes/images/jempol1.png'> : Rp. 6.000
	<br>
	<img src='themes/images/jempol0.png'> : Rp. 3.000
	</p>
	<p>
	<b>Rp. : Halaman + Bintang</b>
	</p>		
		
	</div>

	<div class="ui-bar ui-bar-a">
		<h3>Bonus Total : <?php echo $Tahun;?></h3>
	</div>
	<div class="ui-body ui-body-a">	

	<table>
		<tr><th>No.</th><th>Nama</th><th></th><th>Jumlah</th><th>Bonus Rp.</th><th>Saldo Rp.</th></tr>
		<?php

		$q = "select  vrekapqmeter_pertahun.NamaQori, TotHal,TotJumRp,Tahun,Hafalan,Saldo  from vrekapqmeter_pertahun left join vSaldo on vrekapqmeter_pertahun.IdQori=vSaldo.IdQori where tahun=2024 order by TotHal DESC";
		$qrs = sqlsrv_query($conn, $q);
		$i=0;
		$bon=0;

		while ($ru = sqlsrv_fetch_array($qrs)) {
			$i++;
			$imgStart="";
			for($j=1;$j<=$ru["Hafalan"];$j++){
				$imgStart=$imgStart."<img src='themes/images/red_heart.png'>";
			}
			echo "<tr>
			<td>$i</td>
			<td><a>$ru[NamaQori]</a></td>
			<td>".$imgStart."</td>
			<td align=right>$ru[TotHal]</td>
			<td align=right>".str_replace(",",".",number_format($ru["TotJumRp"]))."</td>
			<td align=right>".str_replace(",",".",number_format($ru["Saldo"]))."</td>
			</tr>";
		}
					
		?>
		</table>
		<a href="http://besmarty.net/qmeter/transaksi.php" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-action ui-btn-icon-right ui-shadow ui-corner-all">Ambil</a>
	</div>			
	
<hr>




	<div class="ui-bar ui-bar-a">
					<h3>Data Riwayat</h3>
				</div>
				<div class="ui-body ui-body-a">
	<a href="http://besmarty.net/qmeter/?add=1" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-plus ui-btn-icon-right ui-shadow ui-corner-all">Tambah Data</a>
	<table >
	<tr ><th>Waktu</th><th>Nama</th><th>Juz</th><th>Mulai</th><th>Selesai</th><th>Jumlah</th><th></th></tr>
				<?php

					$q = "select * from vqmeter_juz order by RecDate DESC";
					$qrs = sqlsrv_query($conn, $q);

					while ($ru = sqlsrv_fetch_array($qrs)) {
						if($ru[HalJum]>=10){
							$star="<img src='themes/images/star_full.png'>";
						}elseif($ru[HalJum]>=7){
							$star="<img src='themes/images/star_empty.png'>";
						}elseif($ru[HalJum]>=4){
							$star="<img src='themes/images/jempol1.png'>";
						}else{
							$star="<img src='themes/images/jempol0.png'>";
						}
						echo "<tr>
							<td>".$ru["RecDate"]->format('d-M-Y H:i')."</td>
							<td><a>$ru[NamaQori]</a></td><td align=right>$ru[IdJuz]</td>
							<td align=right>$ru[HalMulai]</td>
							<td align=right>$ru[HalSelesai]</td>
							<td align=right>$ru[HalJum]</td>
							<td>$star</td></tr>";
					}
							
				?>
	</table>
<hr>
	<p>
	<img src='themes/images/star_full.png'> : >= 10
	<br>
	<img src='themes/images/star_empty.png'> : 7 - 9
	<br>
	<img src='themes/images/jempol1.png'> : 4 - 6
	<br>
	<img src='themes/images/jempol0.png'> : 1 - 3
	</p>
    </div>
  </div>	
<?php
}
?>



</div>




<?php
include "pagefoot.php";
?>