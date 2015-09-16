'use strict';
module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        watch: {
            options: {
                livereload: true,
            },
            sass: {
                files: ['assets/styles/**/*.{scss,sass}'],
                tasks: ['sass', 'autoprefixer', 'cssmin']
            },
            svgstore: {
                files: ['assets/images/svg/**/*.svg'],
                tasks: ['svgstore','svg2png']
            },
            js: {
                files: ['assets/js/**/*.js'],
                tasks: ['uglify']
            }
        },

        sass: {
            dist: {
                options: {
                    style: 'expanded',
                },
                files: {
                    'assets/styles/build/style.css': 'assets/styles/style.scss',
                    'assets/styles/build/style-lte-ie9.css': 'assets/styles/style-lte-ie9.scss',
                    'assets/styles/build/style-admin.css': 'assets/styles/style-admin.scss',
                    'assets/styles/build/style-editor.css': 'assets/styles/style-editor.scss'
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'],
                map: true
            },
            files: {
                expand: true,
                flatten: true,
                src: 'assets/styles/build/*.css',
                dest: 'assets/styles/build'
            },
        },

        cssmin: {
            options: {
                keepSpecialComments: 1
            },
            minify: {
                expand: true,
                cwd: 'assets/styles/build',
                src: ['*.css', '!*.min.css'],
                ext: '.css'
            }
        },

        uglify: {
            plugins: {
                options: {
                    sourceMap: 'assets/js/plugins.js.map',
                    sourceMappingURL: 'plugins.js.map',
                    sourceMapPrefix: 2
                },
                files: {
                    'assets/js/plugins.min.js': [
                        'assets/js/source/plugins.js',
                        'assets/js/vendor/navigation.js',
                        'assets/js/vendor/skip-link-focus-fix.js',
                        // 'assets/js/vendor/yourplugin/yourplugin.js',
                    ]
                }
            },
            main: {
                options: {
                    sourceMap: 'assets/js/main.js.map',
                    sourceMappingURL: 'main.js.map',
                    sourceMapPrefix: 2
                },
                files: {
                    'assets/js/main.min.js': [
                        'assets/js/source/main.js'
                    ]
                }
            }
        },

        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 7,
                    progressive: true,
                    interlaced: true
                },
                files: [{
                    expand: true,
                    cwd: 'assets/images/',
                    src: ['**/*.{png,jpg,gif,svg}'],
                    dest: 'assets/images/'
                }]
            }
        },

        svgstore: {
            options: {
                prefix : 'def-',
                svg: {
                    style : 'display: none'
                }
            },
            default : {
                files: {
                    'assets/images/defs.svg': ['assets/images/svg/**/*.svg'],
                },
            },
        },

        svg2png: {
            all: {
                files: [
                    { cwd: 'assets/images/svg/', src: ['**/*.svg'], dest: 'assets/images/svg/fallback/' }
                ]
            }
        }

    });

    grunt.registerTask('default',
        ['sass', 'autoprefixer', 'cssmin', 'uglify', 'watch']
    );

    grunt.registerTask('svg',
        ['svgstore', 'svg2png']
    );

};
