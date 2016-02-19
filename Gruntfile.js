module.exports = function (grunt) {
    grunt.initConfig({
        distFolder: 'web/dist',

        // Concatenate JS task
        concat: {
            // Common options for all concatenate task
            options: {
                process: function(src, filepath) {
                    return '// File : ' + filepath + '\n' + src;
                }
            },

            // Publish libraries
            jquery: {
                src: [
                    'bower_components/jquery/dist/jquery.js',
                    'bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js'
                ],
                dest: '<%= distFolder %>/js/jquery.js'
            },

            jquery_min: {
                src: [
                    'bower_components/jquery/dist/jquery.min.js',
                    'bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'
                ],
                dest: '<%= distFolder %>/js/jquery.min.js'
            },

            bootstrap: {
                src: [
                    'bower_components/bootstrap/dist/js/bootstrap.js'
                ],
                dest: '<%= distFolder %>/js/bootstrap.js'
            },

            bootstrap_min: {
                src: [
                    'bower_components/bootstrap/dist/js/bootstrap.min.js'
                ],
                dest: '<%= distFolder %>/js/bootstrap.min.js'
            },

            angular: {
                src: [
                    'bower_components/angular/angular.js',
                    'bower_components/angular-sanitize/angular-sanitize.js',
                    'bower_components/ng-file-upload/ng-file-upload-shim.js',
                    'bower_components/ng-file-upload/ng-file-upload.js'
                ],
                dest: '<%= distFolder %>/js/lib.js'
            },

            angular_min: {
                src: [
                    'bower_components/angular/angular.min.js',
                    'bower_components/angular-sanitize/angular-sanitize.min.js',
                    'bower_components/ng-file-upload/ng-file-upload-shim.min.js',
                    'bower_components/ng-file-upload/ng-file-upload.min.js'
                ],
                dest: '<%= distFolder %>/js/lib.min.js'
            }
        },

        // Compile LESS files task
        less: {
            options: {
                compress: true,
                yuicompress: true,
                optimization: 2
            },

            app: {
                src: [
                    'app/Resources/theme/less/app.less'
                ],
                dest: '<%= distFolder %>/css/app.min.css'
            }
        },

        // Copy fonts & images in public directory
        copy: {
            app_images: {
                cwd: 'app/Resources/public/images',
                src: [
                    '**/*'
                ],
                dest: '<%= distFolder %>/images/',
                expand: true
            },

            app_font: {
                src: [
                    'app/Resources/theme/fonts/*'
                ],
                dest: '<%= distFolder %>/fonts/',
                expand: true,
                flatten: true,
                filter: 'isFile'
            },

            glyphicon: {
                src: [
                    'bower_components/bootstrap/fonts/*'
                ],
                dest: '<%= distFolder %>/fonts/',
                expand: true,
                flatten: true,
                filter: 'isFile'
            },

            font_awesome: {
                src: [
                    'bower_components/font-awesome/fonts/*'
                ],
                dest: '<%= distFolder %>/fonts/',
                expand: true,
                flatten: true,
                filter: 'isFile'
            }
        },

        // Watcher
        watch: {
            less: {
                files: [
                    'app/Resources/public/**/*',
                    'app/Resources/theme/**/*.less'
                ],
                tasks: [ 'build' ]
            }
        }
    });

    // Load Grunt task runners
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Register our own custom task alias.
    grunt.registerTask('build', ['copy', 'concat', 'less']);
};