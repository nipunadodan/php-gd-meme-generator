<?php include_once 'config.php'?>
<html>
<head>
    <link rel="icon" type="image/png" href="https://nipunadodan.com/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Nipuna Dodantenna">
    <meta name="description" content="A simple text to image meme generator.">
    <meta name="keywords" content="meme, generator, text, english, sinhala, php, ed, dodanperks">
    <meta name="theme-color" content="#313131" />

    <title>#dodanperks</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/styles.css" type="text/css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>var site_url = "<?php echo SITE_URL; ?>"</script>
    <?php if(DEBUG){
        echo '<script>var debug = true;</script>';
    }?>
    <style>
        @font-face {
            font-family: Inter;
            src: url('fonts/Inter/Inter-ExtraBold.ttf');
            font-weight: 700;
        }
        @font-face {
            font-family: Inter;
            src: url('fonts/Inter/Inter-Light.ttf');
            font-weight: 300;
        }
        body{
            font-family: 'Inter','Roboto', sans-serif;
        }
        footer{
            font-weight: 300;
        }
        label{
            display: inline-block;
            font-size: 1rem !important;
            margin: 15px 0 7px !important;
        }
        label+i{
            float: right;
            margin: 15px 0 7px !important;
            position: relative;
            top: 2px;
        }
        .settings-container label{
            color: #ffffff;
            font-size: 0.8rem !important;
        }
        input, textarea{
            font-size: 1rem !important;
        }
        textarea{
            min-height: 160px;
        }
        input[type="submit"]{
            font-size: 1rem !important;
        }
        input[type="file"]{
            border: none !important;
            padding: 0;
        }
        #display-mode i, #post-to-facebook i{
            position: relative;
            top: -4px;
            margin-right: 6px;
        }
    </style>


