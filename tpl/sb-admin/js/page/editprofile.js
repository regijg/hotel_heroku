/**
 *  WISMA
 *
 *  author :
 *  - RJG
 */

define([
  "jquery",
	"bootstrap",
  "app.min",
  "jquery.slimscroll.min",
  "demo",
	"base64",
	"jqgrid",
	"jqgrid-locale",
	"datepicker",
  "clockpicker",
  "sweetalert",
	"validation",
	"httpcon",
	"fv",
	"fvbs",
	"slc2",
	"daterg",
	"moment",
], function($, bs ) {

  var sitePage = baseURL+'edit_profile/'
	var formUser =  $('#form_edit_profile');

  $("#photo_file").on("change", function(){
        var files = !!this.files ? this.files : [];
        var fileInput = document.getElementById('photo_file');
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            // reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(e){ // set image data as background of div
                // $("#imagePreview").css("background-image", "url("+this.result+")");
                $('#imagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    });

    validateFormUser();
    function validateFormUser() {
          $('#form_edit_profile').formValidation({
              framework: 'bootstrap',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              err: {
                  // You can set it to popover
                  // The message then will be shown in Bootstrap popover
                  container: 'tooltip'
              },
              fields: {
                  username: {
                      validators: {
                          notEmpty: {
                              message: 'Username tidak boleh kosong'
                          },
                      },
                  },
                  // password2: {
                  //     validators: {
                  //         identical: {
                  //             field: 'password',
                  //             message: 'The password and its confirm are not the same'
                  //         }
                  //     }
                  // }
              }
          }).on('err.field.fv', function(e, data) {
            var $icon = data.element.data('fv.icon'),
              title = $icon.data('bs.tooltip').getTitle();

            // Destroy the old tooltip and create a new one positioned to the right
            $icon.tooltip('destroy').tooltip({
                html: true,
                placement: 'right',
                title: title,
                container: 'body'
            });
          }).on('success.form.fv', function(e) {
              e.preventDefault();
              saveDataUser();
          });
      }

      window.saveDataUser = function () {
        var url = sitePage + 'prosess_adding';
        var postData = $("#form_edit_profile").serialize();
        OMAPS_POST_CONNECTION(url, postData, function(response){
          var obj = $.parseJSON(response);
           if (obj.n == 'ss') {
             successNotif('Success!', obj.m);
             $('#form_edit_profile').load();
           } else {
             alert(obj.m);
           }
        },
        function(c,m) {
          alert(m);
        });
      }


      validateFormUserUpload();
      function validateFormUserUpload() {
            $('#form_edit_photo').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                	// photo_file: {
                  //       validators: {
                  //           notEmpty: {
                  //               message: 'Photo tidak boleh kosong'
                  //           },
                  //       }
                  //   },
                }
            }).on('err.field.fv', function(e, data) {
              // var $icon = data.element.data('fv.icon'),
              //   title = $icon.data('bs.tooltip').getTitle();
              //
              // // Destroy the old tooltip and create a new one positioned to the right
              // $icon.tooltip('destroy').tooltip({
              //     html: true,
              //     placement: 'right',
              //     title: title,
              //     container: 'body'
              // });
            }).on('success.form.fv', function(e) {
                e.preventDefault();
                uploadPhotoUser();
            });
        }

      window.uploadPhotoUser = function () {
        var url = sitePage + 'prosess_upload';
        // var postData = $("#form_user").serialize();
        OMAPS_AJAXSUBMIT_CONNECTION("#form_edit_photo", function(response){
          var obj = $.parseJSON(response);
           if (obj.n == 'ss') {
             successNotif('Success!', obj.m);
             window.location.href = '/edit_profile'
           } else {
             alert(obj.m);
           }
        },
        function(c,m) {
          alert(m);
        });
      }

});
