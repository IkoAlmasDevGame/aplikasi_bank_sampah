<?php

namespace model;

class penarikan
{
    protected $table = "penarikan";
    protected $table2 = "saldo_bank";
    protected $table3 = "users";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function penarikan()
    {
        $SQL = "SELECT * FROM $this->table ORDER BY idTarik ASC";
        return mysqli_query($this->db, $SQL);
    }

    public function penarikan_full($idUser, $namaUser, $tglTarik, $saldo, $jmlPenarikan)
    {
        // Menggunakan htmlspecialchars untuk membersihkan input
        $idUser  = htmlspecialchars($_POST['idUser']);
        $namaUser  = htmlspecialchars($_POST['namaUser']);
        $tglTarik = htmlspecialchars($_POST['tglTarik']);
        $saldo = htmlspecialchars($_POST['saldo']);
        $jmlPenarikan = htmlspecialchars($_POST['jmlPenarikan']);

        // Mengambil koneksi database

        // Mendapatkan idTarik
        $result = $this->db->query("SELECT * FROM $this->table ORDER BY idTarik DESC LIMIT 1");
        $row = mysqli_fetch_array($result);
        $urut = isset($row['idTarik']) ? substr($row['idTarik'], 3) : 0;
        $tambah = (int)$urut + 1;
        $format = sprintf("TRK%03d", $tambah); // Format idTarik

        // Mendapatkan idTransaksi
        $result2 = $this->db->query("SELECT * FROM $this->table2 ORDER BY idTransaksi DESC LIMIT 1");
        $row2 = mysqli_fetch_array($result2);
        $urut2 = isset($row2['idTransaksi']) ? substr($row2['idTransaksi'], 3) : 0;
        $tambah2 = (int)$urut2 + 1;
        $format2 = sprintf("SLD%03d", $tambah2); // Format idTransaksi

        // Mendapatkan jmlPenarikan
        $result3 = $this->db->query("SELECT * FROM $this->table3 ORDER BY jmlPenarikan ASC Limit 1");
        $row3 = mysqli_fetch_array($result3);

        // Pengurangan saldo pada users
        $totalSaldo = $jmlPenarikan;
        $jmlPenarikan01 = $row3['jmlPenarikan'] + 1;
        $subSaldo = $saldo - $jmlPenarikan;
        $aksi = ("Pengurangan");

        // Menyiapkan dan mengeksekusi query untuk penarikan
        $data = $this->db->prepare("INSERT INTO $this->table (idTarik, idUser , namaUser , tglTarik, jmlPenarikan) VALUES (?, ?, ?, ?, ?)");
        $data->bind_param("sssss", $format, $idUser, $namaUser, $tglTarik, $jmlPenarikan);

        // Menyiapkan dan mengeksekusi query untuk saldo_bank
        $data2 = $this->db->prepare("INSERT INTO $this->table2 (idTransaksi, aksi, tanggal, aktor, jumlah, totalSaldo) VALUES (?, ?, ?, ?, ?, ?)");
        $data2->bind_param("ssssss", $format2, $aksi, $tglTarik, $idUser, $jmlPenarikan, $totalSaldo);

        // Menyiapkan dan mengeksekusi query untuk update users
        $data3 = $this->db->prepare("UPDATE $this->table3 SET jmlPenarikan = ?, saldo = ? WHERE idUser  = ?");
        $data3->bind_param("sss", $jmlPenarikan01, $subSaldo, $idUser);

        // Mengecek hasil eksekusi
        if ($data->execute() && $data2->execute() && $data3->execute()) {
            echo "
            <script>
                alert('Penarikan Baru Berhasil Ditambahkan');
                document.location.href = '../ui/header.php?page=penarikanAdmin';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Penambahan Penarikan Gagal!');
                document.location.href = '../ui/header.php?page=penarikanAdmin';
            </script>
        ";
        }
    }

