<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Grafik Monitoring</title>
        <?php if ($_SESSION['level'] == 'admin'): ?>
        <?php require_once("../ui/header.php") ?>
        <?php require_once("../../../config/config.php") ?>
        <?php else: ?>
        <?php header('location:../ui/header.php?page=beranda') ?>
        <?php exit(0) ?>
        <?php endif; ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="table-responsive">
                <h2 style="font-size: 30px; color: #262626;">Jumlah Stock Sampah</h2>
                <div class="container">
                    <canvas id="myChart" width="100%" height="50%"></canvas>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>