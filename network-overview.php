<?php
/*
Plugin Name: 	Network Overview
Plugin URI: 	https://davidsword.ca/wordpress-plugins/
Network: 		true
Description: 	Get a birds eye view of your entire Wordpress Network in a single. See all information for all sites in a glance.
Version: 		2.3
Author: 		davidsword
Author URI: 	https://davidsword.ca/
License:     	GPLv3
License URI: 	https://www.gnu.org/licenses/quick-guide-gplv3.en.html
Text Domain:    ntwovrw
*/

/**
 * Check if super admin in network admin
 *
 * @since 2.0
 *
 * @return boolean, true if super admin in network admin, false if not
 */
function ntwovrw_check() {
	return (is_network_admin() && is_multisite() && is_super_admin()) ? true : false;
}

/**
 * Add CSS
 *
 * @since 2.0
 */
add_action( 'admin_enqueue_scripts', 'ntwovrw_admin_style' );
function ntwovrw_admin_style() {
	if (ntwovrw_check() && get_current_screen()->base == 'toplevel_page_network-plugin-overview-network') {
        wp_register_style( 'ntwovrw_css', plugins_url('style.css', __FILE__), false, '2.0' );
        wp_enqueue_style( 'ntwovrw_css' );
    }
}

/**
 * Add Menu Page
 *
 * @since 2.0
 */
add_action('network_admin_menu',  'ntwovrw_add' );
function ntwovrw_add(){ 	
	if (ntwovrw_check())
		add_menu_page(__('Network Overview','ntwovrw'), __('Network Overview','ntwovrw'), 'activate_plugins', 'network-plugin-overview', 'ntwovrw_page',''); 
}

/**
 * Plugin Page, all the meat
 *
 * @since 1.0
 */
function ntwovrw_page() {
	global $wpdb;		
	
	// this won't happen ever - but you know, double check the locks
	if (!ntwovrw_check()) 
		return;
	
	// alright, normal operation
	// get all plugins..
	$plugins = apply_filters( 'all_plugins', get_plugins() );
	
	// get all sites, their name, and their plugins, put into array
	$get_sites = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}blogs` ORDER BY `blog_id`");
	
	// our main holders for the info
	$sites_plugins = $sites_themes = $sites_style = $sitesName = array();
	
	// cycle through each site, get some info
	foreach ($get_sites as $k => $site) {
		
		// the first blog doesn't use $site->blog_id prefix
		$prefix = ($site->blog_id == '1') ? "{$wpdb->prefix}" : "{$wpdb->prefix}{$site->blog_id}_";
		
		// get the sites name
		$getName = $wpdb->get_row("SELECT option_value FROM {$prefix}options WHERE option_name = 'blogname'");
		$sitesName[$site->blog_id] = $getName->option_value;
		
		// plugins for site
		$getPlugins = $wpdb->get_row("SELECT option_value FROM {$prefix}options WHERE option_name = 'active_plugins'");
		$sites_plugins[$site->blog_id] = (array)unserialize($getPlugins->option_value);		
		
		// theme for site
		$getsite_template = $wpdb->get_row("SELECT option_value FROM {$prefix}options WHERE option_name = 'template'");
		$sites_themes[$site->blog_id] = $getsite_template->option_value;
		
		// and possible child theme
		$getStyle = $wpdb->get_row("SELECT option_value FROM {$prefix}options WHERE option_name = 'stylesheet'");
		$sites_styles[$site->blog_id] = $getStyle->option_value;
		
	}

	// get network-wide actived plugins
	$getnetwork_plugins = $wpdb->get_row("SELECT meta_value FROM {$wpdb->prefix}sitemeta WHERE meta_key = 'active_sitewide_plugins'");
	$network_plugins = array_flip((array)unserialize($getnetwork_plugins->meta_value));		
	
	?>
	<div class='wrap' id='ntwovrw'>
		<h2><?php _e('Network Overview','ntwovrw') ?></h2>
		<?php
		
		// our tabs/pages
		$tabs = array('Sites','Plugins','Themes');
		
		//get the user's tab, or set default
		$tabSelect = (isset($_GET['tab']) && !empty($_GET['tab'])) ? $_GET['tab'] : $tabs[0];
		
		// validate the user's $_GET value, if not one of the above (something malicious), revert to default
		$tabSelect = (in_array($tabSelect, $tabs)) ? $tabSelect : $tabs[0];
		?>
		<h2 class="nav-tab-wrapper wp-clearfix">
			<?php
				// you've seent his a million times:
				foreach ($tabs as $tab) {
					$act = ($tabSelect == $tab) ? ' nav-tab-active' : '';
					echo "<a href='?page=network-plugin-overview&tab={$tab}' class='nav-tab {$act}'>{$tab}</a>";
				}
			?>
		</h2>
		
		<?php 
		// get the request tab contents
		include('network-overview-'.sanitize_key($tabSelect).'.php');
		
		// no good deed goes without bragging about it:
		?>
		<p id='streetcred'><?php _e('Plugin By','ntwovrw') ?> <a href='https://davidsword.ca/' target='_Blank'>David Sword</a></p>
	</div>		
	<?php
}
?>