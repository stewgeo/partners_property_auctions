jQuery(document).ready(function($) {
	$('#publishing-action').hide();
    var publish_link = $('#major-publishing-actions .clear').before(publish_step);
	
	$('#jje_publish_step').click(publishConfirm);
	
	function publishConfirm(e) {
		e.preventDefault();
		console.log('Clicked the publish link.')
		var decision = confirm('Double check agent and then press publish again!');
		if(decision) {
			$('#jje_publish_step').hide();
			$('#publishing-action').show();
		}
	}

});

var publish_step = '<a href="#" id="jje_publish_step">Publish?</a>';

