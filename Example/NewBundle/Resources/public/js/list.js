function clearForm(id) {
    $('#' + id).find('input').each(function () {
        $(this).val('')
    })
    $('#' + id).find('checkbox').each(function () {
        $(this).val(0)
    })
    var search = '';
    if(getParam('sort')){
        if(search =='') {
            search = search + '?sort=' +  getParam('sort');
        }
        else {
            search = search + '&sort=' +  getParam('sort');
        }
    }
    if(getParam('dir')){
        if(search =='') {
            search = search + '?dir=' +  getParam('dir');
        }
        else {
            search = search + '&dir=' +  getParam('dir');
        }
    }
    if(getParam('limit')){
        if(search =='') {
            search = search + '?limit=' +  getParam('limit');
        }
        else {
            search = search + '&limit=' +  getParam('limit');
        }
    }
    window.location.search = search;
}

// return a parameter value from the current URL
function getParam ( sname )
{
    var params = window.location.search.substr(window.location.search.indexOf("?")+1);
    var sval = "";
    params = params.split("&");
    // split param and value into individual pieces
    for (var i=0; i<params.length; i++)
    {
        temp = params[i].split("=");
        if ( [temp[0]] == sname ) { sval = temp[1]; }
    }
    return sval;
}

$(function () {
    $(document.body).on('submit', '#form_edit', function () {
        $.ajax({
            url:$('#form_edit').attr('action'),
            data:$('#form_edit').serialize(),
            type:'post',
            success:function (data) {
                if (data == 1) {
                    location.href = location.href
                } else {
                    $('.fancybox-inner').html(data)
                }
            }
        })
        return false;
    })

    $('[data-role="block"], .btn-delete').on('click', function(){
        var $this = $(this);

        var loc = $this.data('locale') ? $this.data('locale') : 'en';

        if(loc == 'ru') {
            if (!confirm('Вы уверены?')) {
                return false;
            }
        } else {
            if (!confirm('Are you shure?')) {
                return false;
            }
        }
        $.ajax({
            url: $this.data('url'),
            type: 'post',
            success: function () {
                location.reload();
            },
            error: function(error) {
                var message = (error.responseText != undefined ? error.responseText : 'Error on change status');
                alert(message);
            }
        })
    });
});
