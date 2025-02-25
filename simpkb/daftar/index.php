<?php
session_start();
$user="admin";
$password="1234";

include "pagehead.php";

?>
<script>
function myFunction() {
	try{
		document.getElementById("frmWU").submit();
	}catch(err){
		alert(err.message);
	}
}
</script>
	<div  style="padding:2 2 2 2;" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main"> 
<center></center>
		  <?php

		$staIdx=1;
		if(isset($_POST["staLogin"])){
			if($_POST["staLogin"]==1){
				
				if($_POST["username"]==$user&&$_POST["password"]==$password){
					$_SESSION["username"]=$user;
					$_SESSION["password"]=$password;
					$staIdx=1;
				}else{
					$staIdx=0;
					session_unset(); 
					session_destroy();
					?>
					
					<p>Login gagal!
					<a href="https://ujikirkotamalang.com/simpkb/daftar" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn  ui-shadow ui-corner-all">Kembali</a>
					</p>
					<?php
				}
			}else{
				session_unset(); 
				session_destroy();	
			}
		}
		if($staIdx==1){
		  if(isset($_POST['keyid'])){

		  }else{
			?>
			<form style="margin-top:-10px" id="frmWU" name="frmWU" method="post" action="daftar.php">
		<input type="hidden" name="s" value="1">

			<div>
     		<label for="search-1" style="text-shadow:0 0px 0 black">No.Uji/No.Kendaraan:</label>

			</div>

			<div style="margin-top:-20px">
     		<input type="search" name="txtCari" id="txtCari" value="">

				  <a href="javascript:myFunction()" data-icon="search" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-search ui-btn-icon-right ui-shadow ui-corner-all">Daftar Uji Berkala</a>
					
					<div class="ui-corner-all custom-corners" style="margin-top:-16px;">
					  <div class="ui-bar ui-bar-a">
					    <h3>Persyaratan Uji Berkala :</h3>
					  </div>

						<div class="ui-body ui-body-a" >
						<p >- Foto copy STNK.<br>
						- Foto copy KTP.<br>
						- Bukti Lulus Uji Elektronik (Kartu Uji).</p>
						
						</div>
					</div>
					
					<div class="ui-corner-all custom-corners" style="margin-top:-8px;">
					  <div class="ui-bar ui-bar-a">
					    <h3>Tata Cara Pendaftaran Online Pengujian Kendaraan Bermotor :</h3>
					  </div>

						<div class="ui-body ui-body-a" >
						<table>
<tr><td>1.</td><td>Masukkan No.Uji / No.Kendaraan.</td></tr>
<tr><td>2.</td><td>Masukkan Nama Pendaftar.</td></tr>
<tr><td>3.</td><td>Masukkan No.Whatsapp (Contoh: 085612345678).</td></tr>
<tr><td>4.</td><td>Kirim 4 digit nomor Verifikasi.</td></tr>
<tr><td>5.</td><td>Pendaftaran uji dapat dilakukan minimal 1 hari dan maksimal 14 hari sebelum dilakukan pengujian.</td></tr>
<tr><td>6.</td><td>Pilih tanggal uji yang diinginkan (5 hari kerja).</td></tr>

		</table>
						</div>
					</div>
										
					
				<hr>
				<a href="https://ujikirkotamalang.com/daftar/status.php" data-icon="check" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-check ui-btn-icon-right ui-shadow ui-corner-all">Cek Status Pendaftaran</a>


			</div>
			</form>
			<a href="https://ujikirkotamalang.com/simpkb/daftar" data-transition="flip" class="ui-icon-back ui-btn-icon-left ui-btn ui-corner-all ui-shadow ui-btn-inline ">Kembali</a>
			
			<?php
			
			if(isset($_SESSION["username"])){
				?>
				<br><hr>
				<?php
			}
		  }
		}
		  ?>
		</div>
<?php

include "pagefoot.php";
?>