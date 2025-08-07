<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Unauthorized {{ setting()->title }} Back Office </title>
    <link href="{{ asset('') }}assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('') }}css/style.css" rel="stylesheet">
    <link href="{{ asset('') }}css/pages/error-pages.css" rel="stylesheet">
    <link href="{{ asset('') }}css/colors/default-dark.css" id="theme" rel="stylesheet">
</head>

<body class="fix-header card-no-border fix-sidebar">
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1 class="text-info">403</h1>
                <h3 class="text-uppercase">Unauthorized !</h3>
                <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
                <a href="/" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a>
            </div>
            <footer class="footer text-center">© 2019 {{ setting()->title }}.</footer>
        </div>
    </section>
    <script src="{{ asset('') }}assets/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}js/waves.js"></script>
</body>

</html>
