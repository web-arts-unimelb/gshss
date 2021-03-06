Drupal.behaviors.the_search = {
	attach: function (context, settings) {
		__define_focus();

		$("#search-button", context).click(function() {
			var search_input_value = $("#search-input").val();
			window.location = '/search/node/' + search_input_value;
		});

		__handle_search_by_pressing_return();
	}
};


Drupal.behaviors.career_and_program = {
	attach: function (context, settings) {
		// Initial
		var target_class_name = "." + "careers-by-program-row";
		var href_link = $(target_class_name).prev().find("a");
		var item_list_class_name = target_class_name + " .item-list";

		href_link.removeAttr("href");
		href_link.css("cursor", "pointer");
	
		$(item_list_class_name).hide();
		$(target_class_name).prev().css("margin-top", "-5px");

		// Listen
		$(target_class_name).prev().find("a").click(function(){
			$(this).parent().next().find(".item-list").toggle();
		});
	
		// Initial
		var target_class_name = "." + "programs-by-career-row";
		var first_row = ".views-row-1" + target_class_name; 
		var href_link = $(first_row).prev().find("a");	

		href_link.removeAttr("href");
		href_link.css("cursor", "pointer");

		$(target_class_name).hide();
		$(target_class_name).prev().css("margin-top", "-2px");	


		// Listen
		$(first_row).prev().find("a").click(function(){
			var curr_element = $(this).parent().next();
			var tag_name = curr_element.get(0).tagName;
			if(tag_name == "DIV")
			{
				// First div
				curr_element.toggle();

				// 2nd div and so on
				while(curr_element.next().get(0).tagName == "DIV")
				{
					curr_element.next().toggle();
					curr_element = curr_element.next();
				}
			}
			else
			{

			}
		});	
	
	}
};

// Define your functions

// Add focus, so we can use
function __define_focus()
{
	var filters = $.expr[":"];
	if ( !filters.focus ) { 
	    filters.focus = function( elem ) {
	       return elem === document.activeElement && ( elem.type || elem.href );
	    };
	}
}


function __handle_search_by_pressing_return()
{
	$(document).keypress(function(e) {
		// Return is pressed.		
		if(e.which == 13) 
		{
			// Search box is focused.
			if( $("#search-input").is(":focus") )
			{
				var search_input_value = $("#search-input").val();
				window.location = '/search/node/' + search_input_value;
			}
		}
	});
}


