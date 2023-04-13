<?php

class FlickrAPI{

    private $apiKey; 
    private $tags; 
    private $perPage; 
    private $page;

    public function __construct($apiKey, $tags, $perPage = 10, $page = 1){

        $this->apiKey = $apiKey;
        $this->tags = $tags;
        $this->perPage = $perPage;
        $this->page = $page;
    }

    public function getPhotos(){

        $url =  'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=' . $this->apiKey . 
                '&tags=' . $this->tags . 
                '&per_page=' . $this->perPage . 
                '&page=' . $this->page . 
                '&format=json&nojsoncallback=1';

        $response = file_get_contents($url);

        $data = json_decode($response, true);

        $photos = $data['photos']['photo'];

        return $photos;
    }
}

?>