=== Network Overview ===
Contributors: 		davidsword
Donate link: 		http://canadian.redcross.ca/donate/
Tags: 				active plugins, wordpress network, network summary, find unused plugins, multisite, read-only, dormant, overview,
Requires at least: 	4.8
Tested up to: 		4.8
Stable tag: 		2.3
License:     		GPLv3
License URI: 		https://www.gnu.org/licenses/quick-guide-gplv3.en.html

Get a birds eye view of your entire Wordpress Network in a single. See all information for all sites in a glance.

== Description ==

Get a birds eye view of your entire Wordpress Network. See all information for all sites, get warnings about unused themes and plugins, review who is using what.

* **Sites:** See a large table of your network summarized, show sites with all users, themes, plugins, and more.
* **Plugins:** a list of all plugins and which sites are uses them, highlights plugins that aren't being used by any site
* **Themes:** table of all themes, who's using them and which themes are being unused

The plugin notifies of unused plugins and themes, for example:

* A site that hasn't been modified in over a year
* A theme or plugin that is unused on any site
* An archived or non-public site


== Installation ==

* This is a NETWORK plugin only! Super Admin network access required
* In the NETWORK ADMIN go to 'Plugins' and activate
* In your NETWORK ADMIN panel, "Network Overview" will now be in the sidebar


== Frequently Asked Questions ==

= Why would I need this? =

I personally needed it to delete dated/forgotten plugins that posed a security risk by keeping around. Having a large number of different sites in a network, it's sometimes hard to determine which plugins are being used where. This plugin clearly highlights which plugins are not being used at all.

	> "...if you are not using a specific plugin, delete it from the system."
	> http://codex.wordpress.org/Hardening_WordPress#Plugins
	
When wordpress network installations get large and you want to know what's where and what's not needed, this plugin is the simplest solution.

= Can I use it on a single installation instead of a network? =

No, just go to "Plugins" in the admin.


== Screenshots ==

1. Sites Overview, see all sites and all users, plugins, and themes. Red highlights sites that haven't been modified in over a year, or are deleted/archived/spam

2. Plugins Overview, see a list of all plugins (left), and sites that use that plugin (right). Red highlights plugins that are unused, blue highlights network-wide plugins.

3. Themes Overview, see a list of all themes (left), and sites that use that theme (right). Red highlights themes that are unused.


== Changelog ==

= 2.3 =
* July 7 2017
* fixed issue where Plugins overview listed only 1 site, not all

= 2.2 =
* July 6 2017
* fixed use of php shorttags

= 2.1 =
* June 19 2017
* changes to readme.txt

= 2.0 =
* June 2017
* complete rewrite of plugin
* added tabs: new "themes" and "sites" overviews *darn the plugin name
* added stylesheet, made beautiful and to match Wordpress UI
* added foundation for localization support
* new assets

= 1.0 =
* Nov 2012
* Initial Release

== Upgrade Notice ==

= 2.0 =
* all clear, blue sky

= 1.0 =
* all clear, blue sky

== Road Map ==

The current todo list. Please add any additional requests into support.

* Add info bar "x live sites (x archived, x deleted) with x plugins and x themes, running on WP x powered by php x"
* Add styles to inline <li> lists
* Change 1|0 for Public/Deleted/Archive to real words
* Add domains from domain mapping
* Confirm compatibility with subdomain networks
* Use real theme names, not their slugs
* Use real plugin names, not paths, in Sites > Active Plugins
* Expand/Collapse entire rows to reveal all info for a site inline, for less overwhelming view
* Add "nerd" mode that'll toggle more meta information about themes, plugins, users, and sites
* Add "enabled themes" to Sites overview to show what sites have access to themes