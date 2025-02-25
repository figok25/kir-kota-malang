<?php

include "pagehead.php";
include "koneksi.php";


?>
<div style="padding:8px" class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main">
    <center>
        <img src="http://103.131.16.80/sijalakkebo/header.png" width=100%>
        <hr>
    </center>
    <div class="ui-corner-all">
        <?php
        if (isset($_GET['NoUji'])) {
            $txtCari = $_GET['NoUji'];

            $str = "select *,NewID() as fname,vWajibUjiList.IdWajibUji as IDWU from vWajibUjiList where (NoUji='$txtCari' or NoKendaraan='$txtCari') and Aktif=1 ";
            $rs = sqlsrv_query($conn, $str);
            $r = sqlsrv_fetch_array($rs);
            $query = "EXEC sp_ExportImage $r[IDWU],'E:\\inetpub\\wwwroot\\simpkb\\temp','$r[fname]'";
            $result = sqlsrv_query($conn, $query);
            $history = [];
            $q = "select TglUji, TglJatuhTempo, NmTipeUji, NmStatusUji, NoReg from vPengujian where (NoUji='$txtCari' or NoKendaraan='$txtCari') order by TglJatuhTempo DESC";
            $qrs = sqlsrv_query($conn, $q);
            // echo "<pre>";
            while ($ru = sqlsrv_fetch_array($qrs)) {
                $history[] = $ru;
            }
            // echo "</pre>";
            $NoReg = $history[0]['NoReg'];
            $qgambar = "SELECT * FROM DataKendaraanImg WHERE NoReg = '$NoReg'";
            $grs = sqlsrv_query($conn, $qgambar);
            $gr = sqlsrv_fetch_array($grs);

        }
        ?>

        <!-- ============================================================================================================== -->
        <!-- ============================================================================================================== -->
        <div class="ui-bar ui-bar-a">
            <h3>Foto Kendaraan</h3>
        </div>
        <div class="ui-body ui-body-a">
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <div class="ui-bar ui-bar-a">Tampak Depan</div>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($gr['Gambar1']); ?>"
                        alt="Tampak Depan" style="width:100%;">
                </div>
                <div class="ui-block-b">
                    <div class="ui-bar ui-bar-a">Tampak Belakang</div>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($gr['Gambar2']); ?>"
                        alt="Tampak Depan" style="width:100%;">
                </div>
                <div class="ui-block-a">
                    <div class="ui-bar ui-bar-a">Tampak Kiri</div>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($gr['Gambar3']); ?>"
                        alt="Tampak Depan" style="width:100%;">
                </div>
                <div class="ui-block-b">
                    <div class="ui-bar ui-bar-a">Tampak Kanan</div>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($gr['Gambar4']); ?>"
                        alt="Tampak Depan" style="width:100%;">
                </div>

            </div>
        </div>
        <!-- ============================================================================================================== -->
        <!-- ============================================================================================================== -->
        <div class="ui-bar ui-bar-a">
            <h3>Identitas Kendaraan dan Pemilik</h3>
        </div>
        <div class="ui-body ui-body-a">
            <?php
            echo "
		  <p>Nomor Uji Berkala:<br><span style='color:#0073e6;'><b>- $r[NoUji]</b></span></p>
		  <p>Nomor Kendaraan:<br><span style='color:#0073e6'><b>- $r[NoKendaraan]</b></span></p>
		  <p>Nama Pemilik Kendaraan:<br><span style='color:#0073e6'><b>- $r[NmPemilik]</b></span></p>
		  <p>Alamat Pemilik Kendaraan:<br><span style='color:#0073e6'><b>- $r[Alamat], $r[NmKecamatan]</b></span></p>
		  ";
            ?>
        </div>
        <!-- ============================================================================================================== -->
        <!-- ============================================================================================================== -->
        <div class="ui-bar ui-bar-a">
            <h3>Uraian Data Kendaraan</h3>
        </div>
        <div class="ui-body ui-body-a">
            <?php
            echo "
		  <p>Merek:<br><span style='color:#0073e6;'><b>- $r[NmMerek]</b></span></p>
		  <p>Tipe:<br><span style='color:#0073e6'><b>- $r[NmTipe]</b></span></p>
        <p>Jenis:<br><span style='color:#0073e6'><b>- $r[NmJenis] - $r[NmJenis]</b></span></p>
		  <p>Isi Silinder:<br><span style='color:#0073e6'><b>- $r[IsiSilinder]</b></span></p>
		  <p>Daya Motor:<br><span style='color:#0073e6'><b>- $r[DayaMotor]</b></span></p>
		  <p>Bahan Bakar:<br><span style='color:#0073e6'><b>- $r[NmBahanBakar]</b></span></p>
		  <p>Tahun Pembuatan:<br><span style='color:#0073e6'><b>- $r[TahunProduksi]</b></span></p>
		  <p>Status Penggunaan:<br><span style='color:#0073e6'><b>- $r[NmStatus]</b></span></p>
		  ";
            ?>
        </div>
        <!-- ============================================================================================================== -->
        <!-- ============================================================================================================== -->
        <div class="ui-bar ui-bar-a">
            <h3>Ukuran Kendaraan</h3>
        </div>
        <div class="ui-body ui-body-a">
            <?php
            echo "<table>
		<col width='10'>
	  <tr><td colspan=4>a. Ukuran Utama</td></tr>
	  <tr><td colwidth=100px></td><td>- Panjang</td><td>:</td><td class='isian-nilai'>$r[DimPanjang]</td><td>mm</td></tr>
	  <tr><td></td><td>- Lebar</td><td>:</td><td class='isian-nilai'>$r[DimLebar]</td><td>mm</td></tr>
	  <tr><td></td><td>- Tinggi</td><td>:</td><td class='isian-nilai'>$r[DimTinggi]</td><td>mm</td></tr>
	  <tr><td></td><td>- Julur Belakang / ROH</td><td>:</td><td class='isian-nilai'>$r[DimROH]</td><td>mm</td></tr>
	  <tr><td></td><td>- Julur Depan / FOH</td><td>:</td><td class='isian-nilai'>$r[DimFOH]</td><td>mm</td></tr>
	  <tr><td colspan=4>b. Ukuran Bak/Box Muatan</td></tr>
	  <tr><td></td><td>- Panjang</td><td>:</td><td class='isian-nilai'>$r[TankPanjang]</td><td>mm</td></tr>
	  <tr><td></td><td>- Lebar</td><td>:</td><td class='isian-nilai'>$r[TankLebar]</td><td>mm</td></tr>
	  <tr><td></td><td>- Tinggi</td><td>:</td><td class='isian-nilai'>$r[TankTinggi]</td><td>mm</td></tr>
	  <tr><td></td><td>- Jenis Bahan</td><td>:</td><td class='isian-nilai'>$r[NmMaterial]</td><td></td></tr>
	  </table>";
            ?>
        </div>
        <!-- ============================================================================================================== -->
        <!-- ============================================================================================================== -->
        <div class="ui-bar ui-bar-a">
            <h3>Berat Kendaraan</h3>
        </div>
        <div class="ui-body ui-body-a">
            <?php
            echo "<table>
			
		  <tr><td>- Sumbu I</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb1]</td><td>kg</td></tr>
		  <tr><td>- Sumbu II</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb2]</td><td>kg</td></tr>
		  <tr><td>- Sumbu III</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb3]</td><td>kg</td></tr>
		  <tr><td>- Sumbu IV</td><td>:</td><td class='isian-nilai'>$r[BeratKosongSb4]</td><td>kg</td></tr>
		  <tr><td>Jumlah (Total)</td><td>:</td><td class='isian-nilai'>$r[BeratKosong]</td><td>kg</td></tr>
		  <tr><td>- JBB</td><td>:</td><td class='isian-nilai'>$r[JBB]</td><td>kg</td></tr>
		  <tr><td>- JBI</td><td>:</td><td class='isian-nilai'>$r[JBI]</td><td>kg</td></tr>
		  <tr><td>- MST</td><td>:</td><td class='isian-nilai'>$r[MST]</td><td>kg</td></tr>
		  <tr><td>- Kelas Jalan</td><td>:</td><td class='isian-nilai'>$r[NmKelasJalan]</td><td></td></tr>
		  </table>";
            ?>
        </div>
        <!-- ============================================================================================================== -->
        <!-- ============================================================================================================== -->
        <div class="ui-bar ui-bar-a">
            <h3>Pengujian</h3>
        </div>
        <div class="ui-body ui-body-a">
            <?php
            // echo count($history); TglUji, TglJatuhTempo, NmTipeUji, NmStatusUji, NoReg
            foreach ($history as $h) {
                // print_r($h);
                $tglUji = $h['TglUji']->format('d M Y');
                // $TglJatuhTempo = $h['TglJatuhTempo'];
            
                echo "<div class='ui-body ui-body-a'>";
                echo "<b>$h[NmTipeUji] | $h[NmStatusUji]</b> <br> Tgl. Uji : $tglUji <br> Tgl. Jatuh Tempo : $h[TglJatuhTempo]";
                echo "</div>";
            }
            ?>
        </div>

    </div>
    <a href="/sijalakkebo/info-kendaraan/" data-transition="flip"
        class="ui-icon-back ui-btn-icon-left ui-btn ui-corner-all ui-shadow ui-btn-inline ">Kembali</a>
</div>




<?php
include "pagefoot.php";
?>