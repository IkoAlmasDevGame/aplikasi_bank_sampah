<?php

namespace model;

class setoran
{
    protected $table = "setoran";
    protected $table2 = "users";
    protected $table3 = "stock_sampah";
    protected $table4 = "sampah";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setoran()
    {
        $SQL = "SELECT * FROM $this->table ORDER BY idSetor ASC";
        return mysqli_query($this->db, $SQL);
    }

    public function setoran_tambah($penyetoran, $sampah, $tanggal, $berat)
    {
        $no = mysqli_query($this->db, "SELECT * FROM $this->table ORDER BY idSetor DESC");
        $noArr = mysqli_fetch_array($no);
        if ($noArr == null) {
            $row = 000;
        } else {
            $row = $noArr[0];
        }
        $takeId = substr($row, -3);
        $lastId = (int)$takeId;
        $newId = $lastId + 1;
        $hitung = (string)$newId;

        if (strlen($hitung) == 1) {
            $format = "STR" . "00" . $hitung;
        } else if (strlen($hitung) == 2) {
            $format = "STR" . "0" . $hitung;
        } else {
            $format = "STR" . $hitung;
        }

        $penyetoran = htmlspecialchars($_POST['penyetor']);
        $ambildatauser = mysqli_query($this->db, "SELECT * FROM $this->table2 WHERE namaUser = '$penyetoran'");
        $id1 = mysqli_fetch_array($ambildatauser);
        $sampah = htmlspecialchars($_POST['sampah']);
        $ambildatasampah = mysqli_query($this->db, "SELECT * FROM $this->table4 WHERE namaSampah = '$sampah'");
        $id2 = mysqli_fetch_array($ambildatasampah);
        $tanggal = htmlspecialchars($_POST['tanggal']);
        $berat = htmlspecialchars($_POST['berat']);
        $ambilhargasampah = mysqli_query($this->db, "SELECT * FROM $this->table4 WHERE namaSampah = '$sampah'");
        $id3 = mysqli_fetch_array($ambilhargasampah);

        $harga = $id3['harga'];
        $total = $berat * $harga;
        $updatestock = $berat + $id2['stock'];
        $jmlSetoran = $id1['jmlSetoran'] + 1;
        $saldo = $id1['saldo'] + $total;

        if ($berat < 1) {
            return 0;
        } else {
            $data = mysqli_query($this->db, "INSERT INTO $this->table SET idSetor = '$format', idUser = '$id1[idUser]', idSampah = '$id2[idSampah]', 
            tglSetor = '$tanggal', berat = '$berat', total = '$total'");
            $data2 = mysqli_query($this->db, "UPDATE $this->table3 SET stock = '$updatestock' WHERE namaSampah = '$id2[namaSampah]'");
            $data3 = mysqli_query($this->db, "UPDATE $this->table2 SET jmlSetoran = '$jmlSetoran', saldo = '$saldo' WHERE idUser = '$id1[idUser]'");
            if ($data != "" && $data2 != "" && $data3 != "") {
                if ($data && $data2 && $data3) {
                    header("location:../ui/header.php?page=setoranAdmin");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=tambahSetoran");
                exit(0);
            }
        }
    }

    public function setoran_ubah($idSetor)
    {
        $idSetor = htmlspecialchars($_POST['idSetoran']);
        $ambildatasetoran = mysqli_query($this->db, "SELECT * FROM $this->table WHERE idSetor = '$idSetor'");
        $id5 = mysqli_fetch_array($ambildatasetoran);
        $beratsetoran = $id5['berat'];
        $totalSetor = $id5['total'];
        $ambildatauser = mysqli_query($this->db, "SELECT * FROM $this->table2 WHERE namaUser = '$_POST[penyetor]'");
        $id1 = mysqli_fetch_array($ambildatauser);
        $saldoUser = $id1['saldo'];
        $ambildatasampah = mysqli_query($this->db, "SELECT * FROM $this->table4 WHERE namaSampah = '$_POST[sampah]'");
        $id2 = mysqli_fetch_array($ambildatasampah);
        $namaSampah = $id2['namaSampah'];
        $stock = $id2['stock'];
        $berat = htmlspecialchars($_POST['berat']);
        $tanggal = htmlspecialchars($_POST['tanggal']);

        $idUser = $id1['idUser'];
        $idSampah = $id2['idSampah'];
        $harga = $id2['harga'];
        $total = $berat * $harga;

        # hitung berat
        if ($beratsetoran > $berat) {
            $beratfix = $beratsetoran - $berat;
            $sisaStock = $stock - $beratfix;
        } else if ($beratsetoran < $berat) {
            $beratfix = $berat - $beratsetoran;
            $sisaStock = $stock + $beratfix;
        } else if ($beratsetoran = $berat) {
            $sisaStock = $stock + 0;
        }

        # hitung total setor
        if ($totalSetor > $total) {
            $totalfix = $totalSetor - $total;
            $sisaSaldo = $saldoUser - $totalfix;
        } elseif ($totalSetor < $total) {
            $totalfix = $total - $totalSetor;
            $sisaSaldo = $saldoUser + $totalfix;
        } elseif ($totalSetor = $total) {
            $sisaSaldo = $saldoUser + 0;
        }

        $data = mysqli_query($this->db, "UPDATE $this->table3 SET stock = '$sisaStock' WHERE namaSampah = '$namaSampah'");
        $data2 = mysqli_query($this->db, "UPDATE $this->table2 SET saldo = '$sisaSaldo' WHERE idUser = '$idUser'");
        $data3 = mysqli_query($this->db, "UPDATE $this->table SET idUser = '$idUser', idSampah = '$idSampah', tglSetor = '$tanggal', berat = '$berat', total = '$total' WHERE idSetor = '$idSetor'");
        if ($data != "" && $data2 != "" && $data3 != "") {
            if ($data && $data2 && $data3) {
                header("location:../ui/header.php?page=setoranAdmin");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=editSetoran&idSetoran=$idSetor");
            exit(0);
        }
    }

    public function setoran_hapus($id)
    {
        $id = htmlspecialchars($_GET['id']);
        $ambildatasetoran = mysqli_query($this->db, "SELECT * FROM $this->table WHERE idSetor = '$id'");
        $id1 = mysqli_fetch_array($ambildatasetoran);
        $idUser = $id1['idUser'];
        $idSampah = $id1['idSampah'];
        $ambildatasampah = mysqli_query($this->db, "SELECT * FROM $this->table4 WHERE idSampah = '$idSampah'");
        $id2 = mysqli_fetch_array($ambildatasampah);
        $namaSampah = $id2['namaSampah'];
        $ambildatastock = mysqli_query($this->db, "SELECT * FROM $this->table3 WHERE namaSampah = '$namaSampah'");
        $id3 = mysqli_fetch_array($ambildatastock);
        $ambildatauser = mysqli_query($this->db, "SELECT * FROM $this->table2 WHERE idUser = '$idUser'");
        $id4 = mysqli_fetch_array($ambildatauser);
        $saldo = $id1['saldo'];
        $setoran = $id4['jmlSetoran'] - 1;
        $stock = $id3['stock'];
        $berat = $id1['berat'];
        $total = $id4['total'];
        $sisaStock = $stock - $berat;
        $sisaSaldo = $saldo - $total;
        # data
        $data = mysqli_query($this->db, "DELETE FROM $this->table WHERE idSetor = '$id'");
        $data2 = mysqli_query($this->db, "UPDATE $this->table3 SET stock = '$sisaStock' WHERE namaSampah = '$namaSampah'");
        $data3 = mysqli_query($this->db, "UPDATE $this->table2 SET jmlSetoran = '$setoran', saldo = '$sisaSaldo' WHERE idUser = '$idUser'");
        if ($data != "" && $data2 != "" && $data3 != "") {
            if ($data && $data2 && $data3) {
                header("location:../ui/header.php?page=setoranAdmin");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?page=setoranAdmin");
            exit(0);
        }
    }
}
