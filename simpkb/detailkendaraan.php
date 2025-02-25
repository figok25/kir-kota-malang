<?php

include "pagehead.php";
include "koneksi.php";
		  
		if(isset($_GET['NoUji'])){
			  $txtCari=$_GET['NoUji'];
				
				$str="select *,NewID() as fname,vWajibUji.IdWajibUji as IDWU from vWajibUji where NoUji='$txtCari' and Aktif=1 ";
				
				$rs = sqlsrv_query($conn,$str);	
				$r=sqlsrv_fetch_array($rs);
				$query="EXEC sp_ExportImage $r[IDWU],'E:\\inetpub\\wwwroot\\simpkb\\temp','$r[fname]'";
				$result=sqlsrv_query($conn,$query);


			$db = mysqli_connect("192.168.1.11","root","abcd1234","perhubungan"); //keep your db name
			
			$sql = "SELECT nokendalikartu,fotokanansmall,fotokirismall,fotodepansmall,fotobelakangsmall FROM datapengujian WHERE nouji = '$txtCari'";
			
			$sth = mysqli_query($db,$sql);
			$foto=mysqli_fetch_array($sth);

		  }

?>


	<div   class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main"> 
			<div class="ui-bar ui-bar-a"><h3>Foto Kendaraan</h3>
			</div>
		 	<div class="ui-body ui-body-a" style="margin-top:-20px">
		<?php
		echo "<center><img width=49% src='data:image/jpeg;base64,".base64_encode( $foto['fotodepansmall'] )."'/>
			<img width=49% src='data:image/jpeg;base64,".base64_encode( $foto['fotobelakangsmall'] )."'/>
		<img width=49% src='data:image/jpeg;base64,".base64_encode( $foto['fotokirismall'] )."'/>
		<img width=49% src='data:image/jpeg;base64,".base64_encode( $foto['fotokanansmall'] )."'/>
		</center>
		";
		?>
		
			</div>
			<div class="ui-bar ui-bar-a"><h3>Identitas Kendaraan dan Pemilik</h3>
			</div>
		 	<div class="ui-body ui-body-a" style="margin-top:-22px">
				<?php
				  echo "
				  <p >Nomor Uji Berkala:<br><span style='color:#0073e6;'><b>$r[NoUji]</b></span>
				  <br>Nomor Kendaraan:<br><span style='color:#0073e6'><b>$r[NoKendaraan]</b></span>
				  <br>Nama Pemilik Kendaraan:<br><span style='color:#0073e6'><b>$r[NmPemilik]</b></span>
				  <br>Alamat Pemilik Kendaraan:<br><span style='color:#0073e6'><b>$r[Alamat], $r[NmKecamatan]</b></span></p>
				  ";
				  ?>
			</div>	
			<div class="ui-bar ui-bar-a"><h3>Uraian Data Kendaraan</h3>
			</div>
		 	<div class="ui-body ui-body-a" style="margin-top:-22px">
				<?php
			  echo "
			  <p >Merek:<br><span style='color:#0073e6;'><b>$r[NmMerek]</b></span>
				<br>Tipe:<br><span style='color:#0073e6'><b>$r[NmTipe]</b></span>
				<br>Jenis:<br><span style='color:#0073e6'><b>$r[NmJenis] - $r[NmJenis]</b></span>
				<br>Isi Silinder:<br><span style='color:#0073e6'><b>$r[IsiSilinder]</b></span>
				<br>Daya Motor:<br><span style='color:#0073e6'><b>$r[DayaMotor]</b></span>
				<br>Bahan Bakar:<br><span style='color:#0073e6'><b>$r[NmBahanBakar]</b></span>
				<br>Tahun Pembuatan:<br><span style='color:#0073e6'><b>$r[TahunProduksi]</b></span>
				<br>Status Penggunaan:<br><span style='color:#0073e6'><b>$r[NmStatus]</b></span></p>
			  ";
			  ?>
			</div>
			<div class="ui-bar ui-bar-a"><h3>Ukuran Kendaraan</h3>
			</div>
		 	<div class="ui-body ui-body-a" style="margin-top:-22px">
				<?php
			  echo "<table style='font-size:95%'>
				<col width='10'>
			  <tr><td colspan=4>a. Ukuran Utama</td></tr>
			  <tr><td colwidth=100px></td><td>- Panjang</td><td>:</td><td class='isian-nilai'>$r[DimPanjang]</td><td>mm</td></tr>
			  <tr><td></td><td>- Lebar</td><td>:</td><td class='isian-nilai'>$r[DimLebar]</td><td>mm</td></tr>
			  <tr><td></td><td>- Tinggi</td><td>:</td><td class='isian-nilai'>$r[DimTinggi]</td><td>mm</td></tr>
			  <tr><td></td><td>- Julur Belakang / ROH</td><td>:</td><td class='isian-nilai'>$r[DimROH]</td><td>mm</td></tr>
			  <tr><td></td><td>- Julur Depan / FOH</td><td>:</td><td class='isian-nilai'>$r[DimFOH]</td><td>mm</td></tr>
			  </table>";
			  ?>

			</div>
			
			<div class="ui-bar ui-bar-a"><h3>Berat Kendaraan</h3>
			</div>
		 	<div class="ui-body ui-body-a" style="margin-top:-22px">
				<?php
			  echo "<table style='font-size:95%'>

			  <tr><td>- Sumbu I</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb1]</td><td>kg</td></tr>
			  <tr><td>- Sumbu II</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb2]</td><td>kg</td></tr>
			  <tr><td>- Sumbu III</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb3]</td><td>kg</td></tr>
			  <tr><td>- Sumbu IV</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb4]</td><td>kg</td></tr>
			  <tr><td>Jumlah (Total)</td><td>:</td><td class='isian-nilai'>$r[BeratKosongJum]</td><td>kg</td></tr>
			  </table>";
			  ?>
			</div>
	
	
<a href="http://ujikirkotamalang.ip-dynamic.com/simpkb/datakendaraan.php" data-transition="flip" class="ui-icon-back ui-btn-icon-left ui-btn ui-corner-all ui-shadow ui-btn-inline ">Kembali</a>


	  
		  
		</div>
	



<?php
include "pagefoot.php";
?>