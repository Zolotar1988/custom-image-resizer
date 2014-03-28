$(document).ready(function(){
    $('#btn-generate').click(function () {
        $.ajax({
            url: $("#card-generate-form").attr('action'),
            type: 'post',
            data: $("#card-generate-form").serialize(),
            beforeSend: function() {
                $('#card-generation-popup .popup-buttons').html('');
                $('#form_count').attr('disabled', 'disabled');
                $('.card-loading').show();
            },
            success: function (data) {
                $('.fancybox-inner').html(data);
            },
            error: function() {
                $('.card-loading').hide();
                $('#card-generation-popup .popup-buttons').html('Card generation error. Please Try again');
            }
        })
    });
})