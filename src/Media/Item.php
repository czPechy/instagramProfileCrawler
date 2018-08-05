<?php
namespace czPechy\instagramProfileCrawler\Media;

abstract class Item implements IItem
{

    /** @var string */
    protected $shortCode;

    /** @var string */
    protected $link;

    /** @var string */
    protected $fullPhoto;

    /** @var int */
    protected $likes;

    /** @var int */
    protected $comments;

    /** @var string */
    protected $thumbnail;

    /** @var string|null */
    protected $text;

    public function __construct(array $data)
    {
        $this->shortCode = $data['shortcode'];
        $this->link = $data['link'];
        $this->fullPhoto = $data['fullPhoto'];
        $this->likes = (int) $data['likes'];
        $this->comments = (int) $data['comments'];
        $this->thumbnail = $data['thumbnail'];
        $this->text = $data['text'];
    }

    public function toArray() {
        return [
            'shortCode' => $this->getShortCode(),
            'link' => $this->getLink(),
            'photo' => $this->getPhoto(),
            'likes' => $this->getLikesCount(),
            'comments' => $this->getCommentsCount(),
            'thumbnail' => $this->getThumbnail(),
            'text' => $this->getText()
        ];
    }

    public function getShortCode()
    {
        return $this->shortCode;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getPhoto()
    {
        return $this->fullPhoto;
    }

    public function getLikesCount()
    {
        return $this->likes;
    }

    public function getCommentsCount()
    {
        return $this->comments;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function getText()
    {
        return $this->text;
    }

}
