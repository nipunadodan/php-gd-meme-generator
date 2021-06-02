<!DOCTYPE html>
<html>
<head>
    <title>Facebook Login JavaScript Example</title>
    <meta charset="UTF-8">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
        console.log('statusChangeCallback');
        console.log(response);                   // The current login status of the person.
        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
            testAPI();
        } else {                                 // Not logged into your webpage or we are unable to tell.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this webpage.';
        }
    }


    function checkLoginState() {               // Called when a person is finished with the Login Button.
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

    function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
        console.log('Welcome!  Fetching your information.... ');
            console.log(FB);
        FB.api('/me', function(response) {
            console.log(response);
            document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';

            $.ajax({
                url:'https://graph.facebook.com/'+response.id+'/accounts?access_token='+FB.getAccessToken(),
                method:'GET'
            }).done(function (res) {
                console.log(res);
                FB.api(
                    '/130471229144380/photos',
                    'POST',
                    {"url":"https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/SparkyLinux-logo-200px.png/110px-SparkyLinux-logo-200px.png","access_token":res.data[0].access_token},
                    function(response) {
                        console.log(response);
                    }
                );
            });
        });
    }

</script>


<!-- The JS SDK Login Button -->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>