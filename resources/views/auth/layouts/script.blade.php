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

<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
            .then(reg => console.log('Service Worker registered', reg))
            .catch(err => console.log('SW failed', err));
    }

    function isIOS() {
        return /iphone|ipad|ipod/i.test(navigator.userAgent);
    }

    function isInStandaloneMode() {
        return ('standalone' in window.navigator) && window.navigator.standalone;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        if (isIOS() && !isInStandaloneMode()) {

            Swal.fire({
                title: "Install Aplikasi 🚀",
                html: `
                <p>Install aplikasi ini di iPhone kamu:</p>
                <ol style="text-align:left">
                    <li>Klik tombol <b>Share</b> 📤</li>
                    <li>Pilih <b>Add to Home Screen</b> ➕</li>
                </ol>
            `,
                icon: "info",
                confirmButtonText: "Oke, mengerti 👍"
            });

        }

        function isIOS() {
            return /iphone|ipad|ipod/i.test(navigator.userAgent);
        }

        function isInStandaloneMode() {
            return ('standalone' in window.navigator) && window.navigator.standalone;
        }

        if (!localStorage.getItem('pwaPromptShown')) {
            // tampilkan swal
            localStorage.setItem('pwaPromptShown', 'true');
        }

    });
</script>
