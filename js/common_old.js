$(document).ready(function(e) {

    $('.btn-toggle').click(function(e) {

        ChangeStatus($(this);


        $(this).find('.btn').toggleClass('active');
		if($(this).find('.btn-primary').size() > 0)
        {
			$(this).find('.btn').toggleClass('btn-primary');
		}
		 $(this).find('.btn').toggleClass('btn-default');
    });
});

/**
 * Function sends ajax request to controller, to change status of some records in database
 * @param model_class string class of model
 * @param url_path string path to controller
 * @param id int id of record
 * @param status int active or not
 * @constructor
 */
var ChangeStatus = function(obj)
{
    Console.log(obj);
    
    var url_path = '/ajax/changeproductstatus/'+ (obj).attr('prod_id');
    //ajax load data
    
};