<?php

session_start();

?>
</div>

		</div>
		
		
	    <div style="margin-top:-28px;" data-role="panel" data-position="left" data-position-fixed="true" data-display="push" data-theme="a" id="nav-panel">
        <ul data-role="listview">
           <!-- <li style="height:22px" data-icon="delete"><a href="#" data-rel="close">Tutup</a></li>
            <li style="height:22px" ><a href="http://210.210.149.178/smartkir/sklu">Halaman Depan</a></li>
            <li style="height:22px" ><a href="http://210.210.149.178/smartkir/sklu">Halaman Depan</a></li>
            <li style="height:22px" ><a href="#panel-fixed-page2">Data Kendaraan</a></li>
            <li style="height:22px" ><a href="#panel-fixed-page2">Hasil Pengujian</a></li> -->
			<li style="height:42px" data-icon="delete"><a href="" data-rel="close">Tutup</a> </li>
			<li style="height:42px"><a href="http://103.131.16.80/sijalakkebo/index.php">Halaman Depan</a> </li>
			<li style="height:42px"><a href="datakendaraan.php">Data Kendaraan</a> </li>
			<li style="height:42px"><a href="datahasiluji.php">Data Hasil Uji</a> </li>
			<?php
			if(isset($_SESSION["username"])){
				?>
				<li style="height:42px"><a href="datapengujian.php">Riwayat Pengujian</a> </li>
				<li style="height:42px"><a href="datarekappengujian.php">Rekap Pengujian </a> </li>		
				<?php
			}
			?>
	
			

        </ul>
    	</div><!-- /panel --> 	
	    <div style="margin-top:-40px;" data-role="panel" data-position="right" data-position-fixed="true" data-display="overlay" data-theme="a" id="add-form">
	        <form class="userform" Id="frmLogin" action="index.php" method="post" >
	
	            
	
	<?php
	if(isset($_SESSION["username"])){
		
		echo "
		<input type='hidden' name='staLogin' value='2'>
		<h2>User Info: $_SESSION[username] </h2>
		<a href='javascript:myLogin()' class='ui-btn ui-shadow ui-corner-all ui-btn-a ui-mini'>Logout</a>
		";
		
	}else{
	?>
	<input type="hidden" name="staLogin" value="1">
	<h2>Login</h2>
	<table>
	<tr><td colspan=2>Username:</td></tr>
	<tr><td colspan=2><input type="text" name="username" id="username" value="" data-clear-btn="true" data-mini="true"></td></tr>
	<tr><td colspan=2>Password:</td></tr>
	<tr><td colspan=2><input type="password" name="password" id="password" value="" data-clear-btn="true" autocomplete="off" data-mini="true"></td></tr>
	<tr><td ><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-b ui-mini">Batal</a></td>
	<td><a href="javascript:myLogin()" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-mini">Login</a>
	</td></tr>
	</table>
	<?php
	}
	?>
	        </form>
	<script>
	function myLogin(){
		try{
			document.getElementById("frmLogin").submit();
		}catch(err){
			alert(err.message);
		}		
	}
	</script>
	    </div><!-- /panel -->
		<br>
	</div>
	
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close"><img src="power-black.png"></span>
            <img src="popup.jpeg" alt="popup" width="100%" class="pop-img">
            <!-- <div class="modal-header">
                <h2>Modal Header</h2>
            </div> -->
            <!-- <div class="modal-body">
            </div> -->
            <!-- <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div> -->
        </div>

    </div>	
<script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        // var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        // btn.onclick = function() {
        //     modal.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function openModal() {
            modal.style.display = "block";
        }
    </script>		
</body>
</html>