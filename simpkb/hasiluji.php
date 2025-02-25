<?php

include "pagehead.php";
include "koneksi.php";
$str="select * from db_SIMPKB_SKLU_$_GET[lajur].dbo.vLajurUjiHasilUjiMekanisFullADM where NoPendaftaran='$_GET[noreg]'";
$rs = sqlsrv_query($conn,$str);	
$r=sqlsrv_fetch_array($rs);

?>
<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
<div style="margin-top:-4px;" data-role="collapsibleset" data-theme="a" data-content-theme="a" data-iconpos="right">
<style>
.isian-nilai {
    color:#0073e6;
	font-weight:bold;
	text-align:right;
}

</style>
	<div data-role="collapsible" data-collapsed="false" >
<h3><span style="font-size:90%" >Hasil Uji Mekanis</span></h3>

<?php
	echo "<table align=center style='margin:4px 0px 4px 4px;font-size:90%' id='riwayatuji' >";
	
	$tglUji=date_format($r["WaktuUjiEmisiBensin"],"Y-m-d H:i");
	if($tglUji!=""){
		$ket="";
		if($r['IDHasilUjiAkhirEmisiBensin']=="1"){
			$ket="Lulus";
		}elseif($r['IDHasilUjiAkhirEmisiBensin']=="2"){
			$ket="Tidak Lulus";
		}
		  echo "<tr><th colspan=4>Emisi Bensin</th></tr>
		  <tr><td>Waktu Uji</td><td>:</td><td class='isian-nilai'>$tglUji</td><td></td></tr>
		  <tr><td>HC</td><td>:</td><td class='isian-nilai'>$r[HC]</td><td>ppm</td></tr>
		  <tr><td>CO</td><td>:</td><td class='isian-nilai'>$r[CO]</td><td>%</td></tr>
		  <tr><td>Penguji</td><td>:</td><td class='isian-nilai'>$r[PengujiEmisiBensin]</td><td></td></tr>
		  <tr><td>Keterangan</td><td>:</td><td class='isian-nilai'>$ket</td><td></td></tr>";		
		
	}

 
	$tglUji=date_format($r["WaktuUjiEmisiDiesel"],"Y-m-d H:i");
	if($tglUji!=""){
		$ket="";
		if($r['IDHasilUjiAkhirEmisiDiesel']=="1"){
			$ket="Lulus";
		}elseif($r['IDHasilUjiAkhirEmisiDiesel']=="2"){
			$ket="Tidak Lulus";
		} 
	  echo "<tr><th colspan=4>Emisi Diesel</th></tr>
	   <tr><td>Waktu Uji</td><td>:</td><td class='isian-nilai'>$tglUji</td><td></td></tr>
	  <tr><td>Opacity</td><td>:</td><td class='isian-nilai'>$r[Opaciti]</td><td>%</td></tr>
	  <tr><td>Penguji</td><td>:</td><td class='isian-nilai'>$r[PengujiEmisiDiesel]</td><td></td></tr>
	  <tr><td>Keterangan</td><td>:</td><td class='isian-nilai'>$ket</td><td></td></tr>";
	}

  
 	$tglUji=date_format($r["WaktuUjiRem"],"Y-m-d H:i");
	$ket="";
	if($r['IDHasilUjiAkhirRem']=="1"){
		$ket="Lulus";
	}elseif($r['IDHasilUjiAkhirRem']=="2"){
		$ket="Tidak Lulus";
	} 
	$g=9.8;
	$Berat1=$r["BeratSb1"];
	$Berat2=$r["BeratSb2"];
	$Berat3=$r["BeratSb3"];
	$Berat4=$r["BeratSb4"];
	$Berat=$Berat1+$Berat2+$Berat3+$Berat4;
	$GTot1=$r["RemKiriSb1"]+$r["RemKananSb1"];
	$GTot2=$r["RemKiriSb2"]+$r["RemKananSb2"];
	$GTot3=$r["RemKiriSb3"]+$r["RemKananSb3"];
	$GTot4=$r["RemKiriSb4"]+$r["RemKananSb4"];
	$GTot=$GTot1+$GTot2+$GTot3+$GTot4;
	$GSel1=abs($r["RemKiriSb1"]-$r["RemKananSb1"]);
	$GSel2=abs($r["RemKiriSb2"]-$r["RemKananSb2"]);
	$GSel3=abs($r["RemKiriSb3"]-$r["RemKananSb3"]);
	$GSel4=abs($r["RemKiriSb4"]-$r["RemKananSb4"]);	
	$JIS1=round(($GSel1 * 100) / ($Berat1 * $g),1);
	$JIS2=round(($GSel2 * 100) / ($Berat2 * $g),1);
	$JIS3=round(($GSel3 * 100) / ($Berat3 * $g),1);
	$JIS4=round(($GSel4 * 100) / ($Berat4 * $g),1);
	
	$Eff1=round(($GTot1 * 100) / ($Berat1 * $g));
	$Eff2=round(($GTot2 * 100) / ($Berat2 * $g));
	$Eff3=round(($GTot3 * 100) / ($Berat3 * $g));
	$Eff4=round(($GTot4 * 100) / ($Berat4 * $g));

	$Eff=round(($GTot * 100) / ($Berat * $g));
	
  echo "<tr><th colspan=4>Rem Utama</th></tr>
   <tr><td>Waktu Uji</td><td>:</td><td class='isian-nilai'>$tglUji</td><td></td></tr>
  <tr><td colspan=4>
  <table id='riwayatuji' style='font-weight:none;font-size:90%'>
  <tr><th></th>
  <th>Berat (Kg)</th>
  <th>Gaya Ki. (N)</th>
  <th>Gaya Ka. (N)</th>
  <th>Total (N)</th>
  <th>JIS (%)</th>
  <th>Eff. (%)</th>
  </tr>
  <tr><th>Sb1.</th><td class='isian-nilai'>$r[BeratSb1]</td><td class='isian-nilai'>$r[RemKiriSb1]</td><td class='isian-nilai'>$r[RemKananSb1]</td><td class='isian-nilai'>$GTot1</td><td class='isian-nilai'>$JIS1</td><td class='isian-nilai'>$Eff1</td></tr>
  <tr><th>Sb2.</th><td class='isian-nilai'>$r[BeratSb2]</td><td class='isian-nilai'>$r[RemKiriSb2]</td><td class='isian-nilai'>$r[RemKananSb2]</td><td class='isian-nilai'>$GTot2</td><td class='isian-nilai'>$JIS2</td><td class='isian-nilai'>$Eff2</td></tr>";
  
  if($r["JumlahSumbu"]>2){
	  echo "<tr><th>Sb3.</th><td class='isian-nilai'>$r[BeratSb3]</td><td class='isian-nilai'>$r[RemKiriSb3]</td><td class='isian-nilai'>$r[RemKananSb3]</td><td class='isian-nilai'>$GTot3</td><td class='isian-nilai'>$JIS3</td><td class='isian-nilai'>$Eff3</td></tr>";
  }
  if($r["JumlahSumbu"]>3){
	  echo "<tr><th>Sb4.</th><td class='isian-nilai'>$r[BeratSb4]</td><td class='isian-nilai'>$r[RemKiriSb4]</td><td class='isian-nilai'>$r[RemKananSb4]</td><td class='isian-nilai'>$GTot4</td><td class='isian-nilai'>$JIS4</td><td class='isian-nilai'>$Eff4</td></tr>";
  }
  echo "<tr><th>Total</th><td class='isian-nilai'>$Berat</td><td></td><td></td><td class='isian-nilai'>$GTot</td><td></td><td class='isian-nilai'>$Eff</td>
  </table>
  </td></tr>
  <tr><td>Penguji</td><td>:</td><td class='isian-nilai'>$r[PengujiRem]</td><td></td></tr>
  <tr><td>Keterangan</td><td>:</td><td class='isian-nilai'>$ket</td><td></td></tr>";
  
