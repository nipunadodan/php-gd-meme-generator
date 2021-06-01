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

/*------------------------------*/
function darkMode(toggle) {
    if (localStorage.getItem("gdText-darkmode") !== null && localStorage.getItem("gdText-darkmode") === 'dark') {
        $('.dark-mode').addClass('text-white bg-dark');

    }else if(localStorage.getItem("gdText-darkmode") !== null && localStorage.getItem("gdText-darkmode") === 'light'){
        $('.dark-mode').removeClass('text-white bg-dark');
        if(toggle) {
            localStorage.setItem("gdText-darkmode", "dark");
            $('.dark-mode').addClass('text-white bg-dark');
        }
    }else{
        localStorage.setItem("gdText-darkmode", "light");
        darkMode();
    }
}

function toggleDarkMode() {
    if (localStorage.getItem("gdText-darkmode") !== null && localStorage.getItem("gdText-darkmode") === 'dark') {
        localStorage.setItem("gdText-darkmode", "light");
        $('.dark-mode').removeClass('text-white bg-dark');
    }else{
        localStorage.setItem("gdText-darkmode", "dark");
        $('.dark-mode').addClass('text-white bg-dark');
    }
}

/*------------------------------*/

let dyn_functions = [];

dyn_functions['result'] = function (json) {
    const title = $('#title').val();
    const body = $('#body').val();
    const lang = $('#lang').val();
    const titleColour = $('#title-colour').val();
    const bodyColour = $('#body-colour').val();
    const tagColour = $('#tag-colour').val();
    const bgColour = $('#background-colour').val();
    if(json.status === 'success') {
        $('.result').show().attr('src', json.image);
        $('#result').show();
        $('html, body').animate({
            scrollTop: $("#result").offset().top
        }, 300);
        localStorage.setItem('gdText-title',title);
        localStorage.setItem('gdText-body',body);
        localStorage.setItem('gdText-lang',lang);
        localStorage.setItem('gdText-title-colour',titleColour);
        localStorage.setItem('gdText-body-colour',bodyColour);
        localStorage.setItem('gdText-tag-colour',tagColour);
        localStorage.setItem('gdText-bg-colour',bgColour);
    }
}

/* ready */
$(document).ready(function () {
    if(localStorage.getItem('gdText-title') !== null) {
        $('#title').val(localStorage.getItem('gdText-title'));
    }
    if(localStorage.getItem('gdText-body') !== null){
        $('#body').val(localStorage.getItem('gdText-body'));
    }
    if(localStorage.getItem('gdText-lang') !== null){
        $('#lang').val(localStorage.getItem('gdText-lang'));
    }
    if(localStorage.getItem('gdText-title-colour') !== null) {
        $('#title-colour').val(localStorage.getItem('gdText-title-colour'));
    }
    if(localStorage.getItem('gdText-body-colour') !== null){
        $('#body-colour').val(localStorage.getItem('gdText-body-colour'));
    }
    if(localStorage.getItem('gdText-tag-colour') !== null){
        $('#tag-colour').val(localStorage.getItem('gdText-tag-colour'));
    }
    if(localStorage.getItem('gdText-bg-colour') !== null){
        $('#background-colour').val(localStorage.getItem('gdText-bg-colour'));
    }

    $('#title,#body').trigger('keyup');
    if($('#lang').val() === 'si') {
        $('#title, #body').each(function () {
            const elem_id = $(this).attr('id');
            const text = $(this).val();

            startText(text, elem_id);
        });

        $('#title, #body, #lang, #submit').on('keyup change click', function () {
            const elem_id = $(this).attr('id');
            const text = $(this).val();

            startText($(this).val(), elem_id);
        });
    }else{
        $('#title_').val($('#title').val());
        $('#body_').val($('#body').val());
    }


    // DOC: https://seballot.github.io/spectrum/
    $('.color-picker').spectrum({
        type: "component",
        preferredFormat: "hex",
    });

    darkMode();

    $('#display-mode').on('click', function (e) {
        e.preventDefault();
        toggleDarkMode();
    })
})