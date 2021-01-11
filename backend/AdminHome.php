<?php

include "dbcont.php";

class AdminHome{

    public static function getCounters(){
        global $cont;
        $coursesCount = $cont->prepare("SELECT COUNT('id') FROM courses");
        $coursesCount->execute();

        $requestsCount = $cont->prepare("SELECT COUNT('id') FROM requests");
        $requestsCount->execute();

        $data = [
            'coursesCount' => $coursesCount->fetchColumn(),
            'requestsCount' => $requestsCount->fetchColumn()
        ];

        return $data;
    }

}

?>