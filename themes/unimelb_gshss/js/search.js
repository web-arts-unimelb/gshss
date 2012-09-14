jQuery(document).ready(function($) {
	$("#search-button").click(function() {
		var search_input_value = $("#search-input").val();
		window.location = '/search/node/' + search_input_value; 
	});
});
