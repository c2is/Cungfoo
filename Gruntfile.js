/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    watch: {
      less: {
        files: 'web/css/vacancesdirectes/*.less',
        tasks: ['mincss']
      },
      js: {
        files: ['web/js/vacancesdirectes/*.js', '!web/js/vacancesdirectes/*.min.js'],
        tasks: ['minjs']
      }
    },
    uglify: {
          pluginGmap: {
        files: { 'web/js/vacancesdirectes/pluginGmap.min.js': 'web/js/vacancesdirectes/pluginGmap.js' }
      },
      compte: {
        files: { 'web/js/vacancesdirectes/compte.min.js': 'web/js/vacancesdirectes/compte.js' }
          },
      couloir: {
          files: { 'web/js/vacancesdirectes/couloir.min.js': 'web/js/vacancesdirectes/couloir.js' }
      },
      date: {
        files: { 'web/js/vacancesdirectes/date.min.js': 'web/js/vacancesdirectes/date.js' }
      },
      iframe: {
        files: { 'web/js/vacancesdirectes/iframe.min.js': 'web/js/vacancesdirectes/iframe.js' }
      },
      front: {
        files: { 'web/js/vacancesdirectes/plugFront.min.js': ['web/js/vacancesdirectes/plugins.js', 'web/js/vacancesdirectes/front.js', 'web/js/vacancesdirectes/searchSelectChange.js']}
      },
      brochure: {
        files: { 'web/js/vacancesdirectes/brochure.min.js':  'web/js/vacancesdirectes/brochure.js' }
      }
    },

    less: {
      screen: {
        options: {
          paths: ["web/css/vacancesdirectes"], compress: true, yuicompress: true
        },
        files: {
		  'web/css/vacancesdirectes/couloir_de.css': 'web/css/vacancesdirectes/couloir_de.less',
          'web/css/vacancesdirectes/couloir.css': 'web/css/vacancesdirectes/couloir.less',
          'web/css/vacancesdirectes/payment.css': 'web/css/vacancesdirectes/payment.less',
          'web/css/vacancesdirectes/compte.css': 'web/css/vacancesdirectes/compte.less',
          'web/css/vacancesdirectes/screen.css': 'web/css/vacancesdirectes/screen.less',
          'web/css/vacancesdirectes/screen_de.css': 'web/css/vacancesdirectes/screen_de.less',
          'web/css/vacancesdirectes/screen_nl.css': 'web/css/vacancesdirectes/screen_nl.less'
        }
      },
      iframe: {
        options: {
          paths: ["web/css/vacancesdirectes"], compress: true, yuicompress: true
        },
        files: {
          'web/css/vacancesdirectes/iframe.css': 'web/css/vacancesdirectes/iframe.less'
        }
      }
    }
  });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('default', ['less','uglify']);
    grunt.registerTask('minjs', ['uglify']);
    grunt.registerTask('mincss', 'less');
};
