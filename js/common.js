$(document).ready(function(e) {
    $('.btn-toggle').click(function(e) {
        $(this).find('.btn').toggleClass('active');
		if($(this).find('.btn-primary').size() > 0){
			$(this).find('.btn').toggleClass('btn-primary');		
		}
		 $(this).find('.btn').toggleClass('btn-default');
    });
	
	$.fn.editable.defaults.mode = 'inline'; 
	
	$('#ed_Type').editable({
        value: 1,    
        source: [
              {value: 1, text: 'Fizinis'},
              {value: 2, text: 'Juridinis'},
           ]
    });
	
	$('#datepick').datepicker({
		orientation: "bottom left"	
	});
	
});