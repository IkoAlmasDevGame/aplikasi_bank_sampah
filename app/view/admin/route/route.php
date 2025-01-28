<?php
# pengambilan database di config
require_once("../../../config/config.php");
$SQL = "SELECT * FROM setting";
$row = $koneksi->query($SQL);
$setting = mysqli_fetch_array($row);

# session
if (isset($_SESSION['status'])) {
    if (isset($_SESSION['IdAdmin'])) {
        if (isset($_SESSION['nama'])) {
            if (isset($_SESSION['username'])) {
                if (isset($_SESSION['password'])) {
                    if (isset($_SESSION['level'])) {
                        if (isset($_COOKIE['cookies'])) {
                            if (isset($_SERVER['HTTPS'])) {
                                if (isset($_SERVER['REDIRECT_STATUS'])) {
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
        window.location.href='../../index.php'
    }, 3000);
    </script>";
    die;
    exit(0);
}

# Files model dan Files controller
# Folder Files
require_once("../../../model/authentication.php");
$login = new model\authentication($koneksi);
require_once("../../../model/pengguna.php");
$users = new model\users($koneksi);
require_once("../../../model/sampah.php");
$sampah = new model\sampah($koneksi);
require_once("../../../model/setoran.php");
$withdraw = new model\setoran($koneksi);
require_once("../../../model/penarikan.php");
$penarikan = new model\penarikan($koneksi);
require_once("../../../model/penjualan.php");
$selling = new model\selling($koneksi);
require_once("../../../model/berita.php");
$news = new model\berita($koneksi);
# Folder Controller
require_once("../../../controller/controller.php");
$usersEdit = new controller\pengguna($koneksi);
$Recycle = new controller\Recylce($koneksi);
$setor = new controller\setor($koneksi);
$narik = new controller\tarik($koneksi);
$penjualan = new controller\penjualan($koneksi);
$koran = new controller\newsletter($koneksi);

# Page / Halaman
if (!isset($_GET['page'])) {
} else {
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'pengguna':
            require_once("../pengguna/pengguna.php");
            break;

        case 'sampahAdmin':
            require_once("../sampah/sampahAdmin.php");
            break;

        case 'stocksampahAdmin':
            require_once("../sampah/stock.php");
            break;

        case 'setoranAdmin':
            require_once("../setoran/setoranAdmin.php");
            break;

        case 'penarikanAdmin':
            require_once("../penarikan/penarikanAdmin.php");
            break;

        case 'penjualanAdmin':
            require_once("../penjualan/penjualanAdmin.php");
            break;

        case 'beritaAdmin':
            require_once("../berita/beritaAdmin.php");
            break;

        case 'monitoringAdmin':
            require_once("../monitoring/monitoringAdmin.php");
            break;

        case 'setting':
            require_once("../setting/edit.php");
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
            # Pengguna
        case 'editpengguna':
            require_once("../pengguna/edit.php");
            break;
        case 'pengguna-edit':
            $usersEdit->ubah_users();
            break;
        case 'pengguna-hapus':
            $usersEdit->hapus_users();
            break;
        case 'edit-password':
            $new_password = htmlspecialchars($_POST['new_password']);
            $old_password = htmlspecialchars($_POST['old_password']);
            $new_password_verify = htmlspecialchars($_POST['new_password_verify']);
            $id = htmlspecialchars($_POST['IdAdmin']);
            # database
            $mysql = $koneksi->query("SELECT * FROM admins WHERE IdAdmin = '$id'");
            $row = mysqli_fetch_array($mysql);
            # cek update password
            if ($old_password != $row['passwordAdmin']) {
                echo "<script>
                alert('maaf password anda tidak sama dengan password lama anda.');
                document.location.href = '../ui/header.php?page=user-profile&IdAdmin=$id&change=$id';
                </script>";
                die;
            }
            # change password yang terbaru ...
            if ($new_password == $new_password_verify) {
                $SQL = "UPDATE admins SET passwordAdmin = '$new_password' WHERE IdAdmin = '$id'";
                $data = $koneksi->query($SQL);
                if ($data) {
                    echo "<script>
                    alert('selamat anda sudah, berhasil mengubah kata sandi anda yang baru.');
                    document.location.href = '../ui/header.php?page=user-profile&IdAdmin=$id';
                    </script>";
                    die;
                }
            } else {
                echo "<script>
                alert('maaf anda gagal, mengubah kata sandi menjadi yang baru.');
                document.location.href = '../ui/header.php?page=user-profile&IdAdmin=$id';
                </script>";
                die;
            }
            break;
        case 'edit-biodata':
            $id = htmlspecialchars($_POST['IdAdmin']);
            $namaAdmin = htmlspecialchars($_POST['namaAdmin']);
            $usernameAdmin = htmlspecialchars($_POST['usernameAdmin']);
            $level = htmlspecialchars($_POST['level']);
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
                    move_uploaded_file($file_tmp_photo_src, "../../../../assets/foto/" . $photo_src);
                } else {
                    echo "Tidak Dapat Ter - Upload Size Gambar";
                    exit(0);
                }
            } else {
                echo "Tidak Dapat Ter-Upload Ke Dalam Database";
                exit(0);
            }
            # Foto Section IdAdmin atau username pengguna
            $SQL = "SELECT * FROM admins WHERE IdAdmin = '$id'";
            $result = $koneksi->query($SQL);
            $row = mysqli_fetch_array($result);
            # section if
            if ($row['IdAdmin'] > 0) {
                if ($ganti) {
                    if ($row['gambar'] == '') {
                        $update = "UPDATE admins SET namaAdmin = '$namaAdmin', usernameAdmin = '$usernameAdmin', level = '$level', gambar = '$photo_src' WHERE IdAdmin = '$id'";
                        $data = $koneksi->query($update);
                        if ($data) {
                            echo "<script>
                            alert('selamat anda sudah, berhasil mengubah data anda menjadi yang baru.');
                            document.location.href = '../ui/header.php?page=user-profile&IdAdmin=$id';
                            </script>";
                            die;
                        } else {
                            echo "<script>
                            alert('maaf anda sudah gagal mengubah data anda menjadi yang baru.');
                            document.location.href = '../ui/header.php?page=user-profile&IdAdmin=$id&data=$id';
                            </script>";
                            die;
                        }
                    } else if ($row['gambar'] != "") {
                        if ($photo_src != "") {
                            $update = "UPDATE admins SET namaAdmin = '$namaAdmin', usernameAdmin = '$usernameAdmin', level = '$level', gambar = '$photo_src' WHERE IdAdmin = '$id'";
                            $data = $koneksi->query($update);
                            unlink("../../../../assets/foto/$row[gambar]");
                            if ($data) {
                                echo "<script>
                                alert('selamat anda sudah, berhasil mengubah data anda menjadi yang baru.');
                                document.location.href = '../ui/header.php?page=user-profile&IdAdmin=$id';
                                </script>";
                                die;
                            } else {
                                echo "<script>
                                alert('maaf anda sudah gagal mengubah data anda menjadi yang baru.');
                                document.location.href = '../ui/header.php?page=user-profile&IdAdmin=$id&data=$id';
                                </script>";
                                die;
                            }
                        }
                    }
                }
            }
            break;
            # Pengguna

            # SampahAdmin
        case 'tambahSampah':
            require_once("../sampah/tambah.php");
            break;
        case 'editSampah':
            require_once("../sampah/edit.php");
            break;
        case 'Sampah-tambah':
            $Recycle->sampah_tambah();
            break;
        case 'Sampah-edit':
            $Recycle->sampah_ubah();
            break;
        case 'Sampah-hapus':
            $Recycle->sampah_hapus();
            break;
        case 'StockSampah-hapus':
            $Recycle->stocksampah_hapus();
            break;
            # SampahAdmin

            #SetoranAdmin
        case 'tambahSetoran':
            require_once("../setoran/tambah.php");
            break;
        case 'editSetoran':
            require_once("../setoran/edit.php");
            break;
        case 'setoran-tambah':
            $setor->tambah_setoran();
            break;
        case 'setoran-edit':
            $setor->ubah_setoran();
            break;
        case 'setoran-hapus':
            $setor->hapus_setoran();
            break;
            #SetoranAdmin

            #penarikanAdmin
        case 'tambahPenarikan':
            require_once("../penarikan/tambah.php");
            break;
        case 'editPenarikan':
            require_once("../penarikan/edit.php");
            break;
        case 'tambah-penarikan':
            $narik->data_penarikan();
            break;
        case 'edit-penarikan':
            $narik->data_ubah_penarikan();
            break;
        case 'hapus-penarikan':
            $narik->data_hapus_penarikan();
            break;
            #penarikanAdmin

            #penjualanAdmin
        case 'tambahPenjualan':
            require_once("../penjualan/tambah.php");
            break;
        case 'tambah-penjualan':
            $penjualan->data_penjualan();
            break;
        case 'hapus-penjualan':
            $penjualan->hapus_penjualan();
            break;
            #penjualanAdmin

            #beritaAdmin
        case 'tambahBerita':
            require_once("../berita/tambah.php");
            break;
        case 'editBerita':
            require_once("../berita/edit.php");
            break;
        case 'tambah-berita':
            $koran->data_berita();
            break;
        case 'edit-berita':
            $koran->ubah_berita();
            break;
        case 'hapus-berita':
            $koran->hapus();
            break;
            #beritaAdmin

        case 'profile-website':
            $idSetting = htmlspecialchars($_POST['idSetting']);
            $developer = htmlspecialchars($_POST['developer']);
            $nama = htmlspecialchars($_POST['nama']);
            $status = htmlspecialchars($_POST['status']);
            $data = $koneksi->query("UPDATE setting SET nama = '$nama', developer = '$developer', status = '$status' WHERE idSetting = '$idSetting'");
            if ($data) {
                echo "<script>
                alert('berhasil mengubah data website');
                document.location.href = '../ui/header.php?page=setting&idSetting=$idSetting';
                </script>";
                die;
            } else {
                echo "<script>
                alert('gagal mengubah data website');
                document.location.href = '../ui/header.php?page=setting&idSetting=$idSetting';
                </script>";
                die;
            }
            break;

        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
