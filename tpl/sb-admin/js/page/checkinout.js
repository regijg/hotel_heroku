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
  "sweetalert-dev",
	"validation",
	"httpcon",
	"fv",
	"fvbs",
	"slc2",
	"daterg",
	"moment",
], function($, bs ) {

  var sitePage = baseURL+'checkinout/';
  var sitePagePeserta = baseURL+'peserta/';
	var formAreaTamu =  $('#form_tamu');
	var formDiklat =  $('#form_diklat');
	var formUmum =  $('#form_umum');

    // setTimeout(function(){
    //     $('.preloader').fadeOut(200);
    // }, 500);
  $(function () {
      $(".custom-close").on('click', function() {
          $('#modal_tambah_layanan').modal('hide');
      });
  });

  $(function () {
      $(".custom-close-deposit").on('click', function() {
          $('#modal_kekurangan_deposit').modal('hide');
      });
  });

  $('#in_date_diklat').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  });
  $('#out_date_diklat').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  });
  var input = $('#in_time_diklat').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
  });
  var input = $('#out_time_diklat').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
  });

	$('#in_date_umum').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  });
  $('#out_date_umum').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  });
  var input = $('#in_time_umum').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
  });
  var input = $('#out_time_umum').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
  });

  //form validation
  //validateFormTamu();

	// function formatAction(cellValue, options, rowObject) {
	// 	var id = rowObject.tamu_id;
	// 	var actionHtmlTpl = "<a title=' Edit data' href='javascript:;' onclick='openEditForm("+'"'+id+ '"'+");'  class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o'></i><a/>    <a title='Delete data'  onclick='remove("+'"'+id+ '"'+");'   class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i><a/>";
	// 	return actionHtmlTpl;
  // }

	// Helper openEditForm
	window.openFormRoom = function (id, type, rowObject) {
    //  var id = rowObject.room_number;
		 OMAPS_GET_CONNECTION(sitePage + 'select_id_room?room_number='+id, function(response){
        var obj = $.parseJSON(response);
        if (obj.room_status == 3) {
          errorNotif("Room "+obj.room_number+" Kotor/ Belum Dibersihkan", '');
        }else if (obj.room_status == 2) {
          successNotif("Room "+obj.room_number+" sudah terisi",'')
        }else if (obj.room_status == 4) {
          errorNotif("Room "+obj.room_number+" Tidak bisa digunakan",'');
        }else if (obj.room_status == 5) {
          successNotif("Room "+obj.room_number+" Sudah Dipesan",'');
        }else{
          $('#form_umum').trigger('reset');
           formUmum.data('formValidation').destroy();
           validateFormRoomUmum();
          $('#room_number_umum').val(obj.room_number);
          $('#rate_id_umum').val(obj.rate_id);
          $('#rate_name_umum').val(obj.rate_name);
          $('#floor_umum').val(obj.floor);
          $('#deposit_umum').val();
          ambilHargaRoom(obj.rate_id);
          $('#kategori_tamu').select2();
          $('#modal_umum').modal('show');
        }
		 }, function(c, m) {
			 alert(m);
		 });
	}

  window.ambilHargaRoom = function (id, type) {
		OMAPS_GET_CONNECTION(sitePage + 'ambilHargaRoom?kode='+id+'&idfield='+type, function(response){
				//console.log(response);
		var obj = $.parseJSON(response);
		$("#rate_id_umum").val(obj.rate_id);
		$("#rate_name_umum").val(obj.rate_name);
		$("#tarif_umum").val(obj.tarif_umum);
    // FAKE OUTPUT RUPIAH START//
    var bilangan = obj.tarif_umum;
    var	reverse = bilangan.toString().split('').reverse().join(''),
      ribuan 	= reverse.match(/\d{1,3}/g);
      ribuan	= ribuan.join('.').split('').reverse().join('');
    $('#tarif_umum_fake').val('Rp. '+ribuan+'');
    // FAKE OUTPUT RUPIAH END//
		}, function(c, m) {
		 alert(m);
		});
	}

  validateFormRoomUmum();
  function validateFormRoomUmum() {
        $('#form_umum').formValidation({
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
                alamat: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat tidak boleh kosong'
                        },
                    },
                },
                telpon: {
                    validators: {
                        notEmpty: {
                            message: 'Telpon tidak boleh kosong'
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
            saveDataUmum();
        });
    }

      //save data
  	window.saveDataUmum = function () {
      // alert('test');
  		var url = sitePage + 'simpan_checkinout_umum';
  		var postData = $("#form_umum").serialize();
  		 OMAPS_POST_CONNECTION(url, postData, function(response){
  			 var obj = $.parseJSON(response);
  			 if (obj.n == 'ss') {

  				 $('#modal_umum').modal('hide');
           $('#modal_room').modal('hide');
           swal({
              title: "Thank You!",
              //text: "Pembayaran berhasil!",
              type: "success",
              confirmButtonText: "OK"
            },
            function(isConfirm){
                if (isConfirm) {
                window.location.href = "checkinout";
              }
            });
  			 } else {
  				 alert(obj.m);
  			 }
  		 }, function(c, m) {
  			 alert(m);
  		 });
  	}

    // JS MODAL BILLING WISMA START //
    function generateTable(){
  		OMAPS_GET_CONNECTION(sitePage + 'table_cr_layanan', function(response){

  			 var obj = $.parseJSON(response);
  			 $('#table-template-layanan-pembayaran').html(obj.table);
         for (var i = 0; i < 1; i++) {
           $('#price_menu_'+i).val('').maskMoney({
             prefix:'Rp. ', thousands:'.', decimal:',', precision:0
           });
         }
  		 }, function(c, m) {
  			 alert(m);
  		 });
  	}

    $('.select2').select2();
    // $('#in_date_checkout_umum_fake').datepicker({
    //   format: 'dd-mm-yyyy',
    //   autoclose: true
    // });
    $('#out_date_checkout_umum_fake').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    });

    var input = $('#out_time_checkout_umum').clockpicker({
      placement: 'bottom',
      align: 'left',
      autoclose: true,
      'default': 'now'
    });

    window.todayDate = function (dateIn) {
       var yyyy = dateIn.getFullYear();
       var mm = dateIn.getMonth()+1; // getMonth() is zero-based
       var dd  = dateIn.getDate();
       return String(yyyy+'-'+mm+'-'+dd); // Leading zeros for mm and dd
    }

    $('input[type="text"]   [value="now"]').each(function(){
      var d = new Date(),
          h = d.getHours(),
          m = d.getMinutes();
      if(h < 10) h = '0' + h;
      if(m < 10) m = '0' + m;
      $(this).attr({
        'value': h + ':' + m
      });
    });

    window.openFormRoomCheckIn = function (id, type, rowObject) {
  		 OMAPS_GET_CONNECTION(sitePage + 'select_room_and_date?room_number='+id, function(response){
          var obj = $.parseJSON(response);
          // FORMAT TANGGAL NOW START//
          var today = new Date(),
          month = '' + (today.getMonth() + 1),
          day = '' + today.getDate(),
          year = today.getFullYear();
          // FORMAT TANGGAL NOW END//

          var myDate = new Date(obj.in_date);
          var d = '' + myDate.getDate();
          var m = '' + (myDate.getMonth() + 1);
          var y = myDate.getFullYear();

          // FORMAT JAM NOW START//
          var jam = today.getHours(),
              menit = today.getMinutes();
          if(jam < 10) h = '0' + jam;
          if(menit < 10) m = '0' + menit;
          // FORMAT JAM NOW END//

          if (obj.room_number == '' || obj.out_date_umum == '') {
            errorNotif("Room "+obj.room_number+" Kotor/ Belum Dibersihkan", '');
          }else if(obj.room_number != '' || obj.out_date_umum == ''){

            $('btn_simpan_pembayaran').prop("disabled", true);
            generateTable();
            $('#form_checkout_umum').trigger('reset');
            $('#reg_id_checkout_umum').val(obj.reg_id);
            $('#reg_no').val(obj.reg_no);
            $('#rate_id_checkout_umum').val(obj.rate_id);
            $('#room_number_checkout_umum').val(obj.room_number);
            $('#rate_name_checkout_umum').val(obj.rate_name);
            $('#floor_checkout_umum').val(obj.floor);
            $('#no_identitas_checkout_umum').val(obj.no_identitas);
            $('#nama_checkout_umum').val(obj.nama);
            $('#nama_checkout_umum2').val(obj.nama2);
            $('#alamat_checkout_umum').val(obj.alamat);
            $('#telpon_checkout_umum').val(obj.telpon);
            $('#tarif_checkout_umum').val(obj.price);
            $('#in_date_checkout_umum').val(obj.in_date);
            $('#out_date_checkout_umum').val(obj.out_date);
            $('#deposit').val(obj.deposit);
            if (obj.in_date) {
              if (m.length < 2) m = '0' + m;
              if (d.length < 2) d = '0' + d;
              $('#in_date_checkout_umum_fake').val([d, m, y].join('-'));
            }
            // else {
            //   if (m.length < 2) m = '0' + m;
            //   if (d.length < 2) d = '0' + d;
            //   $('#in_date_checkout_umum_fake').val([d, m, y].join('-'));
            // }

            $('#in_time_checkout_umum').val(obj.in_time);
            if (obj.out_date == '0000-00-00') {
              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;
              $('#out_date_checkout_umum_fake').val([day, month, year].join('-'));
            }else {
              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;
              $('#out_date_checkout_umum_fake').val([day, month, year].join('-'));
            }
            $('#out_time_checkout_umum').val(jam + ':' + menit);
            $('#tamu_tipe_checkout').val(obj.tipe_tamu);
            $('#modal_checkout_umum').modal('show');

            tanggalKeluarFake();
            hitung_durasi_tgl();
            peyment_method_click();
            deposit_type_click();
            // hitungSisaDeposit();
            hitungKembalian();

            $('#btn_simpan_pembayaran').prop("disabled", true);
            // disableButton();
            // if(obj.kembalian >= -1){
            //     $('btn_simpan_pembayaran').prop("disabled", true);
            // }else{
            //     $('btn_simpan_pembayaran').prop("disabled", false);
            // }
            // if($('#kembalian').val() <= -1){
            //     $('#btn_simpan_pembayaran').prop("disabled", true);
            // }else{
            //     $('#btn_simpan_pembayaran').prop("disabled", false);
            // }
            // FAKE OUTPUT RUPIAH START//
            var bilangan = obj.price;
            var	reverse = bilangan.toString().split('').reverse().join(''),
              ribuan 	= reverse.match(/\d{1,3}/g);
              ribuan	= ribuan.join('.').split('').reverse().join('');
            $('#tarif_checkout_umum_fake').val('Rp. '+ribuan+'');
            var bilangan = obj.deposit;
            var	reverse = bilangan.toString().split('').reverse().join(''),
              ribuan 	= reverse.match(/\d{1,3}/g);
              ribuan	= ribuan.join('.').split('').reverse().join('');
            $('#deposit_fake').val('Rp. '+ribuan+'');

            $('#payment_total_checkout_umum_fake').val('').maskMoney({
              prefix:'Rp. ', thousands:'.', decimal:',', precision:0
            });
            // FAKE OUTPUT RUPIAH END//


          }else if(obj.room_number != '' || obj.out_date_umum != ''){
            // $('#tamu_tipe').val(3);
            $('#modal_checkout_umum').modal('show');
          }
  		 }, function(c, m) {
  			 alert(m);
  		 });
  	}

    // window.disableButton = function(value){
    //   value = $('#kembalian').val();
    //   if(value <= -1){
    //       $('btn_simpan_pembayaran').prop("disabled", true);
    //   }else{
    //       $('btn_simpan_pembayaran').prop("disabled", false);
    //   }
    // }

    window.peyment_method_click = function(value){
      // alert();
      // var deposit = $('#deposit').val();
      if (value === 'deposit') {
        $('#div_deposit').show();
        $('#div_sisa_deposit').show();
        $('#div_payment_total').hide();
        $('#div_kembalian').hide();
        $('#div_deposit_tipe').show('slow');
        $('#payment_total_checkout_umum').val(0);
        $('#payment_total_checkout_umum_fake').val('Rp. '+0);
        $('#kembalian').val(0);
        $('#kembalian_fake').val('Rp. '+0);
      }else {
        $('#deposit_type').val('');
        $('#div_deposit').hide();
        $('#div_sisa_deposit').hide();
        $('#div_payment_total').show();
        $('#div_kembalian').show();
        $('#div_deposit_tipe').hide('slow');
        $('#payment_total_checkout_umum').val(0);
        $('#payment_total_checkout_umum_fake').val('Rp. '+0);
        $('#kembalian').val(0);
        $('#kembalian_fake').val('Rp. '+0);
      }

    }

    window.deposit_type_click = function(value){
      var a = $("#billingdet_payment_total_checkout_umum").val();
 	    var b = $("#deposit").val();
 	    c = b - a; //a kali b

      var	reverse = c.toString(),
      sisa 	= reverse.length % 3
      rupiah 	= reverse.substr(0, sisa);
      ribuan	= reverse.substr(sisa).match(/\d{3}/g);
      if (ribuan) {
      	 separator = sisa ? '.' : '';
         rupiah += separator + ribuan.join('.');
      }

      var	reverseB = b.toString(),
      sisaB 	= reverseB.length % 3
      rupiahB 	= reverseB.substr(0, sisaB);
      ribuanB	= reverseB.substr(sisaB).match(/\d{3}/g);
      if (ribuanB) {
      	 separatorB = sisaB ? '.' : '';
         rupiahB += separatorB + ribuanB.join('.');
      }

      if (value === 'autodebit') {
          if (b != 0) {
            $('#sisa_deposit').val(c);
            $('#sisa_deposit_fake').val('Rp. '+rupiah+'');
            if ($('#sisa_deposit').val() <= -1) {
              $('#modal_kekurangan_deposit').modal('show');
              $('#btn_simpan_pembayaran').prop('disabled', true);
            }else {
              $('#btn_simpan_pembayaran').prop('disabled', false);
            }
          }else {
            $('#sisa_deposit').val(b);
            $('#sisa_deposit_fake').val('Rp. '+rupiahB+'');
          }
      }else {
        $('#sisa_deposit').val(b);
        $('#sisa_deposit_fake').val('Rp. '+rupiahB+'');
      }

    }

    window.tambahRowLayanan = function (id, type) {
  		var i = $('#tabel_layanan').find('tr').length;
  		i--;
  		OMAPS_GET_CONNECTION(sitePage + 'tambahRowLayanan?id='+i, function(response){
  			 var wrapper = $("#row_layanan");
  			 var obj = $.parseJSON(response);
  			 var tableData = Base64.decode(obj.d);
  			 //alert(tableData);
  			 $(wrapper).append(tableData);
  			 flagTambah(i);
  		 }, function(c, m) {
  			 alert(m);
  		 });
  	}

    window.priceInput = function ()  {
      var len = [];
      for(i = 0; i < len; i++){
        if(dataArray[i] == document.getElementById("price_menu_"+i).value){
          alert(i);
        }
      }
      // $('#price_menu_'+id).val('').maskMoney({
      //   prefix:'Rp. ', thousands:'.', decimal:',', precision:0
      // });
  	}

    window.flagTambah = function (id)  {
  		var wrapper = $("#div_tambah");
      $('#price_menu_'+id).val('').maskMoney({
        prefix:'Rp. ', thousands:'.', decimal:',', precision:0
      });
  		$("#flag_"+id).val('add');
  	}

    window.ambilDataLayanan = function (id, type) {
  		OMAPS_GET_CONNECTION(sitePage + 'ambilDataLayanan?kode='+id+'&idfield='+type, function(response){
  			var obj = $.parseJSON(response);
  			$("#id_order_"+obj.i).val(obj.id_order);
  			$("#order_menu_layanan_"+obj.i).val(obj.order_menu);
  			$("#price_menu_"+obj.i).val(obj.price_menu);
  		 }, function(c, m) {
  			 alert(m);
  		 });
  	}

    window.ambilLayananHitung = function (id, type) {
      	ambilDataLayanan(id, type);
      }

    window.hitungTotalPembayaranKamar = function() {
  	    var b = $("#tarif_checkout_umum").val();
  	    var c = $("#hari_checkout_umum").val();
  	    a = b * c;
  	    $("#billing_total_checkout_umum").val(a);
        $("#billingdet_payment_total_checkout_umum").val(a);


        var	reverse =a.toString().split('').reverse().join(''),
          ribuan 	= reverse.match(/\d{1,3}/g);
          ribuan	= ribuan.join('.').split('').reverse().join('');
        $('#billing_total_checkout_umum_fake').val('Rp. '+ribuan+'');
        $("#billingdet_payment_total_checkout_umum_fake").val('Rp. '+ribuan+'');
        // HitungTotalLayanan();
  	}

    window.hitungQty = function (value) {
    	var i = value.split('_');
    	var qty = $('#qty_pesanan_'+i[2]).val();
    	var harga = $('#price_menu_'+i[2]).val();
      jumlahPriceMenu = harga.replace(/[Rp. ]/g,'');
    	var jumlah = (qty * jumlahPriceMenu);

      var	reverse = jumlah.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');
    	$('#jumlah_pesanan_'+i[2]).val('Rp. '+ribuan+'');
    	HitungTotalLayanan();
    }

    window.hitungKembalian = function() {
	    var a = $("#billingdet_payment_total_checkout_umum").val();
	    var b = $("#payment_total_checkout_umum").val();
	    c = b - a;
	    $("#kembalian").val(c);

      var	reverse = c.toString(),
        sisa 	= reverse.length % 3
        rupiah 	= reverse.substr(0, sisa);
        ribuan	= reverse.substr(sisa).match(/\d{3}/g);
        if (ribuan) {
           separator = sisa ? '.' : '';
           rupiah += separator + ribuan.join('.');
         }
    	$('#kembalian_fake').val('Rp. '+rupiah+'');
      // $("#kembalian").val(pembayaran.val()-total);
      if ($('#kembalian').val() <= -1) {
        $('#btn_simpan_pembayaran').prop('disabled', true);
      }else {
        $('#btn_simpan_pembayaran').prop('disabled', false);
      }
	   }

     window.hitungSisaDeposit = function() {
 	    var a = $("#billingdet_payment_total_checkout_umum").val();
 	    var b = $("#deposit").val();
 	    c = b - a; //a kali b
 	    // $("#sisa_deposit").val(c);
      // var autodebit = $('#')
      var	reverse = c.toString(),
      sisa 	= reverse.length % 3
      rupiah 	= reverse.substr(0, sisa);
      ribuan	= reverse.substr(sisa).match(/\d{3}/g);
      if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }

      var	reverseB = b.toString(),
      sisaB 	= reverseB.length % 3
      rupiahB 	= reverseB.substr(0, sisaB);
      ribuanB	= reverseB.substr(sisaB).match(/\d{3}/g);
      if (ribuanB) {
      	 separatorB = sisaB ? '.' : '';
         rupiahB += separatorB + ribuanB.join('.');
      }
     	// $('#sisa_deposit_fake').val('Rp. '+rupiah+'');
      if (b == 0) {
          $("#sisa_deposit").val(b);
         	$('#sisa_deposit_fake').val('Rp. '+0+'');
        }else if ($('#deposit_type').val() == 'autodebit') {
            // alert(autodebit);
          $("#sisa_deposit").val(c);
          $('#sisa_deposit_fake').val('Rp. '+rupiah+'');
        }else {
          $("#sisa_deposit").val(b);
          $('#sisa_deposit_fake').val('Rp. '+rupiahB+'');
      }
 	   }



    window.hitungKembalianFake = function() {
	    var b = $("#payment_total_checkout_umum_fake").val();
      jumlahPayment = b.replace(/[Rp. ]/g,'');
	    $("#payment_total_checkout_umum").val(jumlahPayment);
      hitungKembalian();
	  }

    window.HitungTotalLayanan = function () {
      var totalPembayaranKamar = $('#billing_total_checkout_umum').val();
      var a = $('#tabel_layanan').find('tr').length;
    	a--;
    	var total=0;
    	for (var i = 0; i<a; i++){
    		var b = $('#jumlah_pesanan_'+i).val();
    		if(b != '' && b != undefined){
          jumlahPemesanan = b.replace(/[Rp. ]/g,'');
    			total += (parseFloat(jumlahPemesanan));
    		}
    	}
    	$('#billingdet_payment_total_checkout_umum').val(total+parseFloat(totalPembayaranKamar));

      var hasilConvert = total+parseFloat(totalPembayaranKamar);
      // alert(hasilConvert);
      var	reverse = hasilConvert.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');
      $("#billingdet_payment_total_checkout_umum_fake").val('Rp. '+ribuan+'');
      hitungKembalian();
  	}

    window.tanggalKeluarFake = function(){
      var edate = $('#out_date_checkout_umum_fake').val();
      var newdate = edate.split("-").reverse().join("-");
      $('#out_date_checkout_umum').val(newdate);
      hitung_durasi_tgl();
    }

    window.hitung_durasi_tgl = function() {
        var date1 = new Date($("#in_date_checkout_umum").val());
        var date2 = new Date($("#out_date_checkout_umum").val());
        var sisaDepo = $('#deposit').val();
        var depositTipe = $('#deposit_type').val();
        var autodebit = 'autodebit';
        // alert(depositTipe);

        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        $('#hari_checkout_umum').val(diffDays);
        $('#out_time_checkout_umum').focus();
        hitungTotalPembayaranKamar();
        if ($('#deposit_type').val() == autodebit) {
          hitungSisaDeposit();
        }else {
          $('#sisa_deposit').val(sisaDepo);
        }
  	}

    window.hitung_durasi_waktu = function() {
  	    var tgl_awal = $('#in_date_checkout_umum').val();
        var tgl_akhir = $('#out_date_checkout_umum').val();
        var tgl_awal_pisah = tgl_awal.split('-');
        var tgl_akhir_pisah = tgl_akhir.split('-');
        var objek_tgl = new Date();
        var tgl_awal_leave = objek_tgl.setFullYear(tgl_awal_pisah[0], tgl_awal_pisah[1], tgl_awal_pisah[2]);
        var tgl_akhir_leave = objek_tgl.setFullYear(tgl_akhir_pisah[0], tgl_akhir_pisah[1], tgl_akhir_pisah[2]);
        var hasil = (tgl_akhir_leave-tgl_awal_leave)/(60*60*24*1000);
        $('#hari_checkout_umum').val(hasil);
        $('#out_time_checkout_umum').focus();
        hitung();
  	}

    window.removeRow = function (id,value)  {
  		if (confirm('Apakah anda yakin ingin menghapus data ini..?')) {
  		var str = id.split('_');
  		var a = $("#order_menu_"+str[1]).val();
  		$("#row_"+str[1]).hide();
  		$("#jumlah_pesanan_"+str[1]).val(0);
  		HitungTotalLayanan(value);
  		flagHapus(value, str[1], str[2]);
  	 }
  	}

    window.flagHapus = function (value, id,kode)  {
  		var wrapper = $("#div_hapus");
  		if (kode==undefined) {
  			$("#data_layanandel_"+id).val('kosong');
  		} else{
  		$("#data_layanandel_"+id).val(value);
  		$("#flag_"+id).val('hapus');
  		$("#kode_layanandel_"+id).val(kode);
  		}

  	}

    validateBilling();
    function validateBilling() {
    	var a = $('#tabel_layanan').find('tr').length;
    	var i = 0;
        $('#form_checkout_umum').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },

            fields: {
                // deposit_type: {
                //     validators: {
                //         notEmpty: {
                //             message: 'Tanggal keluar tidak boleh kosong'
                //         },
                //     },
                // },
            }


        }).on('err.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
        }).on('success.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            generateNoOrder();
        });
    	}

    window.generateNoOrder = function () {
      		var kode = '1';
      		OMAPS_GET_CONNECTION(sitePage + 'generateNoOrder?id='+kode, function(response){
      			//console.log(response);
      			var obj = $.parseJSON(response);
      			var t = new Date();
          		var th = t.getFullYear();
          		var a = th.toString();
          		var thn = a.substr(2, 2);
          		var billing_no = 'UM'+thn+'01'+obj.kode;
          		simpan_pembayaran(billing_no);
      		 }, function(c, m) {
      			 alert(m);
      		 });
    }

    window.simpan_pembayaran = function (billing_no) {
      if ($("#id_pembayaran_switch").val() == '') {
      		$("#billing_no").val(billing_no);
      } else{
      }
      var url = sitePage + 'prosess_pembayaran';
      var postData = $("#form_checkout_umum").serialize();
       OMAPS_POST_CONNECTION(url, postData, function(response){
        // console.log(response);
         var obj = $.parseJSON(response);
         if (obj.n == 'ss') {
           var id= obj.id;
           //successNotif('Success !', obj.m);
           // $('#modal_checkout_umum').modal('hide');


           // $('#billing_id_billing').val(id);
           $('#btn_simpan_pembayaran').hide();
           $("#btn-print").html('<a href="'+sitePage+'cetakNota/'+id+'" target="_blank"> <button type="button" class="btn btn-sm btn-primary name="btn_print" id="btn_print"><i class="fa fa-print"></i> Cetak Nota</button></a>');

           $('#btn_print').click(function(){
             $('#modal_checkout_umum').modal('hide');
             swal({
                title: "Thank You!",
                //text: "Pembayaran berhasil!",
                type: "success",
                confirmButtonText: "OK"
              },
              function(isConfirm){
                  if (isConfirm) {
                  window.location.href = "checkinout";
                }
              });
           });
           // setTimeout(function(){
           //
           // }, 500000);
           // swal({
           //    title: "Thank You!",
           //    //text: "Pembayaran berhasil!",
           //    type: "success",
           //    confirmButtonText: "OK"
           //  },
           //  function(isConfirm){
           //      if (isConfirm) {
           //      window.location.href = "checkinout";
           //    }
           //  });
         } else {
           alert(obj.m);
         }
       }, function(c, m) {
         alert(m);
       });
    }

    // JS MODAL BILLING WISMA END //

    window.openPrint = function (id) {
    	OMAPS_GET_CONNECTION(sitePage + 'cetakNota/'+id, function(response){
    	},function(c, m) {
    		alert(m);
    	});
    }

    // window.openPrint = function (event) {
    //   var thisParameters = $('#billing_id_billing').serialize();
    // 	window.open(sitePage + "cetakNota?"+ thisParameters ,"_blank");
    //   event.preventDefault();
    // }

    // var formCetak = '#form_cetak';
    // $(formCetak).submit(function( event ) {
    //     var thisParameters = $(formCetak).serialize();
    //     // alert(JSON.stringify($(formCetak).serialize()))
    //     window.open(sitePage + "cetakNota?"+ thisParameters ,"_blank");
    //     event.preventDefault();
    //
    // });
});
