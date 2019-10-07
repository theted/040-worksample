<?php

require_once "./models/courses.php";
require_once "./models/user.php";

class Main
{
    public $courses;

    public function __construct()
    {
        $this->courses = new Courses();
        $this->user = new User(); // TODO: rename!
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
        if (!$placeholder) {
            $placeholder = $label;
        }

        $output = "<div>";
        $output .= "<label for=\"$name\">$label</label>";
        $output .= "<input name=\"$name\" placeholder=\"$placeholder\" required />";
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
        $output = '

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
                ' . $this->input('company', 'Company name') . '
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
                ' . $this->input('participant1_name', 'Name') . '
                ' . $this->input('participant1_phone', 'Phone') . '
                ' . $this->input('participant1_email', 'Email') . '
              </div>


              <course-participant id="1"></course-participant>

              <button id="add-participant">Add a participant</button>
            </div>

            <button>Submit</button>

          </form>
        ';
        return $output;
    }

    public function data()
    {
        return json_encode($this->courses->data);
    }

    public function renderUsersList($users)
    {
        $output = "<table>";
        $output .= "<thead>
        <tr>
          <th>Name</th>
        </tr>
          </thead>";

        debug($users);

        foreach ($users as $key => $user) {
            $output .= '<tr><td>' . $user['name'] . 'x</td></tr>';
        }

        $output .= "</table>";

        return $output;
    }

    // TODO: move to prettier view
    public function render()
    {
        $output = "";

        // enter into DB
        // TODO: validation
        // TODO: refactorisation!
        if (!empty($_POST)) {

            $registerResult = $this->user->register($_POST);
            debug($_POST);
            die($registerResult);
        }

        // TODO: implement a router instead
        switch ($_GET['page']) {
            default:break;

            // output courses data as JSON
            case 'data':
                echo $this->data();
                exit;
                break;

            case 'list':
                $users = $this->user->listUsers();
                $output .= $this->renderUsersList($users);
                // debug($users);
                // die('We list stuff here...');
                // exit;
                break;

        }

        $output .= $this->renderForms();

        return $output;
    }

}
