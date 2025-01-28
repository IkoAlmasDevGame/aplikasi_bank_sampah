<?php

namespace model;

class selling
{
    protected $table = "penjualan";
    protected $table2 = "saldo_bank";
    protected $table3 = "stock_sampah ";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function penjualan()
    {
        $SQL = "SELECT * FROM penjualan ORDER BY idJual ASC";
        return mysqli_query($this->db, $SQL);
    }

    public function tambah_penjualan($idSampah, $berat, $tglPenjualan, $namaPembeli, $nomorPembeli, $harga)
    {
        // Ambil idJual terakhir
        $struktur = $this->db->query("SELECT * FROM $this->table ORDER BY idJual DESC LIMIT 1");
        $row = mysqli_fetch_array($struktur);
        $urut = isset($row['idJual']) ? substr($row['idJual'], 3) : 0; // Jika tidak ada data, mulai dari 0
        $tambah = (int)$urut + 1;
        $format = sprintf("JUL%03d", $tambah); // Format idJual

        // Validasi input
        $idSampah = htmlspecialchars($_POST['idSampah']);
        $berat = htmlspecialchars($_POST['berat']);
        $tglPenjualan = htmlspecialchars($_POST['tglPenjualan']);
        $namaPembeli = htmlspecialchars($_POST['namaPembeli']);
        $nomorPembeli = htmlspecialchars($_POST['nomorPembeli']);
        $harga = htmlspecialchars($_POST['harga']);
        $namaSampah = htmlspecialchars($_POST['namaSampah']);
        $totalPendapatan = (int)$berat * (int)$harga;

        // Ambil stock sampah
        $ambilSampah = $this->db->query("SELECT stock FROM $this->table3 WHERE namaSampah = '$namaSampah'");
        $arrayBerat = $ambilSampah->fetch_array();
        $stock = isset($arrayBerat['stock']);

        // Validasi stock
        if ($berat > $stock || $berat < 1 || $harga < 1) {
            return 0; // Gagal jika kondisi tidak terpenuhi
        }

        // Update stock sampah
        $updateStock = (int)$arrayBerat['stock'] - (int)$berat;

        // Ambil idTransaksi terakhir
        $struktur2 = $this->db->query("SELECT * FROM $this->table2 ORDER BY idTransaksi DESC LIMIT 1");
        $row2 = mysqli_fetch_array($struktur2);
        $urut2 = isset($row2['idTransaksi']) ? substr($row2['idTransaksi'], 3) : 0; // Jika tidak ada data, mulai dari 0
        $tambah2 = (int)$urut2 + 1;
        $format2 = sprintf("SLD%03d", $tambah2); // Format idTransaksi

        $jumlah = (int)$berat * (int)$harga;
        $totalSaldo = $jumlah + (isset($row2['totalSaldo']) ? $row2['totalSaldo'] : 0);

        // Insert data penjualan
        $data = $this->db->prepare("INSERT INTO $this->table (idJual, idSampah, berat, tglPenjualan, namaPembeli, nomorPembeli, harga, totalPendapatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $dataInsert = array($format, $idSampah, $berat, $tglPenjualan, $namaPembeli, $nomorPembeli, $harga, $totalPendapatan);
        $data->execute($dataInsert);

        // Insert data saldo bank
        $aksi = "Penambahan";
        $aktor = "ADM001";
        $data2 = $this->db->prepare("INSERT INTO $this->table2 (idTransaksi, aksi, tanggal, aktor, jumlah, totalSaldo) VALUES (?, ?, ?, ?, ?, ?)");
        $dataInsert2 = array($format2, $aksi, $tglPenjualan, $aktor, $jumlah, $totalSaldo);
        $data2->execute($dataInsert2);

        // Update stock sampah
        $data3 = $this->db->prepare("UPDATE $this->table3 SET stock = ? WHERE namaSampah = ?");
        $dataInsert3 = array($updateStock, $namaSampah);
        $data3->execute($dataInsert3);

        // Eksekusi semua query
        if ($data && $data2 && $data3) {
            echo "
            <script>
                alert('Penjualan Baru Berhasil Ditambahkan');
                document.location.href = '../ui/header.php?page=penjualanAdmin';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Penambahan Penjualan Gagal!');
                document.location.href = '../ui/header.php?page=penjualanAdmin';
            </script>
        ";
        }
    }

    public function delete_penjualan($id)
    {
        $id = htmlspecialchars($_GET['id']);
        // Ambil idTransaksi terakhir
        $struktur2 = $this->db->query("SELECT * FROM $this->table2 ORDER BY idTransaksi DESC LIMIT 1");
        $row2 = mysqli_fetch_array($struktur2);
        $urut2 = isset($row2['idTransaksi']) ? substr($row2['idTransaksi'], 3) : 0; // Jika tidak ada data, mulai dari 0
        $lastId = (int)$urut2;
        $newId = $lastId + 1;
        $hitung = (string)$newId;
        $hitung2 = (string)$lastId;
        if (strlen($hitung) == 1) {
            $format2 = "SLD" . '00' . $hitung;
        } elseif (strlen($hitung) == 2) {
            $format2 = "SLD" . '0' . $hitung;
        } else {
            $format2 = "SLD" . $hitung;
        }
        $ambildatapenjualan = $this->db->query("SELECT * FROM $this->table WHERE idJual = '$id'");
        $id1 = mysqli_fetch_array($ambildatapenjualan);
        $jumlah = $id1['totalPendapatan'];
        $tanggal = $id1['tglPenjualan'];
        $idSampah = $id1['idSampah'];
        # saldo_bank
        if (strlen($hitung2) == 1) {
            $kodeformat = "SLD" . "00" . $hitung2;
        } else if (strlen($hitung2) == 2) {
            $kodeformat = "SLD" . "0" . $hitung2;
        } else {
            $kodeformat = "SLD" . $hitung2;
        }
        $ambildatasaldo = $this->db->query("SELECT * FROM saldo_bank WHERE idTransaksi = '$kodeformat'");
        $id2 = mysqli_fetch_array($ambildatasaldo);
        $saldoBank = $id2['totalSaldo'] - $id1['totalPendapatan'];
        $aksi = ("Pengurangan");
        $aktor = ("ADM001");
        # sampah
        $ambildatasampah = $this->db->query("SELECT * FROM sampah WHERE idSampah = '$idSampah'");
        $id3 = mysqli_fetch_array($ambildatasampah);
        # stock_sampah
        $namaSampah = $id3['namaSampah'];
        $ambildatastock = $this->db->query("SELECT * FROM $this->table3 WHERE namaSampah = '$namaSampah'");
        $id3 = mysqli_fetch_array($ambildatastock);
        $stock = $id3['stock'];
        $berat = $id1['berat'];
        $sisaStock = $stock + $berat;
        # database insert and update
        $data = $this->db->query("DELETE FROM $this->table WHERE idJual = '$id'");
        $data2 = $this->db->query("INSERT INTO $this->table2 SET idTransaksi = '$format2', aksi = '$aksi', tanggal = '$tanggal', aktor = '$aktor', jumlah = '$jumlah', totalSaldo = '$saldoBank'");
        $data3 = $this->db->query("UPDATE $this->table3 SET stock = '$sisaStock' WHERE namaSampah = '$namaSampah'");
        if ($data && $data2 && $data3) {
            echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href = '../ui/header.php?page=penjualanAdmin';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = '../ui/header.php?page=penjualanAdmin';
            </script>
        ";
        }
    }
}