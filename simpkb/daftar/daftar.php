<?php
session_start();
include "pagehead.php";
include "koneksi.php";
$NoUji=$_POST['txtCari'];
$s=$_POST["s"];
$nVer=rand(1000,9999);
	$_SESSION['staDaftar']=1;
/* 	$str="select top 1 JBB,vWajibUjiList.IdWajibUji,NoUji,NoRangka,NoMesin,NmPemilik,Alamat,NoKendaraan,TahunProduksi, NmStatus,NmJenis,NmSubJenis,MerekTipe,NmBahanBakar,NoUji,isnull(Pengujian.IdPengujian,-1) as IdPengujian,isnull(Pengujian.IdTipeUji,0) as IdTipeUji,NmTipeUji,Tarif,IdStatus,IdSubJenis, NmKategoriJenis
                       from vWajibUjiList
                       left join Pengujian on vWajibUjiList.IdWajibUji=Pengujian.IdWajibUji
                       left join MasterTipeUji on Pengujian.IdTipeUji=MasterTipeUji.IdTipeUji where NoReg<>'REG.' and (vWajibUjiList.NoUji='$NoUji' or NoKendaraan='$NoUji') order by TglRegistrasi Desc";
	 */
	$str="select top 1 JBB,vWajibUjiList.IdWajibUji,NoUji,NoRangka,NoMesin,NmPemilik,Alamat,NoKendaraan,TahunProduksi, NmStatus,NmJenis,NmSubJenis,MerekTipe,NmBahanBakar,NoUji,Tarif,IdStatus,IdSubJenis, NmKategoriJenis
                       from vWajibUjiList
                       where (vWajibUjiList.NoUji='$NoUji' or NoKendaraan='$NoUji') order by IdWajibUji Desc";
	
	//echo $str;
	$rs = sqlsrv_query($conn,$str);	
	$r=sqlsrv_fetch_array($rs);
	$NoUji=$r["NoUji"];
	$JBB=$r["JBB"];
	$NoKendaraan=$r["NoKendaraan"];
	$NmPemilik=$r["NmPemilik"];
	$Alamat=$r["Alamat"];
	
	$TglJatuhTempo=$r["TglJatuhTempo"];
	$IdWajibUji=$r["IdWajibUji"];
	$penerbitan=$r["keterangan"];
	$IdJenis = $r["IdJenis"];
	$MenhubJenis = $r["IdSubJenis"];
	
	$strSQLTarif="";
	$strSQLTarif = "select Tarif from MasterKategoriJenis where $JBB between JBBMin and JBBMax";
	$rsTarif = sqlsrv_query($conn,$strSQLTarif);	
	$rTarif=sqlsrv_fetch_array($rsTarif);
	//echo "IDJ".$IdJenis;
/* 	if($IdJenis==4){
		$strSQLTarif = "select Tarif as BiayaRetribusi,TEmisi+TRem+TKincupRoda+TLampuUtama+TKecepatan as BiayaLayanan from MasterKategoriJenis where IdLayanan=2 and IdJenis=$IdJenis and $JBB >=JBBMin and $JBB <=JBBMax";
	}elseif($IdJenis==5||$IdJenis==6||$IdJenis==7){
	   $strSQLTarif = "select Tarif as BiayaRetribusi,TEmisi+TRem+TKincupRoda+TLampuUtama+TKecepatan as BiayaLayanan from MasterKategoriJenis where IdLayanan=2 and IdJenis=$IdJenis";
	}else{
		$strSQLTarif = "select Tarif as BiayaRetribusi,TEmisi+TRem+TKincupRoda+TLampuUtama+TKecepatan as BiayaLayanan from MasterKategoriJenis where IdLayanan=2 and menhub_jenis=$MenhubJenis";
	}
	//echo "SQL".$strSQLTarif;die;
	$rsTarif = sqlsrv_query($conn,$strSQLTarif);	
	$rTarif=sqlsrv_fetch_array($rsTarif); */
	
	//$Tarif=$rTarif["BiayaRetribusi"]+$rTarif["BiayaLayanan"];
	$Tarif=0;//$rTarif["Tarif"];
	$BiayaLayanan=0;// $rTarif["BiayaLayanan"];
	$str="select keterangan,cast(TglJatuhTempo as varchar) as TglJatuhTempo from vPengujianAkhir where NoUji='$NoUji' order by TglRegistrasi Desc";
	//echo $str;
	$rsUji = sqlsrv_query($conn,$str);	
	$rUji=sqlsrv_fetch_array($rsUji);
	$penerbitan=$rUji["keterangan"];
	$TglJatuhTempo=$rUji["TglJatuhTempo"];
