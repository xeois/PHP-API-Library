<?php namespace Eduvo\Endpoints;

/**
 * User Class.
 * This is an abstract class. Users must be instantiated
 * as either a Parents, Students or Teachers class.
 * @package Eduvo\Endpoints
 */
abstract class Users extends BootstrapEndpoint
{
    /**
     * Creates a new User record.
     * @param $body
     * @return mixed
     */
    public function create($body)
    {
        $body = ['body' => json_encode($body)];
        $body['headers']['Content-Type'] = 'application/json';

        try {
            $post = $this->postRequest($this->uri, $body);
        } catch (ClientException $e) {
            echo $e->getMessage().PHP_EOL;
        }
        $response = $post->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded;
    }

    /**
     * Updates the specified record.
     * @param $body
     * @param $id
     * @return mixed
     */
    public function update($id, $body)
    {
        $body = ['body' => json_encode($body)];
        $body['headers']['Content-Type'] = 'application/json';
        $uri = $this->uri . $id . '/';

        try {
            $post = $this->patchRequest($uri, $body);
        } catch (ClientException $e) {
            echo $e->getMessage().PHP_EOL;
        }
        $response = $post->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded;
    }
}