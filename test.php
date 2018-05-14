<?php
$userName = 'angelinajolieofficial';

$dataStart = '<script type="text/javascript">window._sharedData = ';
$dataEnd = ';</script><script type="text/javascript">';

$result = @file_get_contents("https://www.instagram.com/{$userName}/");

$startPos = strpos($result, $dataStart);
$result = substr($result, $startPos + strlen($dataStart));

$endPos = strpos($result, $dataEnd);
$result = substr($result, 0, $endPos);

$instaData = @json_decode($result);
$instaProfile = array_shift($instaData->entry_data->ProfilePage);
$instaMedia = $instaProfile->graphql->user->edge_owner_to_timeline_media->edges;

$media = [];
foreach($instaMedia as $media_item) {
	$mediaData = $media_item->node;	
	$fullPhoto = $mediaData->display_url;
	$likes = $mediaData->edge_liked_by->count; 
	$comments = $mediaData->edge_media_to_comment->count;
	$thumbnail = $mediaData->thumbnail_src;
	$isVideo = $mediaData->is_video;
	$shortCode = $mediaData->shortcode;

	$media[] = [
		'shortcode' => $shortCode,
		'link' => 'https://www.instagram.com/p/' . $shortCode . '/',
		'fullPhoto' => $fullPhoto,
		'likes' => $likes,
		'comments' => $comments,
		'thumbnail' => $thumbnail,
		'is_video' => $isVideo
	];
}

header('Content-Type: application/json');
echo json_encode($media);