</head>
<body class="dark-mode">
    <div class="container">
        <div class="row align-content-center min-vh-100">
            <div class="col-md-6">
                <h1 style="font-weight: bolder" class="display-1 mt-5">#dodanperks</h1>
                <form enctype="multipart/form-data" class="form" name="result" method="post" action="test/result.php">
                    <div class="row">
                        <div class="col-md-9">
                            <label>Language</label>
                            <select id="lang" name="lang" class="dark-mode" style="font-weight: normal">
                                <option value="en">English</option>
                                <option value="si">Sinhala (Unicode)</option>
                            </select>
                        </div>
                    </div>

                    <!-- TITLE -->
                    <div class="row">
                        <div class="col-md-9">
                            <label>Title</label><i class="la la-gear cursor-pointer" id="title-settings"></i>
                            <input id="title" name="title" placeholder="Title" class="dark-mode" style="font-weight: normal" />
                            <input type="hidden" name="title_" id="title_">

                            <div id="title-settings-container" class="bg-secondary rounded px-2 pt-0 pb-3 pb-md-2 mt-2 settings-container" style="display: none">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Lines</label>
                                        <input type="number" id="title-lines" name="title-lines" placeholder="Lines" class="dark-mode" value="1" style="font-weight: normal" />
                                    </div>
                                    <div class="col-md-4">
                                        <label>Font Size</label>
                                        <input type="number" id="title-font-size" name="title-font-size" placeholder="Font Size" class="dark-mode" value="100" style="font-weight: normal" />
                                    </div>
                                    <div class="col-md-4">
                                        <label>Position Y</label>
                                        <input type="number" id="title-position-y" name="title-position-y" placeholder="Position Y" class="dark-mode" value="280" style="font-weight: normal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="title-colour" id="title-colour" value='#f89a1f' />
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="row">
                        <div class="col-md-9">
                            <label>Body</label><i class="la la-gear cursor-pointer" id="body-settings"></i>
                            <textarea id="body" name="body" placeholder="Body" class="dark-mode" style="font-weight: normal"></textarea>
                            <input type="hidden" name="body_" id="body_">

                            <div id="body-settings-container" class="bg-secondary rounded px-2 pt-0 pb-3 pb-md-2 mt-2 settings-container" style="display: none">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Opacity (%)</label>
                                        <input type="number" id="body-opacity" name="body-opacity" placeholder="Opacity" class="dark-mode" value="60" style="font-weight: normal" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-small">Font Size</label>
                                        <input type="number" id="body-font-size" name="body-font-size" placeholder="Font Size" class="dark-mode" value="45" style="font-weight: normal" />
                                    </div>
                                    <div class="col-md-4">
                                        <label>Position Y</label>
                                        <input type="number" id="body-position-y" name="body-position-y" placeholder="Position Y" class="dark-mode" value="515" style="font-weight: normal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="body-colour" id="body-colour" value='#ffffff' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label>Tag</label>
                            <input name="tag" id="tag" placeholder="Tag" value="" autocomplete="off" list="tags" class="dark-mode" style="font-weight: normal" />
                            <datalist id="tags">
                                <option value="dodanperks">
                                <option value="dailyaviation">
                                <option value="srilankanairlinesfans">
                            </datalist>
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="tag-colour" id="tag-colour" value='#e0e0e0' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Width</label>
                            <input name="width" type="number" placeholder="Width" value="1600" class="dark-mode" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Height</label>
                            <input name="height" type="number" placeholder="Height" value="1200" class="dark-mode" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Image</label>
                            <input name="bg_image" type="file" class="dark-mode" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="background-colour" id="background-colour" value='#313131' />
                        </div>
                    </div>
                    <div class="row mt-3 align-content-center">
                        <div class="col-md-6 col-7">
                            <input type="submit" id="submit" value="Generate" class="w-auto p-3">
                            <input type="reset" value="Reset" class="w-auto p-3">
                            <span class="nav-title"></span>
                        </div>
                        <div class="col-md-3 offset-md-3">
                            <div class="h-100 d-flex align-content-center flex-wrap cursor-pointer mt-4 mt-md-0" id="display-mode">
                                <i class="las la-adjust la-2x"></i> Light/Dark
                            </div>
                        </div>
                    </div>
                </form>
                <div id="facebook-publishing" style="display: none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form">
                                <label for="page">Page</label>
                                <select id="page"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="d-block w-100">Publishing Settings</label>
                            <input name="nature" value="schedule" type="radio" class="form-check-input" id="schedule"><label for="schedule" class="d-inline ms-2">Schedule</label>
                            <input name="nature" value="draft" type="radio" class="form-check-input" id="draft" checked><label for="draft" class="d-inline ms-2">Draft</label>
                            <input name="nature" value="publish" type="radio" class="form-check-input" id="publish"><label for="publish" class="d-inline ms-2">Publish</label>
                            <div class="form">
                                <label for="date">Date</label>
                                <input type="datetime-local" name="schedule-datetime">
                            </div>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-md-3">
                            <div class="h-100 d-flex align-content-center flex-wrap cursor-pointer mt-4 mt-md-0"
                                 id="post-to-facebook">
                                <i class="lab la-facebook la-2x"></i> Publish
                            </div>
                        </div>

                        <div class="col-md-3">
                            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                            </fb:login-button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-md-8 mt-5 mb-5" id="result" style="display: none">
                <img src="" id="resultImage" data-title="" class="result img-fluid" style="display: none">
            </div>
        </div>

        <div id="status">
        </div>

        <footer class="text-small">
            <p>&copy; <?php echo date('Y'); ?> <a href="https://nipunadodan.com/">Nipuna Dodantenna</a> <?php echo VERSION; ?>. Special credits for Sinhala Unicode converter for FM fonts <a href="https://projects.malinthe.com/converter/">Malinthe Samarakoon</a> and <a href="http://www.ucsc.cmb.ac.lk/ltrl/services/feconverter/">University of Colombo School of Computing</a></p>
            <p>No data saved on servers. Everything is saved on your browser.</p>
        </footer>
    </div>

    <!-- Response Modal -->
    <div class="modal fade" id="response-modal" tabindex="-1" role="dialog" aria-labelledby="responseModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered border-0" role="document">
            <div class="modal-content border-0 ">
                <div class="modal-header d-block border-0 pt-5">
                    <div class="text-center">
                        <i class="" id="response-modal-icon"></i>
                        <span class="text-bold text-capitalize" id="response-modal-title"></span>
                    </div>
                </div>
                <div class="modal-body text-center text-small">
                </div>
                <div class="modal-footer border-0 p-0 mt-3">
                    <button type="button" id="response-modal-okay" class="btn btn-light text-small text-uppercase w-100 rounded-0 rounded-bottom py-3 m-0" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
<script src="js/lang_converter.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>