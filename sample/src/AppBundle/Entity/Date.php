<?php
/**
 * Created by PhpStorm.
 * User: py2211
 * Date: 8/9/17
 * Time: 10:04 AM
 */

namespace  AppBundle\Entity;

class Date
{
    protected $startDate;
    protected $endDate;

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate(\DateTime $startDate = null)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate(\DateTime $endDate = null)
    {
        $this->endDate = $endDate;
    }


}