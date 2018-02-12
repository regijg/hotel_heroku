
/*
 * OMAPSLAB JQUERY CONNECTION HANDLER
 * This is Generic Function for handle GET, POST, SUBMIT Connection with JQUERY
 *
 * Author : Agus Prasetyo
 * Email : agusprasetyo811@gmail.com
 *
 */

var timeOut = 15000;

/**
 *
 * @param url
 * @param run
 * @returns
 */
function OMAPS_GET_CONNECTION(url, run, callback) {
	$.ajax({
		type : "GET",
		url : url,
		timeout: timeOut,
		success : function(data) {
			run(data);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
	        OMAPS_NETWORK_ERROR_HANDLER(XMLHttpRequest, textStatus, errorThrown, callback);
	    }
	});
}

/**
 *
 * @param url
 * @param postData
 * @param run
 * @returns
 */
function OMAPS_POST_CONNECTION(url, postData, run, callback) {
	$.ajax({
		type : "POST",
		url : url,
		timeout: timeOut,
		data: postData,
		success : function(data) {
			run(data);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
	       OMAPS_NETWORK_ERROR_HANDLER(XMLHttpRequest, textStatus, errorThrown, callback);
	    }
	});
}

/**
 *
 * @param tagID
 * @param run
 * @returns
 */
function OMAPS_SUBMIT_CONNECTION(tagID, run, callback) {
	$(tagID).submit(function(e) {
		e.preventDefault();
	    $(this).ajaxSubmit({
			timeout: timeOut,
			success: function(response) {
				run(response);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
		       OMAPS_NETWORK_ERROR_HANDLER(XMLHttpRequest, textStatus, errorThrown, callback);
		    }
	    });
	    e.unbind();
	});
	return false;
}

/**
 *
 * @param tagID
 * @param run
 * @returns
 */
function OMAPS_AJAXSUBMIT_CONNECTION(tagID, run, callback) {
	$(tagID).ajaxSubmit({
		timeout: timeOut,
		success: function(response) {
			run(response);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
	       OMAPS_NETWORK_ERROR_HANDLER(XMLHttpRequest, textStatus, errorThrown, callback);
	    }
    });
	return false;
}

/**
 *
 * @param tagID
 * @param beforeSend
 * @param uploadProgress
 * @param complete
 * @returns
 */
function OMAPS_AJAXFORM_CONNECTION(tagID, beforeSend, uploadProgress, complete) {
	 $(tagID).ajaxForm({
        beforeSend: function() {
        	beforeSend();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            uploadProgress(event, position, total, percentComplete);
        },
        complete: function(xhr) {
        	complete(xhr)
        }
    });
}

/**
 *
 * @param XMLHttpRequest
 * @param textStatus
 * @param errorThrown
 * @param callback
 * @returns
 */
function OMAPS_NETWORK_ERROR_HANDLER(XMLHttpRequest, textStatus, errorThrown, callback) {
	var m = '';
	if (XMLHttpRequest.readyState == 4) {
        m = 'Something wrong, Request Not Initialized. Please check Your Connection again ';
        callback(XMLHttpRequest.readyState, m);
    } else if (XMLHttpRequest.readyState == 0) {
    	m = 'Something wrong, Request Not Initialized. Please check Your Connection again ';
    	callback(XMLHttpRequest.readyState, m);
    } else if (XMLHttpRequest.readyState == 1) {
        m = 'Something wrong, Server Connection Established. Please check Your Connection again ';
        callback(XMLHttpRequest.readyState, m);
    } else {
        m = 'Something wrong, Request Not Initialized.. Please check Your Connection again ';
        callback(XMLHttpRequest.readyState, m);
    }
}
