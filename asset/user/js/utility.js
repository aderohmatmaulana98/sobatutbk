$(document).ready(function () {

    $('#ptn1').change(function () {
        var ptn = $(this).val();
        $.ajax({
            url: window.location.origin + '/exm/get_jurusan',
            method: "POST",
            data: { nama: ptn },
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.status) {
                    $.each(data.data, function (index, value) {
                        html += '<option value="' + value.id + '">' + value.jurusan + '</option>';
                    });

                    $('#jurusan1').html('<option selected>Jurusan</option>' + html);
                }
            }
        });
        return false;
    });

    $('#ptn2').change(function () {
        var ptn = $(this).val();
        $.ajax({
            url: window.location.origin + '/exm/get_jurusan',
            method: "POST",
            data: { nama: ptn },
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.status) {
                    $.each(data.data, function (index, value) {
                        html += '<option value="' + value.id + '">' + value.jurusan + '</option>';
                    });

                    $('#jurusan2').html('<option selected>Jurusan</option>' + html);
                }
            }
        });
        return false;
    });
});