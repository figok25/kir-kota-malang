<?php
session_start();
$user="admin";
$password="1234";

include "pagehead.php";
include "koneksi.php";
if($_POST["respon"]=="puas"){
	$sql="update IKM set RespPuas=RespPuas+1";
	$stmt = sqlsrv_prepare( $conn, $sql);
	sqlsrv_execute($stmt);
	
}
if($_POST["respon"]=="tidakpuas"){
	$sql="update IKM set RespTidakPuas=RespTidakPuas+1";
	$stmt = sqlsrv_prepare( $conn, $sql);
	sqlsrv_execute($stmt);
	
}
?>
	
	<div  style="padding:2 2 2 2;background-color:white" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main"> 
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
					<a href="http://ujikirkotamalang.ip-dynamic.com/daftar/" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn  ui-shadow ui-corner-all">Kembali</a>
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
			$str="select *,cast(RespPuas as decimal)/(RespPuas+RespTidakPuas)*100 as PPuas,cast(RespTidakPuas as decimal)/(RespPuas+RespTidakPuas)*100 as PTPuas from IKM ";
			$rs = sqlsrv_query($conn,$str);	
			$r=sqlsrv_fetch_array($rs);	
			?>
			<script>
			function puasSubmit() {
				try{
					document.getElementById("RPuas").submit();
				}catch(err){
					alert(err.message);
				}
			}
			function tidakpuasSubmit() {
				try{
					document.getElementById("RTPuas").submit();
				}catch(err){
					alert(err.message);
				}
			}			


			</script> 		
			
			<center><table>
			<tr><td style="text-align:center;vertical-align:bottom;width:40px">
			
			<table style="height:300px; width:60px" border=0>
			
			<tr><td style="vertical-align:bottom;"><b><?php echo $r["RespPuas"]; ?><br><?php echo number_format($r["PPuas"])."%"; ?></b>
			<img height=<?php echo number_format($r["PPuas"])."%"; ?> style="width:100px;" src="bar1.png"></td></tr>
	
			</table>

			<form id="RPuas" method="post" action="index.php">
			<input type="hidden" name="respon" value="puas">
			<a href="javascript:puasSubmit()"><img width=100 src="sangat_puas.png"><br><img width=100 src="puas0.png"></a>
			</form>
			</td>
			<td style="text-align:center;vertical-align:bottom">
			
			<table style="height:300px; width:60px"  border=0>

			<tr><td style="vertical-align:bottom;"><b><?php echo $r["RespTidakPuas"]; ?><br><?php echo number_format($r["PTPuas"])."%"; ?></b>
			<img height=<?php echo number_format($r["PTPuas"])."%"; ?> style="width:100px;" src="bar2.png"></td></tr>
	
			</table>
			<form id="RTPuas" method="post" action="index.php">
			<input type="hidden" name="respon" value="tidakpuas">			
			<a href="javascript:tidakpuasSubmit()"><img width=83 src="tidak_puas.png"><br><img width=100 src="tidakpuas0.png"></a>
			</form>
			</td>
			<td><img src="ikm.png"></td></tr>
			</table></center>

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