jQuery(document).ready(function($) {

	$(document).on('click', '#cn-accept-cookie', function(event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: cnArgs.ajaxurl,
			data: {
				action: 'cn-save-cookie'
			},
			dataType: 'html'
		})
		.done(function(data) {
			if(data === 'CN_OK') {
				cnHideFrontBox();
			} else {
				cnSetCookie();
				cnHideFrontBox();
			}
		}).fail(function(data) {
			cnSetCookie();
			cnHideFrontBox();
		});
	});


	function cnHideFrontBox() {
		if(cnArgs.hideEffect === 'fade') {
			$('#cookie-notice').fadeOut(300, function() {
				$(this).remove();
			});
		} else if(cnArgs.hideEffect === 'slide') {
			$('#cookie-notice').slideUp(300, function() {
				$(this).remove();
			});
		} else {
			$('#cookie-notice').remove();
		}
	}


	function cnSetCookie() {
		var cnTime = new Date();
		var cnLater = new Date();

		cnLater.setTime(cnTime.getTime() + cnArgs.cookieTime);
		document.cookie = cnArgs.cookieName+"="+escape(cnArgs.cookieValue)+";expires="+cnLater.toGMTString()+';domain='+cnArgs.cookieDomain+';path='+cnArgs.cookiePath;
	}
});