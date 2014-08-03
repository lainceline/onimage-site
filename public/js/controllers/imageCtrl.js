angular.module('imageCtrl', [])
    .controller('ImageController', function($scope, $http) {
        //Commenting out the infinite scroll stuff until I figure out how to make this work with searching
/*
        $scope.counter = 1;

        var imagePromise = $http.get('/images/' + $scope.counter);

        imagePromise
            .success(function(data, status, headers, config) {
                console.log(data);
                $scope.images = data.data;
                $scope.lastPage = data.last_page;
            })
            .error(function(data, status, headers, config) {
                console.log(status);
            });

        $scope.loadMore = function() {

            if ($scope.counter >= $scope.lastPage) {
                return;
            }

            $scope.counter++;

            var imagePromise = $http.get('/images/' + $scope.counter);

            imagePromise
                .success(function(data, status, headers, config) {
                   $scope.images = $scope.images.concat(data.data);
                })
                .error(function(data, status, headers, config) {
                    console.log(status);
                });
        }
*/

        var imagePromise = $http.get('/images');

        imagePromise
            .success(function(data, status, headers, config) {
                $scope.images = data;
            })
            .error(function(data, status, headers, config) {
                console.log(status);
            });
    });