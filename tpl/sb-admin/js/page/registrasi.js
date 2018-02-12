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
	"validation",
	"httpcon",
	"fv",
	"fvbs",
	"slc2",
	"daterg",
	// "moment",
], function($, bs ) {

  var sitePage = baseURL+'registrasi/'
	var formAreaTamu =  $('#form_tamu');

  $('#in_date_start_div').datepicker({
    format: 'dd M yyyy',
    autoclose: true
  });

  $('#in_date_end_div').datepicker({
    format: 'dd M yyyy',
    autoclose: true
  });

  // DATA TAMU HISTORY START//
	var colModelHistoryTamu =  [
		{
			label: " ",
	        name: "actions",
	        width: 40,
	        formatter: formatAction,
	        colmenu : false,
	        align: 'center'
        },
		    {
        	label: 'No Registrasi',
        	name: 'reg_no',
        	width: 50,
        	index: 'tt.reg_no',
        	ignoreCase: true,
        	align: 'left'
        },
        {
        	label: 'Nama',
        	name: 'nama',
        	width: 100,
        	index: 'tt.nama',
        	align: 'left'
        },
        {
        	label: 'Address',
        	name: 'alamat',
        	width: 130,
        	index: 'tt.tamu_alamat',
        	align: 'left'
        },
        {
        	label: 'Telpon',
        	name: 'telpon',
        	width: 50,
        	index: 'tt.telpon',
        	align: 'left'
        },
        {
        	label: 'No. Kamar',
        	name: 'room_number',
        	width: 40,
        	index: 'tt.room_number',
        	align: 'center',
        },
        // {
        // 	label: 'Lantai',
        // 	name: 'floor',
        // 	width: 30,
        // 	index: 'tt.floor',
        // 	align: 'left'
        // },
        {
        	label: 'Nama Diklat',
        	name: 'judul_diklat',
        	width: 80,
        	index: 'tt.judul_diklat',
        	align: 'left'
        }
    ];


	$.jgrid.defaults.width = $('#grid').width();
	$.jgrid.defaults.height = 450;
	$.jgrid.styleUI.Bootstrap.base.headerTable = "table";
	$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-responsive";
	$(document).ready(function () {
        $("#jqGridDataTamu").jqGrid({
            url: baseURL+'registrasi/list_data_history_registrasi?callback=?&qwery=orders',
            mtype: "GET",
			      styleUI : 'Bootstrap',
            datatype: "jsonp",
            ignoreCase: true,
            colModel: colModelHistoryTamu,
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
            sortorder:'desc',
            pager: "#jqGridPager",
        });
    });


    window.setDateRange = function() {
  		// var key = $("#nama").val();
  		var date_start = $("#in_date_start").val();
      var date_end = $("#in_date_end").val();
    		$("#jqGridDataTamu").setGridParam({
    			url: baseURL+'registrasi/list_data_history_registrasi?callback=?&qwery=orders&in_date_start='+date_start+'&in_date_end='+date_end,
    	        page:1
    	    }).trigger("reloadGrid");
    };

    window.searchData = function(key) {
		$("#jqGridDataTamu").setGridParam({
			url: baseURL+'registrasi/list_data_history_registrasi?callback=?&qwery=orders&key='+key,
	        page:1
	    }).trigger("reloadGrid");
	  };

    window.resetData = function(key) {
      // $("#in_date_start").val('');
      // $("#in_date_end").val('');
  		// $("#jqGridDataTamu").setGridParam({
  		// 	url: baseURL+'registrasi/list_data_history_registrasi?callback=?&qwery=orders&key='+key,
  	  //       page:1
  	  //   }).trigger("reloadGrid");
      window.location.href = '/registrasi';
	  };

  function formatAction(cellValue, options, rowObject) {
		var id = rowObject.reg_id;
    var status = rowObject.status;
    var actionHtmlTpl = "<a title='' href='javascript:;' onclick='openEditRegistrasi("+'"'+id+ '"'+");'  class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Edit<a/>";
    // alert(status);
    var checkin = '<p style="background-color:#5aea5a; font-weight:bold">Check-IN</p>';
    var checkout = '<p style="background-color:#ef9c9c; font-weight:bold">Check-OUT</p>';
    if (status == 1) {
      // return actionHtmlTpl;
      return checkin;
    }else{
      return checkout;
    }
  }

  window.openEditRegistrasi = function (id, type) {
     OMAPS_GET_CONNECTION(sitePage + 'detailDataRegistrasi?id='+id, function(response){
        var obj = $.parseJSON(response);
        // alert(obj.tipe_tamu);
        if (obj.tipe_tamu == 1) {
          $("#form_registrasi_umum").trigger('reset');
          // formBooking.data('formValidation').destroy();
          // validateFormBooking();
           $('#modal_registrasi_umum').modal({backdrop: 'static', keyboard: false});
           $("#reg_id").val(obj.reg_id);
           $('#reg_no').val(obj.reg_no);
           $('#nama').val(obj.nama);
           $('#person').val(obj.person);
           $('#room_number').val(obj.room_number);
           $('#room_number_lama').val(obj.room_number);
           $('#rate_name').val(obj.rate_name);
           $('#price').val(obj.price);
           $('#rate_id').val(obj.resv_out);
           $('#floor').val(obj.in_time);

           var nilaiHarga = obj.price;
           var	reverse =nilaiHarga.toString().split('').reverse().join(''),
             ribuan 	= reverse.match(/\d{1,3}/g);
             ribuan	= ribuan.join('.').split('').reverse().join('');
           $('#price_fake').val('Rp. '+ribuan+'');
        }else {

        }
     }, function(c, m) {
       alert(m);
     });
   }

   window.ambilRoomNumber = function (id, type) {
     OMAPS_GET_CONNECTION(sitePage + 'ambilRoomNumber?kode='+id+'&idfield='+type, function(response){
             //console.log(response);
     var obj = $.parseJSON(response);
     var tarifUmum = obj.tarif_umum;
     $("#room_number").val(obj.room_number);
     $("#rate_name").val(obj.rate_name);
     $("#price").val(obj.tarif_umum);
     var hargaKamar = obj.tarif_umum;

     var	reverse = hargaKamar.toString().split('').reverse().join(''),
       ribuan 	= reverse.match(/\d{1,3}/g);
       ribuan	= ribuan.join('.').split('').reverse().join('');
     $('#price_fake').val('Rp. '+ribuan+'');

     // hitungTotalHariBooking();
     // $('#person').focus();
     }, function(c, m) {
       alert(m);
     });
   }
  // DATA TAMU HISTORY END//

  // DATA TAMU MENGINAP START//
	var colModel =  [
		{
			label: " ",
	        name: "actions",
	        width: 20,
	        // formatter: formatAction,
	        colmenu : false,
	        align: 'center'
        },
		    {
        	label: 'No Registrasi',
        	name: 'reg_no',
        	width: 50,
        	index: 'tt.reg_no',
        	ignoreCase: true,
        	align: 'left'
        },
        {
        	label: 'Nama',
        	name: 'nama',
        	width: 100,
        	index: 'tt.nama',
        	align: 'left'
        },
        {
        	label: 'Address',
        	name: 'alamat',
        	width: 130,
        	index: 'tt.tamu_alamat',
        	align: 'left'
        },
        {
        	label: 'Telpon',
        	name: 'telpon',
        	width: 50,
        	index: 'tt.telpon',
        	align: 'left'
        },
        {
        	label: 'No. Kamar',
        	name: 'room_number',
        	width: 40,
        	index: 'tt.room_number',
        	align: 'center',
        },
        // {
        // 	label: 'Lantai',
        // 	name: 'floor',
        // 	width: 30,
        // 	index: 'tt.floor',
        // 	align: 'left'
        // },
        {
        	label: 'Nama Diklat',
        	name: 'judul_diklat',
        	width: 80,
        	index: 'tt.judul_diklat',
        	align: 'left'
        }
    ];


	$.jgrid.defaults.width = $('#grid').width();
	$.jgrid.defaults.height = 340;
	$.jgrid.styleUI.Bootstrap.base.headerTable = "table";
	$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-responsive";
	$(document).ready(function () {
        $("#jqGrid").jqGrid({
            url: baseURL+'registrasi/list_data?callback=?&qwery=orders',
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
            sortorder:'desc',
            pager: "#jqGridPagerDataTamuMenginap",
        });
    });


    window.searchDataTamuMenginap = function(key) {
		$("#jqGrid").setGridParam({
			url: baseURL+'registrasi/list_data?callback=?&qwery=orders&key='+key,
	        page:1
	    }).trigger("reloadGrid");
	};
  // DATA TAMU MENGINAP END//

  //LIST DATA REGISTRASI CHECKIN START //
  var colModelCheckin =  [
		{
			label: " ",
	        name: "actions",
	        width: 20,
	        // formatter: formatAction,
	        colmenu : false,
	        align: 'center'
        },
		    {
        	label: 'No Registrasi',
        	name: 'reg_no',
        	width: 50,
        	index: 'tt.reg_no',
        	ignoreCase: true,
        	align: 'left'
        },
        {
        	label: 'Nama',
        	name: 'nama',
        	width: 100,
        	index: 'tt.nama',
        	align: 'left'
        },
        {
        	label: 'Address',
        	name: 'alamat',
        	width: 130,
        	index: 'tt.tamu_alamat',
        	align: 'left'
        },
        {
        	label: 'Telpon',
        	name: 'telpon',
        	width: 50,
        	index: 'tt.telpon',
        	align: 'left'
        },
        {
        	label: 'No. Kamar',
        	name: 'room_number',
        	width: 40,
        	index: 'tt.room_number',
        	align: 'center',
        },
        // {
        // 	label: 'Lantai',
        // 	name: 'floor',
        // 	width: 30,
        // 	index: 'tt.floor',
        // 	align: 'left'
        // },
        {
        	label: 'Nama Diklat',
        	name: 'judul_diklat',
        	width: 80,
        	index: 'tt.judul_diklat',
        	align: 'left'
        }
    ];


	$.jgrid.defaults.width = $('#grid').width();
	$.jgrid.defaults.height = 340;
	$.jgrid.styleUI.Bootstrap.base.headerTable = "table";
	$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-responsive";
	$(document).ready(function () {
        $("#jqGridDataCheckIn").jqGrid({
            url: baseURL+'registrasi/list_data_checkin?callback=?&qwery=orders',
            mtype: "GET",
			      styleUI : 'Bootstrap',
            datatype: "jsonp",
            ignoreCase: true,
            colModel: colModelCheckin,
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
            sortorder:'desc',
            pager: "#jqGridPager",
        });
    });


    window.searchDataCheckin = function(key) {
		$("#jqGridDataCheckIn").setGridParam({
			url: baseURL+'registrasi/list_data_checkin?callback=?&qwery=orders&key='+key,
	        page:1
	    }).trigger("reloadGrid");
	};
  //LIST DATA REGISTRASI CHECKIN END //

  //LIST DATA REGISTRASI CHECKOUT START //
  var colModelCheckout =  [
		{
			label: " ",
	        name: "actions",
	        width: 20,
	        // formatter: formatAction,
	        colmenu : false,
	        align: 'center'
        },
		    {
        	label: 'No Registrasi',
        	name: 'reg_no',
        	width: 50,
        	index: 'tt.reg_no',
        	ignoreCase: true,
        	align: 'left'
        },
        {
        	label: 'Nama',
        	name: 'nama',
        	width: 100,
        	index: 'tt.nama',
        	align: 'left'
        },
        {
        	label: 'Address',
        	name: 'alamat',
        	width: 130,
        	index: 'tt.tamu_alamat',
        	align: 'left'
        },
        {
        	label: 'Telpon',
        	name: 'telpon',
        	width: 50,
        	index: 'tt.telpon',
        	align: 'left'
        },
        {
        	label: 'No. Kamar',
        	name: 'room_number',
        	width: 40,
        	index: 'tt.room_number',
        	align: 'center',
        },
        // {
        // 	label: 'Lantai',
        // 	name: 'floor',
        // 	width: 30,
        // 	index: 'tt.floor',
        // 	align: 'left'
        // },
        {
        	label: 'Nama Diklat',
        	name: 'judul_diklat',
        	width: 80,
        	index: 'tt.judul_diklat',
        	align: 'left'
        }
    ];


	$.jgrid.defaults.width = $('#grid').width();
	$.jgrid.defaults.height = 340;
	$.jgrid.styleUI.Bootstrap.base.headerTable = "table";
	$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-responsive";
	$(document).ready(function () {
        $("#jqGridDataCheckout").jqGrid({
            url: baseURL+'registrasi/list_data_checkout?callback=?&qwery=orders',
            mtype: "GET",
			      styleUI : 'Bootstrap',
            datatype: "jsonp",
            ignoreCase: true,
            colModel: colModelCheckout,
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
            sortorder:'desc',
            pager: "#jqGridPager",
        });
    });


    window.searchDataCheckout = function(key) {
		$("#jqGridDataCheckout").setGridParam({
			url: baseURL+'registrasi/list_data_checkout?callback=?&qwery=orders&key='+key,
	        page:1
	    }).trigger("reloadGrid");
	};
  //LIST DATA REGISTRASI CHECKOUT END //

});
