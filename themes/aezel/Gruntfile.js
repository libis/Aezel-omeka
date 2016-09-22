module.exports = function(grunt) {

   // Project configuration.
   grunt.initConfig({
     pkg: grunt.file.readJSON('package.json'),
    // CONFIG ===================================/
    watch: {
       compass: {
         files: ['**/*.{scss,sass}'],
         tasks: ['compass:dev']
       }
       //js: {
        //files: ['javascripts/**/*.js'],
       //  tasks: ['uglify']
       //}*/
    },

    compass: {
       dev: {
         options: {              
            sassDir: ['sass'],
            cssDir: ['css'],
            environment: 'development'
         }
       },
       prod: {
         options: {              
            sassDir: ['sass'],
            cssDir: ['css'],
            environment: 'production'
         }
       }
    },
    /*uglify: {
      all: {
        files: {
            'javascripts/min/main.min.js': [
            'javascripts/libs/jquery.js', 
            'javascripts/main.js'
            ]
        }
      },
    },*/
	
   });
 
  // DEPENDENT PLUGINS =========================/
 
   grunt.loadNpmTasks('grunt-contrib-watch');
   grunt.loadNpmTasks('grunt-contrib-compass');
   //grunt.loadNpmTasks('grunt-contrib-uglify');
 
   // TASKS =====================================/
 
   grunt.registerTask('default', ['compass:dev' , 'watch']);
 
};
