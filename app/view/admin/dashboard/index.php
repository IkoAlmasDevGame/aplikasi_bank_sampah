    <div id="content">
        <?php require_once("../ui/header.php") ?>
        <?php require_once("../ui/sidebar.php") ?>
        <!-- Layout Pada Dashboard -->
        <?php
        require_once("../../../config/config.php");
        function query($query)
        {
            global $koneksi;
            $result = mysqli_query($koneksi, $query);
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }

        $no = mysqli_query($koneksi, "SELECT * FROM saldo_bank");
        $jumlahData = mysqli_num_rows($no);
        $hitung = $jumlahData - 1;

        if ($hitung < 0) {
            $saldoAkhir = 0;
        } else {
            $saldo = query("SELECT * FROM saldo_bank")[$hitung];
            $saldoAkhir = ($saldo['totalSaldo']);
        }

        $stock = mysqli_query($koneksi, "SELECT stock FROM stock_sampah");
        $users = mysqli_query($koneksi, "SELECT * FROM users");
        $jumlahDataUsers = mysqli_num_rows($users);
        $total = 0;
        foreach ($stock as $row) {
            $row['stock'];
            $total += $row['stock'];
        };
        ?>
        <section class="content">
            <div class="content-wrapper">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="display-3 fs-3 mb-0 text-gray">Dashboard</h1>
                </div>
                <marquee behavior="scroll" scrollamount="15" direction="left">
                    <h2 class="fs-2 display-2 fw-normal fst-normal">Selamat Datang di Aplikasi Bank Sampah</h2>
                </marquee>
                <br>
                <section class="mt-4 text-center">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <div class="card bg-warning p-3">
                                <i class="fa fa-fw fa-eye fa-3x shadow shadow-sm text-light"></i>
                                <h3><?php echo "Rp. " . number_format(($saldoAkhir), 2, ",", ".") ?></h3>
                                <p class="fs-4 display-4 fw-normal fst-normal">Jumlah Saldo Bank</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <div class="card bg-danger p-3">
                                <i class="fas fa-cubes fa-fw fa-3x shadow shadow-sm text-light"></i>
                                <h3><?php echo $total . " KG" ?></h3>
                                <p class="fs-4 display-4 fw-normal fst-normal">Jumlah Stock Sampah</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card bg-success p-3">
                                <i class="fa fa-user-alt fa-3x fa-fw shadow shadow-sm text-light"></i>
                                <h3><?php echo $jumlahDataUsers; ?></h3>
                                <p class="fs-4 display-4 fw-normal fst-normal">Jumlah User Yang Aktif</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
    <!-- Layout Pada Dashboard -->
    <?php require_once("../ui/footer.php") ?>
    </div>