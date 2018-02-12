/**
 *  WISMA
 *
 *  author :
 *  - RJG
 */

define([
  "jquery",
	"bootstrap",
	"dataTable",
  // "dataTableNetBs",
  "app.min",
  "jquery.slimscroll.min",
  "demo",
	"base64",
	"jqgrid",
	"jqgrid-locale",
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

  var sitePage = baseURL+'registrasi/';
  var sitePageTamuMenginap = baseURL+'tamu_menginap/';
	var formAreaTamu =  $('#form_registrasi_umum');

  $('.select2').select2();
  // DATA TAMU MENGINAP START//
  $( document ).ready(function() {
		// $(function () {
			$('#example1').DataTable();
		// })
	});

  function formatAction(cellValue, options, rowObject) {
		var id = rowObject.reg_id;
    var status = rowObject.status;
    var actionHtmlTpl = "<a title='' href='javascript:;' onclick='openEditRegistrasi("+'"'+id+ '"'+");'  class='btn btn-xs btn-success'><i class='fa fa-pencil'></i> Edit<a/>";
    // alert(status);
    if (status == 1) {
      return actionHtmlTpl;
    }else{
      return 'Checkout';
    }
  }

  window.openEditRegistrasi = function (id, type) {
     OMAPS_GET_CONNECTION(sitePage + 'detailDataRegistrasi?id='+id, function(response){
        var obj = $.parseJSON(response);
        // alert(obj.tipe_tamu);
        if (obj.tipe_tamu == 1) {
          $("#form_registrasi_umum_edit").trigger('reset');
          // formBooking.data('formValidation').destroy();
          // validateFormBooking();
           $('#modal_registrasi_umum_edit').modal({backdrop: 'static', keyboard: false});
           $("#reg_id_umum_edit").val(obj.reg_id);
           // $('#reg_no_umum_edit').val(obj.reg_no);
           $('#nama_umum_edit').val(obj.nama);
           $('#person_umum_edit').val(obj.person);
           $('#alamat_umum').val(obj.alamat);
           $('#room_number_umum_edit').val(obj.room_number);
           $('#room_number_lama_umum_edit').val(obj.room_number);
           $('#rate_name_umum_edit').val(obj.rate_name);
           $('#price_umum_edit').val(obj.price);
           // $('#rate_id').val(obj.resv_out);
           // $('#floor').val(obj.in_time);

           var nilaiHarga = obj.price;
           var	reverse =nilaiHarga.toString().split('').reverse().join(''),
             ribuan 	= reverse.match(/\d{1,3}/g);
             ribuan	= ribuan.join('.').split('').reverse().join('');
           $('#price_fake_umum_edit').val('Rp. '+ribuan+'');
        }else {
          $("#form_registrasi_diklat_edit").trigger('reset');
          $('#modal_registrasi_diklat_edit').modal({backdrop: 'static', keyboard: false});
          $("#reg_id_diklat_edit").val(obj.reg_id);
          $('#reg_no_edit').val(obj.reg_no);
          $('#nama_diklat_edit').val(obj.nama);
          $('#nama2_diklat_edit').val(obj.nama2);
          $('#alamat_diklat_edit').val(obj.alamat);
          $('#alamat2_diklat_edit').val(obj.alamat2);
          $('#telpon_diklat_edit').val(obj.telpon);
          $('#telpon2_diklat_edit').val(obj.telpon2);
          $('#kode_diklat_diklat_edit').val(obj.kode_diklat).change();
          $('#kode_diklat_diklat_edit').change(function(){
            $('#no_identitas_diklat_edit').val(obj.no_induk).trigger('change');
          });
          $('#judul_diklat_diklat_edit').val(obj.judul_diklat);
          $('#sumber_dana_diklat_edit').val(obj.sumber_dana);
          $('#nama_perusahaan_diklat_edit').val(obj.nama_perusahaan);
          $('#nama_perusahaan2_diklat_edit').val(obj.nama_perusahaan2);
          // $('#no_identitas_diklat_edit').val(obj.no_induk).trigger('change');
          // alert(obj.no_induk);
          $('#person_edit').val(obj.person);
          $('#room_number_diklat_edit').val(obj.room_number);
          $('#room_number_lama_diklat_edit').val(obj.room_number);
          $('#rate_name_diklat_edit').val(obj.rate_name);
          $('#price_diklat_edit').val(obj.price);
          // $('#rate_id').val(obj.resv_out);
          $('#floor_diklat_edit').val(obj.floor);
        }
     }, function(c, m) {
       alert(m);
     });
   }

   window.openMutasiRegistrasi = function (id, type) {
      OMAPS_GET_CONNECTION(sitePage + 'detailDataRegistrasi?id='+id, function(response){
         var obj = $.parseJSON(response);
         // alert(obj.tipe_tamu);
         if (obj.tipe_tamu == 1) {
           $("#form_registrasi_umum_mutasi").trigger('reset');
           // formBooking.data('formValidation').destroy();
           // validateFormBooking();
            $('#modal_registrasi_umum_mutasi').modal({backdrop: 'static', keyboard: false});
            $("#reg_id_umum_mutasi").val(obj.reg_id);
            $('#person_umum').val(obj.person);
            $('#nama_umum_mutasi').val(obj.nama);
            // $('#person_umum_mutasi').val(obj.person);
            $('#alamat_umum_mutasi').val(obj.alamat);
            // $('#room_number_umum_mutasi').val(obj.room_number);
            $('#room_number_umum_lama_mutasi').val(obj.room_number);
            // $('#rate_name_umum_mutasi').val(obj.rate_name);
            // $('#price_umum_mutasi').val(obj.price);
            // $('#rate_id').val(obj.resv_out);
            // $('#floor').val(obj.in_time);

            var nilaiHarga = obj.price;
            var	reverse =nilaiHarga.toString().split('').reverse().join(''),
              ribuan 	= reverse.match(/\d{1,3}/g);
              ribuan	= ribuan.join('.').split('').reverse().join('');
            $('#price_fake_umum_edit').val('Rp. '+ribuan+'');
         }else {
           $("#form_registrasi_diklat_mutasi").trigger('reset');
           $('#modal_registrasi_diklat_mutasi').modal({backdrop: 'static', keyboard: false});
           $("#reg_id_diklat_mutasi").val(obj.reg_id);
           $('#nama_diklat_mutasi').val(obj.nama);
           $('#nama2_diklat_mutasi').val(obj.nama2);
           $('#room_number_diklat_mutasi').val(obj.room_number);
           $('#rate_name_diklat_mutasi').val(obj.rate_name);
           // $('#rate_id').val(obj.resv_out);
           $('#floor_diklat_mutasi').val(obj.floor);
         }
      }, function(c, m) {
        alert(m);
      });
    }

   window.ambilRoomNumberUmum = function (id, type) {
     OMAPS_GET_CONNECTION(sitePage + 'ambilRoomNumber?kode='+id+'&idfield='+type, function(response){
             //console.log(response);
     var obj = $.parseJSON(response);
     var tarifUmum = obj.tarif_umum;
     $("#room_number_umum").val(obj.room_number);
     $("#rate_name_umum").val(obj.rate_name);
     $("#price_umum").val(obj.tarif_umum);
     $("#floor_umum").val(obj.floor)
     var hargaKamar = obj.tarif_umum;

     var	reverse = hargaKamar.toString().split('').reverse().join(''),
       ribuan 	= reverse.match(/\d{1,3}/g);
       ribuan	= ribuan.join('.').split('').reverse().join('');
     $('#price_fake_umum').val('Rp. '+ribuan+'');

     // hitungTotalHariBooking();
     // $('#person').focus();
     }, function(c, m) {
       alert(m);
     });
   }

   window.ambilRoomNumberDiklat = function (id, type) {
     OMAPS_GET_CONNECTION(sitePage + 'ambilRoomNumber?kode='+id+'&idfield='+type, function(response){
             //console.log(response);
     var obj = $.parseJSON(response);
     var tarifUmum = obj.tarif_umum;
     $("#room_number_diklat").val(obj.room_number);
     $("#rate_name_diklat").val(obj.rate_name);
     $("#price_diklat").val(obj.tarif_dinas);
     $("#floor_diklat").val(obj.floor)
     var hargaKamar = obj.tarif_dinas;

     var	reverse = hargaKamar.toString().split('').reverse().join(''),
       ribuan 	= reverse.match(/\d{1,3}/g);
       ribuan	= ribuan.join('.').split('').reverse().join('');
     $('#price_fake_diklat').val('Rp. '+ribuan+'');

     // hitungTotalHariBooking();
     // $('#person').focus();
     }, function(c, m) {
       alert(m);
     });
   }

   window.ambilDataDiklat = function (id, type) {
 		OMAPS_GET_CONNECTION('diklat/ambilDataDiklat?kode='+id+'&idfield='+type, function(response){
 			//console.log(response);
 			var obj = $.parseJSON(response);
       $('#diklat_id_diklat_edit').val(obj.diklatID);
 			$("#kode_diklat_diklat_edit").val(obj.kode_diklat);
 			$("#judul_diklat_diklat_edit").val(obj.full_name);
 			$("#sumber_dana_diklat_edit").val(obj.sumber_dana);
 		 }, function(c, m) {
 			 alert(m);
 		 });
 	}

  window.ambilDataPeserta1 = function (id, type) {
		OMAPS_GET_CONNECTION(sitePageTamuMenginap+'ambilDataPeserta?kode='+id+'&idfield='+type, function(response){
			//console.log(response);
			var obj = $.parseJSON(response);
      var namaPeserta = obj.nama_peserta;
      // alert(namaPeserta.split(' ').join(''));
      $("#pesertaID_1").val(obj.pesertaID);
			$("#no_induk_diklat_edit").val(obj.nip_register);
			$("#nama_diklat_edit").val(namaPeserta.replace(/\s+/g,' ').trim());
			$("#alamat_diklat_edit").val(obj.alamat_rumah);
			$('#telpon_diklat_edit').val(obj.telpon);
			$("#nama_perusahaan_diklat_edit").val(obj.nama_perusahaan);
			$("#no_identitas_diklat_edit").val(obj.no_registrasi);
		 }, function(c, m) {
			 alert(m);
		 });
	}

  window.ambilDataPeserta2 = function (id, type) {
		OMAPS_GET_CONNECTION(sitePageTamuMenginap+'ambilDataPeserta?kode='+id+'&idfield='+type, function(response){
			//console.log(response);
			var obj = $.parseJSON(response);
      var namaPeserta = obj.nama_peserta;
			$("#no_induk2_diklat_edit").val(obj.nip_register);
			$("#nama2_diklat_edit").val(namaPeserta.replace(/\s+/g,' ').trim());
			$("#alamat2_diklat_edit").val(obj.alamat_rumah);
			$('#telpon2_diklat_edit').val(obj.telpon);
			$("#nama_perusahaan2_diklat_edit").val(obj.nama_perusahaan);
			$("#no_identitas2_diklat_edit").val(obj.no_registrasi);
		 }, function(c, m) {
			 alert(m);
		 });
	}

  $('#kode_diklat_diklat_edit').change(function(){
          var peserta = $(this).val();
          $("#no_identitas_diklat_edit > option").remove();
          $.ajax({
              type: "POST",
              url: "checkinout/populate_peserta_diklat",
              data: {no_registrasi: peserta},
              dataType: 'json',
              success:function(data){
                  $.each(data,function(k, v){
                      var opt = $('<option />');
                      opt.val(k);
                      opt.text(v);
                      $('#no_identitas_diklat_edit').append(opt);
                  });
              }
          });
  });

  $('#kode_diklat_diklat_edit').change(function(){
          var peserta = $(this).val();
          $("#no_identitas2_diklat_edit > option").remove();
          $.ajax({
              type: "POST",
              url: "checkinout/populate_peserta_diklat",
              data: {no_registrasi: peserta},
              dataType: 'json',
              success:function(data){
                  $.each(data,function(k, v){
                      var opt = $('<option />');
                      opt.val(k);
                      opt.text(v);
                      $('#no_identitas2_diklat_edit').append(opt);
                  });
              }
          });
  });
  // DATA TAMU HISTORY END//

  // EDIT REGISTRASI UMUM DAN DIKLAT //
  validateFormEditDiklat();
  function validateFormEditDiklat() {
        $('#form_registrasi_diklat_edit').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
        }).on('err.field.fv', function(e, data) {

        }).on('success.form.fv', function(e) {
            e.preventDefault();
            simpan_edit_diklat();
        });
    }

    window.simpan_edit_diklat = function () {
      var url = sitePage + 'prosess_edit_diklat';
      var postData = $("#form_registrasi_diklat_edit").serialize();
      OMAPS_POST_CONNECTION(url, postData, function(response){
        var obj = $.parseJSON(response);
        if (obj.n == 'ss') {
        $('#modal_registrasi_diklat_edit').modal('hide');
          swal({
             title: "Thank You!",
             type: "success",
             confirmButtonText: "OK"
           },
           function(isConfirm){
            if (isConfirm) {
               window.location.href = baseURL+'tamu_menginap';
             }
           });
        } else {
          alert(obj.m);
        }
      },function(c,m) {
        alert(m);
      });
    }

    validateFormEditUmum();
    function validateFormEditUmum() {
          $('#form_registrasi_umum_edit').formValidation({
              framework: 'bootstrap',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              err: {
                  container: 'tooltip'
              },
              fields: {
                keterangan: {
                      validators: {
                          notEmpty: {
                              message: 'Keterangan tidak boleh kosong'
                          },
                      }
                  },
              }
          }).on('err.field.fv', function(e, data) {

          }).on('success.form.fv', function(e) {
              e.preventDefault();
              simpan_edit_umum();
          });
      }

      window.simpan_edit_umum = function () {
        var url = sitePage + 'prosess_edit_umum';
        var postData = $("#form_registrasi_umum_edit").serialize();
        OMAPS_POST_CONNECTION(url, postData, function(response){
          var obj = $.parseJSON(response);
          if (obj.n == 'ss') {
          $('#modal_registrasi_umum_edit').modal('hide');
            swal({
               title: "Thank You!",
               type: "success",
               confirmButtonText: "OK"
             },
             function(isConfirm){
              if (isConfirm) {
                 window.location.href = baseURL+'tamu_menginap';
               }
             });
          } else {
            alert(obj.m);
          }
        },function(c,m) {
          alert(m);
        });
      }
    // EDIT REGISTRASI UMUM DAN DIKLAT //

    // MUTASI REGISTRASI UMUM DAN DIKLAT //
      validateFormMutasiUmum();
      function validateFormMutasiUmum() {
            $('#form_registrasi_umum_mutasi').formValidation({
              framework: 'bootstrap',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              err: {
                  container: 'tooltip'
              },
              fields: {
                keterangan: {
                      validators: {
                          notEmpty: {
                              message: 'Keterangan tidak boleh kosong'
                          },
                      }
                  },
              }
          }).on('err.field.fv', function(e, data) {
              data.fv.disableSubmitButtons(false);
          }).on('success.field.fv', function(e, data) {
              data.fv.disableSubmitButtons(false);
          }).on('success.form.fv', function(e) {
              e.preventDefault();
              simpan_mutasi_umum();
          });
        }

        window.simpan_mutasi_umum = function () {
          var url = sitePage + 'prosess_mutasi_umum';
          var postData = $("#form_registrasi_umum_mutasi").serialize();
          OMAPS_POST_CONNECTION(url, postData, function(response){
            var obj = $.parseJSON(response);
            if (obj.n == 'ss') {
            $('#modal_registrasi_umum_mutasi').modal('hide');
              swal({
                 title: "Thank You!",
                 type: "success",
                 confirmButtonText: "OK"
               },
               function(isConfirm){
                if (isConfirm) {
                   window.location.href = baseURL+'tamu_menginap';
                 }
               });
            } else {
              alert(obj.m);
            }
          },function(c,m) {
            alert(m);
          });
        }

    validateFormMutasiDiklat();
    function validateFormMutasiDiklat() {
          $('#form_registrasi_diklat_mutasi').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            err: {
                container: 'tooltip'
            },
            fields: {
              keterangan: {
                    validators: {
                        notEmpty: {
                            message: 'Keterangan tidak boleh kosong'
                        },
                    }
                },
            }
        }).on('err.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
        }).on('success.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            simpan_mutasi_diklat();
        });
      }

      window.simpan_mutasi_diklat = function () {
        var url = sitePage + 'prosess_mutasi_diklat';
        var postData = $("#form_registrasi_diklat_mutasi").serialize();
        OMAPS_POST_CONNECTION(url, postData, function(response){
          var obj = $.parseJSON(response);
          if (obj.n == 'ss') {
          $('#modal_registrasi_diklat_mutasi').modal('hide');
            swal({
               title: "Thank You!",
               type: "success",
               confirmButtonText: "OK"
             },
             function(isConfirm){
              if (isConfirm) {
                 window.location.href = baseURL+'tamu_menginap';
               }
             });
          } else {
            alert(obj.m);
          }
        },function(c,m) {
          alert(m);
        });
      }
  // MUTASI REGISTRASI UMUM DAN DIKLAT //

});
