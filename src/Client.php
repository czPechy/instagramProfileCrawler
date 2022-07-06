<?php
namespace czPechy\instagramProfileCrawler;

class Client
{

    /** @var string */
    protected $profileName;

    /** @var Profile */
    protected $profile;

    public function __construct( $profileName )
    {
        $this->profileName = $profileName;
    }

    /**
     * @return Profile
     * @throws ClientException
     * @throws ParserException
     */
    public function getProfile()
    {
        if ( !$this->profile ) {
            $this->downloadData();
        }
        return $this->profile;
    }

    /**
     * @throws ClientException
     * @throws ParserException
     */
    private function downloadData()
    {
		$opts = [
			'http' => [
				'method' => 'GET',
				'header' => "x-ig-app-id: 936619743392459\r\n"
			]
		];
		$context = stream_context_create($opts);
        $page_data = @file_get_contents( 'https://i.instagram.com/api/v1/users/web_profile_info/?username=' . $this->profileName, false, $context);
        if ( !$page_data ) {
            throw new ClientException( 'Cannot get data from Instagram' );
        }

        $json = Parser::parseJson( $page_data );
        $this->profile = Parser::createProfile( $json );
    }

}
