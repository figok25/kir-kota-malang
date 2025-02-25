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
<div class="ui-bar ui-bar-a"><h3>Rekap Pengujian Harian</h3>
</div>
<div class="ui-body ui-body-a">
	<form id="datarekappengujian" method="get" action="datarekappengujian.php"><label for="tanggal">Tanggal:</label>
	<input type="date" data-clear-btn="true" name="tanggal" id="tanggal" value="<?php echo $tgl; ?>" >
	<a href="javascript:mySubmit()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-shadow ui-corner-all">Tampil</a>
	</form>
<hr>
		<?php
		
		if(isset($_GET["tanggal"])){
			$tgl=$_GET["tanggal"];

			//$str="select * from vPengujian where IdTipeUji<4 and TglUji='$tgl' and NoReg<>'REG.' order by IdTipeUji,NoReg asc";
			
			$str="select MasterJenis.NmJenis,count(vPembayaran.IdJenis) as Jumlah,MasterJenis.IdJenis
					from vPembayaran 
					right join MasterJenis 
					on vPembayaran.IdJenis=MasterJenis.IdJenis and TglUji='$tgl' and vPembayaran.IdTipeUji<4
					where MasterJenis.IdJenis between 2 and 7 
					group by MasterJenis.NmJenis,MasterJenis.IdJenis order by MasterJenis.IdJenis";
			//echo $str;
			$rs = sqlsrv_query($conn,$str);
			$no=0;
			$trHasil="";
			while($ru=sqlsrv_fetch_array($rs)){
				$no=$no+$ru["Jumlah"];
				$trHasil=$trHasil."<tr><td>$ru[NmJenis]</td><td>$ru[Jumlah]</td></tr>";
			}
			
			

			echo "
			<p>Jumlah Pengujian : $no</p>
			<table id='riwayatuji' style='font-size:14px' >
			<tr>

			<th>Jenis Kendaraan</th>
			<th>Jumlah</th>
			
			</tr>
			$trHasil
			</table>";
		}
		
		
		  ?>
<script>
function mySubmit() {
	try{
		document.getElementById("datarekappengujian").submit();
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