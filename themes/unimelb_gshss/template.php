<?php
/**
 * @file
 * Preprocess functions and theme overrides for the unimelb_gshss theme.
 */

/**
 * Implements hook_preprocess_html().
 */
function unimelb_gshss_preprocess_html(&$variables) {
  $variables['overlay'] = FALSE;
  if (module_exists('overlay') && in_array('overlay', $variables['page']['#theme_wrappers'])) {
    $variables['overlay'] = TRUE;
  }
}


function social_icons()
{
	$html = "";

	$social_list = array(
		"twitter",
		"wordpress",
		"facebook"
	);

	$html .= "<div id=\"social-icons\">";
	foreach($social_list as $social_name)
	{
		$html .= __get_social_icon_html($social_name);
	}
	$html .= "</div>";

	return $html;
}


function __get_social_icon_html($social_name = null)
{
	global $base_url;
	$html = "";

	if(!__is_social_icon_url_existed($social_name, $social_media_url))
	{
		return "";
	}

	$theme_path = path_to_theme();
	$image_uri = "$theme_path/images/$social_name-logo.png";	
	$image_full_url = $base_url. "/". $image_uri;
	$image_file_path = $_SERVER['DOCUMENT_ROOT']. "/". $image_uri;

	if(!is_file($image_file_path))
	{
		return "";
	}
	
	$adjust = __get_social_icon_adjust();
	$padding_top = $adjust["padding-top"];

	$icon_info = __get_social_icon_dimensions();
	$width = $icon_info["width"];	
	$height = $icon_info["height"];

	$image_style = "style=\"width:$width; height:$height; padding-top:$padding_top;\"";

	$html = "
		<a href=\"$social_media_url\">
			<img src=\"$image_full_url\" $image_style />
		</a>
	";

	return $html;
}


function __is_social_icon_url_existed($social_name = null, &$url)
{
	if($social_name == "twitter")
	{
		$url = theme_get_setting("unimelb_settings_tw-url");
	}
	elseif($social_name == "facebook")
	{
		$url = theme_get_setting("unimelb_settings_fb-url");
	}
	elseif($social_name == "wordpress")
	{
		$url = theme_get_setting("unimelb_settings_wordpress-url");
	}


	if(empty($url))
	{
		$url = null;
		return false;
	}
	else
	{
		return true;
	}
}


function __get_social_icon_dimensions()
{
	$info = array();
	$info["width"] = "30px";
	$info["height"] = "30px";

	$browser_info = browscap_get_browser();
	$user_agent = $browser_info["browser"]; 
	if($user_agent == "Chromium")
	{
		$info["width"] = "28px";
		$info["height"] = "28px";	
	}	
	else
	{
		
	}

	return $info;
}

function __get_social_icon_adjust()
{
	$info = array();
	$info["padding-top"] = "3px";

	if(!module_exists('browscap')) {
		return $info;
	}
	$browser_info = browscap_get_browser();
	$user_agent = $browser_info["browser"]; 
	if($user_agent == "Chromium")
	{
		$info["padding-top"] = "2px";	
	}	
	else
	{
		
	}

	return $info;
}
