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
              <course-participant id="1"></course-participant>

            </section>

            <section>
              <button id="add-participant">Add a participant</button>
            </section>

            <section>
              <button>Submit</button>
            </section>

          </form>
        ';
        return $output;
    }

    public function data()
    {
        return json_encode($this->courses->data);
    }

    // TODO: optimize! use a separated table view for tis
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
            $this->user->register($_POST);
            $output = "<h2>Application registered, thank you!</h2>";
            return $output;
        }

        // TODO: implement a router instead
        if (!isset($_GET['page'])) {
            $_GET['page'] = 'default';
        }

        switch ($_GET['page']) {
            default:
                $output .= $this->renderForms();
                break;

            // output courses data as JSON
            case 'data':
                echo $this->data();
                exit;
                break;

            case 'list':
                $users = $this->user->listUsers();
                $output .= $this->renderUsersList($users);
                break;

        }

        return $output;
    }

}
