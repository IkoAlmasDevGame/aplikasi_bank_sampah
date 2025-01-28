<?php

namespace model;

class authentication
{
    protected $table = "users";
    protected $table2 = "admins";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function LoginAuth($username, $password)
    {
        if (empty($_POST['username']) || empty($_POST['password'])):
            header("location:error/error-msg.php?HttpStatus=401");
            exit(0);
        else:
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $akses = htmlspecialchars($_POST['akses']);
            password_verify($password, PASSWORD_DEFAULT);
            $admin = $this->db->query("SELECT * FROM $this->table2 WHERE usernameAdmin = '$username' and passwordAdmin = '$password'");
            $nasabah = $this->db->query("SELECT * FROM $this->table WHERE username = '$username' and passwordUser = '$password'");
            # cek users dan cek nasabah
            $cek_admin = mysqli_num_rows($admin);
            $cek_nasabah = mysqli_num_rows($nasabah);
            $hasil = $_POST['angka1'] + $_POST['angka2'];
            if ($akses == 'admin'):
                if ($cek_admin > 0) {
                    $response = array($username, $password);
                    $response[$this->table2] = array($username, $password);
                    if ($row = $admin->fetch_assoc()) {
                        if ($row['level'] == 'admin') {
                            $_SESSION['IdAdmin'] = $row['IdAdmin'];
                            $_SESSION['nama'] = $row['namaAdmin'];
                            $_SESSION['username'] = $row['usernameAdmin'];
                            $_SESSION['password'] = $row['passwordAdmin'];
                            $_SESSION['level'] = 'admin';
                            if ($hasil == $_POST['hasil']):
                                $_SESSION['status'] = true;
                                header("location:admin/error/error-msg.php?HttpStatus=200");
                                exit(0);
                            else:
                                $_SESSION['status'] = false;
                                unset($_POST['hasil']);
                                echo "<script>alert('Maaf username dan password tidak valid!');</script>";
                                echo "<script>document.location = 'login.php';</script>";
                                exit(0);
                            endif;
                        }
                        $_COOKIE['cookies'] = $username;
                        $_SERVER['HTTPS'] = "on";
                        $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                        if ($HttpStatus == 400) {
                            header("location:error/error-msg.php?HttpStatus=400");
                            exit(0);
                        }
                        if ($HttpStatus == 403) {
                            header("location:error/error-msg.php?HttpStatus=403");
                            exit(0);
                        }
                        if ($HttpStatus == 500) {
                            header("location:error/error-msg.php?HttpStatus=500");
                            exit(0);
                        }
                        setcookie($response[$this->table2], $row, time() + (86400 * 30), "/");
                        array_push($response[$this->table2], $row);
                        die;
                        exit(0);
                    } else {
                        unset($_POST['hasil']);
                        $_SESSION['status'] = false;
                        $_SERVER['HTTPS'] = "off";
                        echo "<script>alert('Maaf username dan password tidak valid!');</script>";
                        echo "<script>document.location = 'login.php';</script>";
                        exit(0);
                    }
                }
            endif;

            if ($akses == 'pengguna') {
                if ($cek_nasabah > 0) {
                    $response = array($username, $password);
                    $response[$this->table] = array($username, $password);
                    if ($row_n = $nasabah->fetch_assoc()) {
                        $_SESSION['idUser'] = $row_n['idUser'];
                        $_SESSION['namaUser'] = $row_n['namaUser'];
                        $_SESSION['nik'] = $row_n['nik'];
                        $_SESSION['alamat'] = $row_n['alamat'];
                        $_SESSION['telepon'] = $row_n['telepon'];
                        $_SESSION['username'] = $row_n['username'];
                        $_SESSION['passwordUser'] = $password;
                        $_SESSION['jmlSetoran'] = $row_n['jmlSetoran'];
                        $_SESSION['saldo'] = $row_n['saldo'];
                        $_SESSION['users_akses'] = $akses;
                        if ($hasil == $_POST['hasil']):
                            $_SESSION['status'] = true;
                            header("location:pengguna/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        else:
                            $_SESSION['status'] = false;
                            unset($_POST['hasil']);
                            echo "<script>alert('Maaf username dan password tidak valid!');</script>";
                            echo "<script>document.location = 'login.php';</script>";
                            exit(0);
                        endif;
                    }
                    $_COOKIE['cookies'] = $username;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$this->table], $row_n, time() + (86400 * 30), "/");
                    array_push($response[$this->table], $row_n);
                    die;
                    exit(0);
                } else {
                    unset($_POST['hasil']);
                    $_SESSION['status'] = false;
                    $_SERVER['HTTPS'] = "off";
                    echo "<script>alert('Maaf username dan password tidak valid!');</script>";
                    echo "<script>document.location = 'login.php';</script>";
                    exit(0);
                }
            }
        endif;
    }
}
