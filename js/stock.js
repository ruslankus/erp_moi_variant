jQuery(document).ready(function(){

    jQuery('#prod-name').autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "/stock/autocompleteproductcards",
                dataType: "json",
                data: {
                    name: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        minLength: 1
    });

    jQuery('#prod-code').autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "/stock/autocompleteproductcards",
                dataType: "json",
                data: {
                    code: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        minLength: 1
    });

    /**
     * When clicked on 'filter' button
     */
    jQuery(document).on('click','.filter-button-top',function(){
        var params = getParamsFromInputs();
        filter(params);
        return false;
    });

    /**
     * When clicked on pagination page
     */
    jQuery(document).on('click','.links-pages',function(){
        var params = getParamsFromInputs();
        params.page = jQuery(this).html(); //get page number
        filter(params);
    });

});

/********************************************************************************************************************/

/**
 * Returns parameters from inputs for ajax request (POST parameters)
 * @returns {{name: *, code: *, location: *, units: *}}
 */
var getParamsFromInputs = function(){

    var prod_name = jQuery('#prod-name').val();
    var prod_code = jQuery('#prod-code').val();
    var stock_loc_id = jQuery('#stock-location').val();
    var measures = jQuery('#measure-units').val();

    return {
        name : prod_name,
        code : prod_code,
        location: stock_loc_id,
        units : measures
    };
};

/**
 * Loads filtered data to table
 * @param params
 */
var filter = function(params)
{
    var filter_url = '/stock/filter';
    jQuery(".table-holder").load(filter_url,params);
};//filter