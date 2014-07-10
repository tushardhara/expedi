<?php header("content-type: application/x-javascript"); ?> 

<?php
require_once( '../../../../wp-load.php' );
?>

<?php
	if(isset($_GET['youtube_id']) && !empty($_GET['youtube_id']))
	{
		$pp_homepage_youtube_id = $_GET['youtube_id'];
	}
	else
	{
		$pp_homepage_youtube_id = get_option('pp_homepage_youtube_id');
	}
	if(isset($_GET['videoQuality']) && !empty($_GET['videoQuality']))
	{
		$pp_youtube_videoQuality = $_GET['videoQuality'];
	}
	else{
		$pp_youtube_videoQuality = 'default';
	}
	$pp_youtube_video_ratio = get_option('pp_youtube_video_ratio');
	if(empty($pp_youtube_video_ratio))
	{
		$pp_youtube_video_ratio = '16/9';
	}
?>

$j('document').ready(function() {
	var options = { videoId: '<?php echo $pp_homepage_youtube_id; ?>', start: 0, mute: false, repeat: false, ratio: <?php echo $pp_youtube_video_ratio; ?>,videoQuality: '<?php echo $pp_youtube_videoQuality; ?>'};
	$j('#wrapper').tubular(options);
});