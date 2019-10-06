<?php

require_once "./models/courses.php";
require_once "./models/user.php";

class Main
{
    public $courses;

    public function __construct()
    {
        $this->courses = new Courses();
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

    public function input($name, $label, $placeholder = false)
    {
        $output = "<div>";
        $output .= "<label for=\"$name\">$label</label>";
        $output .= "<input name=\"$name\" placeholder=\"$placeholder\"/>";
        $output .= "</div>";
        return $output;
    }

    public function select($name, $values, $label = false)
    {
        if (!$label) {
            $label = $name;
        }

        $output = "<div><label for=\"$name\">$label</label>";
        $output .= "<select name=\"$name\">";

        foreach ($values as $key => $value) {
            $output .= "<option value=\"$value->id\">$value->name</option>";
        }

        $output .= "</select></div>";
        return $output;
    }

    public function renderForms()
    {
        $output = "";
        // $output .= $this->select("course", $this->courses->data);
        return $output;
    }

    public function data()
    {
        return json_encode($this->courses->data);
    }

    // TODO: move to prettier view
    public function render()
    {
        // TODO: implement a router instead
        switch ($_GET['page']) {
            default:break;
            case 'data':
                echo $this->data();
                exit;
                break;
        }

        $output = $this->renderForms();
        $output .= '

         <form method="post">

            <section id="course">
              <h2>Course</h2>
              <div class="box">
                ' . $this->select("course", $this->courses->data) . '
                ' . $this->select("date", []) . '
              </div>
            </section>

            <section id="company">
              <h2>Company</h2>
              <div class="box">
                <input name="company" placeholder="Comppany name" />
              </div>

              <div class="box">
                ' . $this->input('email', 'Email') . '
                ' . $this->input('phone', 'Phone number') . '
              </div>
            </section>


            <section id="participants">
              <h2>Participants</h2>

              <div class="participant">
                <h3>Participant #1</h3>
                <input name="participant_name" placeholder="Name" />
                <input name="prticipant_company" placeholder="Comppany name" />
                <input name="participant" placeholder="Comppany name" />

                <button id="add-participant">Add participant</button>

              </div>
            </div>

            <button>Submit</button>

          </form>
        ';

        return $output;
    }

}
