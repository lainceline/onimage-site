<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B is for Bryan</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    {{ HTML::style('css/bryan.css') }}

</head>
<body>

    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">B is for Bryan</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="navbar navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="upload">
            //uploader goes here
        </div>
    </div>

    <div class="container-fluid">
        @yield('images')
    </div>

    <nav class="navbar navbar-default navbar-static-bottom">
        @yield('footer')
    </nav>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>