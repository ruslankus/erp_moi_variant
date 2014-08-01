/**
 * Created by Wolfdark on 21.07.14.
 */

jQuery(document).ready(function(){
    $.fn.editable.defaults.mode = 'inline';
	
    $('#client-type').change(function(e) {
		var val = $(this).val()
		if(val == 0){
        	$('.filter-wrapper').html('<h5 class="text-center">Select client type</h5>');
		}else{
			changeFilter(val);
		}
    });


}); // document ready

var changeFilter = function(val){
	$(".filter-wrapper").load('/ajax/fselector/'+val);
}//changeFilter


var clientForm = function(obj){
    var clientName = obj.val();
	console.log(clientName);
	$('.right-part .form-holder').load('/ajax/check_customer',
		{name : clientName},function(data){});
 }





//when ajax loaded
jQuery(document).ajaxComplete(function(){

    //get editable type-field
    var editTypeFiled = jQuery('#ed_type');

    //for selectable client type field
    editTypeFiled.editable({
        type: 'select',
        value: 'none',
        name: 'select',
        title: editTypeFiled.attr('title'),
        send: 'newer'
        //when changed value
    }).on('save', function(e, editable){
            //st value to hidden field
            jQuery('#ed_typeH').val(editable.newValue);

            //if switched to company
            if(editable.newValue == 1)
            {
                showFields('both'); //show all fields
                hideFields('phys'); //hide physical fields
                showFields('jur'); //show juridical fields

            }
            //if switched to person
            else
            {
                showFields('both'); //show all fields
                hideFields('jur'); //hide juridical fields
                showFields('phys'); //show physical fields
            }
        });


    //for text items
    jQuery('.text-editable').editable({
        type:  'text',
        name:  'username',
        title: jQuery(this).attr('title'),
        send:  'newer'
        //when changed value
    }).on('save', function(e, editable){
            //get id of current link
            var id =  jQuery(this).attr('id');
            //find by this id hidden field and set value (hidden field has same id, but with H letter in end)
            jQuery('#'+id+'H').val(editable.newValue);
        });
});

/**
 * Adds class 'hidden' to element
 * @param type class name
 */
var hideFields = function(type)
{
    jQuery('.'+type).addClass('hidden');
};

/**
 * Removes class 'hidden' from element
 * @param type
 */
var showFields = function(type)
{
    jQuery('.'+type).removeClass('hidden');
};
