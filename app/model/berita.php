<?php

namespace model;

class berita
{
    protected $table = "berita";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function berita()
    {
        $SQL = "SELECT * FROM berita ORDER BY idBerita ASC";
        return $this->db->query($SQL);
    }

    public function buatKode($inisial)
    {
        $mysql = $this->db->query("SELECT * FROM $this->table order by idBerita desc LIMIT 1");
        $row = mysqli_fetch_array($mysql);

        $urut = isset($row['idBerita']) ? substr($row['idBerita'], 3) : 0;
        $tambah = (int)$urut + 1;

        if (strlen($tambah) == 1) {
            return $inisial . '00' . $tambah;
        } elseif (strlen($tambah) == 2) {
            return $inisial . '0' . $tambah;
        } else {
            return $inisial . $tambah;
        }
    }

    public function beritaEdit($id)
    {
        $SQL = "SELECT * FROM berita WHERE idBerita = '$id'";
        return $this->db->query($SQL);
    }

    public function ubahBerita($idBerita, $judul, $isi, $sumber)
    {
        $idBerita = htmlspecialchars($_POST['idBerita']);
        $judul = htmlspecialchars($_POST['judul']);
        $isi = htmlspecialchars($_POST['isi']);
        $sumber = htmlspecialchars($_POST['sumber']);
        $ganti = isset($_POST['ganti']);

        # Foto 
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["gambar"]["name"]) ? htmlspecialchars($_FILES["gambar"]["name"]) : $_FILES["gambar"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['gambar']['size'];
        $file_tmp_photo_src = $_FILES['gambar']['tmp_name'];

        # selection Foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/berita/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        # Foto Section idUSer atau username pengguna
        $SQL = "SELECT * FROM $this->table WHERE idBerita = '$idBerita'";
        $result = $this->db->query($SQL);
        $row = mysqli_fetch_array($result);

        if ($idBerita > 0) {
            if ($ganti) {
                if ($row['gambar'] == "") {
                    $update = "UPDATE $this->table SET judul = '$judul', isi = '$isi', gambar = '$photo_src', sumber = '$sumber' WHERE idBerita = '$idBerita'";
                    $data = $this->db->query($update);
                    if ($data) {
                        echo "<script>
                        alert('Berita Baru Berhasil Diubah');
                        document.location.href = '../ui/header.php?page=beritaAdmin';
                        </script>";
                        die;
                    } else {
                        echo "<script>
                        alert('Berita Gagal Diubah!');
                        document.location.href = '../ui/header.php?aksi=editBerita&id=$idBerita';
                        </script>";
                        die;
                    }
                } else if ($row['gambar'] != '') {
                    if ($photo_src != '') {
                        $update = "UPDATE $this->table SET judul = '$judul', isi = '$isi', gambar = '$photo_src', sumber = '$sumber' WHERE idBerita = '$idBerita'";
                        $data = $this->db->query($update);
                        unlink("../../../../assets/berita/$row[gambar]");
                        if ($data) {
                            echo "<script>
                            alert('Berita Baru Berhasil Diubah');
                            document.location.href = '../ui/header.php?page=beritaAdmin';
                            </script>";
                            die;
                        } else {
                            echo "<script>
                            alert('Berita Gagal Diubah!');
                            document.location.href = '../ui/header.php?aksi=editBerita&id=$idBerita';
                            </script>";
                            die;
                        }
                    }
                }
            }
        }
    }

    public function hapus_berita($id)
    {
        $id = htmlspecialchars($_GET['id']);
        $select = $this->db->query("SELECT * FROM $this->table WHERE idBerita = '$id'");
        $array = mysqli_fetch_array($select);
        $foto = $array["gambar"];

        if ($array["gambar"] == "") {
            $delete = "DELETE FROM $this->table WHERE idBerita = '$id'";
            $data = $this->db->query($delete);
            if ($data != null) {
                if ($data) {
                    header("location:../ui/header.php?page=beritaAdmin");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=beritaAdmin");
                exit(0);
            }
        } else {
            unlink("../../../../assets/berita/$foto");
            $data = $this->db->query("DELETE FROM $this->table WHERE idBerita = '$id'");
            if ($data != null) {
                if ($data) {
                    header("location:../ui/header.php?page=beritaAdmin");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=beritaAdmin");
                exit(0);
            }
        }
    }

    public function tambahBerita($idBerita, $judul, $isi, $sumber)
    {
        $idBerita = htmlspecialchars($_POST['idBerita']);
        $judul = htmlspecialchars($_POST['judul']);
        $isi = htmlspecialchars($_POST['isi']);
        $sumber = htmlspecialchars($_POST['sumber']);

        # Foto 
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["gambar"]["name"]) ? htmlspecialchars($_FILES["gambar"]["name"]) : $_FILES["gambar"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['gambar']['size'];
        $file_tmp_photo_src = $_FILES['gambar']['tmp_name'];

        # selection Foto
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/berita/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        # section Foto idBerita
        $SQL = "SELECT * FROM $this->table WHERE judul = '$judul'";
        $result = $this->db->query($SQL);
        $row = mysqli_fetch_array($result);

        if ($row) {
            unlink("../../../../assets/berita/$photo_src");
            echo "<script>
            alert('Penambahan Berita Gagal, dikarenakan judul sama !');
            document.location.href = '../ui/header.php?aksi=tambahBerita';
            </script>";
            die;
        } else {
            $data = $this->db->query("INSERT INTO $this->table SET idBerita = '$idBerita', judul = '$judul', isi = '$isi', gambar = '$photo_src', sumber = '$sumber'");
            if ($data) {
                echo "<script>
                alert('Berita Baru Berhasil Ditambahkan');
                document.location.href = '../ui/header.php?page=beritaAdmin';
                </script>";
                die;
            } else {
                echo "<script>
                alert('Penambahan Berita Gagal!');
                document.location.href = '../ui/header.php?aksi=tambahBerita';
                </script>";
                die;
            }
        }
    }
}
