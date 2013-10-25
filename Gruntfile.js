module.exports = function(grunt) {

  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
        uglify: {
          options: {
            banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
          },
          build: {
            src: 'library/js/**/*.js',
            dest: 'library/build/js/site.min.js'
          }
        },

    sass: {
        dist: {
          files: {
            'library/build/css/style.css': 'library/scss/style.scss' // destination : source
          },
        },
        options: {                       
        style: 'compressed'   //Output style. Can be nested (default), compact, compressed, or expanded.
      },
      },

    imagemin: {                          // Task
      options: {                       // Target options
        optimizationLevel: 3,
        progressive: true
      },
      files: {                         // Dictionary of files
        'library/img/*.png': 'library/img/*.png', // 'destination': 'source'
        'library/img/*.jpg': 'library/img/*.jpg'
      },
    },
  
    watch: {
      
      js: {
        files: ['library/js/**/*.js'],
        tasks: ['uglify']
      },

      sass: {
        files: ['library/scss/*.scss'],
        tasks: ['sass']
      },

      // watch for image files 
      
      img: {
        files: ['library/img/*.jpg','library/img/*.png'],
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

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default' , ['imagemin', 'sass', 'watch', 'uglify']);

}