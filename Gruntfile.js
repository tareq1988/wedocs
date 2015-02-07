'use strict';
module.exports = function(grunt) {

    grunt.initConfig({
        // Generate POT files.
        makepot: {
            target: {
                options: {
                    domainPath: '/languages/', // Where to save the POT file.
                    potFilename: 'wedocs.pot', // Name of the POT file.
                    type: 'wp-theme', // Type of project (wp-plugin or wp-theme).
                    potHeaders: {
                        'report-msgid-bugs-to': 'https://github.com/tareq1988/wedocs/issues',
                        'language-team': 'LANGUAGE <EMAIL@ADDRESS>'
                    }
                }
            }
        }
    });

    // Load NPM tasks to be used here
    grunt.loadNpmTasks( 'grunt-wp-i18n' );
};