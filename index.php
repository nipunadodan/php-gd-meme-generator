<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/styles.css" type="text/css" rel="stylesheet" />
    <title>#dodanperks</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
</head>
<body class="bg-dark text-white">
    <div class="container">
        <div class="row align-content-center justify-content-center min-vh-100 justify-content-center">
            <div class="col-md-8">
                <h1 style="font-weight: bolder" class="display-1 mt-5">#dodanperks</h1>
                <form class="form" name="result" method="post" action="test/result.php">
                    <label>Title</label>
                    <input name="title" placeholder="Title" class="bg-dark text-white" style="font-weight: normal" />
                    <label>Body</label>
                    <textarea name="body" placeholder="Body" class="bg-dark text-white" style="font-weight: normal"></textarea>
                    <input type="submit" value="Generate" class="w-auto p-3">
                </form>
                <img src="" class="result img-fluid my-5" style="display: none">
            </div>
        </div>
    </div>

<script src="js/scripts.js"></script>
</body>
</html>