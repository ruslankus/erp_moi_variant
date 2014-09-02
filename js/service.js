
$(function() {
    $.fn.editable.defaults.mode = 'inline';
	
    $('#client-type').change(function(e) {
        
		var val = $(this).val()
		if(val == 0){
        	$('.filter-wrapper').html('<h5 class="text-center">Select client type</h5>');
		}else{
			changeFilter(val);
		}
    });//change
    
     $(document).on('keydown','.by-name',function(){

        $('.by-name').autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "/ajax/clients",
                    dataType: "json",
                    data: {
                        term: request.term,
                        type: jQuery("#client-type").val()
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            minLength: 1,
            
            select:function(event,ui){
                var id = ui.item.id; //get id of client
                var label = ui.item.label; //get entered word
            
            }
        });  
    
    });//live
    
     $(document).on('click','#filter-search',function(){
        var value = $('.by-name').val();
        var type = $("#client-type").val();
      
        clientFilter(type,value);
    });//click
    
    $(document).on('click','.cust-link',function(e){
        var link = $(this).attr('data-link');
        modalInfo(link);
        return false;
	});// click on body-holder
   
  
  
}); // document ready


var modalInfo = function(link){
    $.ajaxSetup({async:false});
    $('#modal-user-info').load(link);
    $('.cust-info').modal('show');
}//modalInfo


var clientFilter = function(type,value){
    console.log(type,value);
	$('.body-holder table tbody').load('/ajax/custfilter/',
		{type: type, name : value}
	);	
}//clientFilter


var changeFilter = function(val){
	$(".filter-wrapper").load('/ajax/fselector/'+val);
}//changeFilter


var clientForm = function(obj){
    var clientName = obj.val();
	console.log(clientName);
	$('.right-part .form-holder').load('/ajax/check_customer',
		{name : clientName},function(data){});
 }



