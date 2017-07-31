<?php namespace Eduvo\Endpoints;

use Eduvo\ResultIterator;

abstract class Groups extends BootstrapEndpoint
{
    /**
     * Retrieves all students belonging to the group specified by id.
     * @param $id
     * @return mixed
     */
    public function students($id)
    {
        $uri = $this->uri . $id . '/students';
        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded = json_decode($response);
        return new ResultIterator($decoded, $this->token, 'student_ids', $this->uri);
    }
    /**
     * Adds the list of student IDs to the specified group.
     * @param $id
     * @param array $students
     * @return mixed
     */
    public function add_students($id, $students)
    {
        $body = ['body' => json_encode(['student_ids' => $students])];
        $body['headers']['Content-Type'] = 'application/json';
        $uri = $this->uri . $id . '/add_students';
        $post = $this->postRequest($uri, $body);
        $response = $post->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded;
    }

    /**
     * Removes the list of student IDs from the specified group.
     * @param $id
     * @param $students
     * @return mixed
     */
    public function remove_students($id, $students)
    {
        $body = ['body' => json_encode(['student_ids' => $students])];
        $body['headers']['Content-Type'] = 'application/json';
        $uri = $this->uri . $id . '/remove_students';
        $post = $this->postRequest($uri, $body);
        $response = $post->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded;
    }
}