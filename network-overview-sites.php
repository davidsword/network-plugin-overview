<table class='widefat'>
	<thead>
	<tr>
		<th><?php _e('ID','ntwovrw') ?> #</th>
		<th><?php _e('Location','ntwovrw') ?></th>
		<th><?php _e('Site','ntwovrw') ?></th>
		<th><?php _e('Public','ntwovrw') ?></th>
		<th><?php _e('Archived','ntwovrw') ?></th>
		<th><?php _e('Deleted','ntwovrw') ?></th>
		<th><?php _e('Last Edited','ntwovrw') ?></th>
		<th><?php _e('Users','ntwovrw') ?></th>
		<th><?php _e('Theme Used','ntwovrw') ?></th>
		<th><?php _e('Active Plugins','ntwovrw') ?></th>
	</tr>
	</thead>
	<tbody>
<?php
$walker = 1;
foreach ($get_sites as $site) {
	$trClass = '';
	
	// we're going to scale the ID's, if a site was deleted and an ID is missed, we want to be aware of that
	// if the next ID isn't a site, show a notice of the unused id
	if ($site->blog_id != $walker+1)
		for ($i = $walker; $i != $site->blog_id; $i++)
			if ($i != $walker)
				echo "<tr class='meh'><td>{$i}</td><td colspan='9'>".__('No site for this ID','ntwovrw')."</td></tr>";
	
	// our cap for if a site hasn't been touched in over a year				
	$notUsed = ( (time() - strtotime($site->last_updated)) > 60*60*24*365 ) ? true : false;
	
	// if any of these things are true, let the super admin know
	if (
		$site->public == '0' ||
		$site->archived == '1' ||
		$site->deleted == '1' || 
		$notUsed
	) {
		$trClass = 'bad';
	}
	
	// get users
	$users = '';
	$blogusers = get_users( 'blog_id='.$site->blog_id );
	foreach ( $blogusers as $user )
	    $users .= $user->data->user_nicename."<br />";
	
	// plugins 
	$plugins = '';
	foreach ($sites_plugins[$site->blog_id] as $plugin)
		$plugins .= $plugin."<br />";
	$plugins .= implode('<br />', $network_plugins);
	
	// theme 
	if (!$theme = $sites_themes[$site->blog_id])
		$theme = $sites_styles[$site->blog_id];
	
	// location
	if ($site->blog_id != 1 && $site->path == '/')
		$siteLocation = $site->domain;
	else 
		$siteLocation = $site->path;
	
	echo "
	<tr class='{$trClass}'>
		<td>{$site->blog_id}</td>
		<td>{$siteLocation}</td>
		<td><strong>{$sitesName[$site->blog_id]}</strong></td>
		<td".($site->public == '0' ? " class='highlightme'" : '').">{$site->public}</td>
		<td".($site->archived == '1' ? " class='highlightme'" : '').">{$site->archived}</td>
		<td".($site->deleted == '1' ? " class='highlightme'" : '').">{$site->deleted}</td>
		<td".($notUsed ? " class='highlightme'" : '').">".date('F j, Y',strtotime($site->last_updated))."</td>
		<td>{$users}</td>
		<td>{$theme}</td>
		<td>{$plugins}</td>
	</tr>
	";
	$walker = $site->blog_id;
}

?>
	</tbody>             
</table>