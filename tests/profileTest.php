<?php
require_once __DIR__ . '/../vendor/autoload.php';

class profileTest extends PHPUnit_Framework_TestCase
{

    private $profile;

    public function getProfile()
    {
        if(!$this->profile) {
            $client = new \czPechy\instagramProfileCrawler\Client( 'angelinajolie' );
            $this->profile = $client->getProfile();
        }

        return $this->profile;
    }

    public function testProfileData() {
        $profile = $this->getProfile();

        $this->assertInternalType('array', $profile->toArray());
    }

    public function testProfileName() {
        $profile = $this->getProfile();

        $this->assertInternalType('string', $profile->getFullName());
    }

    public function testMedia() {
        $profile = $this->getProfile();

        $this->assertInternalType('array', $profile->getMedia());
    }

    public function testMediaItem() {
        $profile = $this->getProfile();

        $media = $profile->getMedia();
        /** @var \czPechy\instagramProfileCrawler\Media\IItem $mediaItem */
        $mediaItem = array_shift($media);

        $this->assertInstanceOf(\czPechy\instagramProfileCrawler\Media\IItem::class, $mediaItem);
        $this->assertInternalType('array', $mediaItem->toArray());
    }

}
