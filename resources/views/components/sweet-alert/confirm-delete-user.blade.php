<div x-data
    @confirm-delete-user.window="
     const id = $event.detail.id; // Ambil ID dari event
                
        Swal.fire({
            title: 'Are you sure?',
            text: `You won't be able to revert this!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33', // Warna yang benar untuk tombol konfirmasi
            cancelButtonColor: '#3085d6', // Warna yang benar untuk tombol cancel
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Delete User with ID: ' + id);

                $wire.confirmDeleteUser(id).then(() => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'User has been deleted.',
                        icon: 'success'
                    })
                }).catch(() => {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'User failed to delete.',
                        icon: 'error'
                    });
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'The User is safe :)',
                    icon: 'error'
                });
            }
        });
    ">
</div>
