<?php

namespace czPechy\instagramProfileCrawler;

class Parser
{

    /**
     * @param array $json
     * @return array
     */
    protected static function createStructure( $json )
    {
        $userData = [];
        $getUserData = [
            'biography', 'edge_followed_by', 'full_name', 'id', 'is_private', 'is_verified',
            'profile_pic_url', 'profile_pic_url_hd', 'username', 'connected_fb_page'
        ];
        foreach($getUserData as $key) {
            $userData[$key] = isset($json[$key]) ? $json[$key] : null;
        }

        $media = [];
        if(isset($json['edge_owner_to_timeline_media']['edges']) && is_array($json['edge_owner_to_timeline_media']['edges'])) {
            foreach($json['edge_owner_to_timeline_media']['edges'] as $edgeMedia) {
                $mediaData = $edgeMedia['node'];
                $mediaText = isset($edgeMedia['node']['edge_media_to_caption']['edges'][0]['node']['text']) ? $edgeMedia['node']['edge_media_to_caption']['edges'][0]['node']['text'] : '';

                $media[] = [
                    'shortcode' => $mediaData['shortcode'],
                    'link' => 'https://www.instagram.com/p/' . $mediaData['shortcode'] . '/',
                    'fullPhoto' => $mediaData['display_url'],
                    'likes' => $mediaData['edge_liked_by']['count'],
                    'comments' => $mediaData['edge_media_to_comment']['count'],
                    'thumbnail' => $mediaData['thumbnail_src'],
                    'is_video' => $mediaData['is_video'],
                    'text' =>  !empty($mediaText) ? $mediaText : null
                ];
            }
        }

        return [
            'profile' => $userData,
            'media' => $media
        ];
    }

    /**
     * @param $json
     * @return Profile
     * @throws ParserException
     */
    public static function createProfile( $json ) {
        $structure = self::createStructure( $json );
        return new Profile($structure);
    }

    /**
     * @param $output
     * @return array
     * @throws ParserException
     */
    public static function parseJson( $output )
    {
        $instaData = @json_decode($output, true);
        if(!$instaData || !isset($instaData['data']['user'])) {
            throw new ParserException('Cannot parse JSON from Instagram, please create Issue');
        }
        return $instaData['data']['user'];
    }

}
