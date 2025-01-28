<?php

namespace controller;

use model\users;
use model\authentication;
use model\sampah;
use model\setoran;
use model\penarikan;
use model\selling;
use model\berita;

class newsletter
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new berita($konfig);
    }

    public function hapus()
    {
        $id = htmlspecialchars($_GET['id']);
        $data = $this->konfig->hapus_berita($id);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function data_berita()
    {
        $idBerita = htmlspecialchars($_POST['idBerita']);
        $judul = htmlspecialchars($_POST['judul']);
        $isi = htmlspecialchars($_POST['isi']);
        $sumber = htmlspecialchars($_POST['sumber']);
        $data = $this->konfig->tambahBerita($idBerita, $judul, $isi, $sumber);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function ubah_berita()
    {
        $idBerita = htmlspecialchars($_POST['idBerita']);
        $judul = htmlspecialchars($_POST['judul']);
        $isi = htmlspecialchars($_POST['isi']);
        $sumber = htmlspecialchars($_POST['sumber']);
        $data = $this->konfig->tambahBerita($idBerita, $judul, $isi, $sumber);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }
}

class penjualan
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new selling($konfig);
    }

    public function data_penjualan()
    {
        $idSampah = htmlspecialchars($_POST['idSampah']);
        $berat = htmlspecialchars($_POST['berat']);
        $tglPenjualan = htmlspecialchars($_POST['tglPenjualan']);
        $namaPembeli = htmlspecialchars($_POST['namaPembeli']);
        $nomorPembeli = htmlspecialchars($_POST['nomorPembeli']);
        $harga = htmlspecialchars($_POST['harga']);
        $data = $this->konfig->tambah_penjualan($idSampah, $berat, $tglPenjualan, $namaPembeli, $nomorPembeli, $harga);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function hapus_penjualan()
    {
        $id = htmlspecialchars($_GET['id']);
        $data = $this->konfig->delete_penjualan($id);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }
}

class tarik
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new penarikan($konfig);
    }

    public function data_penarikan()
    {
        $idUser = htmlspecialchars($_POST['idUser']);
        $namaUser = htmlspecialchars($_POST['namaUser']);
        $tglTarik = htmlspecialchars($_POST['tglTarik']);
        $saldo = htmlspecialchars($_POST['saldo']);
        $jmlPenarikan = htmlspecialchars($_POST['jmlPenarikan']);
        $base = $this->konfig->penarikan_full($idUser, $namaUser, $tglTarik, $saldo, $jmlPenarikan);
        if ($base === true):
            return true;
        else:
            return false;
        endif;
    }

    public function data_ubah_penarikan()
    {
        $idUser = htmlspecialchars($_POST['idUser']);
        $namaUser = htmlspecialchars($_POST['namaUser']);
        $tglTarik = htmlspecialchars($_POST['tglTarik']);
        $idTarik = htmlspecialchars($_POST['idTarik']);
        $jmlPenarikan = htmlspecialchars($_POST['jmlPenarikan']);
        $base = $this->konfig->ubah_penarikan_full($idTarik, $idUser, $namaUser, $tglTarik, $jmlPenarikan);
        if ($base === true):
            return true;
        else:
            return false;
        endif;
    }

    public function data_hapus_penarikan()
    {
        $id = htmlspecialchars($_GET['id']);
        $base = $this->konfig->hapus_penarikan_full($id);
        if ($base === true):
            return true;
        else:
            return false;
        endif;
    }
}

class pengguna
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new users($konfig);
    }

    public function tambah_users()
    {
        $nama = htmlspecialchars($_POST['nama']);
        $nik = htmlspecialchars($_POST['nik']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $data = $this->konfig->tambah($nama, $nik, $alamat, $telepon, $username, $password);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function ubah_users()
    {
        $idUser = htmlspecialchars($_POST['idUser']);
        $nama = htmlspecialchars($_POST['nama']);
        $nik = htmlspecialchars($_POST['nik']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $jmlSetoran = htmlspecialchars($_POST['jmlSetoran']);
        $saldo = htmlspecialchars($_POST['saldo']);
        $data = $this->konfig->ubah($nama, $nik, $alamat, $telepon, $jmlSetoran, $saldo, $idUser);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function hapus_users()
    {
        $idUser = htmlspecialchars($_GET['idUser']);
        $data = $this->konfig->hapus($idUser);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }
}

class Recylce
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new sampah($konfig);
    }

    public function sampah_tambah()
    {
        $jenisSampah = htmlspecialchars($_POST['jenisSampah']);
        $namaSampah = htmlspecialchars($_POST['namaSampah']);
        $satuan = htmlspecialchars($_POST['satuan']);
        $harga = htmlspecialchars($_POST['harga']);
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
        $data = $this->konfig->tambah_sampah($jenisSampah, $namaSampah, $satuan, $harga, $deskripsi);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function sampah_ubah()
    {
        $idSampah = htmlspecialchars($_POST['idSampah']);
        $jenisSampah = htmlspecialchars($_POST['jenisSampah']);
        $namaSampah = htmlspecialchars($_POST['namaSampah']);
        $satuan = htmlspecialchars($_POST['satuan']);
        $harga = htmlspecialchars($_POST['harga']);
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
        $data = $this->konfig->ubah_sampah($jenisSampah, $namaSampah, $satuan, $harga, $deskripsi, $idSampah);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function sampah_hapus()
    {
        $idSampah = htmlspecialchars($_GET['idSampah']);
        $data = $this->konfig->hapus_sampah($idSampah);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function stocksampah_hapus()
    {
        $idStock = htmlspecialchars($_GET['idStock']);
        $data = $this->konfig->hapus_sampah($idStock);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }
}

class AuthLogin
{

    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new authentication($konfig);
    }

    public function LoginAuthen()
    {
        session_start();
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $data = $this->konfig->LoginAuth($username, $password);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }
}

class setor
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new setoran($konfig);
    }

    public function tambah_setoran()
    {
        $penyetoran = htmlspecialchars($_POST['penyetor']);
        $sampah = htmlspecialchars($_POST['sampah']);
        $tanggal = htmlspecialchars($_POST['tanggal']);
        $berat = htmlspecialchars($_POST['berat']);
        $data = $this->konfig->setoran_tambah($penyetoran, $sampah, $tanggal, $berat);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function ubah_setoran()
    {
        $idSetor = htmlspecialchars($_POST['idSetoran']);
        $data = $this->konfig->setoran_ubah($idSetor);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }

    public function hapus_setoran()
    {
        $id = htmlspecialchars($_GET['id']);
        $data = $this->konfig->setoran_hapus($id);
        if ($data === true):
            return true;
        else:
            return false;
        endif;
    }
}