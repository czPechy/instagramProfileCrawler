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
        $page_data = @file_get_contents( 'https://www.instagram.com/' . $this->profileName . '/' );
        if ( !$page_data ) {
            throw new ClientException( 'Cannot get data from Instagram' );
        }

        $json = Parser::parseJson( $page_data );
        $this->profile = Parser::createProfile( $json );
    }

}
