<?php
# pengambilan database di config
require_once("../../../config/config.php");
$SQL = "SELECT * FROM setting"; # bisa di isi untuk pengambilan nama website atau settingan webiste
$row = $koneksi->query($SQL);
$setting = mysqli_fetch_array($row);
# session
if (isset($_SESSION['status'])) {
    if (isset($_SESSION['idUser'])) {
        if (isset($_SESSION['namaUser'])) {
            if (isset($_SESSION['nik'])) {
                if (isset($_SESSION['alamat'])) {
                    if (isset($_SESSION['telepon'])) {
                        if (isset($_SESSION['username'])) {
                            if (isset($_SESSION['passwordUser'])) {
                                if (isset($_SESSION['jmlSetoran'])) {
                                    if (isset($_SESSION['saldo'])) {
                                        if (isset($_SESSION['users_akses'])) {
                                            if (isset($_SESSION['cookies'])) {
                                                if (isset($_SESSION['HTTPS'])) {
                                                    if (isset($_SESSION['REDIRECT_STATUS'])) {
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('Maaf anda gagal masuk ke halaman utama ...'),
        window.location.href='../index.php'
    }, 3000);
    </script>";
    die;
    exit(0);
}


# Files model dan Files controller
# Folder Files
require_once("../../../model/model.php"); # model contoh
# Folder Controller
require_once("../../../controller/controller.php"); # controller contoh

# Page / Halaman
if (!isset($_GET['page'])) {
} else {
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'hasilUser':
            require_once("../sampah/hasilUser.php");
            break;

        case 'setoranUser':
            require_once("../setoran/setoranUser.php");
            break;

        case 'pengumpulanUser':
            require_once("../grafik/pengumpulanUser.php");
            break;

        case 'user-profile':
            require_once("../profile/edit.php");
            break;

        case 'logout':
            if (isset($_SESSION['status'])) {
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../../login.php");
            exit(0);
            break;

        default:
            require_once("../dashboard/index.php");
            break;
    }
}

# Aksi / Action
if (!isset($_GET['aksi'])) {
} else {
    switch ($_GET['aksi']) {
        case 'edit-biodata':
            $id = htmlspecialchars($_POST['idUser']);
            $namaUser = htmlspecialchars($_POST['namaUser']);
            $username = htmlspecialchars($_POST['username']);
            $nik = htmlspecialchars($_POST['nik']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $telepon = htmlspecialchars($_POST['telepon']);
            $jmlSetoran = htmlspecialchars($_POST['jmlSetoran']);
            $jmlPenarikan = htmlspecialchars($_POST['jmlPenarikan']);
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
            # Foto Section idUser atau username pengguna
            $SQL = "SELECT * FROM users WHERE idUser = '$id'";
            $result = $koneksi->query($SQL);
            $row = mysqli_fetch_array($result);
            # section if
            if ($row['idUSer'] > 0) {
                if (isset($_POST['ganti'])) {
                    if ($row['gambar'] == '') {
                        $update = "UPDATE users SET namaUser = '$namaUser', gambar = '$photo_src', nik = '$nik', alamat = '$alamat', telepon = '$telepon', 
                        username = '$username', jmlSetoran = '$jmlSetoran', jmlPenarikan = '$jmlPenarikan', saldo = '$saldo' WHERE idUser = '$id'";
                        $data = $koneksi->query($update);
                        if ($data) {
                            echo "<script>
                            alert('selamat anda sudah, berhasil mengubah kata sandi anda yang baru.');
                            document.location.href = '../ui/header.php?page=user-profile&idUser=$id';
                            </script>";
                            die;
                        } else {
                            echo "<script>
                            alert('maaf anda sudah gagal mengubah data anda yang lama menjadi baru.');
                            document.location.href = '../ui/header.php?page=user-profile&idUser=$id&data=$id';
                            </script>";
                            die;
                        }
                    } else if ($row['gambar'] != '') {
                        if ($photo_src != '') {
                            $update = "UPDATE users SET namaUser = '$namaUser', gambar = '$photo_src', nik = '$nik', alamat = '$alamat', telepon = '$telepon', 
                            username = '$username', jmlSetoran = '$jmlSetoran', jmlPenarikan = '$jmlPenarikan', saldo = '$saldo' WHERE idUser = '$id'";
                            $data = $koneksi->query($update);
                            unlink("../../../../assets/foto/$row[gambar]");
                            if ($data) {
                                echo "<script>
                                alert('selamat anda sudah, berhasil mengubah data anda yang baru.');
                                document.location.href = '../ui/header.php?page=user-profile&idUser=$id';
                                </script>";
                                die;
                            } else {
                                echo "<script>
                                alert('maaf anda sudah gagal mengubah data anda yang lama menjadi baru.');
                                document.location.href = '../ui/header.php?page=user-profile&idUser=$id&data=$id';
                                </script>";
                                die;
                            }
                        }
                    }
                }
            }
            break;

        case 'edit-password':
            $new_password = htmlspecialchars($_POST['new_password']);
            $old_password = htmlspecialchars($_POST['old_password']);
            $new_password_verify = htmlspecialchars($_POST['new_password_verify']);
            $id = htmlspecialchars($_POST['idUser']);
            # database
            $mysql = $koneksi->query("SELECT * FROM users WHERE idUser = '$id'");
            $row = mysqli_fetch_array($mysql);
            # cek update password
            if ($old_password != $row['passwordUser']) {
                echo "<script>
                alert('maaf password anda tidak sama dengan password lama anda.');
                document.location.href = '../ui/header.php?page=user-profile&idUser=$id&change=$id';
                </script>";
                die;
            }
            # change password yang terbaru ...
            if ($new_password == $new_password_verify) {
                $SQL = "UPDATE users SET passwordUser = '$new_password' WHERE idUser = '$id'";
                $data = $koneksi->query($SQL);
                if ($data) {
                    echo "<script>
                    alert('selamat anda sudah, berhasil mengubah kata sandi anda yang baru.');
                    document.location.href = '../ui/header.php?page=user-profile&idUser=$id';
                    </script>";
                    die;
                }
            } else {
                echo "<script>
                alert('maaf anda gagal, mengubah kata sandi menjadi yang baru.');
                document.location.href = '../ui/header.php?page=user-profile&idUser=$id';
                </script>";
                die;
            }
            break;

        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
