<?php

trait CoursesTrait{

    /**
     * Get Course Requests.
     * Return Course Requests.
     *
     * @param $courseId
     * @return bool|PDOStatement
     */
    public static function checkCourseRequests($courseId){
        global $cont;
        $courseRequests = $cont->prepare("SELECT * FROM requests WHERE course_id=?");
        $courseRequests->execute([$courseId]);
        return $courseRequests;
    }

}