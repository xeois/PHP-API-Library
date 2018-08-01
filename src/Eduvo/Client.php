<?php namespace Eduvo;

use Eduvo\Endpoints\Classes;
use Eduvo\Endpoints\IbGroups;
use Eduvo\Endpoints\Parents;
use Eduvo\Endpoints\Students;
use Eduvo\Endpoints\Teachers;
use Eduvo\Endpoints\School;

class Client
{
    /**
     * @var string
     */
    public $token;
    /**
     * @var Classes
     */
    public $classes;
    /**
     * @var IbGroups
     */
    public $ib_groups;
    /**
     * @var Parents
     */
    public $parents;
    /**
     * @var Students
     */
    public $students;
    /**
     * @var Teachers
     */
    public $teachers;
    /**
     * @var School
     */
    public $school;

    /**
     * Client constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->classes = new Classes($token);
        $this->ib_groups = new IbGroups($token);
        $this->parents = new Parents($token);
        $this->students = new Students($token);
        $this->teachers = new Teachers($token);
        $this->school = new School($token);
    }
}
