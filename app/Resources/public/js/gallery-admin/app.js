/**
 * Gallery Admin
 */
(function () {
    'use strict';

    var module = angular.module('galleryAdmin', [
        'angularFileUpload'
    ]);

    module.directive('gallerySlideshowForm', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                templateUrl: App.basePath + 'angular/src/gallery-admin/views/slideshow-form.html',
                scope: {
                    pages: '='
                },
                controller: function () {
                    this.pages = [];

                    this.addPage = function () {
                        var page = {
                            disposition: 'unique',
                            primary: null,
                            secondary: null
                        };

                        this.pages.push(page);
                    };

                    this.deletePage = function (page) {
                        var index = this.pages.indexOf(page);
                        if (-1 !== index) {
                            this.pages.splice(index, 1);
                        }
                    };
                },
                link: function (scope, element, attrs, ctrl) {
                    ctrl.pages = scope.pages;

                    scope.addPage = function () {
                        ctrl.addPage();
                    }
                }
            }
        }
    ]);

    module.directive('galleryPageForm', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                require: ['^gallerySlideshowForm', 'galleryPageForm'],
                templateUrl: App.basePath + 'angular/src/gallery-admin/views/page-form.html',
                scope: {
                    page: '='
                },
                controller: function () {
                    this.page = {};

                    this.changeDisposition = function (disposition) {
                        this.page.disposition = disposition;
                    };
                },
                link: function (scope, element, attrs, ctrls) {
                    var parentCtrl = ctrls[0];
                    var ctrl       = ctrls[1];

                    ctrl.page = scope.page;

                    scope.uploader = ctrl.uploader;

                    scope.deletePage = function () {
                        parentCtrl.deletePage(scope.page);
                    };

                    scope.changeDisposition = function (disposition) {
                        ctrl.changeDisposition(disposition);
                    }
                }
            };
        }
    ])
})();