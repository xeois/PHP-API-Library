<?php namespace Eduvo\Endpoints;

use GuzzleHttp\Client;
use Eduvo\ResultIterator;
use GuzzleHttp\Exception\ClientException;

abstract class BootstrapEndpoint
{
    /**
     * @var string
     */
    const endpoint = 'https://api.managebac.com/v2/';
    /**
     * @var string
     */
    public $token;
    /**
     * @var string
     */
    public $uri;

    /**
     * @var
     */
    public $name_s;

    public $name_p;

    /**
     * BootstrapEndpoint constructor.
     * @param $token
     * @param bool $uri
     */
    public function __construct($token, $uri = false)
    {
        $this->token = $token;
        if ($uri) {
            $this->uri = $uri . $this->uri;
        }
    }

    /**
     * Creates a new HTTP Client
     * @return Client
     */
    private function client()
    {
        return new Client([
            'headers' => [
                'auth-token' => $this->token,
                'User-Agent' => 'managebac-php-client'
            ]
        ]);
    }

    /**
     * Retrieves all records of the resource
     * @return mixed
     */
    public function all()
    {
        $uri = $this->uri;
        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded = json_decode($response);
        return new ResultIterator($decoded, $this->token, $this->name_p, $this->uri);
    }
    /**
     * Make a GET request to the specified endpoint.
     * @param $endpoint
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRequest($endpoint)
    {
        return $this->getUrl(self::endpoint . $endpoint);
    }
    /**
     * Make a GET request to the specified URL
     * @param $url
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUrl($url)
    {
        return $this->client()->get($url);
    }

    /**
     * Retrieves a single object matching the specified id.
     * @param $id
     * @param array $parameters
     * @return mixed
     */
    public function get($id, $parameters = [])
    {
        $uri = ! empty($parameters) ? $this->uri . $id . '?' . http_build_query($parameters) : $this->uri . $id;
        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded = json_decode($response);
        $prop_name = $this->name_s;
        return $decoded->$prop_name;
    }

    /**
     * Make a POST request to the specified resource.
     * @param $endpoint
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postRequest($endpoint, $body = [])
    {
        return $this->postUrl(self::endpoint . $endpoint, $body);
    }

    /**
     * Make a POST request to the specified URL.
     * @param $url
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function postUrl($url, $body = [])
    {
        return $this->client()->post($url, $body);
    }

    /**
     * Updates the resource specified by the id.
     * @param $body
     * @param $id
     * @return mixed
     */
    public function update($body, $id)
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

    /**
     * Make a PATCH request to the specified endpoint
     * @param $endpoint
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patchRequest($endpoint, $body = [])
    {
        return $this->patchUrl(self::endpoint . $endpoint, $body);
    }

    /**
     * Make a PATCH request to the specified URL
     * @param $url
     * @param $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function patchUrl($url, $body)
    {
        return $this->client()->patch($url, $body);
    }

    /**
     * Make a PUT request to the specified endpoint
     * @param $endpoint
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function putRequest($endpoint, $body = [])
    {
        return $this->putUrl(self::endpoint . $endpoint, $body);
    }

    /**
     * Make a PUT request to the specified URL
     * @param $url
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function putUrl($url, $body = [])
    {
        return $this->client()->put($url, $body);
    }
}