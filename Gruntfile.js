module.exports = function(grunt) {
  grunt.initConfig({
    jshint: {
      options: {
        esversion: 6
      },
      jsFiles: ['web/assets/script.js']
    },
    clean: ['web/dist/*'],
    copy: {
      main: {
        expand: true,
        cwd: 'web/assets',
        src: ['*.css', '*.js'],
        dest: 'web/dist/'
      }
    },
    assets_versioning: {
      options: {
        versionsMapFile: 'build/file-map.json',
        versionsMapTrimPath: 'web/'
      },
      main: {
        options: {
          tasks: ['cssmin:build', 'uglify:build']
        }
      }
    },
    cssmin: {
      options: {
        sourceMap: true
      },
      build: {
        files: {
          'web/dist/styles.min.css': ['web/dist/reset.css', 'web/dist/style.css']
        }
      }
    },
    uglify: {
      options: {
        sourceMap: true
      },
      build: {
        files: {
          'web/dist/script.min.js': 'web/dist/script.js'
        }
      }
    },
    'regex-replace': {
      main: {
        src: ['web/dist/*.css.map'],
        actions: [
          {
            name: 'fixmapsources',
            search: /web(?:\/|\\\\)dist(?:\/|\\\\)/g,
            replace: ''
          }
        ]
      }
    }
  });

  // load grunt plugins
  grunt.loadNpmTasks('grunt-assets-versioning');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify-es');
  grunt.loadNpmTasks('grunt-regex-replace');

  // Default tasks.
  grunt.registerTask('default', ['jshint', 'clean', 'copy', 'assets_versioning', 'regex-replace']);
};
