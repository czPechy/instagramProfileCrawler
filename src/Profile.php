<?php
namespace czPechy\instagramProfileCrawler;

use czPechy\instagramProfileCrawler\Media\Photo;
use czPechy\instagramProfileCrawler\Media\Video;

class Profile
{

    /** @var string */
    protected $username;

    /** @var string */
    protected $fullName;

    /** @var string */
    protected $id;

    /** @var bool */
    protected $isPrivate;

    /** @var bool */
    protected $isVerified;

    /** @var string|null */
    protected $bio;

    /** @var int|null */
    protected $followers;

    /** @var string|null */
    protected $profilePicture;

    /** @var string|null */
    protected $profilePictureHD;

    /** @var string|null */
    protected $facebookPage;

    /** @var array */
    protected $media;

    public function __construct(array $structure)
    {
        $this->id = $structure['profile']['id'];
        $this->username = $structure['profile']['username'];
        $this->fullName = $structure['profile']['full_name'];
        $this->bio = $structure['profile']['biography'];
        $this->followers = $structure['profile']['edge_followed_by']['count'];
        $this->isPrivate = $structure['profile']['is_private'];
        $this->isVerified = $structure['profile']['is_verified'];
        $this->profilePicture = $structure['profile']['profile_pic_url'];
        $this->profilePictureHD = $structure['profile']['profile_pic_url_hd'];
        $this->facebookPage = $structure['profile']['connected_fb_page'];

        foreach($structure['media'] as $mediaItem) {
            $this->media[] = $this->createMediaItem($mediaItem);
        }
    }

    public function toArray() {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'fullName' => $this->getFullName(),
            'biography' => $this->getBiography(),
            'followers' => $this->getFollowersCount(),
            'isPrivate' => $this->isPrivate(),
            'isVerified' => $this->isVerified(),
            'profilePictureHD' => $this->getProfilePicture(),
            'profilePicture' => $this->getProfilePicture(false),
            'facebookPage' => $this->getFacebookPage()
        ];
    }

    public function getMedia() {
        return $this->media;
    }

    public function hasFacebookPage() {
        return $this->getFacebookPage() !== null;
    }

    public function getFacebookPage() {
        return $this->facebookPage;
    }

    public function getProfilePicture($hd = true) {
        return $hd ? $this->profilePictureHD : $this->profilePicture;
    }

    public function isVerified() {
        return $this->isVerified;
    }

    public function isPrivate() {
        return $this->isPrivate;
    }

    public function getFollowersCount() {
        return $this->followers;
    }

    public function getBiography() {
        return $this->bio;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getId() {
        return $this->id;
    }

    protected function createMediaItem(array $item) {
        if($item['is_video']) {
            return new Video($item);
        }

        return new Photo($item);
    }

}
