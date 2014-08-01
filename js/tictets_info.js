$(document).ready(function(e) {
	
	$.fn.editable.defaults.mode = 'inline'; 
    
	$("#ed_msg_ticket").editable({
		  type:  'textarea'	
	});
	
	$("#ed_ticket_subj").editable({
	});
	
	
});//dicument ready