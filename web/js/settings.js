// validator checkboxes
$('.validator-enabled input:checkbox').change(
    function(){
        if ($(this).is(':checked')) 
            $(this).closest('.validator-enabled').next('.collapse').collapse('show');
        else
            $(this).closest('.validator-enabled').next('.collapse').collapse('hide');
    }
);

$('#dynamic-input-form').on('afterValidate', function(){
    $( ".panel-heading .nav-tabs .has-error" ).removeClass( "has-error" );
    $('.tab-content .tab-pane').each(function(i, obj) {
        if($(this).find('.has-error').length !== 0){
            $( ".panel-heading .nav-tabs li" ).eq( i ).addClass( "has-error" );
        }
    });
});
