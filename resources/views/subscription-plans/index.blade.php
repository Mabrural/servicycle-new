<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'info',
            title: 'Fitur Dalam Pengembangan',
            text: 'Saat ini fitur ini sedang dalam pengembangan, silahkan coba lagi nanti.',
            confirmButtonText: 'Ke Dashboard',
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('dashboard') }}";
            }
        });
    });
</script>