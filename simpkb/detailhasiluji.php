<?php

include "pagehead.php";
include "koneksi.php";
 

?>


	<div  style="padding:8 8 8 8" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main"> 
	
<div style="margin-top:-4px;" data-role="collapsibleset" data-theme="a" data-content-theme="a" data-iconpos="right">



    <div data-role="collapsible" data-iconpos="right" style="margin-top:-22px">
        <h3><span style="font-size:90%" >Riwayat Pengujian</span></h3>
		<?php
		echo "<table id='riwayatuji' style='margin-top:-14px;font-size:90%'>
			<th>Tgl. Uji<br>Jt. Tempo</th>
			<th>Penguji</th>
			<th>Hasil Uji</th>
			
			</tr>
		";
		$str="select *,case when (JmhBulanBulat<0) then 0 else (JmhBulanBulat/6+ case JmhBulanBulat%6 when 0 then 0 else 1 end) end as JmhPeriode,cast(TglUji as varchar) as  strTglUji from vPengujian where NoUji='$r[NoUji]' order by TglUji asc,idPengujian asc";		
$rs = sqlsrv_query($conn,$str);
		while($ru=sqlsrv_fetch_array($rs)){
			$date1=date_format(date_create($ru["strTglUji"]),"Y_m_d");
			$date2=date_format(date_create($ru["TglJatuhTempo"]),"Y_m_d");
			echo "<tr>
			<td valign=middle class='isian-nilai'>$date1<br>$date2</td>
			<td valign=middle class='isian-nilai'>$ru[NmPenyelia]</td>
			<td valign=middle class='isian-nilai'><a href='hasiluji.php?noreg=$ru[NoReg]&lajur=$ru[IdLajurUji]' data-rel='external'>$ru[NmStatusUji]</a></td>
			</tr>";
			
		};
		  
		
		echo "</table>";
		  ?>
		  
  
		  
		  
<script>
function myInfo() {
	window.open("http://besmarty.ip-dynamic.com");
}
</script>

    </div>
</div>		
	


	  
		  
		</div>
	



<?php
include "pagefoot.php";
?>