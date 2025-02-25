<?php
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
	<div  style="padding:8 8 8 8" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main"> 
		  <?php

		  if(isset($_POST['keyid'])){

		  }else{
			?>
			<form id="frmWU" name="frmWU" method="post" action="wajibujidata.php">
			<div>
     		<label for="search-1">Pencarian Berdasarkan:</label>

				<div class="ui-field-contain" style="margin-top:-30px">
				    <select name="keyid" id="keyid" data-native-menu="false">
				        <option value="NoUji" selected="selected">Nomor Uji</option>
				        <option value="NoKendaraan">Nomor Kendaraan</option>
				        <option value="NoRangka" >Nomor Rangka</option>
				        <option value="NoMesin">Nomor Mesin</option>
				    </select>
				</div>	
			</div>
			
	
			
			<div style="margin-top:-44px">
     		<input type="search" name="txtCari" id="txtCari" value="">
				  <a href="javascript:myFunction()" data-icon="star" data-theme="a" data-form="ui-btn-up-a" class=" ui-btn ui-btn-a ui-icon-star ui-btn-icon-left ui-shadow ui-corner-all">Cari</a>
			</div>
			</form>


			
			<?php
			  
		  }
		  ?>

		</div>
	
<?php
include "pagefoot.php";
?>