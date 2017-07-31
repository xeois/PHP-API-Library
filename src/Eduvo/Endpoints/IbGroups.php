<?php namespace Eduvo\Endpoints;

class IbGroups extends Groups
{
    /**
     * @var string
     */
    public $name_s = 'ib_group';
    /**
     * @var string
     */
    public $name_p = 'ib_groups';
    /**
     * @var string
     */
    public $uri = 'ib-groups/';

    /**
     * Retrieves the Homeroom, CAS, EE and ToK
     * advisors for a specified IB group.
     * Returns their ID and roles.
     * @param $id
     * @return mixed
     */
    public function advisors($id)
    {
        $uri = $this->uri . $id . '/advisors';
        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded->advisors;
    }
}