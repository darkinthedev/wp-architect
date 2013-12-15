module.exports = function(grunt) {

  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks("grunt-modernizr");
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-compass');

  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
        uglify: {
          options: {
            banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
          },
          build: {
            src: ['library/js/plugins.js', 'library/js/script.js', 'library/js/mylibs/*.js'],
            dest: 'library/build/js/site.min.js'
          }
        },

        compass: {
          dev: {
            options: {
              config: 'config.rb'
            }
          }
        },

        // Image Minification 
        // Ref: http://blog.grayghostvisuals.com/grunt/image-optimization/
        imagemin: {
            // png
            png: {
              options: {
                optimizationLevel: 7
              },
              files: [
                {
                  // Set to true to enable the following options…
                  expand: true,
                  // cwd is 'current working directory'
                  cwd: 'library/img/',
                  src: ['**/*.png'],
                  // Could also match cwd line above. i.e. project-directory/img/
                  dest: 'library/img/',
                  ext: '.png'
                }
              ]
            },
            // gif
            gif: {
              options: {
                interlaced: true
              },
              files: [
                {
                  // Set to true to enable the following options…
                  expand: true,
                  // cwd is 'current working directory'
                  cwd: 'library/img/',
                  src: ['**/*.gif'],
                  // Could also match cwd line above. i.e. project-directory/img/
                  dest: 'library/img/',
                  ext: '.gif'
                }
              ]
            },
            // jpg
            jpg: {
              options: {
                progressive: true
              },
              files: [
                {
                  // Set to true to enable the following options…
                  expand: true,
                  // cwd is 'current working directory'
                  cwd: 'library/img/',
                  src: ['**/*.jpg'],
                  // Could also match cwd. i.e. project-directory/img/
                  dest: 'library/img/',
                  ext: '.jpg'
                }
              ]
            }
          },

        modernizr: {

            // [REQUIRED] Path to the build you're using for development.
            "devFile" : "library/pack/modernizr/modernizr.js",

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
            "files" : ['library/scss/*.scss', 'library/js/*.js' ],

            // When parseFiles = true, matchCommunityTests = true will attempt to
            // match user-contributed tests.
            "matchCommunityTests" : false,
        },
        
        // Watch Task
        watch: {
          
          options: {
            livereload: true
          },

          // watch for html and php files
            html: {
            files: ['*.html', '*.php']
          },

          // watch for scss files
          sass: {
            files: ['library/scss/*.scss','library/scss/vendor/*.scss'],
            tasks: ['compass:dev'],
          },

          // watch for js files 
          js: {
            files: ['library/js/**/*.js'],
            tasks: ['uglify']
          },

          // watch for image files 
          img: {
            files: ['library/img/*.jpg','library/img/*.png'],
            tasks: ['imagemin']
          },
        }
  });
  
  // Running grunt command starts 'watch' task and waits for changes
  grunt.registerTask('default', 'watch');

};
