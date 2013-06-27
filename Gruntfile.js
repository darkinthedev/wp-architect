module.exports = function(grunt) {

  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({
    sass: {
        dist: {
          files: {
            'library/css/style.css': 'library/scss/style.scss' // destination : source
          },
        },
        options: {                       
        style: 'compact'   //Output style. Can be nested (default), compact, compressed, or expanded.
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
        files: ['*.html', '*.php', 'library/css/style.css'],
        options: {
          livereload: true
        },
      },
    }

  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-imagemin');

  grunt.registerTask('default', 'imagemin');
  grunt.registerTask('default', 'sass');
  grunt.registerTask('default', 'watch');



}