<?php

// require_once "./config.php";

class Courses
{
    public $data;

    public function __construct()
    {
        $file = "./data.json"; // TODO: fix proper path
        $contents = file_get_contents($file);
        $courses = json_decode($contents);
        $this->data = $courses;
    }

}
