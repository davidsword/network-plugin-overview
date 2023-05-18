<table class='widefat'>
	<thead>
	<tr>
		<th><?php _e('Plugin','ntwovrw') ?></th>
		<th><?php _e('Used In','ntwovrw') ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	// cycle through plugins
	foreach ($plugins as $a_plugin_slug => $a_plugin) {
		$count = 0;
		$status = $trClass = '';
		if (in_array($a_plugin_slug,$network_plugins)) {
			$status = "<span class='status'>".__('Network Activated','ntwovrw')."</span>";
			$trClass = 'good';
			$count = 999;
		} else {
			// cycle through sites, see if sites have this plugin
			foreach ($sites_plugins as $this_sites_id => $this_sites_plugins) {
				if ( in_array($a_plugin_slug,$this_sites_plugins) ) {
					$status .= "{$sitesName[$this_sites_id]}<br />";
					$count++;
				}
			}
		}
		if ($count == 0) {
			$status = "<span class='status'>".__('Not used in any site','ntwovrw')."</span>";
			$trClass .= " bad";
		}
		echo "
		<tr class='{$trClass}'>
			<td class='plugin-title column-primary' valign='top'>
				<strong>{$a_plugin['Name']}</strong>
				<code class='nerd'>/{$a_plugin['TextDomain']}/</code>
			</td>
			<td>
				{$status}
			</td>
		</tr>";
	}
	?>    
	</tbody>             
</table>