    public function hapus_penarikan_full($id)
    {
        // Mengambil id dari parameter GET dan membersihkannya
        $id = htmlspecialchars($_GET['id']);

        // Mendapatkan data dari tabel penarikan
        $stmt = $this->db->query("SELECT * FROM $this->table WHERE idTarik = '$id'");
        $row = $stmt->fetch_array();

        $jumlah = $row['jmlPenarikan'];
        $tglTarik = $row['tglTarik'];
        $idUser  = $row['idUser'];

        // Mendapatkan data user
        $stmt2 = $this->db->query("SELECT * FROM users WHERE idUser = '$idUser'");
        $id3 = $stmt2->fetch_array();

        $saldo = $id3['saldo'];
        $penarikan = $id3['jmlPenarikan'] - 1;
        $jmlPenarikan = $row['jmlPenarikan'];
        $sisaSaldo = $saldo + $jmlPenarikan;

        // Mendapatkan idTransaksi untuk saldo_bank
        $struktur2 = $this->db->query("SELECT * FROM $this->table2 LIMIT 1");
        $row2 = mysqli_fetch_array($struktur2);
        $urut2 = isset($row2['idTransaksi']) ? substr($row2['idTransaksi'], 3) : 0;

        // Format idTransaksi
        $takeId = substr($urut2, -3);
        $lastId = (int)$takeId;
        $newId = $lastId + 1;
        $hitung = (string)$newId;

        if (strlen($hitung) == 1) {
            $format = "TRK" . "00" . $hitung;
        } else if (strlen($hitung) == 2) {
            $format = "TRK" . "0" . $hitung;
        } else {
            $format = "TRK" . $hitung;
        }

        // Mendapatkan data saldo_bank
        $stmt3 = $this->db->query("SELECT * FROM saldo_bank WHERE idTransaksi = '$format'");
        $id2 = $stmt3->fetch_array();

        $saldoBank = $id2['totalSaldo'] + $jumlah;
        $aksi = "Penambahan";
        $aktor = "ADM001";

        // Menghapus data dari tabel penarikan
        $data = $this->db->query("DELETE FROM $this->table WHERE idTarik = '$id'");

        // Menyimpan data ke tabel saldo_bank
        $data2 = $this->db->query("INSERT INTO $this->table2 (idTransaksi, aksi, tanggal, aktor, jumlah, totalSaldo) VALUES ('$format', '$aksi', '$tglTarik', '$aktor', '$jumlah', '$saldoBank')");

        // Mengupdate data di tabel users
        $data3 = $this->db->query("UPDATE $this->table3 SET jmlPenarikan = '$penarikan', saldo = '$sisaSaldo' WHERE idUser  = '$idUser'");

        // Mengecek hasil eksekusi
        if ($data && $data2 && $data3) {
            echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href = '../ui/header.php?page=penarikanAdmin';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Data gagal dihapus');
                document.location.href = '../ui/header.php?page=penarikanAdmin';
            </script>
        ";
        }
    }

    public function ubah_penarikan_full($idTarik, $idUser, $namaUser, $tglTarik, $jmlPenarikan)
    {
        $idTarik = htmlspecialchars($_POST['idTarik']);
        $idUser = htmlspecialchars($_POST['idUser']);
        $namaUser = htmlspecialchars($_POST['namaUser']);
        $tglTarik = htmlspecialchars($_POST['tglTarik']);
        $jmlPenarikan = htmlspecialchars($_POST['jmlPenarikan']);
        # data pengambilan pada penarikan
        $ambildatapenarikan = $this->db->query("SELECT * FROM penarikan WHERE idTarik = '$idTarik'");
        $id1 = mysqli_fetch_array($ambildatapenarikan);
        $penarikanAwal = $id1['jmlPenarikan'];
        # data pengambilan pada users
        $ambildatauser = $this->db->query("SELECT * FROM users WHERE namaUser = '$namaUser'");
        $id2 = mysqli_fetch_array($ambildatauser);
        $saldoUser = $id2['saldo'];
        # data pengambilan pada saldo bank
        $ambildatabank = $this->db->query("SELECT * FROM saldo_bank WHERE aktor = '$idUser' AND tanggal = '$tglTarik'");
        $id3 = mysqli_fetch_array($ambildatabank);
        $saldoBank = $id3['totalSaldo'];

        if ($penarikanAwal > $jmlPenarikan) {
            $totalfix = $penarikanAwal - $jmlPenarikan;
            $sisaSaldo = $saldoBank + $totalfix;
        } elseif ($penarikanAwal < $jmlPenarikan) {
            $totalfix = $jmlPenarikan - $penarikanAwal;
            $sisaSaldo = $saldoBank - $totalfix;
        } elseif ($penarikanAwal = $jmlPenarikan) {
            $sisaSaldo = $saldoBank + 0;
        }

        if ($penarikanAwal > $jmlPenarikan) {
            $totalfix = $penarikanAwal - $jmlPenarikan;
            $sisaSaldo2 = $saldoUser + $totalfix;
        } elseif ($penarikanAwal < $jmlPenarikan) {
            $totalfix = $jmlPenarikan - $penarikanAwal;
            $sisaSaldo2 = $saldoUser - $totalfix;
        } elseif ($penarikanAwal = $jmlPenarikan) {
            $sisaSaldo2 = $saldoUser + 0;
        }

        # database insert dan update sesuai table yang tersedia.
        $data = $this->db->query("UPDATE $this->table SET idUser = '$idUser', namaUser = '$namaUser', tglTarik = '$tglTarik', jmlPenarikan = '$jmlPenarikan' WHERE idTarik = '$idTarik'"); # penarikan
        $data2 = $this->db->query("UPDATE $this->table2 SET jumlah = '$jmlPenarikan', totalSaldo = '$sisaSaldo' WHERE aktor = '$idUser' AND tanggal = '$tglTarik'"); # saldo_bank
        $data3 = $this->db->query("UPDATE $this->table3 SET saldo = '$sisaSaldo2' WHERE idUser = '$idUser'"); # users
        if ($data && $data2 && $data3) {
            echo "
                <script>
                    alert('Penarikan Berhasil Diedit');
                    document.location.href = '../ui/header.php?page=penarikanAdmin';
                </script>
            ";
            die;
        } else {
            echo "
                <script>
                    alert('Data Penarikan Gagal Diedit!');
                    document.location.href = '../ui/header.php?page=penarikanAdmin';
                </script>
            ";
            die;
        }
    }
}
