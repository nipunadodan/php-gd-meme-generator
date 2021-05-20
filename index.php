<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/styles.css" type="text/css" rel="stylesheet" />
    <title>#dodanperks</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    <style>
        @font-face {
            font-family: Inter;
            src: url('fonts/Inter/Inter-ExtraBold.ttf');
        }
        body{
            font-family: 'Inter','Roboto', sans-serif;
        }
        label{
            font-size: 1rem !important;
            margin: 15px 0 7px !important;
        }
        input, textarea{
            font-size: 1rem !important;
        }
        textarea{
            min-height: 200px;
        }
        input[type="submit"]{
            font-size: 1rem !important;
        }
        input[type="file"]{
            border: none !important;
            padding: 0;
        }
    </style>
</head>
<body class="bg-dark text-white">
    <div class="container">
        <div class="row align-content-center justify-content-center min-vh-100 justify-content-center">
            <div class="col-md-8">
                <h1 style="font-weight: bolder" class="display-1 mt-5">#dodanperks</h1>
                <form class="form" name="result" method="post" action="test/result.php">
                    <div class="row">
                        <div class="col-md-9">
                            <label>Title</label>
                            <input name="title" placeholder="Title" class="bg-dark text-white" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="title-colour" value='#adefd1' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label>Body</label>
                            <textarea name="body" placeholder="Body" class="bg-dark text-white" style="font-weight: normal"></textarea>
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="body-colour" value='#ffffff' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label>Tag</label>
                            <input name="tag" placeholder="Tag" value="#dodanperks" class="bg-dark text-white" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="tag-colour" value='#d1d1d1' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Image</label>
                            <input type="file" name="image" placeholder="Image" class="bg-dark text-white" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Width</label>
                            <input name="width" placeholder="Width" value="1600" class="bg-dark text-white" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Height</label>
                            <input name="height" placeholder="Height" value="1200" class="bg-dark text-white" style="font-weight: normal" />
                        </div>
                        <div class="col-md-3">
                            <label>Colour</label>
                            <input class="color-picker" name="background-colour" value='#00203F' />
                        </div>
                    </div>
                    <input type="submit" value="Generate" class="w-auto p-3 mt-5">
                </form>
                <img src="" class="result img-fluid my-5" style="display: none">
            </div>
        </div>
    </div>

<script src="js/scripts.js"></script>
</body>
</html>