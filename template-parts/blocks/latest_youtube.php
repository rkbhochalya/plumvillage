<?php

$videoTimestamp = get_option('latest_youtube_timestamp');

if($videoTimestamp === false || (time() - $videoTimestamp) > 7200) {
	$channel_id = get_field('youtube_channel_id', 'options');
	$playlist_id = get_field('youtube_default_playlist_id', 'options');
	$api_key = get_field('youtube_api_key', 'options');

	$json_url="https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=".$playlist_id."&key=".$api_key;

	// wp_oembed_get()

	$ch = curl_init($json_url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux i686; rv:20.0) Gecko/20121230 Firefox/20.0');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$json = curl_exec($ch);

	$videoJson=json_decode($json);

	update_option('latest_youtube_timestamp', time());
	if(!empty($videoJson)){
		update_option('latest_youtube_id', $videoJson->items[0]->snippet->resourceId->videoId);
		update_option('latest_youtube_title', $videoJson->items[0]->snippet->title);
	}
}



$id = get_option('latest_youtube_id');	

$title = get_option('latest_youtube_title');

$video = wp_oembed_get('https://www.youtube.com/watch?v='.$id); ?>


<div class="latest-youtube align<?php echo $block['align'] . ' ' . $block['className']; ?>">
	<?php beautifulVideoEmbed($video, false, false, true); ?>

	<figcaption><?php echo $title; ?></figcaption>

</div>