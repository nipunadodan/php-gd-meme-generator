
//var site_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
    const byteCharacters = atob(b64Data);
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        const slice = byteCharacters.slice(offset, offset + sliceSize);

        const byteNumbers = new Array(slice.length);
        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        const byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }

    const blob = new Blob(byteArrays, {type: contentType});
    return blob;
}

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
        processData: false,
        contentType: false,
        success: function (response) {
            let json;
            try {
                json = JSON.parse(response);
            } catch (e) {
                json = response;
            }

            if(debug === true)
                console.log(json);

            if(json.status === 'session_expired'){
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
    const form = new FormData($(this)[0]);
    ajaxDirectX({
        func:'result',
        data:form
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
    const tag = $('#tag').val();
    const titleColour = $('#title-colour').val();
    const bodyColour = $('#body-colour').val();
    const tagColour = $('#tag-colour').val();
    const bgColour = $('#background-colour').val();
    if(json.status === 'success') {
        const contentType = 'image/png';
        const b64Data = json.image;

        const blob = b64toBlob(b64Data, contentType);
        const blobUrl = URL.createObjectURL(blob);

        $('.result').show().attr({
            src: blobUrl,
            "data-title":title
        });
        $('#result, #facebook-publishing').show();
        $('html, body').animate({
            scrollTop: $("#result").offset().top
        }, 300);

        localStorage.setItem('gdText-title',title);
        localStorage.setItem('gdText-body',body);
        localStorage.setItem('gdText-lang',lang);
        localStorage.setItem('gdText-tag',tag);
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
    if(localStorage.getItem('gdText-tag') !== null){
        $('#tag').val(localStorage.getItem('gdText-tag'));
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

        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
            if(confirm('Are you sure want to post to Facebook?')) {
                const title = $('img').data('title');
                const tag = $('#tag').val();

                $('#facebook-publishing').hide();
                testAPI(title+'\n\n#'+tag); //TODO: send blob to api and see what happenes

                const spinner = ' <i class="la la-circle-o-notch la-spin" id="spinner"></i>';
                $('.nav-title').after(spinner);
                $('button, input[type="submit"]').attr('disabled','true');
            }
        } else {
            // Not logged into your webpage or we are unable to tell.
            responseModal('warning', 'Please login to Facebook');
        }

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
        version    : 'v11.0'           // Use this Graph API version for this call. Prev v10.0
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

            $.each(res.data, function (key, page) {
                $('select#page').html('').append(
                    '<option value="'+key+'">'+page.name+'</option>'
                );
            })

            $('body').unbind('click').on('click', '#post-to-facebook', function (ex) {
                ex.preventDefault();
                const page = $('select#page').val();
                const nature = $('input[name="nature"]:checked').val();
                let scheduledTime = $('input[name="schedule-datetime"]').val();
                scheduledTime = parseInt((new Date(scheduledTime).getTime() / 1000).toFixed(0))

                let params = {
                    "url":site_url+'image.png',
                    "caption":message,
                    "access_token":res.data[page].access_token,
                    "published": (nature === 'publish'),
                    //"unpublished_content_type":(nature === "schedule" ? "SCHEDULED" : nature === "publish" ? "PUBLISHED" : "DRAFT"),
                };

                if(nature === "schedule"){
                    params.scheduled_publish_time= (scheduledTime !== 'undefined' || scheduledTime !== '' ? scheduledTime : '');
                    //params.unpublished_content_type = "SCHEDULED";
                }else if(nature === "draft"){
                    params.unpublished_content_type = "DRAFT";
                }

                console.log(nature);
                console.log(params);

                FB.api(
                    '/'+res.data[page].id+'/photos',
                    'POST',
                    params,
                    function(response) {
                        console.log(response);
                        if(response.hasOwnProperty('post_id') || response.hasOwnProperty('id')){
                            responseModal('success','Successfully posted');
                            $('button, input[type="submit"]').prop("disabled", false);
                            $('#spinner').remove();
                        }else{
                            responseModal('danger','Error in posting');
                        }
                    }
                );
            });
        });
    });
}

$(document).ready(function () {
    $('label+i').on('click', function () {
        const id = $(this).attr('id');
        $(this).toggleClass('la-gear la-times');
        $('#'+id+'-container').toggle();
    })
})