<?php

$jump_to_name = get_field('jump_to_name');
$jump_to_url = sanitize_title($jump_to_name);

$post = get_post($post_id);

if ( has_blocks( $post->post_content ) ) {
    $blocks = parse_blocks( $post->post_content );

   	$i = 0;
   	$sections = array();
   	while ($i < count($blocks)){
   		if($blocks[$i]['blockName'] === 'acf/jump-to-divider'){
   			if(isset($blocks[$i]['attrs']['data']['jump_to_name'])){
   				$sections[] = $blocks[$i]['attrs']['data']['jump_to_name'];		
   			} else {
   				$sections[] = array_values($blocks[$i]['attrs']['data'])[0];
   			}
   		}	
   		$i++;
   	}
}

?>

<div class="jump-to align<?php echo $block['align']; if(isset($block['className'])){ echo ' ' . $block['className']; } ?>" id="<?php echo $jump_to_url; ?>">
	<hr>
	<p><span class="label">Jump To <span class="icon icon-arrow-tiny"></span></span>
	<?php 
		if(!empty($sections) && !is_bool($is_preview)){
			$i = 0;
			foreach ($sections as $section) {
				echo '<a '.($section == $jump_to_name ? 'class="active"' : '').' href="#'. sanitize_title($section) .'">' . $section . '</a>';
				$i++;
				if(count($sections) != $i){
					echo ', ';
				}
			}
		} else {
			echo $jump_to_name;
		} 
	?></p>
</div>