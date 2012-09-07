jQuery(document).ready(function($) {
	/*
		* Handle careers by program
		* Sample html
		* We use uom-row-class as a start point
		
		<h3><a href="xxxx">Eum Valde</a></h3>
  		<div class="views-row views-row-1 views-row-odd views-row-first views-row-last careers-by-program-row">
  			<div class="views-field views-field-field-career-outcomes">        
				<div class="field-content">
					<div class="item-list">
						<ul>
							<li class="first">Corporate communications</li>
							<li>Advocacy</li>
							<li>Advocacy</li>
							<li class="last">Public service</li>
						</ul>
					</div>
				</div>  
			</div>  
		</div>
	*/

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


	/*
		* Handle programs by career
		* Sample html
		<h3><a href="http://gshss.local/#">Defence</a></h3>
  		<div class="views-row views-row-1 views-row-odd views-row-first programs-by-career-row">
			<a href="http://gshss.local/executive-master-arts-0">Executive Master of Arts</a>    
        </div>

		<div class="views-row views-row-2 views-row-even programs-by-career-row">
      		<a href="http://gshss.local/9nfcxyhaxgpksvnmufk5nezdoywndiyy5vhmbbmnbpgj54de3gtmuqqytvl5aaq4jq6clkuqxbkpwxr4qu9ducgppdgozguwytlt">9NFcxyhAXGPksVNMufk5NEzDoywNdiYY5vHMbBmnbpGJ54dE3GTMUqQYtVL5aAq4jQ6CLkUqxbkpWXR4qu9DuCGpPDgozGuwYTLTNNhX4SYZ3SFY2aYLtkUAjVDXZtdfRrAAHQh23wFTehaAnof9LWoCFY4h3kJDDgLpUbQCwsXXeqJiSxLKmTdkmGtXNVgwxYPffwFCKxwZYyu6pNxGaMhC5yRP9ELL8XKrB45pDpM4npGKWqLe6GCRw45Reku</a>    
        </div>

		<div class="views-row views-row-3 views-row-odd views-row-last programs-by-career-row">
			<a href="http://gshss.local/anzevlsknbbb5a6dxvtjxcdw6thn5hwsoumgeazyb6nbu2spwkxmq66ceesy9rhfgrdfwjxydjtw7pqb6fk3qgzido4papfnmftu">aNZEVLskNBbb5A6dXvtjXcdW6thN5HWSoUMgEAzYB6NbU2spWkXMq66CeEsy9RhfgRdFWjxYdJtW7pQb6FK3qGziDo4pApfNMFtUyXqLEuTYjqJN3qY73VGkdLCVJxaKPW6EYTkEf3GrmAdGE9vWmr2BJzbhc5vdbaPoUyw84cLaMejpvHneJpAinT4fZz8LZSEUKGMixkKBrZJiK4HpGcstPHDEt2JQfZheyoBgscBLbh95oNqPFxXTkqhGFis</a>    
        </div>
	*/
	
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
});
