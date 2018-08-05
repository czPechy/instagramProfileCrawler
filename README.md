[![GitHub version](https://badge.fury.io/gh/czPechy%2FinstagramProfileCrawler.svg)](http://badge.fury.io/gh/czPechy%2FinstagramProfileCrawler)
[![travis-ci.com](https://travis-ci.com/czPechy/instagramProfileCrawler.svg?branch=master)](https://travis-ci.com/czPechy/instagramProfileCrawler)
[![codecov.io](https://codecov.io/github/czPechy/instagramProfileCrawler/coverage.svg?branch=master)](https://codecov.io/github/czPechy/instagramProfileCrawler?branch=master)

# instagramProfileCrawler
- Get latest media from instagram profile without API
- This is only HTML crawler (get json from instagram page)
- If Instagram made some change, please send Issue
- If you want some more data, send Issue or MR

# Install with composer
```sh
$ composer require czpechy/instagramprofilecrawler
```

# How to use
```php
include_once __DIR__ . '/../vendor/autoload.php';

$client = new \czPechy\instagramProfileCrawler\Client('angelinajolieofficial');

/** @var \czPechy\instagramProfileCrawler\Profile $profile */
$profile = $client->getProfile();

var_dump($profile->toArray());
```
```php
array(
  'id' => "45276652",
  'username' => "angelinajolieofficial",
  'fullName' => "Angelina Jolie",
  'biography' => "People will always...",
  'followers' => 8848810,
  'isPrivate' => false,
  'isVerified' => false,
  'profilePictureHD' => "https://scontent-frx5-1.cdninstagram.com/vp/031765b0e647064c7aaad4c26067280e/5BF14069/t51.2885-19/11356833_110581152627368_512723102_a.jpg",
  'profilePicture' => "https://scontent-frx5-1.cdninstagram.com/vp/031765b0e647064c7aaad4c26067280e/5BF14069/t51.2885-19/11356833_110581152627368_512723102_a.jpg",
  'facebookPage' => NULL,
);
```
```php
/** @var \czPechy\instagramProfileCrawler\Media\IItem $media */
foreach($profile->getMedia() as $media) {

    // interface \czPechy\instagramProfileCrawler\Media\IItem
    //
    // \czPechy\instagramProfileCrawler\Media\Photo
    // OR
    // \czPechy\instagramProfileCrawler\Media\Video
    
    var_dump($media->toArray());
}
```
```php
array(
  'shortCode' => "BloCixPBqoj",
  'link' => "https://www.instagram.com/p/BloCixPBqoj/",
  'photo' => "https://scontent-frx5-1.cdninstagram.com/vp/d60a0d3bdedeb0253db83decfcbd38ab/5BF1A297/t51.2885-15/e35/37002718_285078285574435_8958765677343145984_n.jpg",
  'likes' => 113196,
  'comments' => 788,
  'thumbnail' => "https://scontent-frx5-1.cdninstagram.com/vp/b9bc9f7c30afde1a7b567a504062a6e5/5C0270C2/t51.2885-15/sh0.08/e35/c0.120.961.961/s640x640/37002718_285078285574435_8958765677343145984_n.jpg",
  'text' => "❤❤"
);
```

# Buy me a coffee <3
[![Buy me a Coffee](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=E8NK53NGKVDHS)

# Or send me some crypto ¯\\\_(ツ)\_/¯
```
ETH: 0x7D771A56735500f76af15F589155BDC91613D4aB
UBQ: 0xAC08C7B9F06EFb42a603d7222c359e0fF54e0a13
```

