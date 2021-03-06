<?php

// thanks to Aaron Tan and team at the Faculty of Architecture, Building and Planning, University of Melbourne, and Paul Tagell and team at Marketing and Communications, University of Melbourne - Media Insights 2011

/**
 * @file
 * theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system folder.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 */

?>

<div class="wrapper">
	<div class="header <?php if(!empty($unimelb_ht_right) && $is_front) { ?>with-ht<?php } else { ?>without-ht<?php } ?>">

	<div class="hgroup">
		<?php if ($brand_logo == 'logo' && !empty($logo)): ?>
			<a href="<?php print $front_page; ?>" title="Home" rel="home"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" /></a>
		<?php else: ?>
			
		<?php 
			if(!empty($unimelb_meta_parent_org_url))
				$home_page_url = $unimelb_meta_parent_org_url;
			else
				$home_page_url = $front_page;
		?>
	
		<?php if(!empty($unimelb_meta_parent_org)): ?>
			<p><a href="<?php echo $home_page_url ?>"><?php echo $unimelb_meta_parent_org ?></a></p>	
		<?php else: ?>

		<?php endif; ?>

		<h1><a href="<?php print $front_page; ?>" title="Home" rel="home"><?php print $site_name; ?></a></h1>
		<?php endif; ?>
	</div><!-- end hgroup -->

	<?php if (!empty($unimelb_ht_right) && $is_front): ?>
		<div id="headingtext">
			<p class="title col-1"><?php print $unimelb_ht_left; ?></p>
			<p class="col-7"><?php print $unimelb_ht_right; ?></p>
			<hr />
		</div>
	<?php endif; ?>

	</div><!-- end header -->

	<div class="feature">
		<?php if (!empty($page['feature_menu'])): ?>
			<div id="feature-menu" class="col-6">
				<?php print render($page['feature_menu']); ?>
				<?php echo social_icons(); ?>
			</div>
		<?php endif; ?>

		<?php if(!empty($site_search_box)): ?>
			<div id="site-search" class="col-2">
				<a id="search-button" href="#">Search</a><input id="search-input"/>
			</div>
		<?php endif;?>
	</div>

	<div id="content-wrap">
		<?php if (!empty($page['slider'])): ?>
			<div class="col-8" role="complementary" id="slider">
				<?php print render($page['slider']); ?>
			</div>
		<?php endif; ?>

		<?php if( !empty( $page['highlight'] ) ): ?>
			<div class="col-2">
				<div class="events">
					<?php print render($page['highlight']); ?>
				</div>		
			</div>	

			<div class="main col-4" role="main" id="main-content">
				<?php print $messages; ?>
				<?php if ($tabs = render($tabs)): ?>
					<div class="tabs"><?php print $tabs; ?></div>
				<?php endif; ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?>
					<ul class="action-links"><?php print render($action_links); ?></ul>
				<?php endif; ?>
				<?php if ($title): ?>
					<?php print render($title_prefix); ?>
					<?php print '<h2 ' . $title_attributes . '>' . $title . '</h2>'; ?>
					<?php print render($title_suffix); ?>
				<?php endif; ?>
				<?php print render($page['content']); ?>
				<?php if ($page['content_bottom']): ?>
					<div id="main-content-bottom">
						<?php print render($page['content_bottom']); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-2">
				<div class="the_nav first" role="navigation">
					<?php if($page["navigation"]): ?>
						<?php print render($page["navigation"]); ?>
					<?php endif; ?>
				</div>

				<?php if($page["sidebar_right"]): ?>
					<div class="sidebar-right">
						<?php print render($page["sidebar_right"]); ?>
					</div>
				<?php endif; ?>
			</div>

		<?php else: ?>

			<div class="main col-6" role="main" id="main-content">
				<?php print $messages; ?>
				<?php if ($tabs = render($tabs)): ?>
					<div class="tabs"><?php print $tabs; ?></div>
				<?php endif; ?>
				<?php print render($page['help']); ?>
				<?php if ($action_links): ?>
					<ul class="action-links"><?php print render($action_links); ?></ul>
				<?php endif; ?>

				<?php if ($title): ?>
					<?php print render($title_prefix); ?>
					<?php print '<h2 ' . $title_attributes . '>' . $title . '</h2>'; ?>
					<?php print render($title_suffix); ?>
				<?php endif; ?>

				<?php print render($page['content']); ?>
				<?php if ($page['content_bottom']): ?>
					<div id="main-content-bottom">
						<?php print render($page['content_bottom']); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-2">
				<div class="the_nav first" role="navigation">
					<?php if($page["navigation"]): ?>
						<?php print render($page["navigation"]); ?>
					<?php endif; ?>
				</div>

				<?php if($page["sidebar_right"]): ?>
					<div class="sidebar-right">
						<?php print render($page["sidebar_right"]); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		</div><!-- end content-wrap -->
	</div><!-- end wrapper -->

	<hr>
	<div class="footer">
		<div id="local" class="wrapper">
			<p class="footertitle"><?php print _unimelb_space_tags($site_name); ?></p>

			<?php if(variable_get('unimelb_settings_ad-line1') || variable_get('unimelb_settings_ad-line2')) { ?><div id="org-details" class="col-2"><?php if(variable_get('unimelb_settings_parent-org')) { ?><p><strong><?php print variable_get('unimelb_settings_parent-org'); ?></strong></p><?php } ?><p class="location"><?php if(variable_get('unimelb_settings_ad-line1')) { ?><?php print variable_get('unimelb_settings_ad-line1'); ?><br><?php } ?><?php if(variable_get('unimelb_settings_ad-line2')) { ?><?php print variable_get('unimelb_settings_ad-line2'); ?><br><?php } ?><?php print variable_get('unimelb_settings_ad-sub'); ?>&nbsp;<?php print variable_get('unimelb_settings_ad-postcode'); ?>&nbsp;<?php print variable_get('unimelb_settings_ad-state'); ?>&nbsp;<?php print variable_get('unimelb_settings_ad-country'); ?></p></div><?php } ?>


		<?php if(!empty($unimelb_meta_email)): ?>
			<ul class="col-2">
				<li>
					<strong>Email: </strong> 
					<a href="mailto:<?php print $unimelb_meta_email; ?>">
						<?php print $unimelb_meta_email; ?>
					</a>
				</li>

				<?php if(!empty($unimelb_meta_phone)): ?>
					<li>
						<strong>Phone:</strong> <?php print $unimelb_meta_phone; ?>
					</li>
				<?php endif; ?>


				<?php if(!empty($unimelb_meta_fax)): ?>
					<li>
						<strong>Fax:</strong> <?php print $unimelb_meta_fax; ?>
					</li>
				<?php endif; ?>


				<?php if(!empty($unimelb_meta_facebook) || !empty($unimelb_meta_twitter)): ?>
					<li class="social">
						<?php if(!empty($unimelb_meta_facebook)): ?>				
							<a class="facebook" href="<?php print $unimelb_meta_facebook; ?>">Facebook</a>
							&nbsp;
						<?php endif; ?>
						<?php if(!empty($unimelb_meta_twitter)): ?>			
							<a class="twitter" href="<?php print $unimelb_meta_twitter; ?>">Twitter</a>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			</ul>

		<?php endif; ?>

		<?php if(!empty($unimelb_meta_auth_name) || !empty($unimelb_meta_maint_name)): ?>
			<ul class="col-2">
				<?php if(!empty($unimelb_meta_auth_name)): ?>	
					<li>
						<strong>Authoriser:</strong><br />
						<?php print $unimelb_meta_auth_name; ?>
					</li>
				<?php endif; ?>

				<?php if(!empty($unimelb_meta_maint_name)): ?>	
					<li>
						<strong>Maintainer:</strong><br />
						<?php print $unimelb_meta_maint_name; ?>
					</li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>

		<ul class="col-2">
			<?php if(!empty($unimelb_meta_date_created)): ?>
				<li>
					<strong>Date created:</strong><br />
					<?php print $unimelb_meta_date_created; ?>
				</li>
			<?php endif; ?>
			<li>
				<strong>Last modified:</strong><br />
				<?php print date('j F Y'); ?>
			</li>
		</ul>
		<hr />
	</div>
</div><!-- end footer -->

