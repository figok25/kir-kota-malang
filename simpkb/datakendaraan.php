<?php

include "pagehead.php";
include "koneksi.php";


?>


	<div  style="padding:8 8 8 8" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
<div class="ui-corner-all custom-corners">
<div class="ui-bar ui-bar-a"><h3>Data Kendaraan</h3>
</div>
<div class="ui-body ui-body-a">
	<form id="detailkendaraan" method="get" action="detailkendaraan.php"><label for="cari">No.Uji/No.Kendaraan:</label>
	<input type="text" data-clear-btn="true" name="NoUji" id="NoUji" value="" >
	<a href="javascript:mySubmit()" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-shadow ui-corner-all">Tampil</a>
	</form>
	
<hr>
<a href="index.php" data-transition="flip" class="ui-icon-back ui-btn-icon-left ui-btn ui-corner-all ui-shadow ui-btn-inline ">Kembali</a>

<script>
function mySubmit() {
	try{
		document.getElementById("detailkendaraan").submit();
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