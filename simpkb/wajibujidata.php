<?php

include "pagehead.php";
include "koneksi.php";
 

?>


	<div  style="padding:8 8 8 8" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main"> 
	
<div style="margin-top:-4px;" data-role="collapsibleset" data-theme="a" data-content-theme="a" data-iconpos="right">

		<div data-role="collapsible" data-collapsed="false">
        <h3><span style="font-size:90%" >Pendaftaran Uji Kendaraan</span></h3>
				<?php
		  if(isset($_POST['keyid'])){
			  $keyid=$_POST['keyid'];
			  $txtCari=$_POST['txtCari'];
				
				$str="select *,NewID() as fname,vWajibUji.IdWajibUji as IDWU from vWajibUji left join DataKendaraanImg on vWajibUji.IdWajibUji=DataKendaraanImg.IdWajibUji
						where $keyid='$txtCari' and Aktif=1  order by IdDataKendaraanImg desc";
				$rs = sqlsrv_query($conn,$str);	
				$r=sqlsrv_fetch_array($rs);
				$query="EXEC sp_ExportImage $r[IDWU],'E:\\inetpub\\wwwroot\\simpkb\\temp','$r[fname]'";
				$result=sqlsrv_query($conn,$query);
			  echo "
			  <p style='margin-top:-14px;margin-bottom:-12px'>Nomor Uji Berkala:<br><span style='color:#0073e6;'><b>- $r[NoUji]</b></span></p>
			  <p style='margin-bottom:-12px'>Nomor Kendaraan:<br><span style='color:#0073e6'><b>- $r[NoKendaraan]</b></span></p>
			  <p style='margin-bottom:-12px'>Nama Pemilik Kendaraan:<br><span style='color:#0073e6'><b>- $r[NmPemilik]</b></span></p>
			  <br>
			  "; 
		  }
		  ?>
		<script>
		function submitDaftar() {
			try{
				document.getElementById("frmDaftar").submit();
			}catch(err){
				alert(err.message);
			}
		}

		</script> 
		  <form id="frmDaftar" method="post" action="daftar.php">
		  <input type="hidden" name="s" value="1">
		  <input type="hidden" name="id" value="<?php echo $r["IDWU"]; ?>">
			<a href="javascript:submitDaftar()" data-icon="myicon" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-myicon ui-btn-icon-right ui-shadow ui-corner-all">Daftar</a>
			</form>
    </div> 
		<div data-role="collapsible" style="margin-top:-22px">
        <h3><span style="font-size:90%" >Visual Kendaraan</span></h3>
<style>
.gambar {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 160px;
	height: auto;
}
</style>
		<table>
		<tr><td><img src="renderImg.php?tampak=depan&NoUji=1"></td><td>Depan</td></tr>
		<tr><td><img src="renderImg.php?tampak=belakang&NoUji=1" class="gambar"></td><td>Belakang</td></tr>
		<tr><td><img src="renderImg.php?tampak=kiri&NoUji=1" class="gambar"></td><td>Samping Kiri</td></tr>
		<tr><td><img src="renderImg.php?tampak=kanan&NoUji=1" class="gambar"></td><td>Samping Kanan</td></tr>
		</table>
    </div>   
	<div data-role="collapsible" style="margin-top:-22px">
        <h3><span style="font-size:90%" >Identitas Kendaraan dan Pemilik</span></h3>
		<?php
		  echo "
		  <p style='margin-top:-14px;margin-bottom:-12px'>Nomor Uji Berkala:<br><span style='color:#0073e6;'><b>- $r[NoUji]</b></span></p>
		  <p style='margin-bottom:-12px'>Nomor Kendaraan:<br><span style='color:#0073e6'><b>- $r[NoKendaraan]</b></span></p>
		  <p style='margin-bottom:-12px'>Nama Pemilik Kendaraan:<br><span style='color:#0073e6'><b>- $r[NmPemilik]</b></span></p>
		  <p style='margin-bottom:-12px'>Alamat Pemilik Kendaraan:<br><span style='color:#0073e6'><b>- $r[Alamat], $r[NmKecamatan]</b></span></p>
		  ";
		  ?>

    </div>
    <div data-role="collapsible" data-iconpos="right" style="margin-top:-22px">
        <h3><span style="font-size:90%" >Uraian Data Kendaraan</span></h3>
		<?php
		  echo "
		  <p style='margin-top:-14px;margin-bottom:-12px'>Merek:<br><span style='color:#0073e6;'><b>- $r[NmMerek]</b></span></p>
		  <p style='margin-bottom:-12px'>Tipe:<br><span style='color:#0073e6'><b>- $r[NmTipe]</b></span></p>
<p style='margin-bottom:-12px'>Jenis:<br><span style='color:#0073e6'><b>- $r[NmJenis] - $r[NmJenis]</b></span></p>
		  <p style='margin-bottom:-12px'>Isi Silinder:<br><span style='color:#0073e6'><b>- $r[IsiSilinder]</b></span></p>
		  <p style='margin-bottom:-12px'>Daya Motor:<br><span style='color:#0073e6'><b>- $r[DayaMotor]</b></span></p>
		  <p style='margin-bottom:-12px'>Bahan Bakar:<br><span style='color:#0073e6'><b>- $r[NmBahanBakar]</b></span></p>
		  <p style='margin-bottom:-12px'>Tahun Pembuatan:<br><span style='color:#0073e6'><b>- $r[TahunProduksi]</b></span></p>
		  <p style='margin-bottom:-12px'>Status Penggunaan:<br><span style='color:#0073e6'><b>- $r[NmStatus]</b></span></p>
		  ";
		  ?>
    </div>

    <div data-role="collapsible" data-iconpos="right" style="margin-top:-22px">
        <h3><span style="font-size:90%" >Ukuran Kendaraan</span></h3>
	<?php
	  echo "<table style='margin-top:-14px;font-size:95%'>
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
    <div data-role="collapsible" data-iconpos="right" style="margin-top:-22px">
        <h3><span style="font-size:90%" >Berat Kosong</span></h3>
		<?php
		  echo "<table style='margin-top:-14px;font-size:95%'>

		  <tr><td>- Sumbu I</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb1]</td><td>kg</td></tr>
		  <tr><td>- Sumbu II</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb2]</td><td>kg</td></tr>
		  <tr><td>- Sumbu III</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb3]</td><td>kg</td></tr>
		  <tr><td>- Sumbu IV</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb4]</td><td>kg</td></tr>
		  <tr><td>Jumlah (Total)</td><td>:</td><td class='isian-nilai'>$r[BeratKosongJum]</td><td>kg</td></tr>
		  </table>";
		  ?>


    </div>
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