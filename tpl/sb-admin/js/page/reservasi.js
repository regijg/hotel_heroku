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

  var sitePage = baseURL+'reservasi/'
	var formBooking =  $('#form_booking');
  $('#resv_in_fake').datepicker({
    format: 'dd-mm-yyyy',
    autoclose:true
  });
  $('#resv_out_fake').datepicker({
    format: 'dd-mm-yyyy',
    autoclose:true
  });
  var input = $('#in_time').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
  });

	var colModel =  [
		{
			label: " ",
	        name: "actions",
        	width: 90,
	        formatter: formatAction,
	        colmenu : false,
	        align: 'center'
        },
		    {
        	label: 'No. Resv',
        	name: 'resv_no',
        	width: 55,
        	index: 'tresv.resv_no',
        	ignoreCase: true,
        	align: 'center'
        },
		    {
        	label: 'No. Kamar',
        	name: 'room_number',
        	width: 55,
        	index: 'tresvdet.room_number',
        	ignoreCase: true,
        	align: 'center'
        },
        {
        	label: 'Tanggal',
        	name: 'resv_date',
        	width: 60,
        	index: 'tresv.resv_date',
        	align: 'left'
        },
        {
        	label: 'Nama',
        	name: 'nama_pemesan',
        	index: 'tresv.nama_pemesan',
        	align: 'left'
        },
        {
        	label: 'Tipe Kamar',
        	name: 'rate_name',
        	width: 70,
        	index: 'tresvdet.rate_name',
        	align: 'left'
        },
        {
        	label: 'Check-IN',
        	name: 'resv_in',
        	width: 60,
        	index: 'tresv.resv_in',
        	align: 'left'
        },
        {
        	label: 'Tamu',
        	name: 'person',
        	width: 30,
        	index: 'tresvdet.person',
        	align: 'left'
        },
        {
        	label: 'Status',
        	name: 'resv_status',
        	width: 70,
        	index: 'tresv.resv_status',
          editable: true,
          formatter: formatStatus,
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
		var id = rowObject.resv_id;
    var status = rowObject.resv_status;
    var room = rowObject.room_number;
    var status_checkin = rowObject.resv_status_checkin;
		// var actionHtmlConfirmCancel = "<a title='' href='javascript:;' onclick='openEditPenjualan("+'"'+id+ '"'+");'  class='btn btn-xs btn-primary'>Confirm<a/> <a title='' href='javascript:;' onclick='cancelBooking("+'"'+id+ '"'+");'  class='btn btn-xs btn-danger'>Cancel<a/>";
    var actionHtmlTpl = "<a title='' href='javascript:;' onclick='openEditBooking("+'"'+id+ '"'+");'  class='btn btn-xs btn-success'>Confirm<a/> <a title='' href='javascript:;' onclick='cancelBooking("+'"'+id+ '"'+");'  class='btn btn-xs btn-danger'>Cancel<a/>";
    var actionHtmlCheckin = "<a title='' href='javascript:;' onclick='confirmCheckin("+'"'+id+ '"'+");'  class='btn btn-xs btn-success'>Check-IN<a/>";
    // var actionHtmCancel = "<a title='' href='javascript:;' onclick='openEditPenjualan("+'"'+id+ '"'+");'  class='btn btn-xs btn-danger'>Cancel<a/>";
    // return actionHtmlTpl;
    if (status == 1) {
      return actionHtmlTpl;
    }else if (status == 3) {
      return 'No Action';
    }else if (status_checkin == 1) {
      return 'Check-IN';
    }else{
      return actionHtmlCheckin;
    }
  }

	$.jgrid.defaults.width = $('#grid').width();
	$.jgrid.defaults.height = 340;
	$.jgrid.styleUI.Bootstrap.base.headerTable = "table";
	$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-responsive";
	$(document).ready(function () {
        $("#jqGrid").jqGrid({
            url: baseURL+'reservasi/list_data?callback=?&qwery=orders',
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
			url: baseURL+'reservasi/list_data?callback=?&qwery=orders&key='+key,
	        page:1
	    }).trigger("reloadGrid");
	};



  // JS MODAL BOOKING ROOM START
  $('.select2').select2();
  window.openFormRoom = function () {
        $('#form_booking').trigger('reset');
        $('#room_number').select2('');
        formBooking.data('formValidation').destroy();
        $('#deposit_fake').val('').maskMoney({
          prefix:'Rp. ', thousands:'.', decimal:',', precision:0
        });
        validateFormBooking();
        // generateTable();
        $('#modal_booking').modal('show');
  }

  // window.closeFormModalBooking = function () {
  //       $('#room_number').val('');
  //       $('#modal_booking').modal('hide');
  // }

  window.ambilRoomNumber = function (id, type) {
    OMAPS_GET_CONNECTION(sitePage + 'ambilRoomNumber?kode='+id+'&idfield='+type, function(response){
            //console.log(response);
    var obj = $.parseJSON(response);
    var tarifUmum = obj.rate_normal;
    $("#room_number").val(obj.room_number);
    $("#rate_name").val(obj.rate_name);
    $("#tarif_umum").val(obj.rate_normal);

    var	reverse =tarifUmum.toString().split('').reverse().join(''),
      ribuan 	= reverse.match(/\d{1,3}/g);
      ribuan	= ribuan.join('.').split('').reverse().join('');
    $('#tarif_umum_fake').val('Rp. '+ribuan+'');

    hitungTotalHariBooking();
    $('#person').focus();
    }, function(c, m) {
      alert(m);
    });
  }

  window.tanggalMasukFake = function(){
    var edate = $('#resv_in_fake').val();
    var newdate = edate.split("-").reverse().join("-");
    $('#resv_in').val(newdate);
    // hitung_durasi_tgl();
  }

  window.tanggalKeluarFake = function(){
    var edate = $('#resv_out_fake').val();
    var newdate = edate.split("-").reverse().join("-");
    $('#resv_out').val(newdate);
    hitung_durasi_tgl();
  }

  window.hitung_durasi_tgl = function() {
      var date1 = new Date($("#resv_in").val());
      var date2 = new Date($("#resv_out").val());

      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      $('#hari').val(diffDays);
      hitungTotalHariBooking();
  }

  window.hitungTotalHariBooking = function() {
      // var a = $("#sub_total").val();
      // alert('test');
      var b = $("#tarif_umum").val();
      var c = $("#hari").val();
      a = b * c;
      $("#jumlah").val(a);
      $("#subtotal").val(a);

      var	reverse =a.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');
      $('#jumlah_fake').val('Rp. '+ribuan+'');
      $("#subtotal_fake").val('Rp. '+ribuan+'');
  }

  window.depositeFake = function() {
    var b = $("#deposit_fake").val();
    jumlahDeposit = b.replace(/[Rp. ]/g,'');
    $("#deposit").val(jumlahDeposit);
  }

    $('#lantaibooking').change(function(){
            var room = $(this).val();
            $("#roombooking > option").remove();
            $.ajax({
                type: "POST",
                url: "reservasi/populate_booking_room",
                data: {room_number: room},
                dataType: 'json',
                success:function(data){
                    $.each(data,function(k, v){
                        var opt = $('<option />');
                        opt.val(k);
                        opt.text(v);
                        $('#roombooking').append(opt);
                    });
                }
            });
    });

    validateFormBooking();
    function validateFormBooking() {
          $('#form_booking').formValidation({
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
              	nama_pemesan: {
                      validators: {
                          notEmpty: {
                              message: 'Nama tidak boleh kosong'
                          },
                      }
                  },
                  alamat: {
                      validators: {
                          notEmpty: {
                              message: 'Alamat tidak boleh kosong'
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

              saveDataBooking();
          });
      }

      window.saveDataBooking = function (no_resv) {
        // alert('test');
        if ($("#id_penjualan_switch").val() == '') {
        		$("#resv_no").val(no_resv);
        } else{
        }
    		var url = sitePage + 'prosess_booking';
    		var postData = $("#form_booking").serialize();
    		 OMAPS_POST_CONNECTION(url, postData, function(response){
    			 var obj = $.parseJSON(response);
    			 if (obj.n == 'ss') {

    				 $('#modal_booking').modal('hide');
             swal({
                title: "Thank You!",
                //text: "Pembayaran berhasil!",
                type: "success",
                confirmButtonText: "OK"
              },
              function(isConfirm){
                  if (isConfirm) {
                  $("#jqGrid").trigger("reloadGrid");
                }
              });
    			 } else {
    				 alert(obj.m);
    			 }
    		 }, function(c, m) {
    			 alert(m);
    		 });
    	}

      window.openEditBooking = function (id, type) {
    		 OMAPS_GET_CONNECTION(sitePage + 'detailDataBooking?id='+id, function(response){
    			  $("#form_booking").trigger('reset');
            formBooking.data('formValidation').destroy();
            validateFormBooking();
    			   var obj = $.parseJSON(response);
    			 // formOrder.data('formValidation').destroy();
             var today = new Date(obj.resv_out),
             month = '' + (today.getMonth() + 1),
             day = '' + today.getDate(),
             year = today.getFullYear();
             // FORMAT TANGGAL NOW END//

             var myDate = new Date(obj.resv_in);
             var d = '' + myDate.getDate();
             var m = '' + (myDate.getMonth() + 1);
             var y = myDate.getFullYear();

    			 	 $('#modal_booking').modal({backdrop: 'static', keyboard: false})
             $("#resv_id_switch").val(id);
             $("#row_id").val(obj.row_id);
    				 $('#resv_no').val(obj.resv_no);
    				 $('#customer_type').val(obj.customer_type);
    				 $('#resv_date').val(obj.resv_date);
    				 $('#resv_in').val(obj.resv_in);
    				 $('#in_time').val(obj.in_time);
    				 // $('#in_time').val(obj.order_head_tanggal);
    				 $('#deposit_type').val(obj.deposit_type).trigger('change');
    				 $('#deposit').val(obj.deposit);
    				 $('#nama_pemesan').val(obj.nama_pemesan);
    				 $('#alamat').val(obj.alamat);
    				 $('#telpon').val(obj.telpon);
    				 $('#person').val(obj.person);
    				 $('#room_number').val(obj.room_number).trigger('change');
    				 $('#nama_perusahaan').val(obj.nama_perusahaan);
             if (obj.resv_in) {
               if (m.length < 2) m = '0' + m;
               if (d.length < 2) d = '0' + d;
               $('#resv_in_fake').val([d, m, y].join('-'));
             }

             if (obj.resv_out == '0000-00-00') {
               $('#resv_out_fake').val('');
      				 $('#resv_out').val('');
             }else {
               if (month.length < 2) month = '0' + month;
               if (day.length < 2) day = '0' + day;
      				 $('#resv_out').val(obj.resv_out);
               $('#resv_out_fake').val([day, month, year].join('-'));
             }

             var nilaiDeposit = obj.deposit;
             var	reverse =nilaiDeposit.toString().split('').reverse().join(''),
               ribuan 	= reverse.match(/\d{1,3}/g);
               ribuan	= ribuan.join('.').split('').reverse().join('');
             $('#deposit_fake').val('Rp. '+ribuan+'');
             $("#flag_").val('edit');
             hitung_durasi_tgl();

    		 }, function(c, m) {
    			 alert(m);
    		 });
    	 }

       window.confirmCheckin = function (id, type) {
     	// if (confirm('Apakah anda yakin ingin mengcancel data ini..?')) {
            // if (obj.n == 'ss') {
           swal({
             title: 'Apakah anda yakin?',
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#00a65a',
             cancelButtonColor: '#999',
             confirmButtonText: 'Yes!',
             cancelButtonText: 'No',
             closeOnConfirm: false
           }, function(checkin) {
               if (checkin) {
               	 OMAPS_GET_CONNECTION(sitePage + 'simpan_reservasi_umum?id='+id, function(response){
                    swal("Tamu Berhasil Check-IN!");
               	    $("#jqGrid").trigger("reloadGrid");
          		     });
               }
             });
       }

      window.cancelBooking = function (id, type) {
    	// if (confirm('Apakah anda yakin ingin mengcancel data ini..?')) {
           // if (obj.n == 'ss') {
          swal({
            title: 'Apakah anda yakin?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dd6b55',
            cancelButtonColor: '#999',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No',
            closeOnConfirm: false
          }, function(willDelete) {
              if (willDelete) {
                swal("Batal Menginap!");
              	 OMAPS_GET_CONNECTION(sitePage + 'cancelBooking?id='+id, function(response){
              	    $("#jqGrid").trigger("reloadGrid");
         		     });
              }
            });
      }

    // validateFormSatuan();
    // function validateFormSatuan() {
    //       $('#form_satuan').formValidation({
    //           framework: 'bootstrap',
    //           icon: {
    //               valid: 'glyphicon glyphicon-ok',
    //               invalid: 'glyphicon glyphicon-remove',
    //               validating: 'glyphicon glyphicon-refresh'
    //           },
    //           fields: {
    //           	room_number: {
    //                   validators: {
    //                       notEmpty: {
    //                           message: 'Room tidak boleh kosong'
    //                       },
    //                   }
    //               },
    //           }
    //       }).on('err.field.fv', function(e, data) {
    //           data.fv.disableSubmitButtons(false);
    //       }).on('success.field.fv', function(e, data) {
    //           data.fv.disableSubmitButtons(false);
    //       }).on('success.form.fv', function(e) {
    //           e.preventDefault();
    //           addTableSatuan();
    //       });
    //   	}
    //
    //     function generateTable(){
    //       OMAPS_GET_CONNECTION(sitePage + 'table_cr_booking', function(response){
    //
    //          var obj = $.parseJSON(response);
    //          $('#table-template-booking').html(obj.table);
    //        }, function(c, m) {
    //          alert(m);
    //        });
    //     }
    //
    //     window.tambahRowLayanan = function (id, type) {
    //   		var i = $('#table_booking').find('tr').length;
    //   		i--;
    //   		OMAPS_GET_CONNECTION(sitePage + 'tambahRowLayanan?id='+i, function(response){
    //   			 var wrapper = $("#row_layanan");
    //   			 var obj = $.parseJSON(response);
    //
    //   			 var tableData = Base64.decode(obj.d);
    //   			 //alert(tableData);
    //   			 $(wrapper).append(tableData);
    //   			 flagTambah(i);
    //   		 }, function(c, m) {
    //   			 alert(m);
    //   		 });
    //   	}
    //
    //     window.flagTambah = function (id)  {
    //   		var wrapper = $("#div_tambah");
    //   		$("#flag_"+id).val('add');
    //   	}
    //
    //     window.removeRow = function (id,value)  {
    //   		if (confirm('Apakah anda yakin ingin menghapus data ini..?')) {
    //   		var str = id.split('_');
    //   		var a = $("#order_menu_"+str[1]).val();
    //   		$("#row_"+str[1]).hide();
    //   		$("#jumlah_pesanan_"+str[1]).val(0);
    //   		//cekRacikan(a, str[1]);
    //   		flagHapus(value, str[1], str[2]);
    //   	 }
    //   	}
    //
    //     window.flagHapus = function (value, id,kode)  {
    //   		var wrapper = $("#div_hapus");
    //   		if (kode==undefined) {
    //   			$("#data_layanandel_"+id).val('kosong');
    //   		} else{
    //   		$("#data_layanandel_"+id).val(value);
    //   		$("#flag_"+id).val('hapus');
    //   		$("#kode_layanandel_"+id).val(kode);
    //   		}
    //
    //   	}

  // JS MODAL BOOKING ROOM END

});
