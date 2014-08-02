'use strict';

module.exports = function(grunt) {
    // Load all tasks
    require('load-grunt-tasks')(grunt);
    // Show elapsed time
    require('time-grunt')(grunt);

    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks("grunt-modernizr");
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-newer');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-svg2png');

    grunt.initConfig({
        // Clean Up
        clean: {
            build: {
                src: ["assets/css/dist","assets/js/dist"]
            }
        },

        svg2png: {
            all: {
                // specify files in array format with multiple src-dest mapping
                files: [
                    // rasterize all SVG files in "img" and its subdirectories to "img/png"
                    // { src: ['assets/img/**/*.svg'], dest: 'img/png/' },
                    // rasterize SVG file to same directory
                    { src: ['assets/img/*.svg'] }
                ]
            }
        },

        // Uglify/Minification for JS files
        uglify: {
            options: {
                banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
            },
            build: {
                src: ['assets/js/src/common/*.js'],
                dest: 'assets/js/dist/common.min.js'
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
                    cwd: 'assets/img/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'assets/img/'
                }]
            }
        },

        // Modernizr Grunt - custom modernizr build.
        modernizr: {
            build: {
                devFile: 'assets/vendor/modernizr/modernizr.js',
                outputFile: 'assets/js/dist/vendor/modernizr.min.js',
                files : {
                    'src' : [
                        ['assets/scss/*.scss'],
                        ['assets/scss/**/*.scss'],
                        ['assets/js/src/*.js'],
                        ['assets/js/src/**/*.js']
                    ]
                },
                uglify : true,
                parseFiles : true,
            }
        },

        // Minify CSS
        cssmin: {
            options: {
                banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
            },
            combine: {
                files: {
                  'assets/css/dist/dist.min.css': ['assets/css/src/*.css'],
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
                files: ['assets/img/*.svg'],
                tasks: ['svg2png'],
            },

            compass: {
                files: ['assets/scss/*.scss', 'assets/scss/**/*.scss'],
                tasks: ['compass:dev', 'newer:cssmin'],
            },

            js: {
                files: ['assets/js/src/*.js', 'assets/js/src/**/*.js'],
                tasks: ['newer:uglify']
            },
        }
    });

    // Register Tasks
    grunt.registerTask('default', [
        'clean:build',
        'uglify',
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
