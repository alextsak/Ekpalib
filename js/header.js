/**
 * 
 */
$(document).ready(function(){
	
	$('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
		effect: 'fade',
        testMode: true,
        onChange: function(evt){
            //alert("The selected language is: "+evt.selectedItem);
        }
	});

});