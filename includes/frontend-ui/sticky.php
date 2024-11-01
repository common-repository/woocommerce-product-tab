
<?php	
	$part=$custom_tab_options['callback'];
	$icon=$custom_tab_options['icon'];
	$title=$custom_tab_options['title'];
	
	$extra_content_height=$custom_tab_options['public_fields'][$public_perfix.'tab_sticky_height'];
	$extra_align = $custom_tab_options['public_fields'][$public_perfix.'tab_sticky_position'];
	$extra_content_align = ($extra_align=='pw-left-stick')?'wt-pw-content-left':'wt-pw-content-right';
	$extra_content_width = $custom_tab_options['public_fields'][$public_perfix.'tab_sticky_width'];
	
	if ($extra_align == 'pw-right-stick'){ $extra_right_top+=65; $extra_top=$extra_right_top; $gravity='e';}
	else if ($extra_align == 'pw-left-stick'){ $extra_left_top+=65; $extra_top=$extra_left_top; $gravity='w';}
	echo '<div id="'.get_the_id().'" class="wt-pw-stick  rotate-y-eff wt-pw-stick-light '.$extra_align.' " style="top:'.$extra_top.'px" ><span class="wt-pw-title"  rel="tipsy'.$gravity.'" title="'.$title.'" >'.$icon.'</div>';
		echo '<div class="wt-pw-content wt-pw-content-light '. $extra_content_width .' ' . $extra_content_align .'  dis-'  . get_the_id().'  "><div class="wt-pw-content-close"></div>';
		   echo '<div class="wt-scrollbarcnt wt-sticky-scroller">
		   			<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>';
		   echo '<div class="viewport" style="height:'.$extra_content_height.'px">
					<div class="overview">';
						include($part);
						
		   echo '	</div>
				</div>';
		   echo '</div>';	
		echo '</div>';					
									
	
?>