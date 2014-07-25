'use strict';

module.exports = function(grunt) {

    // measures the time each task takes
    require('time-grunt')(grunt);

    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks("grunt-modernizr");
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-newer');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-svg2png');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Clean Up
        clean: {
            build: {
                src: ["library/css/dist","library/js/dist"]
            }
        },

        svg2png: {
            all: {
                // specify files in array format with multiple src-dest mapping
                files: [
                    // rasterize all SVG files in "img" and its subdirectories to "img/png"
                    // { src: ['library/img/**/*.svg'], dest: 'img/png/' },
                    // rasterize SVG file to same directory
                    { src: ['library/img/*.svg'] }
                ]
            }
        },

        copy: {
            // Copy normalize from bower into src folder
            normalize: {
                cwd: 'bower_components/normalize-css/',
                src: 'normalize.css',
                dest: 'library/css/src/',
                filter: 'isFile',
                expand: true
            }
        },

        // Uglify/Minification for JS files
        uglify: {
            options: {
                banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
            },
            build: {
                src: ['library/js/src/common/*.js'],
                dest: 'library/js/dist/common.min.js'
            }
        },

        // Compass grunt see config.rb
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
                    dest: 'library/img/'
                }]
            }
        },

        // Modernizr Grunt - custom modernizr build.
        modernizr: {

            dist: {

                // [REQUIRED] Path to the build you're using for development.
                "devFile" : "bower_components/modernizr/modernizr.js",

                // [REQUIRED] Path to save out the built file.
                "outputFile" : "library/js/dist/modernizr-custom.min.js",

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
                    "src" : ['library/scss/*.scss', 'library/scss/**/*.scss', 'library/js/src/*.js' ,'library/js/src/**/*.js' ]
                },

                // When parseFiles = true, matchCommunityTests = true will attempt to
                // match user-contributed tests.
                "matchCommunityTests" : false,
            }
        },

        // Minify CSS
        cssmin: {
            options: {
                banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
            },
            combine: {
                files: {
                  'library/css/dist/dist.min.css': ['library/css/src/*.css'],
                },
            },
        },

        // Watch Task
        watch: {

            options: {
                livereload: true
            },

            html: {
                files: ['*.html', '*.php', 'library/**/*.php']
            },

            img: {
                files: ['library/img/*.svg'],
                tasks: ['svg2png'],
            },

            compass: {
                files: ['library/scss/*.scss', 'library/scss/**/*.scss'],
                tasks: ['compass:dev', 'newer:cssmin'],
            },

            js: {
                files: ['library/js/src/*.js', 'library/js/src/**/*.js'],
                tasks: ['newer:uglify']
            },
        }
    });

    // Register Tasks
    grunt.registerTask('default', [
        'clean:build',
        'uglify',
        'copy:normalize',
        'modernizr',
        'compass',
        'newer:imagemin',
        'newer:cssmin',
        'newer:svg2png'
    ]);

    grunt.registerTask('dev', [
        'watch'
    ]);
};
