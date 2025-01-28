// Menunggu hingga halaman sepenuhnya dimuat
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    const content = document.getElementById('content');

    // Memberikan waktu preloader tampil selama 3 detik
    setTimeout(function() {
        // Menghilangkan preloader
        preloader.style.display = 'none';
        
        // Menampilkan konten dengan efek fade-in
        content.style.display = 'block';
        setTimeout(function() {
            content.classList.add('visible');
        }, 50); // Memberikan sedikit delay agar transisi terlihat halus
    }, 3000); // 3000ms = 3 detik
});
