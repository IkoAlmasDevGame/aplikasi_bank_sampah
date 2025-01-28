<?php
include("../../../config/config.php");
error_reporting(0);
$tamp = $_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$namaUser = $pecah_bar[1];
$sql = "SELECT * FROM users where namaUser = '$namaUser'";
$result = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <style type="text/css">
            .form-justify {
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
            }

            .form-justify-2 {
                justify-content: center;
                align-items: start;
                flex-wrap: wrap;
            }
        </style>
        <div class="form-inline my-2">
            <div class="row form-justify">
                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                    <label for="idUser">ID USER</label>
                </div>
                <div class="col-sm col-sm-1">:</div>
                <div class="col-sm col-sm-5 col-md col-md-5">
                    <input type="text" readonly value="<?= $row['idUser'] ?>" name="idUser" id="idUser" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-inline my-2">
            <div class="row form-justify">
                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                    <label for="namaUser">Nama User</label>
                </div>
                <div class="col-sm col-sm-1">:</div>
                <div class="col-sm col-sm-5 col-md col-md-5">
                    <input type="text" readonly value="<?= $row['namaUser'] ?>" name="namaUser" id="namaUser"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="form-inline my-2">
            <div class="row form-justify">
                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                    <label for="tanggal">Tanggal Penarikan</label>
                </div>
                <div class="col-sm col-sm-1">:</div>
                <div class="col-sm col-sm-5 col-md col-md-5">
                    <input type="date" value="" name="tglTarik" id="tanggal" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-inline my-2">
            <div class="row form-justify">
                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                    <label for="saldo">Saldo Utama</label>
                </div>
                <div class="col-sm col-sm-1">:</div>
                <div class="col-sm col-sm-5 col-md col-md-5">
                    <input type="text" name="saldo" readonly value="<?= $row['saldo'] ?>" id="saldo" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-inline my-2">
            <div class="row form-justify">
                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                    <label for="jmlPenarikan">Jumlah Penarikan Saldo</label>
                </div>
                <div class="col-sm col-sm-1">:</div>
                <div class="col-sm col-sm-5 col-md col-md-5">
                    <input type="text" id="jmlPenarikan" name="jmlPenarikan" class="form-control">
                </div>
            </div>
        </div>
        <!-- <div class="form-inline my-2">
    <div class="row form-justify">
        <div class="form-label col-sm col-sm-4 col-md col-md-4">
            <label for="totalSaldo">Total Saldo</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="text" readonly id="totalSaldo" name="totalSaldo" class="form-control">
        </div>
    </div>
</div> -->
<?php
    }
} else {
    echo "<div class='row form-justify'>
        <div class='col-sm col-sm-10 col-md col-md-10'>0 results</div>
    </div>";
}

mysqli_close($koneksi);

?>