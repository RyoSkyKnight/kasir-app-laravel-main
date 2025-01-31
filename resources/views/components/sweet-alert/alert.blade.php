<div x-data
     x-init="
        @if (session()->has('sweet-alert'))
           setTimeout(() => {
              Swal.fire({
                 icon: '{{ session('sweet-alert.icon') }}',
                 title: '{{ session('sweet-alert.title') }}',
                 toast: true,
                 position: 'top-end',
                 showConfirmButton: false,
                 timer: 3000,
                 timerProgressBar: true,
                 zIndex: 999999, // Pastikan di atas semua elemen lain
                 customClass: {
                    popup: 'swal-custom-zindex'
                 },
                 didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                 }
              });
           }, 100);
        @endif
     ">
</div>

<!-- CSS untuk memastikan SweetAlert selalu di atas -->
<style>
    .swal-custom-zindex {
        z-index: 999999 !important;
    }

    .swal2-container {
        z-index: 999999 !important;
    }
</style>
