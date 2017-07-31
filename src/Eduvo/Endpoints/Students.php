<?php namespace Eduvo\Endpoints;

/**
 * Class Students
 * @package Eduvo\Endpoints
 */
class Students extends Users
{
    public $name_s = 'student';
    /**
     * @var string
     */
    public $name_p = 'students';
    /**
     * @var string
     */
    public $uri = 'students/';

    /**
     * Archives the student record with the specified ID,
     * hiding the student from classes, groups etc.
     * @param $id
     * @param $date
     * @param string $reason
     * @return mixed|string
     */
    public function archive($id, $date, $reason = 'withdrawn')
    {
        $uri = $this->uri . $id . '/archive';
        if ($reason == 'withdrawn') {
            $uri .= '?withdrawn_on='.$date;
        } else if ($reason == 'graduated') {
            $uri .= '?graduated_on='.$date;
        } else {
            return 'No valid reason provided. You must use either withdrawn or graduated as reason.';
        }
        $post = $this->putRequest($uri);
        $response = $post->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded;
    }

    /**
     * Reverses the archive operation on the student record
     * with the specified ID, showing the student
     * in previous classes, groups etc.
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