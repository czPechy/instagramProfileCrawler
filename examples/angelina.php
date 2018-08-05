<?php
include_once __DIR__ . '/../vendor/autoload.php';

$client = new \czPechy\instagramProfileCrawler\Client('angelinajolieofficial');

/** @var \czPechy\instagramProfileCrawler\Profile $profile */
$profile = $client->getProfile();

var_dump($profile->toArray());
//array(10) {
//  'id' => "45276652",
//  'username' => "angelinajolieofficial",
//  'fullName' => "Angelina Jolie",
//  'biography' => "People will always...",
//  'followers' => 8848810,
//  'isPrivate' => false,
//  'isVerified' => false,
//  'profilePictureHD' => "https://scontent-frx5-1.cdninstagram.com/vp/031765b0e647064c7aaad4c26067280e/5BF14069/t51.2885-19/11356833_110581152627368_512723102_a.jpg",
//  'profilePicture' => "https://scontent-frx5-1.cdninstagram.com/vp/031765b0e647064c7aaad4c26067280e/5BF14069/t51.2885-19/11356833_110581152627368_512723102_a.jpg",
//  'facebookPage' => NULL,
//}

/** @var \czPechy\instagramProfileCrawler\Media\IItem $media */
foreach($profile->getMedia() as $media) {
    var_dump($media->toArray());

    // class of interface czPechy\instagramProfileCrawler\Media\IItem
    //
    // czPechy\instagramProfileCrawler\Media\Photo
    // OR
    // czPechy\instagramProfileCrawler\Media\Video
    //
    // array(7) {
    //  'shortCode' => "BloCixPBqoj",
    //  'link' => "https://www.instagram.com/p/BloCixPBqoj/",
    //  'photo' => "https://scontent-frx5-1.cdninstagram.com/vp/d60a0d3bdedeb0253db83decfcbd38ab/5BF1A297/t51.2885-15/e35/37002718_285078285574435_8958765677343145984_n.jpg",
    //  'likes' => 113196,
    //  'comments' => 788,
    //  'thumbnail' => "https://scontent-frx5-1.cdninstagram.com/vp/b9bc9f7c30afde1a7b567a504062a6e5/5C0270C2/t51.2885-15/sh0.08/e35/c0.120.961.961/s640x640/37002718_285078285574435_8958765677343145984_n.jpg",
    //  'text' => "❤❤"
    //}
}

