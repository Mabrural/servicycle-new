<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ✅ Register Service Worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
            .then(reg => console.log('Service Worker registered', reg))
            .catch(err => console.log('SW failed', err));
    }

    // ✅ Detect iOS
    function isIOS() {
        return /iphone|ipad|ipod/i.test(navigator.userAgent);
    }

    // ✅ Detect jika sudah di-install
    function isInStandaloneMode() {
        return ('standalone' in window.navigator) && window.navigator.standalone;
    }

    // ✅ Cek apakah sudah pernah tampil
    const alreadyShown = localStorage.getItem('pwaPromptShown');

    // 🔥 Tampilkan hanya jika:
    // - iOS
    // - belum install
    // - belum pernah muncul
    if (isIOS() && !isInStandaloneMode() && !alreadyShown) {

        setTimeout(() => {
            Swal.fire({
                title: "Install Aplikasi 🚀",
                html: `
                    <p>Supaya lebih nyaman, install aplikasi ini:</p>
                    <ol style="text-align:left">
                        <li>Klik tombol <b>Share</b> 📤 di bawah browser</li>
                        <li>Pilih <b>Add to Home Screen</b> ➕</li>
                    </ol>
                `,
                icon: "info",
                confirmButtonText: "Siap 👍"
            });

            // tandai sudah tampil
            localStorage.setItem('pwaPromptShown', 'true');

        }, 3000); // delay 3 detik biar gak ganggu

    }

});
</script>