angular.module('imageDirectives', [])
    .directive('imagesNavbar', function() {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/navbar.html'
        };
    })
    .directive('images', function(ngDialog) {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/images.html',
            link: function(scope, elem, attrs) {
                scope.open = function() {
                    ngDialog.open({
                        template: 'views/imageDialog.html',
                        className: 'ngdialog-theme-default',
                        scope: scope
                    });
                }
            }
        };
    })
    .directive('uploader', ['$timeout', function(timer) {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/uploader.html',
            link: function(scope, elem, attrs) {
                var jumbotron = elem.get(0);
                var previewNode = elem.find('#template').get(0);
                var previewTemplate = previewNode.parentNode.innerHTML;

                previewNode.id = '';
                previewNode.parentNode.removeChild(previewNode);

                var myDropzone = new Dropzone(jumbotron, {
                    url: '/upload',
                    thumbnailWidth: 80,
                    thumbnailHeight: 80,
                    parallelUploads: 20,
                    previewTemplate: previewTemplate,
                    autoProcessQueue: false,
                    previewsContainer: '#previews',
                    clickable: '.fileinput-button',
                    acceptedFiles: 'image/*, .jpg, .jpeg, .gif, .png'
                });

                myDropzone.on('addedfile', function(file) {
                    file.previewElement.querySelector('.start').onclick = function() {myDropzone.processQueue(file); };
                });

                // Update the total progress bar
                myDropzone.on("totaluploadprogress", function(progress) {
                    elem.find("#total-progress .progress-bar").get(0).style.width = progress + "%";
                });

                myDropzone.on("sending", function(file) {
                    // Show the total progress bar when upload starts
                    elem.find("#total-progress").get(0).style.opacity = "1";
                    // And disable the start button
                    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                });

                // Hide the total progress bar when nothing's uploading anymore
                myDropzone.on("queuecomplete", function(progress) {
                    elem.find("#total-progress").get(0).style.opacity = "0";
                });

                myDropzone.on('success', function(file, image) {
                    scope.images.push(image);
                    timer(function() {
                        elem.find('.file-row').fadeOut('slow');
                    }, 5000);
                })

                // Setup the buttons for all transfers
                // The "add files" button doesn't need to be setup because the config
                // `clickable` has already been specified.
                elem.find('#actions .start').on('click', function() {
                    myDropzone.processQueue(myDropzone.getQueuedFiles());
                });

                elem.find('#actions .cancel').on('click', function() {
                   myDropzone.removeAllFiles(true);
                });
            }
        };
    }])
    .directive('imagesFooter', function() {
        return {
            restrict: 'E',
            replace: 'true',
            templateUrl: 'views/footer.html'
        };
    });