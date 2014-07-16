$(document).ready(function(e) {

    $(document).on('click','.btn-toggle',function() {
         ChangeStatus($(this));

        $(this).find('.btn').toggleClass('active');
		if($(this).find('.btn-primary').size() > 0)
        {
			$(this).find('.btn').toggleClass('btn-primary');
		}
		 $(this).find('.btn').toggleClass('btn-default');
    });//click
    
    
    $('#filter-select').change(function(e){
        var catValue = $(this).val();
        if(catValue > 0){
            ajaxFilter(catValue);
        }
       
    });
    
});//document ready



var ajaxFilter = function(category){
    $('.table tbody').load('/ajax/product',
        {
            category: category
        },
        function(data){}
    );
    return false;
}




/**
 * Function sends ajax request to controller, to change status of some records in database
 * 
 */
var ChangeStatus = function(obj)
{
     var url_path = '/ajax/changeproductstatus/'+ (obj).attr('prod_id');
    //ajax load data
    jQuery.ajax({ url: url_path,beforeSend: function(){/*TODO: pre-loader*/}}).done(function(data){});
};