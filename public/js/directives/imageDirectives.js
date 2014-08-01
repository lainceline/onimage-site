angular.module('imageDirectives', [])
    .directive('imagesNavbar', function() {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/navbar.html'
        };
    })
    .directive('images', function() {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/images.html'
        };
    })
    .directive('uploader', function() {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/uploader.html'
        };
    })
    .directive('imagesFooter', function() {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/footer.html'
        };
    });