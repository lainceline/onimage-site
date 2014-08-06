<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onimage - Login</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.min.css">

    <script type="text/javascript">
        (function () {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://plus.google.com/js/client:plusone.js?onload=start';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
</head>

<body>
    <div class="container-full">
        <div class="row">
            <div class="col-lg-12 text-center v-center">
                <h1>B is for Bryan</h1>
                <p class="lead">Please sign in</p>
                <br>
                <br>
                <br>
                <form class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a class="btn btn-lg btn-primary" href={{ $link }}>
                                <i class="fa fa-google-plus"></i>
                                <span>Sign in using Google</span>
                            </a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>