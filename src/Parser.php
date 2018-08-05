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
            $userData[$key] = isset($json['graphql']['user'][$key]) ? $json['graphql']['user'][$key] : null;
        }

        $media = [];
        if(isset($json['graphql']['user']['edge_owner_to_timeline_media']['edges']) && is_array($json['graphql']['user']['edge_owner_to_timeline_media']['edges'])) {
            foreach($json['graphql']['user']['edge_owner_to_timeline_media']['edges'] as $edgeMedia) {
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
     * @return \stdClass
     * @throws ParserException
     */
    public static function parseJson( $output )
    {
        $dataStart = 'window._sharedData = ';
        $dataEnd = ';</script>';

        $startPos = strpos($output, $dataStart);
        $output = substr($output, $startPos + strlen($dataStart));

        $endPos = strpos($output, $dataEnd);
        $output = substr($output, 0, $endPos);

        $instaData = @json_decode($output, true);
        if(!$instaData || !isset($instaData['entry_data']['ProfilePage']) || !is_array($instaData['entry_data']['ProfilePage'])) {
            throw new ParserException('Cannot parse JSON from Instagram, please create Issue');
        }
        return array_shift($instaData['entry_data']['ProfilePage']);
    }

}
