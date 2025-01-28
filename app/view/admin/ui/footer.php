<?php require_once("../../../config/config.php"); ?>
<script src="<?= base_url('dist/vendor/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('dist/vendor/chart.js/chart.umd.js') ?>"></script>
<script src="<?= base_url('dist/vendor/echarts/echarts.min.js') ?>"></script>
<script src="<?= base_url('dist/vendor/quill/quill.js') ?>"></script>
<script src="<?= base_url('dist/vendor/simple-datatables/simple-datatables.js') ?>"></script>
<script src="<?= base_url('dist/vendor/tinymce/tinymce.min.js') ?>"></script>
<script src="<?= base_url('dist/vendor/php-email-form/validate.js') ?>"></script>
<script src="<?= base_url('dist/js/main.js') ?>"></script>
<script src="<?= base_url('dist/js/preloader.js') ?>"></script>

<!-- Template Main JS File -->
<script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
</script>
<script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script crossorigin="anonymous" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script crossorigin="anonymous" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script crossorigin="anonymous">
    /* Settings DataTables */
    $(document).ready(function() {
        $('#datatable1').DataTable({
            "responsive": true,
            "processing": false,
            "ordering": false,
            "columnDefs": [{
                "orderable": false,
                "targets": [0]
            }]
        });
        $("#datatable1_filter").hide(false);
        // $("#datatable1_filter").hide(true);
        $('#datatable1').parent().addClass("table-responsive");
    });

    $(document).ready(function() {
        $("#datatable2").DataTable({
            "responsive": true
        });
        $('#datatable2').parent().addClass("table-responsive");
    });

    $(document).ready(function() {
        $("#datatable3").DataTable({
            "responsive": true,
            "ordering": false
        });
        $("#datatable3_filter").hide(false);
        $("#datatable3_length").hide(false);
        $('#datatable3').parent().addClass("table-responsive");
    });


    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
            preview.onload = function() {
                URL.revokeObjectURL(preview.src); // Free memory
            };
        }
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#cmb_nama').change(function() { // Jika Select Box id provinsi dipilih
            var tamp = $(this).val(); // Ciptakan variabel provinsi
            $.ajax({
                type: 'POST', // Metode pengiriman data menggunakan POST
                url: '../penarikan/get_nama.php', // File yang akan memproses data
                data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
                success: function(data) { // Jika berhasil
                    $('.tampung').html(data); // Berikan hasil ke id kota
                }
            });
        });
    });
    jQuery(document).ready(function($) {
        $('#cmb_sampah').change(function() { // Jika Select Box id provinsi dipilih
            var tamp = $(this).val(); // Ciptakan variabel provinsi
            $.ajax({
                type: 'POST', // Metode pengiriman data menggunakan POST
                url: '../penjualan/get_sampah.php', // File yang akan memproses data
                data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
                success: function(data) { // Jika berhasil
                    $('.tampung').html(data); // Berikan hasil ke id kota
                }
            });
        });
    });
</script>
<?php $stock = mysqli_query($koneksi, "SELECT stock FROM stock_sampah order by idStock asc"); ?>
<script lang="javascript" type="text/javascript">
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                "Kresek", "Plastik", "Karah Warna", "Botol mineral plastik",
                "Botol mineral kaca",
                "Gelas mineral plastik", "Kaleng", "Kardus/Karton", "Dedaunan",
                "Sampah hasil masak", "Besi", "Baja", "Tembaga", "Aluminium", "Zeng",
                "Kain",
                "Sandal dan Sepatu", "Lampu"
            ],
            datasets: [{
                label: 'Jumlah Stock',
                data: [
                    <?php while ($p = mysqli_fetch_array($stock)) {
                        echo '"' . $p['stock'] . '",';
                    } ?>
                ],
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(55, 100, 180, 1)',
                    'rgba(60, 170, 240, 1)',
                    'rgba(25, 20, 80, 1)',
                    'rgba(175, 195, 195, 1)',
                    'rgba(150, 100, 250, 1)',
                    'rgba(77, 66, 55, 1)'
                ],
                borderColor: 'transparent',
                borderWidth: 2.5,
                barPercentage: 0.8,
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 15
                    }
                }]
            }
        }
    });
</script>
</body>

</html>