// tombol hapus
$('.btn-hapus').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        // title: 'Yakin ?',
        text: "Data akan dihapus",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })
});