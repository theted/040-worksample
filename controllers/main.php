<?php

require_once "./models/courses.php";

class Main
{
    public $courses;

    public function __construct()
    {
        $this->courses = new Courses();
    }

    public function renderCourses()
    {
        $data = [];
        $output = '';
        $array = $this->courses->data;

        foreach ($array as $course) {
            // $data[] = [
            //     "name" => $course->name,
            //     "dates" => $course->dates,
            // ];

            $data = ["name" => $course->name];

            $output .= $this->rederCourse($data);
        }

        return $output;
    }

    public function rederCourse($course)
    {
        $output = "";
        $output .= "<div>";
        $output .= $course['name'];
        $output .= "</div>";
        return $output;
    }

    // form stuff

    public function input($name)
    {

    }

    public function select($name, $values)
    {

    }

    public function renderForms()
    {
        $output = "";
        return $output . "[form]";
    }

    public function render()
    {
        $output = $this->renderCourses();
        $output .= $this->renderForms();
        return $output;
    }

}
