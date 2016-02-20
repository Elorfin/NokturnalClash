angular
    .module('gallery', [])
    .directive('photoSlideshow', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                templateUrl: '../bundles/app/Gallery/views/photo-slideshow.html',
                scope: {
                    photos: '='
                },
                link: function (scope, element, attrs) {
                    scope.current = null;
                    scope.currentIndex = 0;

                    scope.buttons = {
                        previous: false,
                        next:     false
                    };

                    // Get the first photo on load
                    if (scope.photos && scope.photos.length !== 0) {
                        scope.current = scope.photos[0];
                    }

                    scope.next = function () {
                        if (scope.currentIndex + 1 < scope.photos.length) {
                            scope.currentIndex++;
                        }
                    };

                    scope.previous = function () {
                        if (0 < scope.currentIndex) {
                            scope.currentIndex--;
                        }
                    };

                    scope.getPhoto = function (index) {
                        var photo = null;
                        if (scope.photos && scope.photos[index]) {
                            photo = App.basePath + '/upload/' + scope.photos[index].path;
                        }

                        return {
                            path: photo
                        };
                    };

                    scope.toggleButtons = function () {
                        scope.buttons.previous = 0 < scope.currentIndex;
                        scope.buttons.next     = scope.photos.length > scope.currentIndex + 1;
                    };

                    scope.$watch('currentIndex', function (newValue) {
                        scope.current = scope.getPhoto(newValue);

                        scope.toggleButtons();
                    });
                }
            }
        }
    ]);