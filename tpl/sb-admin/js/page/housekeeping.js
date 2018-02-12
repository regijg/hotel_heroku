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

  var sitePage = baseURL+'housekeeping/'
	var formAreaRoomCheck =  $('#form_roomcheck');
  $('#resv_in').datepicker({
    format: 'yyyy-mm-dd',
    autoclose:true
  });
  $('#resv_out').datepicker({
    format: 'yyyy-mm-dd',
    autoclose:true
  });
  var input = $('#in_time').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
  });

	var colModel =  [
      // {
      //   label: "Action",
      //     name: "actions",
      //     width: 30,
      //     formatter: formatAction,
      //     colmenu : false,
      //     align: 'center'
      //   },
		    {
        	label: 'Tanggal',
        	name: 'check_date',
        	width: 55,
        	index: 'tr.recheck_datesv_no',
        	ignoreCase: true,
        	align: 'center'
        },
		    {
        	label: 'No. Kamar',
        	name: 'room_number',
        	width: 55,
        	index: 'tr.room_number',
        	ignoreCase: true,
        	align: 'center'
        },
        {
        	label: 'Keterangan',
        	name: 'keterangan',
        	index: 'tr.keterangan',
        	align: 'left'
        },
        {
        	label: 'Petugas',
        	name: 'user_name',
        	index: 'tr.user_name',
        	align: 'left'
        }
    ];

    function formatColor(cellValue, options, rowObject) {
      var id = cellValue.resv_status;
      if(id == 1){
          return 'style="background-color: red;';
      }
    }

    function formatStatus(cellValue, options, rowObject) {
          var status = (cellValue == '1') ? "Outstanding" : "" || (cellValue == '2') ? "Confirm" : "Cancel";
          return status;

          if(cellvalue == 1){
             return '<span style="background-color: red; display: block; width: 100%; height: 100%; ">'+color+'</span>';
            }else{
             return cellvalue;
           }
    }

    function formatAction(cellValue, options, rowObject) {
  		var id = rowObject.room_number;

  		var actionHtmlTpl = "<a title=' Edit data' href='javascript:;' onclick='openEditForm("+'"'+id+ '"'+");'  class='btn btn-success btn-xs'><i class='fa fa-eye-slash'></i><a/>";

      return actionHtmlTpl;
    }

	$.jgrid.defaults.width = $('#grid').width();
	$.jgrid.defaults.height = 340;
	$.jgrid.styleUI.Bootstrap.base.headerTable = "table";
	$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-responsive";
	$(document).ready(function () {
        $("#jqGrid").jqGrid({
            url: baseURL+'housekeeping/list_data?callback=?&qwery=orders',
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
			url: baseURL+'booking/list_data?callback=?&qwery=orders&key='+key,
	        page:1
	    }).trigger("reloadGrid");
	};



  // JS MODAL BOOKING ROOM START
  $('.select2').select2();
  window.openFormRoom = function () {
        $('#form_roomcheck').trigger('reset');
        formAreaRoomCheck.data('formValidation').destroy();
        validateFormRoomCheck();
        $('#modal_roomcheck').modal('show');
  }

  window.ambilRoomNumber = function (id, type) {
    OMAPS_GET_CONNECTION(sitePage + 'ambilRoomNumber?kode='+id+'&idfield='+type, function(response){
            //console.log(response);
    var obj = $.parseJSON(response);

    if (obj.fasilitas1 == 1) {
      $('#fasilitas1').prop('checked', true);
      //$('#fasilitas1').val(obj.fasilitas1 ? 1 : 0);
    }else {
      $('#fasilitas1').prop('checked', false);
      //$('#fasilitas1').val(obj.fasilitas1 ? 1 : 0);
    }

    if (obj.fasilitas2 == 1) {
      $('#fasilitas2').prop('checked', true);
    }else{
      $('#fasilitas2').prop('checked', false);
    }

    if (obj.fasilitas3 == 1) {
      $('#fasilitas3').prop('checked', true);
    }else {
      $('#fasilitas3').prop('checked', false);
    }

    if (obj.fasilitas4 == 1) {
      $('#fasilitas4').prop('checked', true);
    }else {
      $('#fasilitas4').prop('checked', false);
    }

    if (obj.fasilitas5 == 1) {
      $('#fasilitas5').prop('checked', true);
    }else {
      $('#fasilitas5').prop('checked', false);
    }

    if (obj.fasilitas6 == 1) {
      $('#fasilitas6').prop('checked', true);
    }else {
      $('#fasilitas6').prop('checked', false);
    }

    if (obj.fasilitas7 == 1) {
      $('#fasilitas7').prop('checked', true);
    }else {
      $('#fasilitas7').prop('checked', false);
    }

    if (obj.kamar_mandi == 1) {
      $('#kamar_mandi').prop('checked', true);
      $('#kamar_mandi').val(obj.kamar_mandi ? 1 : 0);
    }else {
      $('#kamar_mandi').prop('checked', false);
      $('#kamar_mandi').val(obj.kamar_mandi ? 1 : 0);
    }

    if (obj.dinding == 1) {
      $('#dinding').prop('checked', true);
      $('#dinding').val(obj.dinding ? 1 : 0);
    }else {
      $('#dinding').prop('checked', false);
      $('#dinding').val(obj.dinding ? 1 : 0);
    }

    if (obj.atap_plafon == 1) {
      $('#atap_plafon').prop('checked', true);
      $('#atap_plafon').val(obj.atap_plafon ? 1 : 0);
    }else {
      $('#atap_plafon').prop('checked', false);
      $('#atap_plafon').val(obj.atap_plafon ? 1 : 0);
    }

    if (obj.pintu == 1) {
      $('#pintu').prop('checked', true);
      $('#pintu').val(obj.pintu ? 1 : 0);
    }else {
      $('#pintu').prop('checked', false);
      $('#pintu').val(obj.pintu ? 1 : 0);
    }

    if (obj.lain_lain == 1) {
      $('#lain_lain').prop('checked', true);
      $('#lain_lain').val(obj.lain_lain ? 1 : 0);
    }else {
      $('#lain_lain').prop('checked', false);
      $('#lain_lain').val(obj.lain_lain ? 1 : 0);
    }

    $("#keterangan").val(obj.kondisi_kerusakan);
    }, function(c, m) {
      alert(m);
    });
  }

  // $('#fasilitas1').on('change', function(){
  //  $('#fasilitas1').val(this.checked ? 1 : 0);
  // });


    validateFormRoomCheck();
    function validateFormRoomCheck() {
          $('#form_roomcheck').formValidation({
              framework: 'bootstrap',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
          }).on('err.field.fv', function(e, data) {
          }).on('success.form.fv', function(e) {
              e.preventDefault();
              saveDataBooking();
          });
      }

      window.saveDataBooking = function (no_resv) {
        // alert('test');
        if ($("#id_penjualan_switch").val() == '') {
        		$("#resv_no").val(no_resv);
        } else{
        }
    		var url = sitePage + 'create_roomcheck';
    		var postData = $("#form_roomcheck").serialize();
    		 OMAPS_POST_CONNECTION(url, postData, function(response){
    			 var obj = $.parseJSON(response);
    			 if (obj.n == 'ss') {

    				 $('#modal_roomcheck').modal('hide');
             swal({
                title: "Thank You!",
                //text: "Pembayaran berhasil!",
                type: "success",
                confirmButtonText: "OK"
              },
              function(isConfirm){
                  if (isConfirm) {
                  // $("#jqGrid").trigger("reloadGrid");
                  window.location.href = '/housekeeping';
                }
              });
    			 } else {
    				 alert(obj.m);
    			 }
    		 }, function(c, m) {
    			 alert(m);
    		 });
    	}

});
