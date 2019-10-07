<?php

class Courses
{
    public $data;

    public function __construct()
    {
        $file = "./data/data.json";
        $contents = file_get_contents($file);
        $courses = json_decode($contents);
        $this->data = $courses;
    }

}
