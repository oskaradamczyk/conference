<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 11:07
 */

namespace AppBundle\Model;


/**
 * Class LectureImport
 * @package AppBundle\Model
 */
class LectureImport extends Import
{
    /** @var string */
    private $lectureName;

    /**
     * @return string
     */
    public function getLectureName(): ?string
    {
        return $this->lectureName;
    }

    /**
     * @param string $lectureName
     * @return Import
     */
    public function setLectureName(string $lectureName): Import
    {
        $this->lectureName = $lectureName;
        return $this;
    }
}
