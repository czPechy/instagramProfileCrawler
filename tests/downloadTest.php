<?php
require_once __DIR__ . '/../vendor/autoload.php';

class downloadTest extends PHPUnit_Framework_TestCase
{

    public function testDownloadProfile()
    {
        $client = new \czPechy\instagramProfileCrawler\Client('angelinajolie');
        $profile = $client->getProfile();

        $this->assertInstanceOf(\czPechy\instagramProfileCrawler\Profile::class, $profile);
    }

    public function testBadProfile()
    {
        $client = new \czPechy\instagramProfileCrawler\Client('fakeNonExistProfileOnInstagramCom');
        try {
            $client->getProfile();
        } catch (\czPechy\instagramProfileCrawler\ClientException $pe) {
            $this->throwException($pe);
        }
    }

}
