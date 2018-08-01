<?php namespace Eduvo\Endpoints;

class School extends Users
{
    /**
     * @var string
     */
    public $name_s = 'schools';
    /**
     * @var string
     */
    public $name_p = 'school';
    /**
     * @var string
     */
    public $uri = 'school/';


     /**
     * Retrieves the academic year details defined for each program a school run                                                                                                                                                             s. It returns academic years for each program including the list of academic yea                                                                                                                                                             r terms.
     * @param $program
     * @return mixed
     */
    public function academicyears($program=null)
    {
        $uri = $this->uri.'academic-years';
        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded = json_decode($response);
        if($program!==null){
         return $decoded->academic_years->$program;
        }
         return $decoded->academic_years;
    }

    /**
     * Retrieves the grade details defined for each program a school runs. It re                                                                                                                                                             turns grades grouped by each program.
     * @return mixed
     */
    public function grades()
    {
        $uri = $this->uri.'grades';
        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded = json_decode($response);
        return $decoded->school;
    }

    /**
     *Retrieves the subject details defined for each program a school runs. It r                                                                                                                                                             eturns subjects grouped by each program.
     * @param $program
     * @return mixed
     */
    public function subjects($program=null)
    {
        $uri = $this->uri.'subjects';
        $response = $this->getRequest($uri)->getBody()->getContents();
        $decoded = json_decode($response);
        if($program!==null){
            return $decoded->subjects->$program;
        }
        return $decoded->subjects;
    }
}
