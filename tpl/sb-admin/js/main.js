/**
 *  WISMA
 *  This is main of Require Configuration
 *
 *  author :
 *  - Regi JG / regijumara@gmail.com
 */
require.config({
    baseUrl: baseURL+'/tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    shim : {
      "bootstrap"                 	: { "deps" :['jquery'] },
      "bootstrapFloatLabel"                 	: { "deps" :['jquery'] },
      "jqueryForm"                  : { "deps" :['jquery'] },
      "dataTable"                   : { "deps" :['jquery'] },
      // "wNumb"                   : { "deps" :['jquery'] },
      "maskMoney"                   : { "deps" :['jquery'] },
      "datepicker"                  : { "deps" :['bootstrap'] },
      "clockpicker"                  : { "deps" :['bootstrap'] },
      "jquery.slimscroll.min"                  : { "deps" :['bootstrap'] },
      "app.min"                      : { "deps" :['bootstrap'] },
      "demo"                        : { "deps" :['bootstrap'] },
      "sweetalert"                        : { "deps" :['bootstrap'] },
      "sweetalert-dev"                        : { "deps" :['bootstrap'] },
      "jqgrid"   		              	: { "deps" :['jquery'] },
      "validation"                 	: { "deps" :['jquery'] },
      "httpcon"                    	: { "deps" :['jquery'] },
      "fv"        							    : { "deps" :['jquery'] },
      "fvbs"        						    : { "deps" :['fv'] },
      "slc2"        					     	: { "deps" :['jquery'] },
      "pn"        						      : { "deps" :['jquery'] },
      "daterg"        					    : { "deps" :['jquery'] },
      "moment"        				      : { "deps" :['jquery'] },
      "type"     		   				      : { "deps" :['jquery'] },
  },
  paths: {
        "jquery"              : 'assets/main/js/jquery-2.2.3.min',
        "jqueryForm"          : 'assets/main/js/jquery.form',
        "dataTable"           : 'assets/main/js/jquery.dataTables.min',
        // "dataTableBs"           : 'assets/datatables.net-bs/js/dataTables.bootstrap.min',
        // "wNumb"               : 'https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min',
        "maskMoney"             : 'assets/main/js/maskMoney',
        "bootstrap"             : 'assets/main/js/bootstrap.min',
        "bootstrapFloatLabel"   : 'assets/main/js/bootstrap-float-label',
        "datepicker"            : 'assets/main/js/bootstrap-datepicker',
        "jquery.slimscroll.min" : 'assets/main/js/jquery.slimscroll.min',
        "app.min"               : 'assets/main/js/app.min',
        "demo"                  : 'assets/main/js/demo',
        "sweetalert"            : 'assets/main/js/sweetalert.min',
        "sweetalert-dev"          : 'assets/main/js/sweetalert-dev',
        "jqgrid-locale"				  : 'assets/main/js/grid.locale-en',
        "jqgrid"							  : 'assets/main/js/jquery.jqGrid',
        "validation"					  : 'assets/main/js/valida.2.1.6.min',
        "clockpicker"           : 'assets/main/js/clockpicker',
        "tpl.all"							  : 'js/page/tpl.all',
        "httpcon"    					  : 'js/connection',
        "base64"    						: 'js/base64',
        "fv"    								: 'assets/main/js/formValidation/formValidation',
        "fvbs"    							: 'assets/main/js/formValidation/bootstrap',
        "slc2"    							: 'assets/main/js/select2.min',
        "pn"    							  : 'assets/main/js/pnotify.custom.min',
        "daterg"							  : 'assets/main/js/daterangepicker',
        "moment"						    : 'assets/main/js/moment',
        "type"								  : 'assets/main/js/typeahead.bundle',
        "nf"									  : 'assets/main/js/numberformat',
    }
});

require([
], function() {});
