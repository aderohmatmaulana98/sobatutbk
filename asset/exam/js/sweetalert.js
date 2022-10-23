$('#btn-selesai').click(function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        // title: 'Yakin ?',
        text: "Yakin Tryout sudah selesai ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sudah',
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })
});

