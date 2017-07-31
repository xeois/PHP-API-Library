<?php namespace Eduvo\Endpoints;

/**
 * Class Parents
 * @package Eduvo\Endpoints
 */
class Parents extends Users
{
    /**
     * @var string
     */
    public $name_s = 'parent';
    /**
     * @var string
     */
    public $name_p = 'parents';
    /**
     * @var string
     */
    public $uri = 'parents/';

    /**
     * Archives the parent record with the specified ID,
     * hiding the parent from groups etc.
     * @param $id
     * @return mixed
     */
    public function archive($id)
    {
        $uri = $this->uri . $id . '/archive';
        $post = $this->putRequest($uri);
        $response = $post->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded;
    }

    /**
     * Reverses the archive operation on the parent record
     * with the specified ID, showing the parent in
     * previous groups etc.
     * @param $id
     * @return mixed
     */
    public function unarchive($id)
    {
        $uri = $this->uri . $id . '/unarchive';
        $post = $this->putRequest($uri);
        $response = $post->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded;
    }
}