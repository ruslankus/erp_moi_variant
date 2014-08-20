$(document).ready(function(e) {
    
     $(document).on('keydown','.by-name',function(){

        $('.by-name').autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "/ajax/sellers",
                    dataType: "json",
                    data: {
                        term: request.term,
                       
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
        clientFilter(value);
    });//click
    
    
    $(document).on('click','.cust-link',function(e){
        var link = $(this).attr('data-link');
        modalInfo(link);
        return false;
	});// click on body-holder
 
});//document ready


var clientFilter = function(value){
    console.log(value);
	$('.body-holder table tbody').load('/ajax/sellfilter/',
		{ name : value}
	);	
}//clientFilter

var modalInfo = function(link){
    $.ajaxSetup({async:false});
    $('#modal-user-info').load(link);
    $('.cust-info').modal('show');
}//modalInfo
