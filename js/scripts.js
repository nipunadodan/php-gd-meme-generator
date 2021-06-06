
//var site_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
function ajaxDirectX({func: func, data: data, silent: silent = false, method:method = 'post', process:process = func+'-process'} = {}){
    if(debug === true)
        console.log('ajax-init~'+process);
    if(silent === false){
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
            if(silent === false){
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

var icons = {
    'success' : 'la la-check-circle',
    'danger' : 'la la-times-circle',
    'info' : 'la la-info-circle',
    'warning' : 'la la-exclamation-triangle'
};
function responseModal(status, message){
    $('#response-modal .modal-content').attr('class','modal-content border-0 bg-'+status);
    $('#response-modal #response-modal-title').html(status);
    $('#response-modal #response-modal-icon').attr('class', icons[status]);
    $('#response-modal .modal-body').html("<span class=''>"+message.replace(/!/g, "")+"</span>");
    $('#response-modal').modal('toggle');
    if(debug === true)
        console.log(icons[status]);
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
        $('.result').show().attr({
            src: json.image,
            "data-title":title
        });
        $('#result, #publish').show();
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

    $('#title, #body, #lang, #submit').on('keyup change click', function () {
        $('#title, #body').each(function () {
            const elem_id = $(this).attr('id');
            const text = $(this).val();

            if($('#lang').val() === 'si') {
                startText(text, elem_id);
            }else{
                $('#'+elem_id+'_').val(text);
            }
        });
    });


    // DOC: https://seballot.github.io/spectrum/
    $('.color-picker').spectrum({
        type: "component",
        preferredFormat: "hex",
    });

    darkMode();

    $('#display-mode').on('click', function (e) {
        e.preventDefault();
        toggleDarkMode();
    });
});

/* ========
 * FACEBOOK
 * ======== */

function statusChangeCallback(response) {
    // Called with the results from FB.getLoginStatus().
    if(debug) {
        console.log('statusChangeCallback');
        console.log(response);
        // The current login status of the person.
    }
    $('body').unbind('click').on('click', '#publish', function (ex) {
        ex.preventDefault();
        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
            const yes = confirm('Are you sure want to post to Facebook?');
            if(yes) {
                $(this).attr('style', 'display:none !important');
                const title = $('img').data('title');
                const tag = $('#tag').val();
                testAPI(title+'\n\n'+tag);
            }
        } else {
            // Not logged into your webpage or we are unable to tell.
            responseModal('warning', 'Please login to Facebook');
        }
    });
}


function checkLoginState() {
    // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
        statusChangeCallback(response);
    });
}


window.fbAsyncInit = function() {
    FB.init({
        appId      : '2198458126957638',
        cookie     : true,                     // Enable cookies to allow the server to access the session.
        xfbml      : true,                     // Parse social plugins on this webpage.
        version    : 'v10.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
        statusChangeCallback(response);        // Returns the login status.
    });
};


function testAPI(message) {
    // Testing Graph API after login.  See statusChangeCallback() for when this call is made.

    FB.api('/me', function(response) {
        console.log('me');
        console.log(response);
        document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';

        $.ajax({
            url:'https://graph.facebook.com/'+response.id+'/accounts?access_token='+FB.getAccessToken(),
            method:'GET'
        }).done(function (res) {
            console.log(res);

            let params = {"url":site_url+'image.png',"caption":message,"access_token":res.data[0].access_token, "published": !debug, "unpublished_content_type":"DRAFT"};
            FB.api(
                '/130471229144380/photos',
                'POST',
                params,
                function(response) {
                    console.log(response);
                    if(response.hasOwnProperty('post_id') || response.hasOwnProperty('id')){
                        responseModal('success','Successfully posted');
                    }else{
                        responseModal('danger','Error in posting');
                    }
                }
            );
        });
    });
}