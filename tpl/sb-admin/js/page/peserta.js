define([
		"jquery",
		"bootstrap",
		"datepicker",
		"jquery.slimscroll.min",
		"app.min",
		"demo",
		"type",
		"base64",
		"jqgrid",
		"jqgrid-locale",
		"validation",
		"httpcon",
		"fv",
		"fvbs",
		"slc2",
		"daterg",
		"moment",
		"nf",
], function($, bs, Bloodhound ) {

    var save_method;
    var table;

    var sitePage = baseURL+'peserta/'
    var formArea = $('#form_peserta');
		$(".select2").select2();

		$('#datepicker').datepicker({
					autoclose: true,
		});



		window.menyatukan =  function (){
		        var text1 = document.getElementById('title1_gelar_depan').value;
		        var text2 = document.getElementById('title2_gelar_belakang').value;
		        var text3 = document.getElementById('nama_peserta_input').value;
		        if(text1 !== "" || text2 !== "" || text3 !== ""){
		            var full_name_peserta = text1 + ". " +text3+ ", " +text2;
		        text1.value = "";
		        document.getElementById('full_name_peserta').value = full_name_peserta;
		   }
		}

		var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"/"+(month)+"/"+(day) ;
    $('#datepicker').val(today);

		window.ambilDataProvinsi = function (id, type) {
		OMAPS_GET_CONNECTION(sitePage + 'ambilDataProvinsi?kode='+id+'&idfield='+type, function(response){
			//console.log(response);
			var obj = $.parseJSON(response);
			// $("#diklatID").val(obj.diklatID);
			//$("#kode_provinsi").val(obj.kode);
			$("#nama_provinsi").val(obj.nama_provinsi);

			//$("#satuan_barang_"+obj.iterasi).select2();
		 }, function(c, m) {
			 alert(m);
		 });
	}

	window.ambilDataKabupaten = function (id, type) {
	OMAPS_GET_CONNECTION(sitePage + 'ambilDataKabupaten?kode='+id+'&idfield='+type, function(response){
		//console.log(response);
		var obj = $.parseJSON(response);
		// $("#diklatID").val(obj.diklatID);
		//$("#kode_kabupaten").val(obj.kode);
		$("#nama_kabupaten").val(obj.nama_kabupaten);

		//$("#satuan_barang_"+obj.iterasi).select2();
	 }, function(c, m) {
		 alert(m);
	 });
}

  window.add_peserta = function(){
      save_method = 'add';
      //$('#form')[0].reset();
      $('.form-group').removeClass('has-error');
      $('.headBlock').empty();
      $('#modal_form').modal('show');
      $('.modal-title').text('BIODATA PESERTA DIKLAT');
  }

  window.save = function(){
        var url;
        if(save_method == 'add'){
            url = sitePage + 'process';
        }else{
            url = sitePage + 'ajax_update';
        }

        $.ajax({
            url : url,
            type : 'POST',
            data : $('#form_peserta').serialize(),
            success: function(data){
                location.reload();
            }
        });
    }

			  window.resetform = function () {
			      document.getElementById("form_peserta").reset();
			  }

  var colModel =  [
      { label: '',
        name: '',
        width: 50,
        formatter: formatAction,
        ignoreCase: true,
        align: 'center'
      },
        {
          label: 'NIP',
          name: 'nip_register',
          width: 160,
          index: 'nip_register',
          align: 'left'
        },
        {
          label: 'Nama Peserta',
          name: 'full_name',
          width: 200,
          index: 'full_name',
          align: 'left'
        },
        {
          label: 'Unit Kerja /Instansi',
          name: 'nama_perusahaan',
          width: 400,
          index: 'nama_perusahaan',
          align: 'left'
        },
        {
          label: 'Jabatan',
          name: 'jabatan',
          width: 100,
          index: 'jabatan',
          align: 'left'
        },
        {
          label: 'email',
          name: 'email',
          //width: null,
          index: 'email',
          align: 'left'
        },
        {
          label: 'Kabupaten',
          name: 'nama_kabupaten',
          //width: 80,
          index: 'nama_kabupaten',
          align: 'left'
        },
        {
          label: 'Provinsi',
          name: 'nama_provinsi',
          //width: 80,
          index: 'nama_provinsi',
          align: 'left'
        }
    ];

    $.jgrid.defaults.width = $('#grid').width();
    $.jgrid.defaults.height = 583;
    $.jgrid.styleUI.Bootstrap.base.headerTable = "table";
    $.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered responsive";
  $(document).ready(function () {
        $("#jqGrid").jqGrid({
            url: baseURL+'peserta/list_data_peserta?callback=?&qwery=orders',
            mtype: "GET",
            styleUI : 'Bootstrap',
            datatype: "jsonp",
            ignoreCase: true,
            colModel: colModel,
            viewrecords: true,
            page: 1,
            //toppager:true,
            scrollPopUp:true,
            colMenu : false,
            autowidth: true,
            shrinkToFit : true,
            //multiselect: true,
            rownumbers: true,
            rownumWidth: 35,
            rowNum: 15,
            rowList:[10,25,50,100],
            viewrecords: true,
            hoverrows: true,
            subGrid: true,
            sortorder:'asc',
            pager: "#jqGridPagerData",
        });
      });

      function formatAction(cellValue, options, rowObject) {
      var id = rowObject.pesertaID;
      //console.log(rowObject);
      //alert(id);
      var actionHtmlTpl = "<a title='Edit' onclick='editPeserta("+id+");'  class='btn btn-xs'><i class=' fa fa-pencil'></i><a/> ";
          return actionHtmlTpl;
      }

			window.editPeserta = function(id){
        save_method = 'update';
        //$('#form_peserta')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.headBlock').empty();


        $.ajax({
            url : sitePage + 'edit_action/'+id,
            type : "GET",
            dataType : "JSON",
            success: function(data){
                $('[name=pesertaID]').val(data.pesertaID);
                $('[name=nama_peserta]').val(data.nama_peserta);
                $('[name=nip_register]').val(data.nip_register);
                $('[name=tempat_lahir]').val(data.tempat_lahir);
                $('[name=tanggal_lahir]').val(data.tanggal_lahir);
                $('[name=title1]').val(data.title1);
                $('[name=title2]').val(data.title2);
                $('[name=full_name]').val(data.full_name);
                $('select[name=kelamin]').val(data.kelamin);
                $('select[name=agama]').val(data.agama);
                $('[name=alamat_rumah]').val(data.alamat_rumah);
                $('[name=telpon]').val(data.telpon);
                $('[name=email]').val(data.email);
                $('select[name=kode_provinsi]').val(data.kode_provinsi).trigger('change');
                $('select[name=kode_kabupaten]').val(data.kode_kabupaten).trigger('change');
								$('[name=nama_provinsi]').val(data.nama_provinsi);
								$('[name=nama_kabupaten]').val(data.nama_kabupaten);
                $('select[name=id_negara]').val(data.id_negara).trigger('change');
                $('[name=jenis_identitas]').val(data.jenis_identitas);
                $('[name=nomor_identitas]').val(data.nomor_identitas);
								$('[name=asal_peserta]').val(data.asal_peserta);
								$('[name=nama_perusahaan]').val(data.nama_perusahaan);
								$('[name=alamat_kantor]').val(data.alamat_kantor);
								$('[name=telp_kantor]').val(data.telp_kantor);
								$('[name=jabatan]').val(data.jabatan);
								$('[name=riwayat_pekerjaan]').val(data.riwayat_pekerjaan);
								$('[name=riwayat_diklat]').val(data.riwayat_diklat);
								$('[name=riwayat_pendidikan]').val(data.riwayat_pendidikan);
								$('[name=riwayat_jabatan]').val(data.riwayat_jabatan);
								$('[name=pendidikan_ln]').val(data.pendidikan_ln);
								$('[name=pendidikan_khusus]').val(data.pendidikan_khusus);
								// $('[name=alamat_kantor]').val(data.alamat_kantor);
								// $('[name=jabatan]').val(data.jabatan);
                $('#modal_form').modal('show');
                //$('.modal-title').text('BIODATA PESERTA DIKLAT');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

      window.searchData = function(key) {
          $("#jqGrid").setGridParam({
            url: baseURL+'peserta/list_data_peserta?callback=?&qwery=orders&key='+key,
                page:1
            }).trigger("reloadGrid");
        };

      $('#kode_provinsi').change(function(){
          var country_id = $(this).val();
          $("#kode_kabupaten > option").remove();
          $.ajax({
              type: "POST",
              url: "peserta/populate_provinsi",
              data: {kode_kabupaten: country_id},
              dataType: 'json',
              success:function(data){
                  $.each(data,function(k, v){
                      var opt = $('<option />');
                      opt.val(k);
                      opt.text(v);
                      $('#kode_kabupaten').append(opt);
                  });
              }
          });
      });

      $('#provinsiInfoPekerjaan').change(function(){
          var country_id = $(this).val();
          $("#kab > option").remove();
          $.ajax({
              type: "POST",
              url: "/peserta/populate_provinsi",
              data: {id: country_id},
              dataType: 'json',
              success:function(data){
                  $.each(data,function(k, v){
                      var opt = $('<option />');
                      opt.val(k);
                      opt.text(v);
                      $('#kabInfoPekerjaan').append(opt);
                  });
              }
          });
      });


			var colModelLookup =  [
			        {
			        	label: 'Nama',
			        	name: 'nama_perusahaan',
			        	width: 200,
			        	index: 'nama_perusahaan',
			        	align: 'left'
			        },
			        {
			        	label: 'alamat',
			        	name: 'alamat',
			        	width: 200,
			        	index: 'alamat',
			        	align: 'left'
			        },
			        {
			        	label: 'Provinsi',
			        	name: 'nama_provinsi',
			        	width: 100,
			        	index: 'nama_provinsi',
			        	align: 'left',
			        },
			        {
			        	label: 'Kab/ Kota',
			        	name: 'nama_kabupaten',
			        	width: 100,
			        	index: 'nama_kabupaten',
			        	align: 'left',
			        },
			        {
			        	label: 'Action',
			        	name: '',
			        	width: 80,
			        	formatter: formatActionLookup,
			        	ignoreCase: true,
			        	align: 'left'
			        }

			    ];
					function formatActionLookup(cellValue, options, rowObject) {
						console.log($('#id_kode_modal').val());
							var id = rowObject.perusahaanID;
							var i = rowObject.id_kode
							var kode= id+'_'+i;
							var getIdCode = 0;
							console.log(JSON.stringify(rowObject.perusahaanID));
							var actionHtmlTpl = "<a title=' Pilih Perusahaan' href='javascript:;' onclick='closeKode("+'"'+kode+ '"'+");'  class='btn btn-xs btn-primary'><i class='fa fa-hand-o-up'></i><a/> ";
					        return actionHtmlTpl;
					    }

			window.openKode = function (value) {
		    	var i = value.split('_');
		    	$("#form_cari").trigger('reset');
		 	    $('#modal_kode').modal('show');
		 	    $('#jqGridVlookup').setGridParam({
		          url: baseURL+'peserta/list_data_vlookup?callback=?&id_kode='+ i[1],
		          page: 1,
		          postData: { filters: null}
		 	    });
    	//alert(value);
 	    $('#jqGridVlookup').trigger('reloadGrid');
    }

		window.closeKode = function (value) {
		    	var str = value.split('_');
		    	if (confirm('Apakah anda yakin ingin memilih kode ini '+ str[0]+'?')) {

		    	if (value != undefined){
		    	var kode =  str[0];
		    	var id =  'id_'+value;

		    	$('#modal_kode').modal('hide');

				} else {
					alert('kode obat tidak ada');
				}
		    	}
		   }

			$("#jqGridVlookup").jqGrid({
	        url: baseURL+'peserta/list_data_vlookup?callback=?&qwery=orders',
	        mtype: "GET",
	        styleUI : 'Bootstrap',
					height:'51%',
	        datatype: "jsonp",
	        ignoreCase: true,
	        colModel: colModelLookup,
	        viewrecords: true,
	        page: 1,
	        toppager:true,
	        //scrollPopUp:true,
	        rowNum: 10,
	        colMenu : false,
	        //autowidth: true,
	        shrinkToFit : true,
	        //multiselect: true,
	        rownumbers: true,
	        rownumWidth: 50,
	        viewrecords: true,
	        hoverrows: true,
	        sortorder:'desc',
	        pager: "#jqGridPagerDataLookup",
	    });
      $("#jqGridVlookup").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false, defaultSearch: "cn" });

});
