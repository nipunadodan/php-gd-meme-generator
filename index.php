<html>
<head>
    <link rel="icon" type="image/png" href="https://nipunadodan.com/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>#dodanperks</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/styles.css" type="text/css" rel="stylesheet" />
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
            display: block;
            font-size: 1rem !important;
            margin: 15px 0 7px !important;
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
        #display-mode i{
            position: relative;
            top: -4px;
            margin-right: 6px;
        }
    </style>
</head>
<body class="dark-mode">
    <div class="container">
        <div class="row align-content-center justify-content-center min-vh-100 justify-content-center">
            <div class="col-md-6">
                <h1 style="font-weight: bolder" class="display-1 mt-5">#dodanperks</h1>
                <form class="form" name="result" method="post" action="test/result.php">
                    <div class="row">
                        <div class="col-md-9">
                            <label>Language</label>
                            <select id="lang" name="lang" class="dark-mode" style="font-weight: normal">
                                <option value="en">English</option>
                                <option value="si">Sinhala (Unicode)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label>Title</label>
                            <input id="title" name="title" placeholder="Title" class="dark-mode" style="font-weight: normal" />
                            <input type="hidden" name="title_" id="title_">
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="title-colour" value='#f89a1f' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label>Body</label>
                            <textarea id="body" name="body" placeholder="Body" class="dark-mode" style="font-weight: normal"></textarea>
                            <input type="hidden" name="body_" id="body_">
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="body-colour" value='#ffffff' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label>Tag</label>
                            <input name="tag" placeholder="Tag" value="dodanperks" class="dark-mode" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="tag-colour" value='#e0e0e0' />
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
                        <div class="col-md-3 offset-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="background-colour" value='#313131' />
                        </div>
                    </div>
                    <div class="row mt-3 align-content-center">
                        <div class="col-md-9">
                            <input type="submit" id="submit" value="Generate" class="w-auto p-3">
                            <input type="reset" value="Reset" class="w-auto p-3">
                        </div>
                        <div class="col-md-3">
                            <div class="h-100 d-flex align-content-center flex-wrap cursor-pointer" id="display-mode">
                                <i class="las la-adjust la-2x"></i> Light/Dark
                            </div>
                        </div>
                    </div>
                </form>
                <footer class="text-small">&copy; <?php echo date('Y')?> <a href="https://nipunadodan.com/">Nipuna Dodantenna</a>. Special credits for Sinhala Unicode converter for FM fonts <a href="https://projects.malinthe.com/converter/">Malinthe Samarakoon</a> and
                    <a href="http://www.ucsc.cmb.ac.lk/ltrl/services/feconverter/">University of Colombo School of Computing</a></footer>
            </div>
            <div class="col-md-6 mt-md-8 mb-5" id="result" style="display: none">
                <img src="" class="result img-fluid" style="display: none">
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
<script src="js/lang_converter.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>