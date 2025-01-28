<?php

namespace model;

class users
{
    protected $table = "users";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function pengguna()
    {
        $SQL = "SELECT * FROM users ORDER BY idUser ASC";
        return $this->db->query($SQL);
    }

    public function pengguna_edit($id)
    {
        $SQL = "SELECT * FROM users WHERE idUser = '$id'";
        return $this->db->query($SQL);
    }

    public function pengguna_admin($id)
    {
        $SQL = "SELECT * FROM admins WHERE IdAdmin = '$id'";
        return $this->db->query($SQL);
    }

    public function hapus($idUser)
    {
        $idUser = htmlspecialchars($_GET['idUser']);
        $select = $this->db->query("SELECT * FROM $this->table WHERE idUser = '$idUser'");
        $array = mysqli_fetch_array($select);
        $foto = $array["gambar"];

        if ($array["gambar"] == "") {
            $delete = "DELETE FROM $this->table WHERE idUser = '$idUser'";
            $data = $this->db->query($delete);
            if ($data != null) {
                if ($data) {
                    header("location:../ui/header.php?page=pengguna");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=pengguna");
                exit(0);
            }
        } else {
            unlink("../../../../assets/foto/$foto");
            $data = $this->db->query("DELETE FROM $this->table WHERE idUser = '$idUser'");
            if ($data != null) {
                if ($data) {
                    header("location:../ui/header.php?page=pengguna");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=pengguna");
                exit(0);
            }
        }
    }

    public function ubah($nama, $nik, $alamat, $telepon, $jmlSetoran, $saldo, $idUser)
    {
        $idUser = htmlspecialchars($_POST['idUser']);
        $nama = htmlspecialchars($_POST['nama']);
        $nik = htmlspecialchars($_POST['nik']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $jmlSetoran = htmlspecialchars($_POST['jmlSetoran']);
        $saldo = htmlspecialchars($_POST['saldo']);

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
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit(0);
            }
        } else {
            echo "Tidak Dapat Ter-Upload Ke Dalam Database";
            exit(0);
        }

        # Foto Section idUSer atau username pengguna
        $SQL = "SELECT * FROM $this->table WHERE idUser = '$idUser'";
        $result = $this->db->query($SQL);
        $row = mysqli_fetch_array($result);

        # section row
        if ($row['idUser'] > 0) {
            if (isset($_POST['ganti'])) {
                if ($row['gambar'] == '') {
                    $update = "UPDATE $this->table SET namaUser = '$nama', gambar = '$photo_src', nik = '$nik', alamat = '$alamat', telepon = '$telepon',
                    jmlSetoran = '$jmlSetoran', saldo = '$saldo' WHERE idUser = '$idUser'";
                    $data = $this->db->query($update);
                    if ($data != "") {
                        if ($data) {
                            header("location:../ui/header.php?page=pengguna");
                            exit(0);
                        }
                    } else {
                        header("location:../ui/header.php?aksi=editpengguna&idUser=$idUser");
                        exit(0);
                    }
                } elseif ($row['gambar'] != '') {
                    if ($photo_src != '') {
                        $update = "UPDATE $this->table SET namaUser = '$nama', gambar = '$photo_src', nik = '$nik', alamat = '$alamat', telepon = '$telepon',
                         jmlSetoran = '$jmlSetoran', saldo = '$saldo' WHERE idUser = '$idUser'";
                        $data = $this->db->query($update);
                        unlink("../../../../assets/foto/$row[gambar]");
                        if ($data != "") {
                            if ($data) {
                                header("location:../ui/header.php?page=pengguna");
                                exit(0);
                            }
                        } else {
                            header("location:../ui/header.php?aksi=editpengguna&idUser=$idUser");
                            exit(0);
                        }
                    }
                }
            }
        }
    }

    public function tambah($nama, $nik, $alamat, $telepon, $username, $password)
    {
        if (empty($_POST['nama']) || empty($_POST['nik']) || empty($_POST['alamat']) || empty($_POST['telepon']) || empty($_POST['username']) || empty($_POST['password'])):
            header("location:register.php");
            exit(0);
        else:
            # USER DATA
            $no = mysqli_query($this->db, "SELECT * FROM users ORDER BY idUser DESC");
            $noArr = mysqli_fetch_array($no);
            $row = $noArr[0];
            $takeId = substr($row, -3);
            $lastId = (int)$takeId;
            $newId = $lastId + 1;
            $hitung = (string)$newId;

            if (strlen($hitung) == 1) {
                $format = "USR" . "00" . $hitung;
            } else if (strlen($hitung) == 2) {
                $format = "USR" . "0" . $hitung;
            } else {
                $format = "USR" . $hitung;
            }

            $nama = htmlspecialchars($_POST['nama']);
            $nik = htmlspecialchars($_POST['nik']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $telepon = htmlspecialchars($_POST['telepon']);
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $password2 = htmlspecialchars($_POST['password2']);
            $jmlSetoran = 0;
            $jmlPenarikan = 0;
            $saldo = 0;
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
                    move_uploaded_file($file_tmp_photo_src, "../../assets/foto/" . $photo_src);
                } else {
                    echo "Tidak Dapat Ter - Upload Size Gambar";
                    exit(0);
                }
            } else {
                echo "Tidak Dapat Ter-Upload Ke Dalam Database";
                exit(0);
            }

            # cek username sudah ada atau belum
            $result = $this->db->query("SELECT username FROM users WHERE username = '$username'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                    alert('Akun anda sudah terdaftar!');
                    </script>";
                return false;
            }

            # untuk mengatasi username kosong
            if (empty(trim($username))) {
                echo "<script>
                    alert('Dimohon untuk mengisi username');
                    </script>";
                return false;
            }

            # cek konfirmasi password
            if ($password !== $password2) {
                echo "<script>
				    alert ('Konfirmasi password tidak sesuai!');
			        </script>";
                return false;
            }

            $SQL = "INSERT INTO users SET idUser = '$format', namaUser = '$nama', gambar = '$photo_src', nik = '$nik', alamat = '$alamat', telepon = '$telepon',
             username = '$username', passwordUser = '$password', jmlSetoran = '$jmlSetoran', jmlPenarikan = '$jmlPenarikan', saldo = '$saldo'";
            $data = $this->db->query($SQL);
            if ($data != "") {
                if ($data) {
                    echo "<script>alert('User baru berhasil ditambahkan!');</script>";
                    echo "<script>document.location.href = 'login.php';</script>";
                    return true;
                }
            } else {
                echo "<script>alert('User baru tidak berhasil ditambahkan!');</script>";
                echo "<script>document.location.href = 'register.php';</script>";
                return false;
            }
        endif;
    }
}