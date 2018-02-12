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

  var sitePage = baseURL+'user/'
	var formUser =  $('#form_user');

	var colModel =  [
		{
			label: " ",
	        name: "actions",
        	width: 40,
	        formatter: formatAction,
	        colmenu : false,
	        align: 'center'
        },
		    {
        	label: 'Nama',
        	name: 'first_name',
        	width: 70,
        	index: 'first_name',
          formatter: formatFirstName,
        	ignoreCase: true
        },
		    {
        	label: 'Alamat',
        	name: 'alamat',
        	index: 'alamat',
        	ignoreCase: true
        },
		    {
        	label: 'Telpon',
        	name: 'telpon',
        	width: 55,
        	index: 'telpon',
        	ignoreCase: true
        },
		    {
        	label: 'Username',
        	name: 'username',
        	width: 55,
        	index: 'username',
        	ignoreCase: true
        },
        {
        	label: 'Email',
        	name: 'email',
        	width: 60,
        	index: 'email',
        	align: 'left'
        },
        {
        	label: 'Level',
        	name: 'group_id',
        	width: 70,
        	index: 'group_id',
          formatter: formatStatus,
        	align: 'left'
        }
    ];

    function formatStatus(cellValue, options, rowObject) {
          var group_id = (cellValue == '1') ? "MANAGER" : "" || (cellValue == '2') ? "RESEPSIONIST" : "" || (cellValue == '3') ? "ROOMBOY" : "" || (cellValue == '9999') ? "ADMINISTRATOR" : "";
          return group_id;

          if(cellvalue == 1){
             return '<span style="background-color: red; display: block; width: 100%; height: 100%; ">'+color+'</span>';
            }else{
             return cellvalue;
           }
    }

  function formatAction(cellValue, options, rowObject) {
		var id = rowObject.user_id;
		// var actionHtmlConfirmCancel = "<a title='' href='javascript:;' onclick='openEditPenjualan("+'"'+id+ '"'+");'  class='btn btn-xs btn-primary'>Confirm<a/> <a title='' href='javascript:;' onclick='cancelBooking("+'"'+id+ '"'+");'  class='btn btn-xs btn-danger'>Cancel<a/>";
    var actionHtmlTpl = "<a title='Edit' href='javascript:;' onclick='openEditUser("+'"'+id+ '"'+");' class='btn btn-xs'><i class='fa fa-pencil' style='color:#000000'></i><a/> <a title='Delete' href='javascript:;' onclick='removeUser("+'"'+id+ '"'+");'  class='btn btn-xs'><i class='fa fa-trash' style='color:#000000'></i><a/>";
    return actionHtmlTpl;
  }

  function formatPhoto(cellValue, options, rowObject) {
		var id = rowObject.user_id;
    var actionHtmlTpl = "<a title='Show' href='javascript:;' onclick='openEditUser("+'"'+id+ '"'+");' class='btn btn-xs btn-primary'>Image<a/>";
    return actionHtmlTpl;
  }

  function formatFirstName(cellValue, options, rowObject) {
		return cellvalue = rowObject.first_name + ' ' + rowObject.last_name;
  }

	$.jgrid.defaults.width = $('#grid').width();
	$.jgrid.defaults.height = 390;
	$.jgrid.styleUI.Bootstrap.base.headerTable = "table";
	$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-responsive";
	$(document).ready(function () {
        $("#jqGrid").jqGrid({
            url: baseURL+'user/list_data?callback=?&qwery=orders',
            mtype: "GET",
			      styleUI : 'Bootstrap',
            datatype: "jsonp",
            ignoreCase: true,
            colModel: colModel,
			      viewrecords: true,
            page: 1,
            toppager:true,
            scrollPopUp:true,
            rowNum: 10,
            colMenu : false,
            autowidth: true,
            shrinkToFit : true,
            multiselect: true,
            rownumbers: true,
            rownumWidth: 35,
            rowList:[25,50,100],
            viewrecords: true,
            hoverrows: true,
            sortorder:'asc',
            pager: "#jqGridPager",
        });
    });


    window.searchData = function(key) {
		$("#jqGrid").setGridParam({
			url: baseURL+'user/list_data?callback=?&qwery=orders&key='+key,
	        page:1
	    }).trigger("reloadGrid");
	};

  window.openFormRoom = function () {
      $("#imagePreview").css("background-image", "");
      $('#imagePreview').attr('src', './tpl/sb-admin/user-image/admin2.jpg');
      $('li > a[href="#dataUser"]').tab("show");
      $(".modal-title").html('Input User Data');
      $('#form_user').trigger('reset');
      formUser.data('formValidation').destroy();
      validateFormUser();
      // generateTable();
      $('#modal_form').modal('show');
  }

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

  // function readURL(input) {
  //     if (input.files && input.files[0]) {
  //           var reader = new FileReader();
  //           reader.onload = function (e) {
  //               $('#imagePreview').attr('src', e.target.result);
  //           }
  //           reader.readAsDataURL(input.files[0]);
  //       }
  //   }
  //
  //   $(document).ready(function() {
  //     $("#photo_file").change(function(){
  //         readURL(this);
  //     });
  //   });

    validateFormUser();
    function validateFormUser() {
          $('#form_user').formValidation({
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
              	group_id: {
                      validators: {
                          notEmpty: {
                              message: 'Level tidak boleh kosong'
                          },
                      }
                  },
                  username: {
                      validators: {
                          notEmpty: {
                              message: 'Username tidak boleh kosong'
                          },
                      },
                  },
                  password: {
                      validators: {
                          notEmpty: {
                              message: 'Password wajib diisi'
                          },
                      },
                  },
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
        // var postData = $("#form_user").serialize();
        OMAPS_AJAXSUBMIT_CONNECTION("#form_user", function(response){
          var obj = $.parseJSON(response);
           if (obj.n == 'ss') {
             successNotif('Success!', obj.m);
             $('#modal_form').modal('hide');
             $("#jqGrid").trigger("reloadGrid");
           } else {
             alert(obj.m);
           }
        },
        function(c,m) {
          alert(m);
        }
        );


         // OMAPS_AJAXSUBMIT_CONNECTION(tagID, postData, function(response){
         //   var obj = $.parseJSON(response);
         //   if (obj.n == 'ss') {
         //     successNotif('Success!', obj.m);
         //     $('#modal_form').modal('hide');
         //     $("#jqGrid").trigger("reloadGrid");
         //   } else {
         //     alert(obj.m);
         //   }
         // }, function(c, m) {
         //   alert(m);
         // });
      }

      // window.saveDataUser = function () {
      //   var postData = $("#form_users").serialize();
      //   $.ajax({
      //       type: "POST",
      //       enctype: 'multipart/form-data',
      //       url: sitePage + 'prosess_adding',
      //       data: data,
      //       processData: postData,
      //       contentType: false,
      //       cache: false,
      //       success: function (data) {
      //         var obj = $.parseJSON(data);
      //         if (obj.n == 'ss') {
      //           successNotif('Success!', obj.m);
      //           $('#modal_form').modal('hide');
      //           $("#jqGrid").trigger("reloadGrid");
      //         } else {
      //           alert(obj.m);
      //         }
      //
      //       },
      //       error: function (e) {
      //
      //           $("#result").text(e.responseText);
      //           console.log("ERROR : ", e);
      //           $("#btnSubmit").prop("disabled", false);
      //
      //       }
      //   });
      // }


    //   $("#btnSubmit").click(function (event) {
    //     event.preventDefault();
    //     var form = $('#form_user')[0];
    //     var data = new FormData(form);
    //
    //     $.ajax({
    //         type: "POST",
    //         enctype: 'multipart/form-data',
    //         url: sitePage + 'prosess_adding',
    //         data: data,
    //         processData: false,
    //         contentType: false,
    //         cache: false,
    //         timeout: 600000,
    //         success: function (data) {
    //           var obj = $.parseJSON(data);
    //           if (obj.n == 'ss') {
    //             successNotif('Success!', obj.m);
    //             $('#modal_form').modal('hide');
    //             $("#jqGrid").trigger("reloadGrid");
    //           } else {
    //             alert(obj.m);
    //           }
    //
    //         }
    //     });
    //
    // });

      window.openEditUser = function (id, type) {
         OMAPS_GET_CONNECTION(sitePage + 'getDetailDataUser?id='+id, function(response){
           $('li > a[href="#dataUser"]').tab("show");
            $("#form_user").trigger('reset');
            $(".modal-title").html('Edit User Data');
            formUser.data('formValidation').destroy();
            validateFormUser();
            var obj = $.parseJSON(response);
             // formOrder.data('formValidation').destroy();
             $('#modal_form').modal({backdrop: 'static', keyboard: false})
             $("#user_id").val(id);
             $("#username").val(obj.username);
             $('#first_name').val(obj.first_name);
             $('#last_name').val(obj.last_name);
             $('#alamat').val(obj.alamat);
             $('#telpon').val(obj.telpon);
             $('#email').val(obj.email);
             $('#group_id').val(obj.group_id).trigger('change');
             $("#flag_").val('edit');

         }, function(c, m) {
           alert(m);
         });
       }

       window.removeUser = function (id, type) {
    		//alert(id);
      	if (confirm('Apakah anda yakin ingin menghapus data ini..?')){
      		OMAPS_GET_CONNECTION(sitePage + 'delete_user?id='+id, function(response){
            var obj = $.parseJSON(response);
            if (obj.n == 'ss') {
              successNotif('Success!', obj.m);
              $("#jqGrid").trigger("reloadGrid");
            } else {
              alert(obj.m);
            }
      		}, function(c, m) {
      			 alert(m);
      		});
    		}
      }

});
