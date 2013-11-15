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

        imagemin: {                          // Task
          options: {                       // Target options
            optimizationLevel: 3,
            progressive: true
          },
          files: {                         // Dictionary of files
            'library/build/img/*.png': 'library/img/*.png', // 'destination': 'source'
            'library/build/img/*.jpg': 'library/img/*.jpg'
          },
        },

        modernizr: {

            // [REQUIRED] Path to the build you're using for development.
            "devFile" : "library/js/libs/modernizr-2.0.6.min.js",

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
      
        watch: {
          
          sass: {
            files: ['library/scss/**/*.scss'],
            tasks: ['compass:dev']
          },

          js: {
            files: ['library/js/**/*.js'],
            tasks: ['uglify']
          },

          // watch for image files 
          
          img: {
            files: ['library/build/img/*.jpg','library/build/img/*.png'],
            tasks: ['imagemin']
          },

          // watch our files for change, reload

          livereload: {
            files: ['*.html', '*.php', 'library/build/css/style.css'],
            options: {
              livereload: true
            },
          },
        }
  });

  grunt.registerTask('default', ['imagemin', 'compass', 'watch', 'uglify', 'modernizr']);

}
