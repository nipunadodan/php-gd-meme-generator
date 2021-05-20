const debug = false;
var site_url = window.location;
//var site_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
function ajaxDirectX({func: func, data: data, silent: silent = false, method:method = 'post', process:process = func+'-process'} = {}){
    if(debug === true)
        console.log('ajax-init~'+process);
    if(silent === 'No'){
        var spinner = ' <i class="la la-circle-o-notch la-spin" id="spinner"></i>';
        $('.nav-title').after(spinner);
        $('button, input[type="submit"]').attr('disabled','true');
    }

    $.ajax({
        data: data,
        type: method,
        url: site_url + 'ajax.php?process=' + process,
        success: function (response) {
            try {
                var json = JSON.parse(response);
            } catch (e) {
                var json = response;
            }

            if(debug === true)
                console.log(json);

            if(json.status === 'sessionexired'){
                location.reload();
                return;
            }
            dyn_functions[func](json);
            if(silent === 'No'){
                $('button, input[type="submit"]').prop("disabled", false);
                $('#spinner').remove();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //console.log('AJAX call failed.');
            //console.log(textStatus + ': ' + errorThrown);
        },
        complete: function () {
            //console.log('AJAX call completed');
        }
    });

    return false;
}

$('form').submit(function (e) {
    e.preventDefault();
    ajaxDirectX({
        func:'result',
        data:$(this).serialize()
    })
});

let dyn_functions = [];

dyn_functions['result'] = function (json) {
    $('.result').show().attr('src',json);
    //$('#image').html(json);
}

/* ready */
$(document).ready(function () {
    // DOC: https://seballot.github.io/spectrum/
    $('.color-picker').spectrum({
        type: "component",
        preferredFormat: "hex",
    });
})