$tglUji=date_format($r["WaktuUjiKincupRoda"],"Y-m-d H:i");
if($tglUji!=""){
	$ket="";
	if($r['IDHasilUjiAkhirKincupRoda']=="1"){
		$ket="Lulus";
	}elseif($r['IDHasilUjiAkhirKincupRoda']=="2"){
		$ket="Tidak Lulus";
	} 
  echo "<tr><th colspan=4>Kincup Roda</th></tr>
   <tr><td>Waktu Uji</td><td>:</td><td class='isian-nilai'>$tglUji</td><td></td></tr>
  <tr><td>Kincup Roda</td><td>:</td><td class='isian-nilai'>$r[KincupRoda]</td><td>mm</td></tr>
  <tr><td>Penguji</td><td>:</td><td class='isian-nilai'>$r[PengujiKincupRoda]</td><td></td></tr>
  <tr><td>Keterangan</td><td>:</td><td class='isian-nilai'>$ket</td><td></td></tr>";
}
  echo "</table>";

?>

</div>
<div data-role="collapsible" >
			<h3><span style="font-size:90%" >Hasil Uji Visual</span></h3>
			<?php
				$str="SELECT     IdItem, NmItem, IdItemGroup, poin, JenisChecked, idx_item
				FROM         db_SIMPKB.dbo.Item
				WHERE     (IdItemGroup = 20)
				ORDER BY poin";
				$rs = sqlsrv_query($conn,$str);
				echo "<table id='riwayatuji'><tr><th>Item Uji Visual</th><th style='text-align:center'>Tidak Lulus</th></tr>";
				$i=0;
				while ($ru=sqlsrv_fetch_array($rs)){
					$i++;
					echo "<tr><td>$ru[NmItem]</td>
					<td valign=middle align=center>
					Lulus
					</td></tr>";
				}
				echo "</table>";
			?>
			</div>
	<div data-role="collapsible" >
	<h3><span style="font-size:90%" >Hasil Uji Manual</span></h3>
<?php
				$str="SELECT     IdItem, NmItem, IdItemGroup, poin, JenisChecked, idx_item
				FROM         db_SIMPKB.dbo.Item
				WHERE     (IdItemGroup = 21)
				ORDER BY poin";
				$rs = sqlsrv_query($conn,$str);
				echo "<table id='riwayatuji'><tr><th>Item Uji Manual</th><th style='text-align:center'>Keterangan</th></tr>";
				$i=0;
				while ($ru=sqlsrv_fetch_array($rs)){
					$i++;
					echo "<tr><td>$ru[NmItem]</td>
					<td valign=middle align=center>
					Lulus
					</td></tr>";
				}
				echo "</table>";
			?>
</div>

</div>
</div>
<?php
include "pagefoot.php";
?>