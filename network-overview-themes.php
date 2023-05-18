<table class='widefat'>
	<thead>
	<tr>
		<th><?php _e('Theme','ntwovrw') ?></th>
		<th><?php _e('In Site','ntwovrw') ?></th>
	</tr>
	</thead>
	<tbody>
<?php
	$themes = wp_get_themes();
	foreach ($themes as $a_theme_slug => $a_theme) {
		
		$status = $trClass = '';
		$count = 0;

		foreach ($sites_themes as $this_sites_id => $this_sites_theme) {
			if ($a_theme_slug == $this_sites_theme) {
				$status .= "{$sitesName[$this_sites_id]}<br />";
				$count++;
			}
		}
		if ($count == 0) { // maybe it's a child theme
			foreach ($sites_styles as $this_sites_id => $this_sites_theme) {
				if ($a_theme_slug == $this_sites_theme) {
					$status .= "{$sitesName[$this_sites_id]}<br />";
					$count++;
				}
			}
		}
		if ($count == 0) {
			$status = "<span class='status'>Not used on any site</span>";
			$trClass = 'bad';
		}
		echo "
		<tr class='{$trClass}'>
			<td valign=top><code style='opacity:1'>/{$a_theme_slug}/</code></td>
			<td>{$status}</td>
		</tr>";

	}
?>

	</tbody>
</table>