?>





<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">

<div class="ui-corner-all custom-corners" style="margin-top:-20px">
<?php
switch($s){
case "1":
?>
  <div class="ui-bar ui-bar-a">
    <h3>Pendaftaran Online</h3>
  </div>

	<div class="ui-body ui-body-a" >
	<br>
	<script>
	function postVer() {
		try{
			if(document.getElementById("nVerifi").value==""){
				//alert("Isikan nomor telepon!");
			}else{
				document.getElementById("postVer").submit();
			}
		}catch(err){
			alert(err.message);
		}
	}

	</script> 
	<form style="font-size:95%;margin-top:-10px" id="postVer" action="daftar.php" method="post">
	<input type="hidden" name="s" value="2">
	<input type="hidden" name="txtCari" id="txtCari" value="<?php echo "$r[NoUji]"; ?>">
	<?php
	echo "<p style='margin-top:-14px;'>Nomor Uji Berkala:<br><span style='color:#0073e6;'><b>- $r[NoUji]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Nomor Kendaraan:<br><span style='color:#0073e6;'><b>- $r[NoKendaraan]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Jenis :<br><span style='color:#0073e6;'><b>- $r[NmJenis]</b></span></p>";
	echo "<p style='margin-top:-14px;'>JBB (Kg):<br><span style='color:#0073e6;'><b>- $JBB</b></span></p>";
	echo "<p style='margin-top:-14px;'>Nama Pemilik :<br><span style='color:#0073e6;'><b>- $r[NmPemilik]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Penerbitan Kartu :<br><span style='color:#0073e6;'><b>- $penerbitan</b></span></p>";
	echo "<p style='margin-top:-14px;'>Tgl. Jatuh Tempo :<br><span style='color:#0073e6;'><b>- $TglJatuhTempo</b></span></p>";
	echo "<hr>";
	?>
	<label style="font-size:95%" for="nmLengkap">Nama Lengkap Pendaftar : (*)</label>
	<input type="text" data-clear-btn="true" name="nmLengkap" id="nmLengkap" value="">	
	<label style="font-size:95%" for="nTelepon">Nomor Telepon (<b>Contoh: 08560001234</b>) : (*)</label>
	<input type="text" data-clear-btn="true" name="nVerifi" id="nVerifi" value="">
	<input type="hidden" name="postVerifikasi" value=<?php echo $nVer;?>>
	<a href="javascript:postVer()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a  ui-shadow ui-corner-all">Kirim Nomor Verifikasi</a>


	
	</div>
<?php
	break;
case "2":
 $email=$_POST["nVerifi"];
 $tlp=$_POST["nVerifi"];
 $nVer=$_POST["postVerifikasi"];
 $ntxt="$nVer";

if(substr($tlp,0,1)==0){
	$tlp="62".substr($tlp,1,strlen($tlp)-1);
	
}
 
 	$StrSQL = "insert into db_SIMPKB_SMS.dbo.SMSOut(NoTlp,SMSBody) values('$tlp','$ntxt')";
	$stmt = sqlsrv_prepare( $conn, $StrSQL);
	sqlsrv_execute($stmt);
	
 $answer1 = shell_exec("KirimWA.exe ".$tlp." " .chr(34) .$ntxt.chr(34) );
//$answer1 = shell_exec("KirimSMS.exe ".$tlp." " .chr(34) .$ntxt.chr(34) );
//$answer2 = shell_exec("KirimEmail.exe ".$email." " .chr(34) ."Nomor Verifikasi Pendaftaran Online".chr(34)." " .chr(34) .$ntxt.chr(34) );
//echo "<a style='font-size:70%'>$answer1</a>";
?>

	  <div class="ui-bar ui-bar-a">
    <h3>Verifikasi Pendaftaran Online</h3>
  </div>
<div class="ui-body ui-body-a" >
	<script>

	function submitVer() {
		try{
			document.getElementById("frmVer").submit();
		}catch(err){
			alert(err.message);
		}
	}	


	</script> 

	<form style="font-size:95%;" id="frmVer" action="daftar.php" method="post" >
		  <input type="hidden" name="s" value="3">
		  <input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="NoTlp" value="<?php echo $tlp; ?>">			  
		  <input type="hidden" name="txtCari" id="txtCari" value="<?php echo "$r[NoUji]"; ?>">
	<?php
	echo "<p style='margin-top:0px;'>Nomor Uji Berkala :<br><span style='color:#0073e6;'><b>- $r[NoUji]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Nomor Kendaraan :<br><span style='color:#0073e6;'><b>- $r[NoKendaraan]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Jenis :<br><span style='color:#0073e6;'><b>- $r[NmJenis]</b></span></p>";
	echo "<p style='margin-top:-14px;'>JBB (Kg):<br><span style='color:#0073e6;'><b>- $JBB</b></span></p>";
	echo "<p style='margin-top:-14px;'>Nama Pemilik :<br><span style='color:#0073e6;'><b>- $r[NmPemilik]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Penerbitan Kartu :<br><span style='color:#0073e6;'><b>- $penerbitan</b></span></p>";
	echo "<p style='margin-top:-14px;'>Tgl. Jatuh Tempo :<br><span style='color:#0073e6;'><b>- $TglJatuhTempo</b></span></p>";
	echo "<hr>";
	?>
	<label style="font-size:95%" for="nEmail">Nomor Verifikasi (4 digit) :</label>
	<input type="hidden" name="submitVerifikasi" value=<?php echo $nVer;?>>
	<input type="number" data-clear-btn="true" name="nsVerifi" id="nsVerifi" value="">
	
	<a href="javascript:submitVer()" data-icon="myicon" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-myicon ui-btn-icon-right ui-shadow ui-corner-all">Submit</a>
	</form>
</div>
<?php
	break;
case "3":

if($_POST["nsVerifi"]==$_POST["submitVerifikasi"]){
	$_SESSION['staDaftar']=1;
	
	$StrSQL = "delete from DataTelepon where NoUji='$NoUji'";
	$stmt = sqlsrv_prepare( $conn, $StrSQL);
	sqlsrv_execute($stmt);
	
	$StrSQL = "Insert into DataTelepon(NoUji,NoTlp) values('$NoUji','$_POST[NoTlp]')";
	$stmt = sqlsrv_prepare( $conn, $StrSQL);
	sqlsrv_execute($stmt);
	
?>
  <div class="ui-bar ui-bar-a">
    <h3>Pendaftaran Uji Kendaraan</h3>
  </div>
	<script>

	function setBukuUji(sts) {
		
		if(sts==1){
			document.getElementById("nBiayaBuku").innerHTML = ": Rp. 0";
			document.getElementById("nBiayaDendaBuku").innerHTML = ": Rp. 0";
		}else if(sts==2){
			document.getElementById("nBiayaBuku").innerHTML = ": Rp. 0";
			document.getElementById("nBiayaDendaBuku").innerHTML = ": Rp. 0";
		}else if(sts==3){
			document.getElementById("nBiayaBuku").innerHTML = ": Rp. 0";
			document.getElementById("nBiayaDendaBuku").innerHTML = ": Rp. 0";
		}else{
			document.getElementById("nBiayaBuku").innerHTML = ": Rp. 0";
			document.getElementById("nBiayaDendaBuku").innerHTML = ": Rp. 0";
		}
			
	}
	function submitKuota(tglY,tglM,tglD) {
			try{
				document.getElementById("tglBook").value = tglY+'-'+tglM+'-'+tglD;
				document.getElementById("frmKuota").submit();
			}catch(err){
				alert(err.message);
			}
		}

	</script> 


  <div class="ui-body ui-body-a" style="margin-top:-20px">
	<?php
	echo "<p style='margin-top:0px;'>Nomor Uji Berkala:<br><span style='color:#0073e6;'><b>- $r[NoUji]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Nomor Kendaraan:<br><span style='color:#0073e6;'><b>- $r[NoKendaraan]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Jenis:<br><span style='color:#0073e6;'><b>- $r[NmJenis]</b></span></p>";
	echo "<p style='margin-top:-14px;'>JBB (Kg):<br><span style='color:#0073e6;'><b>- $JBB</b></span></p>";
	echo "<p style='margin-top:-14px;'>Nama Pemilik:<br><span style='color:#0073e6;'><b>- $r[NmPemilik]</b></span></p>";
	echo "<p style='margin-top:-14px;'>Penerbitan Kartu :<br><span style='color:#0073e6;'><b>- $penerbitan</b></span></p>";
	echo "<p style='margin-top:-14px;'>Tgl. Jatuh Tempo:<br><span style='color:#0073e6;'><b>- $TglJatuhTempo</b></span></p>";
	echo "<hr>";
	?>
	 <form id="frmKuota" method="post" action="daftar.php">

 
		<p style='margin-top:0px;'>Pilih Penerbitan Kartu Uji :<br>
			<fieldset data-role="controlgroup" style="margin-top:-14px;">
		<input type="radio" onchange="setBukuUji(1)" name="buku" id="radio1" value="perpanjang" checked="checked">
        <label for="radio1" style="font-size:80%">Perpanjang</label>
        <input type="radio" onchange="setBukuUji(2)" name="buku" id="radio2" value="habis">
        <label for="radio2" style="margin-top:-20px;font-size:80%">Daftar Baru (Ganti Smartcard)</label>
        <input type="radio" onchange="setBukuUji(3)" name="buku" id="radio3" value="rusak">
        <label for="radio3" style="margin-top:-20px;font-size:80%" >Rusak</label>
        <input type="radio" onchange="setBukuUji(4)" name="buku" id="radio4" value="hilang">
        <label for="radio4" style="margin-top:-20px;font-size:80%" >Hilang</label>
		</fieldset>
		</p>
	<table style="margin-top:-14px;">
		<tr><td>Biaya Uji</td><td class='isian-nilai'>: Rp. <?php 


		echo $Tarif; ?>
		
		</td></tr>
		<tr><td>Biaya Kartu Uji</td><td class='isian-nilai' ><div id="nBiayaBuku">: Rp. 0</div></td></tr>
		<tr><td>Denda Kartu Uji</td><td class='isian-nilai'><div id="nBiayaDendaBuku">: Rp. 0</div></td></tr>
		<tr><td>Denda</td><td class='isian-nilai'>: Rp. 0</td></tr>
	</table>
	

	<ul data-role="listview" data-inset="true" style="margin-top:14px">
	
		  <input type="hidden" name="s" value="4">
		  <input type="hidden" name="txtCari" value="<?php echo $NoUji ;?>">
		  	<input type="hidden" name="tglBook" id="tglBook" value="">

	
	    <li data-role="list-divider" style="margin-top:-20px">Pilih Tanggal Uji:</li>
		<?php
		
			$str="select 1 as no,cast(DATEADD(day, 1, getdate()) as varchar) as tgl,datepart(weekday,DATEADD(weekday, 1, getdate())) as hari,(select NmHari from NamaHari where IdHari=datepart(weekday,DATEADD(weekday, 1, getdate()))) as NmHari";

			for ($x=2;$x<=14;$x++) {
				$y=($x*-1)+1;
				$str=$str." union select $x, cast(DATEADD(day, $x, getdate()) as varchar) as tgl,datepart(weekday,DATEADD(day, $x, getdate())) as hari,(select NmHari from NamaHari where IdHari=datepart(weekday,DATEADD(weekday, $x, getdate()))) as NmHari";
			} 
//echo $str;
//die;
			$rs = sqlsrv_query($conn,$str);	
			while($r=sqlsrv_fetch_array($rs)){
				$date=date_create($r["tgl"]);
				$wd=$r["hari"];
				$strdate=date_format($date,"Y-m-d");
				$strdateY=date_format($date,"Y");
				$strdateM=date_format($date,"m");
				$strdateD=date_format($date,"d");
				if($wd==7||$wd==1){
					//echo "<li data-icon='delete'><a style='font-size:100%;color:red'>$strdate, $r[NmHari] <span class='ui-li-count' style='color:red'>Libur</span></a></li>";
				}else{
					if($wd==6){
						$cHari="green";
					}else{
						$cHari="black";
					}

						$nK=10;
	
					echo "<li><a style='font-size:100%;color:$cHari' href='javascript:submitKuota($strdateY,$strdateM,$strdateD)'>$strdate, $r[NmHari] </a></li>"; //<span class='ui-li-count'>$nK</span>
					//echo "<li><a style='font-size:100%;color:$cHari' href='javascript:submitKuota($strdateY,$strdateM,$strdateD)'>$strdate, $r[NmHari]</a></li>";
				}
			}
		?>	
		
	</ul>
	</form>
  </div>
<?php
}else{
	$_SESSION['staDaftar']=0;
	?>
  <div class="ui-bar ui-bar-a">
    <h3>Verifikasi Gagal!</h3>
  </div>	
<?php
}
	break;
case "4":
	$TglUji=$_POST['tglBook'];
	
	$strSQL="SELECT     TOP 1  TglRegistrasi AS TglUji, NoUji, 
						ISNULL(DATEDIFF(day, CASE IdStatusUji WHEN 1 THEN dateadd(m, 6, TglRegistrasi) WHEN 2 THEN dateadd(d, 14, 
                      TglRegistrasi) END, '$TglUji'), - 1) AS JmhHariDenda, DATEDIFF(month, CASE IdStatusUji WHEN 1 THEN dateadd(m, 6, TglRegistrasi) WHEN 2 THEN dateadd(d, 14, TglRegistrasi) END, 
                      '$TglUji') AS JmhBulanDenda, CASE WHEN datediff(d, CASE Pengujian.IdStatusUji WHEN 1 THEN dateadd(m, 6, TglRegistrasi) WHEN 2 THEN dateadd(d, 14, TglRegistrasi) END, '$TglUji') 
                      > 0 THEN datediff(m, CONVERT(varchar(7), CASE IdStatusUji WHEN 1 THEN dateadd(m, 6, TglRegistrasi) WHEN 2 THEN dateadd(d, 14, TglRegistrasi) END, 126) + '-01', dateadd(d, 
                      day(TglRegistrasi) * - 1, '$TglUji')) + 1 ELSE datediff(m, CONVERT(varchar(7), CASE IdStatusUji WHEN 1 THEN dateadd(m, 6, TglRegistrasi) WHEN 2 THEN dateadd(d, 14, 
                      TglRegistrasi) END, 126) + '-01', dateadd(d, day(TglRegistrasi) * - 1, '$TglUji')) END AS JmhBulanBulat
				FROM         vWajibUjiAll INNER JOIN
									 Pengujian ON vWajibUjiAll.IdWajibUji = pengujian.IdWajibUji 
				WHERE     (NoUji = '$NoUji') and IdStatusUji=1 and Pengujian.Aktif=1
				order by TglUji desc";
	//echo $strSQL;
	$rsTarif = sqlsrv_query($conn,$strSQL);	
	$rTarif=sqlsrv_fetch_array($rsTarif);
	
	$PeriodeDenda = $rTarif["JmhPeriode"];
	$BulanDenda= $rTarif["JmhBulanBulat"];

	$PersenDenda = 0.02 * $BulanDenda * $Tarif;
	$RetribusiPeriode = 0 ;

	If($BulanDenda > 0){
		$tmpBulanDenda = $BulanDenda;

		$totalRet = $PersenDenda + $RetribusiPeriode;

		$ribuan= 0;
		$bilBulat = 0;
		//echo "ribuan bilBulat :$totalRet $ribuan ".$bilBulat;
		If ($totalRet > 1000){ 
			$ribuan =  substr($totalRet,1,strlen($totalRet)-4); //Mid(, 1, totalRet.ToString.Length - 3)
			$bilBulat =substr($totalRet,strlen($totalRet)-3,3);  //Mid(totalRet, totalRet.ToString.Length - 2, 3)

		}
		
		If($bilBulat <= 500 ){
			$ribuan = ($ribuan * 1000) + 500;
		}Else{
			$ribuan = ($ribuan * 1000) + 1000;
		}
		
		//txtBiayaDenda.Text = FormatNumber(ribuan, 0)
		//txtTarifDenda.Text = $ribuan
		$Denda=0; //$totalRet;
	}
	

	
	$IdKatBukuBaru;
	$staPenerbitan;
	switch($_POST['buku']){
		case 'perpanjang':
			$BiayaBuku='0';
			$DendaBuku=0;
			$IdKatBukuBaru=0;
			$staPenerbitan=2;
			break;
		case 'habis':
			$BiayaBuku='0';
			$DendaBuku=0;
			$IdKatBukuBaru=1;
			$staPenerbitan=1;
			break;
		case 'rusak':
			$BiayaBuku='0';
			$DendaBuku='0';
			$IdKatBukuBaru=2;
			$staPenerbitan=3;
			break;
		case 'hilang':
			$BiayaBuku='0';
			$DendaBuku='0';
			$IdKatBukuBaru=2;
			$staPenerbitan=4;
			break;
	}
	$TotalBayar=$Tarif+$Denda+$BiayaBuku+$DendaBuku;
	?>

  <div class="ui-bar ui-bar-a">
    <h3>Konfirmasi Pendaftaran Uji Kendaraan</h3>
  </div>
	<div class="ui-body ui-body-a" >
			<script>
		function submitDaftarOK() {
			try{
				document.getElementById("frmDaftarOK").submit();
			}catch(err){
				alert(err.message);
			}
		}
		


		</script> 
	 <form id="frmDaftarOK" method="post" action="daftar.php">
	 		  <input type="hidden" name="s" value="5">
				<input type="hidden" name="txtCari" value="<?php echo $NoUji ;?>">
				<input type="hidden" name="tglUji" value="<?php echo $TglUji ;?>">
				<input type="hidden" name="BiayaRetribusi" value="<?php echo $Tarif ;?>">
				<input type="hidden" name="BiayaBuku" value="<?php echo $BiayaBuku ;?>">
				<input type="hidden" name="BiayaDendaBuku" value="<?php echo $DendaBuku ;?>">
				<input type="hidden" name="BiayaDenda" value="<?php echo $Denda ;?>">
				<input type="hidden" name="IdKatBukuBaru" value="<?php echo $IdKatBukuBaru ;?>">
				<input type="hidden" name="staPenerbitan" value="<?php echo $staPenerbitan ;?>">
				<input type="hidden" name="BiayaTotal" value="<?php echo $TotalBayar ;?>">
			<?php
			$str="select NmHari from NamaHari where IdHari=datepart(weekday, '$TglUji')";
			$rsHari = sqlsrv_query($conn,$str);	
			$rHari=sqlsrv_fetch_array($rsHari);
			$NmHari=$rHari["NmHari"];
			$TglUji=date_create($TglUji);
			$TglUji=$NmHari.", ". date_format($TglUji,"d/m/Y");
		  echo "
		  <p style='margin-bottom:-12px'>Nomor Uji Berkala :<br><span style='color:#0073e6'><b>- $r[NoUji]</b></span></p>
		  <p style='margin-bottom:-12px'>Nomor Kendaraan :<br><span style='color:#0073e6'><b>- $r[NoKendaraan]</b></span></p>
		  <p style='margin-bottom:-12px'>Jenis :<br><span style='color:#0073e6'><b>- $r[NmJenis]</b></span></p>
		  <p style='margin-bottom:-12px'>Nama Pemilik :<br><span style='color:#0073e6'><b>- $r[NmPemilik]</b></span></p>
		  <p style='margin-bottom:0px'>Alamat :<br><span style='color:#0073e6'><b>- $r[Alamat]</b></span></p>
				<hr>

		<hr>
			<center><h3>
		  <p style='margin-bottom:-12px'>Tanggal Pengujian<br><span style='color:red'><b>$TglUji</b></span></p>
		  </h3></center>
		  ";
		  ?>
		  <br>
		  <a href="javascript:submitDaftarOK()" data-icon="myicon" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-myicon ui-btn-icon-right ui-shadow ui-corner-all">Daftarkan Sekarang</a>
		  <a href="https://ujikirkotamalang.com/daftar/" data-icon="back" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-back ui-btn-icon-right ui-shadow ui-corner-all">Batalkan</a>
		</form>
	</div>
<?php
	
	break;
case "5":
if($_SESSION['staDaftar']==1){

	$TglUji=$_POST["tglUji"];
	
	$TotalBayar=0;//$_POST["BiayaTotal"];
	$statuspenerbitan=$_POST["staPenerbitan"];
	$staDisplay=0;
	
	$str="select IdPetugas from vPegawai where IdJabatan=2";

	$rsReg = sqlsrv_query($conn,$str);	
	$rReg=sqlsrv_fetch_array($rsReg);
	$IdKepalaUPT=$rReg["IdPetugas"];
	
	//$IdKepalaUPT=509;
	$RecUser=396; //ONLINE
	$IdPetugas=-1;
	$IdStatusBayar=0;
	$IdKatBukuBaru=$_POST["IdKatBukuBaru"];
	$LogUID="NULL";
	//$IdWajibUji
	$IdTipeUji=0;
	$BiayaRetribusi=0;//$_POST["BiayaRetribusi"];
	$BiayaDenda=0;//$_POST["BiayaDenda"]+$_POST["BiayaDendaBuku"];
	$BiayaBuku=0;//$_POST["BiayaBuku"];
	$BiayaPlat=0;
	$BiayaStiker=0;
	$BiayaTambahan=0;
	$IdJenisBayar=2;
	$IdKotaKabLokasi=52;

	$str="select  top 1 NoReg as NewReg from pengujian where len(NoReg)=9 and '20'+SUBSTRING(NoReg,1,2) = year(getdate()) and SUBSTRING(NoReg,3,2) = month(getdate()) and SUBSTRING(NoReg,5,1) = 9 order by cast(NoReg as bigint) desc";
	
	$rsReg = sqlsrv_query($conn,$str);	
	$rReg=sqlsrv_fetch_array($rsReg);
	$NoNewReg=$rReg["NewReg"];
	//echo "No.Re".$NoNewReg;
	If(isset($NoNewReg)){
			$NoNewReg++;
	}else{
		
		$date=date('Ym');
		$NoNewReg=substr($date,2)."90001";
	}
	
	
	
	$NoReg=$NoNewReg;
	
	$sql="insert into Pengujian (VA,TglRegistrasi,statuspenerbitan,staDisplay,IdKepalaUPT,RecUser,IdPetugas,IdStatusBayar,IdKatBukuBaru,LogUID,IdWajibUji,IdTipeUji,BiayaRetribusi,BiayaDenda,BiayaBuku,BiayaPlat,BiayaStiker,BiayaTambahan,IdJenisBayar,IdKotaKabLokasi,NoReg)
			values(1,'$TglUji',$statuspenerbitan,$staDisplay,$IdKepalaUPT,$RecUser,$IdPetugas,$IdStatusBayar,$IdKatBukuBaru,$LogUID,$IdWajibUji,$IdTipeUji,$BiayaRetribusi,$BiayaDenda,$BiayaBuku,$BiayaPlat,$BiayaStiker,$BiayaTambahan,$IdJenisBayar,$IdKotaKabLokasi,'$NoReg')";
	//echo $sql;
	//$answer1 = shell_exec("bricreate.exe ". $NoReg);
	$stmt = sqlsrv_prepare( $conn, $sql);
	sqlsrv_execute($stmt);
	//echo "bricreate.exe ". $NoReg;
	//echo $answer1;
	//die;
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
  <div class="ui-bar ui-bar-a">
    <h3>Pendaftaran Pengujian</h3>
  </div>
	<div class="ui-body ui-body-a" >

		<?php
			$str="select NmHari from NamaHari where IdHari=datepart(weekday, '$TglUji')";
			$rsHari = sqlsrv_query($conn,$str);	
			$rHari=sqlsrv_fetch_array($rsHari);
			$NmHari=$rHari["NmHari"];
			$TglUji=date_create($TglUji);
			$TglUji=$NmHari.", ". date_format($TglUji,"d/m/Y");

		  echo "
		  <p style='margin-top:0px;margin-bottom:-12px;font-size:110%'>No. Pendaftaran:<br><span style='background-color:green;color:white;padding:2px'>$NoNewReg</span></p>
		  <br><br>
		  <center><img alt='NoRegBarcode' src='barcode.php?text=$r[NoUji]&size=40' /></center>
		  <br>
		  <p style='margin-bottom:-12px'>Nomor Uji Berkala :<br><span style='color:#0073e6'><b>- $r[NoUji]</b></span></p>
		  <p style='margin-bottom:-12px'>Nomor Kendaraan :<br><span style='color:#0073e6'><b>- $r[NoKendaraan]</b></span></p>
		  <p style='margin-bottom:-12px'>Jenis :<br><span style='color:#0073e6'><b>- $r[NmJenis]</b></span></p>
		  <p style='margin-bottom:-12px'>Nama Pemilik :<br><span style='color:#0073e6'><b>- $r[NmPemilik]</b></span></p>
		  <p style='margin-bottom:0px'>Alamat :<br><span style='color:#0073e6'><b>- $r[Alamat]</b></span></p>
		  <hr>
		  <p style='margin-bottom:-12px'>Tanggal Pengujian:<br><span style='color:red'><b>- $TglUji</b></span></p>

		  
		  ";
		  
		  ?>
		  <br>
			<form id="frmCekBayar" method="post" action="daftar.php">
	 		  <input type="hidden" name="s" value="6">
			  <input type="hidden" name="txtCari" value="<?php echo $NoUji ;?>">
			  <input type="hidden" name="tglUji" value="<?php echo $TglUji ;?>">
			  <input type="hidden" name="NoReg" value="<?php echo $NoNewReg; ?>">
			  <input type="hidden" name="BiayaTotal" value="<?php echo $TotalBayar ;?>">
			</form>
		  
	

		<hr>
		<a href="javascript:submitCekBayar()" data-icon="tag" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-tag ui-btn-icon-right ui-shadow ui-corner-all">Cek Status Pengujian</a>
		<script>
			function copyClipboard() {
			  navigator.clipboard.writeText(<?php echo "100290$NoNewReg";  ?>);
		
			}
					
		</script>
		
	</div>
<?php
//$ntxt="Nomor Registrasi : $NoNewReg";
//$answer2 = shell_exec("KirimEmail.exe uptpkbkabprobolinggo@gmail.com " .chr(34) ."Pendaftaran Online $NoUji".chr(34)." " .chr(34) .$ntxt.chr(34) );
}else{
	?>
  <div class="ui-bar ui-bar-a">
    <h3>Pendaftaran Gagal!</h3>
  </div>	
<?php
}

	break;
case "6":
$NoReg=$_POST["NoReg"];
$TglUji=$_POST["tglUji"];
$TotalBayar=0;//$_POST["BiayaTotal"];

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
  <div class="ui-bar ui-bar-a">
    <h3>Status Pendaftaran</h3>
  </div>
	<div class="ui-body ui-body-a" >

		<?php



		  echo "
		  <p style='margin-top:0px;margin-bottom:-12px;font-size:110%'>No. Pendaftaran:<br><span style='background-color:green;color:white;padding:2px'>$NoReg</span></p>
		  <br>
		  <center><img alt='NoRegBarcode' src='barcode.php?text=$NoReg&size=40'/></center>
		  <br>
		  <p style='margin-top:10px;margin-bottom:0px;font-size:140%'><span style='background-color:green;color:white;padding:2px'>NON RETRIBUSI</span></p>

		  <p style='margin-bottom:-12px'>Nomor Uji Berkala :<br><span style='color:#0073e6'><b>- $r[NoUji]</b></span></p>
		  <p style='margin-bottom:-12px'>Nomor Kendaraan :<br><span style='color:#0073e6'><b>- $r[NoKendaraan]</b></span></p>
		  <p style='margin-bottom:-12px'>Jenis :<br><span style='color:#0073e6'><b>- $r[NmJenis]</b></span></p>
		  <p style='margin-bottom:-12px'>Nama Pemilik :<br><span style='color:#0073e6'><b>- $r[NmPemilik]</b></span></p>
		  <p style='margin-bottom:0px'>Alamat :<br><span style='color:#0073e6'><b>- $r[Alamat]</b></span></p>
		  <hr>
		  <p style='margin-bottom:-12px'>Tanggal Pengujian:<br><span style='color:red'><b>- $TglUji</b></span></p>

		  ";
		  ?>
		  <br>
		  

		  
		  <a href="https://ujikirkotamalang.com/daftar/" data-icon="tag" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-tag ui-btn-icon-right ui-shadow ui-corner-all">Halaman Depan</a>
	</div>
	
	<?php

	break;
}
?>

<a href="https://ujikirkotamalang.com/daftar/" data-transition="flip" class="ui-icon-back ui-btn-icon-left ui-btn ui-corner-all ui-shadow ui-btn-inline ">Kembali</a>

</div>
</div>
<?php
include "pagefoot.php";
?>