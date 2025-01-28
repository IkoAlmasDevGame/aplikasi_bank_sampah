<?php

namespace model;

use mysqli;

# contoh saja pada model ini :
class sampah
{
    protected $table = "sampah";
    protected $table2 = "stock_sampah";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function stock_sampah()
    {
        $SQL = "SELECT * FROM $this->table2 ORDER BY idStock ASC";
        return $this->db->query($SQL);
    }

    public function sampah()
    {
        $SQL = "SELECT * FROM $this->table ORDER BY idSampah ASC";
        return $this->db->query($SQL);
    }

    public function edit_sampah($id)
    {
        $SQL = "SELECT * FROM $this->table WHERE idSampah = '$id'";
        return $this->db->query($SQL);
    }

    public function tambah_sampah($jenisSampah, $namaSampah, $satuan, $harga, $deskripsi)
    {
        $no1 = mysqli_query($this->db, "SELECT * FROM $this->table ORDER BY idSampah DESC");
        $noArr1 = mysqli_fetch_array($no1);
        if ($noArr1 == null) {
            $row1 = 000;
        } else {
            $row1 = $noArr1[0];
        }
        $takeId1 = substr($row1, -3);
        $lastId1 = (int)$takeId1;
        $newId1 = $lastId1 + 1;
        $hitung1 = (string)$newId1;

        if (strlen($hitung1) == 1) {
            $format1 = "SMP" . "00" . $hitung1;
        } else if (strlen($hitung1) == 2) {
            $format1 = "SMP" . "0" . $hitung1;
        } else {
            $format1 = "SMP" . $hitung1;
        }

        $no2 = mysqli_query($this->db, "SELECT * FROM $this->table2 ORDER BY idStock DESC");
        $noArr2 = mysqli_fetch_array($no2);
        if ($noArr2 == null) {
            $row2 = 000;
        } else {
            $row2 = $noArr2[0];
        }
        $takeId2 = substr($row2, -3);
        $lastId2 = (int)$takeId2;
        $newId2 = $lastId2 + 1;
        $hitung2 = (string)$newId2;

        if (strlen($hitung2) == 1) {
            $format2 = "STK" . "00" . $hitung2;
        } else if (strlen($hitung2) == 2) {
            $format2 = "STK" . "0" . $hitung2;
        } else {
            $format2 = "STK" . $hitung2;
        }

        # data Input
        $jenisSampah = htmlspecialchars($_POST['jenisSampah']);
        $namaSampah = htmlspecialchars($_POST['namaSampah']);
        $satuan = htmlspecialchars($_POST['satuan']);
        $harga = htmlspecialchars($_POST['harga']);
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
        $stock = 0;
        # data Foto
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["gambar"]["name"]) ? htmlspecialchars($_FILES["gambar"]["name"]) : $_FILES["gambar"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['gambar']['size'];
        $file_tmp_photo_src = $_FILES['gambar']['tmp_name'];
        # selection Foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto_sampah/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }
        # data nama sampah yang sudah di buat ...
        $result = mysqli_query($this->db, "SELECT namaSampah FROM sampah WHERE namaSampah = '$namaSampah'");
        if (mysqli_fetch_assoc($result)) {
            echo "<script>
            alert('Sampah Sudah Ada!');
            </script>";
            return false;
        }
        if ($harga < 1) {
            return 0;
        } else {
            $SQL = "INSERT INTO $this->table SET idSampah = '$format1', jenisSampah = '$jenisSampah', namaSampah = '$namaSampah', satuan = '$satuan', harga = '$harga',
             gambar = '$photo_src', deskripsi = '$deskripsi'";
            $data = mysqli_query($this->db, $SQL);
            mysqli_query($this->db, "INSERT INTO $this->table2 SET idStock = '$format2', namaSampah = '$namaSampah', stock = '$stock'");
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=sampahAdmin");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=tambahSampah");
                exit(0);
            }
        }
    }

    public function ubah_sampah($jenisSampah, $namaSampah, $satuan, $harga, $deskripsi, $idSampah)
    {
        # data Input
        $idSampah = htmlspecialchars($_POST['idSampah']);
        $jenisSampah = htmlspecialchars($_POST['jenisSampah']);
        $namaSampah = htmlspecialchars($_POST['namaSampah']);
        $namaSampahOld = htmlspecialchars($_POST['namalama']);
        $satuan = htmlspecialchars($_POST['satuan']);
        $harga = htmlspecialchars($_POST['harga']);
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
        # data Foto
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["gambar"]["name"]) ? htmlspecialchars($_FILES["gambar"]["name"]) : $_FILES["gambar"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['gambar']['size'];
        $file_tmp_photo_src = $_FILES['gambar']['tmp_name'];
        # selection Foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto_sampah/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        # Foto Section idUSer atau username pengguna
        if ($namaSampah != $namaSampahOld) {
            $SQL = "SELECT * FROM $this->table WHERE namaSampah = '$namaSampah'";
            $result = $this->db->query($SQL);
            $row = mysqli_fetch_array($result);

            if ($row['namaSampah']) {
                echo "<script>
                alert('Sampah Sudah Ada!');
                </script>";
                return false;
            }

            if ($row['idSampah'] > 0) {
                if (isset($_POST['ganti'])) {
                    if ($row['gambar'] == '') {
                        $update = "UPDATE $this->table SET jenisSampah = '$jenisSampah', namaSampah = '$namaSampah', satuan = '$satuan', 
                        harga = '$harga', gambar = '$photo_src', deskripsi = '$deskripsi' wHERE idSampah = '$idSampah'";
                        $data = mysqli_query($this->db, $update);
                        if ($data != "") {
                            if ($data) {
                                header("location:../ui/header.php?page=sampahAdmin");
                                exit(0);
                            }
                        } else {
                            header("ocation:../ui/header.php?aksi=editSampah&idSampah=$idSampah");
                            exit(0);
                        }
                    } else if ($row['gambar'] != '') {
                        if ($photo_src != '') {
                            $update = "UPDATE $this->table SET jenisSampah = '$jenisSampah', namaSampah = '$namaSampah', satuan = '$satuan', 
                            harga = '$harga', gambar = '$photo_src', deskripsi = '$deskripsi' wHERE idSampah = '$idSampah'";
                            $data = mysqli_query($this->db, $update);
                            unlink("../../../../assets/foto_sampah/$row[gambar]");
                            if ($data != "") {
                                if ($data) {
                                    header("location:../ui/header.php?page=sampahAdmin");
                                    exit(0);
                                }
                            } else {
                                header("location:../ui/header.php?aksi=editSampah&idSampah=$idSampah");
                                exit(0);
                            }
                        }
                    }
                }
            }
        }
    }

    public function hapus_sampah($idSampah)
    {
        $idSampah = htmlspecialchars($_GET['idSampah']);
        $select = $this->db->query("SELECT * FROM $this->table WHERE idSampah = '$idSampah'");
        $array = mysqli_fetch_array($select);
        $foto = $array["foto"];

        if ($array["foto"] == "") {
            $delete = "DELETE FROM $this->table WHERE idSampah = '$idSampah'";
            $data = $this->db->query($delete);
            if ($data != null) {
                if ($data) {
                    header("location:../ui/header.php?page=sampahAdmin");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=sampahAdmin");
                exit(0);
            }
        } else {
            unlink("../../../../assets/foto_sampah/$foto");
            $data = $this->db->query("DELETE FROM $this->table WHERE idSampah = '$idSampah'");
            if ($data != null) {
                if ($data) {
                    header("location:../ui/header.php?page=sampahAdmin");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=sampahAdmin");
                exit(0);
            }
        }
    }

    public function hapus_stocksampah($idStock)
    {
        $idStock = htmlspecialchars($_GET['idStock']);
        $delete = "DELETE FROM $this->table WHERE idStock = '$idStock'";
        $data = $this->db->query($delete);
        if ($data != null) {
            if ($data) {
                header("location:../ui/header.php?page=stocksampahAdmin");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?page=stocksampahAdmin");
            exit(0);
        }
    }
}
