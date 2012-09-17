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
	$twitter_html = __get_social_icon_html("twitter");
	$wordpress_html = __get_social_icon_html("wordpress");

	$html = "
		<div>
			$twitter_html
			$wordpress_html
		</div>
	";
	
	return $html;
}


function __get_social_icon_html($social_name = null)
{
	$html = "";

	if(!__is_social_icon_url_existed($social_name, $social_media_url))
	{
		return;
	}

	$theme_path = path_to_theme();
	$image_uri = "$theme_path/images/$social_name-logo.png";	
	$image_file_path = $_SERVER['DOCUMENT_ROOT']. "/". $image_uri;
	if(!is_file($image_file_path))
	{
		return;
	}
	
	$adjust = __get_social_icon_adjust();
	$padding_top = $adjust["padding-top"];

	$icon_info = __get_social_icon_dimensions();
	$width = $icon_info["width"];	
	$height = $icon_info["height"];

	$image_style = "style=\"width:$width; height:$height; padding-top:$padding_top;\"";

	$html = "
		<a href=\"$social_media_url\">
			<img src=\"$image_uri\" $image_style />
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

	$browser_info = __get_browser_info();
	$user_agent = $browser_info["name"]; 
	if($user_agent == "Google Chrome")
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

	$browser_info = __get_browser_info();
	$user_agent = $browser_info["name"]; 
	if($user_agent == "Google Chrome")
	{
		$info["padding-top"] = "2px";	
	}	
	else
	{
		
	}

	return $info;
}

// See: http://php.net/manual/en/function.get-browser.php
function __get_browser_info()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}


