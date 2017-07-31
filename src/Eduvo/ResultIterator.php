<?php namespace Eduvo;

use Eduvo\Endpoints\BootstrapEndpoint;

/**
 * Class ResultIterator
 * @package Eduvo
 */
class ResultIterator extends BootstrapEndpoint implements \Iterator
{
    /**
     * @var array
     */
    public $array;
    /**
     * @var string
     */
    public $token;
    /**
     * @var array
     */
    public $name;
    /**
     * @var array
     */
    private $meta;

    /**
     * ResultIterator constructor.
     * @param $givenArray
     * @param bool $token
     * @param $name
     * @param $uri
     */
    public function __construct($givenArray, $token, $name, $uri)
    {
        $this->array = $givenArray->$name;
        $this->token = $token;
        $this->meta  = ! empty($givenArray->meta) ? $givenArray->meta : new \stdClass();
        $this->uri = $uri;
        $this->name = $name;
    }
    function rewind()
    {
        return reset($this->array);
    }
    function current()
    {
        return current($this->array);
    }
    function key()
    {
        return key($this->array);
    }
    function next()
    {
        return next($this->array);
    }
    function valid()
    {
        $valid = key($this->array) !== null;
        if ( ! $valid) {
            if ( property_exists($this->meta, 'next_page')) {
                $nextResponse = $this->getRequest($this->uri . '?page=' . $this->meta->next_page)->getBody()->getContents();
                $decoded = json_decode($nextResponse);
                $this->meta = ! empty($decoded->meta) ? $decoded->meta : new \stdClass();
                $prop_name = $this->name;
                $this->array = $decoded->$prop_name;
                reset($this->array);
                return (bool) count($this->array);
            }
        } else {
            return $valid;
        }
    }
}
