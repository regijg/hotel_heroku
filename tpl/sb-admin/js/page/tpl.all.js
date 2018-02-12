/**
 *  WISMA
 *
 *  author :
 *  - Regi JG / regijumara@gmail.com
 */


define([
   "jquery",
	"jqueryForm",
  // "wNumb",
  "maskMoney",
	"bootstrap",
	"bootstrapFloatLabel",
  "dataTable",
  // "dataTableNet",
  // "dataTableNetBs",
  "app.min",
  "jquery.slimscroll.min",
  "demo",
	"pn",
	"daterg",
	"moment",
], function($, bs ) {

	var pagePelayanan = baseURL+'pelayanan/'
	/**
	 * Error Notif
	 */
	window.errorNotif = function(t, m) {
		requirejs(['pnotify','pnotify.buttons'],function(PNotify) {
			new PNotify({
			    title: t,
			    text:m,
			    delay: 2000,
			    type: 'error',
			});
		});
	};


	/**
	 * Success Notif
	 */
	window.successNotif = function(t, m) {
		requirejs(['pnotify','pnotify.buttons'],function(PNotify) {
			new PNotify({
			    title: t,
			    text:m,
			    delay: 2000,
			    type: 'success',
			});
		});
	};

	/**
	 * Confirm Notif
	 */
	window.confirmNotif = function() {
	requirejs(['pnotify','pnotify.confirm','pnotify.buttons'],function(PNotify) {
	(new PNotify({
	    title: 'Confirmation Needed',
	    text: 'Are you sure?',
	    icon: 'glyphicon glyphicon-question-sign',
	    hide: false,
	    confirm: {
	        confirm: true
	    },
	    buttons: {
	        closer: true,
	        sticker: true
	    },
	    history: {
	        history: false
	    },
	    addclass: 'stack-modal',
        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
	})).get().on('pnotify.confirm', function() {
	    alert('Ok, cool.');
	}).on('pnotify.cancel', function() {
	    alert('Oh ok. Chicken, I see.');
	});
	});
	}

	$(function() {
//		 $( "#tanggal_pelayanan" ).daterangepicker({
//			 useCurrent: true,
//			 dateFormat: "DD MMM YYYY"
//       	});
		 $( "#tanggal_pelayanan" ).daterangepicker({
			 useCurrent: true,
			 minDate: new Date(),
			 autoUpdateInput: true,
			 singleDatePicker: true,
	         locale: {
	        	 format: "DD MMM YYYY",//gara2 iki lo ga ada format date disini
	             cancelLabel: 'Clear',
	         }
        });


		 $( "#tanggal_pelayanan" ).on('apply.daterangepicker', function(ev, picker) {
			 //alert(picker.startDate.format('DD MMM YYYY'));
           $(this).val(picker.startDate.format('DD MMM YYYY'));
        });

		 $( "#tanggal_pelayanan" ).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

      });





});
