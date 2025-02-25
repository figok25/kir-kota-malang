<?php
session_start();

include "pagehead.php";
include "koneksi.php";

if($_POST["nominal"]){
	
	
	
}else{
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
		<tr><td>Nominal Rp.</td>
		<td>
		<input type="Text" name="nominal">
		</td></tr>
		</table>

		</form>
		
		<a href="javascript:myFunction()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-check ui-btn-icon-right ui-shadow ui-corner-all">Simpan</a>
		</div>
	  </div>


	</div>




<?php
}
include "pagefoot.php";
?>