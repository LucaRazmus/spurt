module.exports = function (grunt) {
    'use strict';

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            dist: {
                options: {
                    noCache: true,
                    lineNumbers: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'vendor/twbs/bootstrap/scss',
                        src: ['*.scss'],
                        dest: 'public/dist/css/bootstrap',
                        ext: '.css'
                    },
                    {
                        expand: true,
                        cwd: 'public/scss',
                        src: ['*.scss'],
                        dest: 'public/dist/css/app',
                        ext: '.css'
                    }
                ]
            }
        },

        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'public/dist/css/<%= pkg.name %>.min.css': [
                        'public/dist/css/bootstrap/*.css',
                        'public/dist/css/octicons/*.css',
                        'public/dist/css/app/*.css',
                    ]
                }
            }
        },

        concat: {
            options: {
                // define a string to put between each file in the concatenated output
                separator: ';'
            },
            dist: {
                // the files to concatenate
                src: [
                    'vendor/components/jquery/jquery.js',
                    'vendor/twbs/bootstrap/js/src/dist/*.js',
                ],
                // the location of the resulting JS file
                dest: 'public/dist/js/<%= pkg.name %>.js'
            }
        },

        uglify: {
            options: {
                mangle: false,
                sourceMap: true,
                sourceMapName: 'public/dist/js/<%= pkg.name %>.map'
            },
            js: {
                files: {
                    'public/dist/js/<%= pkg.name %>.min.js': ['public/dist/js/<%= pkg.name %>.js'],
                }
            }
        },

        // Watch
        watch: {
            css: {
                files: [
                    //'vendor/components/jquery/jquery.js',
                    //'vendor/twbs/bootstrap/js/src/dist/*.js',
                    'public/assets/*.js',
                    'vendor/twbs/bootstrap/scss/*.scss',
                    'scss/*.scss'
                ],
                tasks: ['sass', 'concat'],
                options: {
                    spawn: false
                }
            }
        }
    });

    grunt.registerTask('dev', ['watch']);
    grunt.registerTask('prod', ['sass', 'concat', 'cssmin', 'uglify']);
};