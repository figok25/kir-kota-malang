<?php
session_start();
$user="admin";
$password="1234";

include "pagehead.php";
header("location: http://ujikir.malangkota.go.id/simpkb/daftar");

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
	<div  style="padding:12 12 12 12;" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main"> 
		<center><img src="Logo_Kota_Malang.png">
	<p style="font-size:20px"><b>UPT PKB KOTA MALANG</b></p></center>
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
					<a href="http://ujikir.malangkota.go.id/simpkb" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn  ui-shadow ui-corner-all">Kembali</a>
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
			<p ><center>Sistem Informasi Manajemen<br>Pengujian Kendaraan Bermotor Online</center></p>
			<p ><center><a href="simpkb/datakendaraan.php"><img src="simpkb/cek_data.png" ></a></center></p>
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