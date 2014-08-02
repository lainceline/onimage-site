angular.module('imageCtrl', [])
    .controller('ImageController', function($scope, $http) {

        var imagePromise = $http.get('/images');

        imagePromise
            .success(function(data, status, headers, config) {
                $scope.images = data;
            })
            .error(function(data, status, headers, config) {
                console.log(status);
            });

       // $scope.imageRow = [];
        //$scope.counter = 1;

        //New plan.  Download all the images at once and partition them into the rows in the beginning
        //loadMore will then pop them into the model
        //But how will we handle dynamically loading uploads?
        //Well, we'll add it onto the end of a row...maybe...
        //Maybe i should switch to the non-row approach Robert suggested...
        $scope.loadMore = function() {
/*
            var last = $scope.imageRow.length - 1;

               if (last < 0) {
                   last = 0;
               }

               //Get the next 12 images
               var imagePromise = $http.get('/images/12');

               imagePromise
                   .success(function(data, status, headers, config) {
                       console.log(data);
                       for (var i = 1; i <= 3; i++) {
                           $scope.imageRow.push(last + i);
                           $scope.imageRow[last+ i] = data.slice($scope.counter - 1, $scope.counter + 2);
                           $scope.counter += 3;
                       }
                   })
                   .error(function(data, status, headers, config) {
                       console.log(status);
                   });
                   */
           }
    });