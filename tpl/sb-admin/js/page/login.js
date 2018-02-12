/**
 *  BIXBUX
 *
 *  author :
 *  - RJG
 */

define([
  "jquery",
	"bootstrap",
  "tweenmax",
  "jquery.ui",
  "joinable",
  "neon.api",
  "jquery.validate",
  "neon.login",
  // "neon.custom",
  "neon.demo",
	"base64",
	"httpcon",
	"fv",
	"fvbs",
	"slc2",
	"daterg",
	"moment",
], function($, bs ) {

  var sitePage = baseURL+'login/';
  var wismaPage = baseURL+''

  //form validation
  validateFormTamu();

    	function validateFormTamu() {
        $('#form').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter username'
                        },
                    },
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'please enter password'
                        },
                    },
                },
            }
        }).on('err.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
        }).on('success.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            saveData();
        });
    	}

  window.saveData = function () {
      //alert('cekson');
     var url = 'login/auth';
     var postData = $("#form").serialize();
      OMAPS_POST_CONNECTION(url, postData, function(response){
        window.location.href = baseURL+'home';
      }, function(c, m) {
        alert(m);
      });
  }

  // window.registrasi = function () {
  //     //alert('cekson');
  //    var url = 'login/registrasi';
  //    var postData = $("#form").serialize();
  //     OMAPS_POST_CONNECTION(url, postData, function(response){
  //       window.location.href = 'login/registrasi';
  //     }, function(c, m) {
  //       alert(m);
  //     });
  // }

});
