<?php
namespace czPechy\instagramProfileCrawler\Media;

interface IItem
{

    public function getShortCode();

    public function getLink();

    public function getPhoto();

    public function getLikesCount();

    public function getCommentsCount();

    public function getThumbnail();

    public function getText();

    public function toArray();

}
