$(document).ready(function () {

    $('#category').change(function () {
        var category = $(this).val();
        $.ajax({
            url: window.location.origin + '/manage/bank_soal/get_subject',
            method: "POST",
            data: { category: category },
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.status) {
                    $.each(data.data, function (index, value) {
                        html += '<option value="' + value.id + '">' + value.subject + '</option>';
                    });

                    $('#subject').html('<option selected>Pilih kategori soal</option>' + html);
                }
            }
        });
        return false;
    });

    $('#subject').change(function () {
        var subject = $(this).val();
        $.ajax({
            url: window.location.origin + '/manage/bank_soal/get_subject',
            method: "POST",
            data: { id: subject },
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.status) {
                    $.each(data.data, function (index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    
                    $('#material').html('<option selected>Pilih bank soal</option>' +html);
                }
            }
        });
        return false;
    });
});