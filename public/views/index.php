<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B is for Bryan</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ng-dialog/0.2.3/css/ngDialog.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ng-dialog/0.2.3/css/ngDialog-theme-default.min.css">

    <link rel="stylesheet" href="css/bryan.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.8.4/dropzone.min.js"></script>
</head>
<body ng-app="imageApp">

    <images-navbar></images-navbar>

    <div class="wrap" ng-controller="ImageController as imageCtrl">

        <uploader></uploader>

        <div class="img-container" infinite-scroll="loadMore()" infinite-scroll-distance="1">
            <div class="row">
                <images ng-repeat="image in images"></images>
            </div>
        </div>

    </div>

    <script type="text/ng-template" id="imageDialog">
        <div class="ngdialog-message">
            <img ng-src="{{image.image}}" /></img>
        </div>
    </script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-route.min.js"></script>

    <script src="js/vendor/ng-infinite-scroll.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ng-dialog/0.2.3/js/ngDialog.min.js"></script>

    <script src="js/controllers/imageCtrl.js"></script>
    <script src="js/directives/imageDirectives.js"> </script>
    <script src="js/app.js"></script>
</body>
</html>