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

                var jumbotron       = elem.get(0);
                var startAll        = elem.find('.start');
                var previews        = elem.find('#previews');
                var totalProgress   = elem.find('#total-progress');
                var progressBar     = elem.find('#total-progress .progress-bar');

                var previewNode     = elem.find('#template').get(0);
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
                    acceptedFiles: 'image/*, .jpg, .jpeg, .gif, .png',
                    maxFilesize: 2
                });

                myDropzone.on('addedfile', function(file) {
                    startAll.removeAttr('disabled');
                    $(file.previewElement).find('.start-single').on('click', function() {
                        myDropzone.processFile(file);
                    });
                });

                myDropzone.on('removedfile', function(file) {
                    // if there's no files in the preview box now, then disable the upload all button
                   if (previews.children().length < 1) {
                       startAll.attr('disabled', 'disabled');
                   }
                });

                // Update the total progress bar
                myDropzone.on('uploadprogress', function(file, progress) {
                    progressBar.css('width', progress + '%');
                });

                myDropzone.on('sending', function(file) {
                    // Show the total progress bar when upload starts
                    totalProgress.css('opacity', '1');
                    // And disable the start button
                    $(file.previewElement).find('.start-single').attr('disabled', 'disabled');
                });

                // Hide the total progress bar when nothing's uploading anymore
                myDropzone.on('queuecomplete', function(progress) {
                    startAll.attr('disabled', 'disabled');
                    totalProgress.css('opacity', '0');
                });

                myDropzone.on('success', function(file, image) {
                    scope.images.unshift(image);

                    //trigger animations to hide the file row and the total progress bar
                    timer(function() {
                        $(file.previewElement).fadeOut('slow');
                    }, 2000);

                    //only reset the width once the bar is completely hidden to avoid jarring visuals
                    totalProgress.fadeOut(400, function() {
                        progressBar.css('width', '0%');
                    });
                });

                // Setup the buttons for all transfers
                // The "add files" button doesn't need to be setup because the config
                // `clickable` has already been specified.
                startAll.on('click', function() {
                    myDropzone.processQueue(myDropzone.getQueuedFiles());
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