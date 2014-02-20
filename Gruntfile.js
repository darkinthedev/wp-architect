'use strict';

module.exports = function(grunt) {

    // measures the time each task takes
    require('time-grunt')(grunt);

    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks("grunt-modernizr");
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-newer');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Clean Build Folder
        clean: {
            build: {
                src: ["library/build"]
            }
        },

        // Uglify/Minification for JS files
        uglify: {
            options: {
                banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
            },
            build: {
                src: ['library/js/plugins.js', 'library/js/script.js', 'library/js/mylibs/*.js'],
                dest: 'library/build/js/site.min.js'
            }
        },

        // CSS.min
        cssmin: {
            minify: {
            expand: true,
            cwd: 'library/bower_components/normalize-css/',
            src: ['*.css', '!*.min.css'],
            dest: 'library/scss/vendor/',
            ext: '.scss'
            }
        },

        // Compass grunt – see config.rb
        compass: {
            dev: {
                options: {
                config: 'config.rb'
                }
            }
        },

        // Image Minification 
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'library/img/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'library/build/img'
                }]
            }
        },

        // Modernizr Grunt - custom modernizr build. 
        modernizr: {

            dist: {

                // [REQUIRED] Path to the build you're using for development.
                "devFile" : "library/bower_components/modernizr/modernizr.js",

                // [REQUIRED] Path to save out the built file.
                "outputFile" : "library/build/js/libs/modernizr-custom.js",

                // Based on default settings on http://modernizr.com/download/
                "extra" : {
                    "shiv" : true,
                    "printshiv" : false,
                    "load" : true,
                    "mq" : false,
                    "cssclasses" : true
                },

                // Based on default settings on http://modernizr.com/download/
                "extensibility" : {
                    "addtest" : false,
                    "prefixed" : false,
                    "teststyles" : false,
                    "testprops" : false,
                    "testallprops" : false,
                    "hasevents" : false,
                    "prefixes" : false,
                    "domprefixes" : false
                },

                // By default, source is uglified before saving
                "uglify" : true,

                // By default, this task will crawl your project for references to Modernizr tests.
                // Set to false to disable.
                "parseFiles" : true,

                // When parseFiles = true, this task will crawl all *.js, *.css, *.scss files, except files that are in node_modules/.
                // You can override this by defining a "files" array below.
                "files" : {
                    "src" : ['library/scss/*.scss', 'library/scss/**/*.scss', 'library/js/*.js' ]
                },

                // When parseFiles = true, matchCommunityTests = true will attempt to
                // match user-contributed tests.
                "matchCommunityTests" : false,
            }
        },

        // Watch Task
        watch: {

            options: {
                livereload: true
            },
            
            html: {
                files: ['*.html', '*.php']
            },
            
            compass: {
                files: ['library/scss/*.scss', 'library/scss/vendor/**/*.scss', 'library/scss/vendor/*.scss'],
                tasks: ['compass:dev'],
            },
            
            js: {
                files: ['library/js/**/*.js'],
                tasks: ['newer:uglify']
            },
        }
    });

    // Register Tasks
    grunt.registerTask('default', [
        'clean',
        'uglify',
        'modernizr',
        'compass',
        'cssmin',
        'imagemin'
    ]);

    grunt.registerTask('dev', [
        'watch'
    ]);
};
