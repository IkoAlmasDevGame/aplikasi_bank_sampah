<?php
include("../../../config/config.php");
error_reporting(0);
$tamp = $_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$namaSampah = $pecah_bar[1];
$sql = "SELECT * FROM sampah where namaSampah = '$namaSampah'";
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
            <label for="idSampah">ID Sampah</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="text" readonly value="<?= $row['idSampah'] ?>" name="idSampah" id="idSampah"
                class="form-control">
        </div>
    </div>
</div>
<div class="form-inline my-2">
    <div class="row form-justify">
        <div class="form-label col-sm col-sm-4 col-md col-md-4">
            <label for="namaSampah">Nama Sampah</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="text" name="namaSampah" readonly value="<?= $row['namaSampah'] ?>" class="form-control">
        </div>
    </div>
</div>
<div class="form-inline my-2">
    <div class="row form-justify">
        <div class="form-label col-sm col-sm-4 col-md col-md-4">
            <label for="berat">Berat yang Dijual (Kg)</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="text" inputmode="numeric" value="" name="berat" id="berat" class="form-control">
        </div>
    </div>
</div>
<div class="form-inline my-2">
    <div class="row form-justify">
        <div class="form-label col-sm col-sm-4 col-md col-md-4">
            <label for="saldo">Tanggal Penjualan</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="date" name="tglPenjualan" id="tglPenjualan" class="form-control">
        </div>
    </div>
</div>
<div class="form-inline my-2">
    <div class="row form-justify">
        <div class="form-label col-sm col-sm-4 col-md col-md-4">
            <label for="namaPembeli">Nama Pembeli</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="text" id="namaPembeli" name="namaPembeli" class="form-control">
        </div>
    </div>
</div>
<div class="form-inline my-2">
    <div class="row form-justify">
        <div class="form-label col-sm col-sm-4 col-md col-md-4">
            <label for="nomorPembeli">Nomor Pembeli</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="text" inputmode="numeric" id="nomorPembeli" name="nomorPembeli" class="form-control">
        </div>
    </div>
</div>
<div class="form-inline my-2">
    <div class="row form-justify">
        <div class="form-label col-sm col-sm-4 col-md col-md-4">
            <label for="harga">Harga Penjualan/Kg</label>
        </div>
        <div class="col-sm col-sm-1">:</div>
        <div class="col-sm col-sm-5 col-md col-md-5">
            <input type="text" inputmode="numeric" id="harga" name="harga" class="form-control">
        </div>
    </div>
</div>
<div class="card-footer my-2">
    <div class="text-center">
        <a href="?page=penjualanAdmin" aria-current="page">
            <button type="button" class="btn btn-default btn-outline-dark" style="width: 10%;">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save fa-fw fa-1x"></i>
            Simpan Data
        </button>
        <button type="reset" class="btn btn-danger">
            <i class="fas fa-eraser fa-fw fa-1x"></i>
            Hapus Semua
        </button>
    </div>
</div>
<?php
    }
} else {
    echo "<div class='row form-justify'>
        <div class='col-sm col-sm-10 col-md col-md-10'>0 results</div>
    </div>";
}

mysqli_close($koneksi);

?>