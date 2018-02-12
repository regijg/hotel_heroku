/**
 *  Gobo Main
 *  This is main of Require Configuration
 *
 *  author :
 *  - Regi JG
 */
require.config({
    baseUrl: baseURL+'/tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    shim : {
        "bootstrap"                 	: { "deps" :['jquery'] },
        "tweenmax"                  : { "deps" :['jquery'] },
        "jquery.ui"                  : { "deps" :['jquery'] },
        "jquery.validate"                      : { "deps" :['jquery'] },
        "joinable"                      : { "deps" :['bootstrap'] },
        "neon.api"                        : { "deps" :['bootstrap'] },
        "neon.login"                        : { "deps" :['bootstrap'] },
        // "neon.custom"                        : { "deps" :['bootstrap'] },
        "neon.demo"                        : { "deps" :['bootstrap'] },
        "httpcon"                    	: { "deps" :['jquery'] },
        "fv"        							    : { "deps" :['jquery'] },
        "fvbs"        						    : { "deps" :['fv'] },
    },
    paths: {
        "jquery"              : 'assets/mainlogin/js/jquery-1.11.3.min',
        "tweenmax"            : 'assets/mainlogin/js/TweenMax.min',
        "jquery.ui"           : 'assets/mainlogin/js/jquery-ui-1.10.3.minimal.min',
        "bootstrap"           : 'assets/mainlogin/js/bootstrap.min',
        "joinable"            : 'assets/mainlogin/js/joinable',
        "resizeable"          : 'assets/mainlogin/js/resizeable',
        "neon.api"            : 'assets/mainlogin/js/neon-api',
        "jquery.validate"     : 'assets/mainlogin/js/jquery.validate.min',
        "neon.login"				  : 'assets/mainlogin/js/neon-login',
        // "neon.custom"					: 'assets/js/neon-custom',
        "neon.demo"					  : 'assets/mainlogin/js/neon-demo',
        "tpllogin"							: 'js/page/tpllogin',
        "httpcon"    					: 'js/connection',
        "base64"    					: 'js/base64',
        "fv"    							: 'assets/mainlogin/js/formValidation/formValidation',
        "fvbs"    						: 'assets/mainlogin/js/formValidation/bootstrap',
        "slc2"    						: 'assets/mainlogin/js/select2.min',
        "pn"    							: 'assets/mainlogin/js/pnotify.custom.min',
        "daterg"							: 'assets/mainlogin/js/daterangepicker',
        "moment"						  : 'assets/mainlogin/js/moment',
        "type"								: 'assets/mainlogin/js/typeahead.bundle',
        // "nf"									: 'assets/mainlogin/js/numberformat',
    }
});

require([
], function() {});
