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

    public function input($name, $label)
    {
        $output = "<div>";
        $output .= "<label for=\"$name\">$label</label>";
        $output .= "<input name=\"$name\" required />";
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
                ' . $this->select("course", []) . '
                ' . $this->select("date", []) . '
              </div>
            </section>

            <section id="company">
              <h2>Company</h2>
              <div class="columns">
                ' . $this->input('company', 'Company name') . '
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

    // TODO: optimize! use a separated table view for this
    public function renderUsersList($users)
    {
        $output = "<table>";
        $output .= "<thead>
        <tr>
          <th>Course ID</th>
          <th>Date</th>
          <th>Company</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Participants</th>
        </tr>
          </thead>
          <tbody>";

        foreach ($users as $key => $user) {

            $participants = "";

            // prepare partipiants
            // TODO: would make prettier if had more time!
            foreach ($user['users'] as $key => $participant) {
                $participants .= "Participant #$key:<br />" .
                    "NAME: " . $participant['name'] . '<br />'
                    . "PHONE: " . $participant['phone'] . '<br />'
                    . "EMAIL: " . $participant['email'] . '<br /><br />';
            }

            $output .= '<tr>
              <td>' . $user['course'] . '</td>
              <td>' . $user['date'] . '</td>
              <td>' . $user['name'] . '</td>
              <td>' . $user['phone'] . '</td>
              <td>' . $user['email'] . '</td>
              <td>' . $participants . '</td>
              </tr>';
        }

        $output .= "</tbody></table>";

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

        // quick&dirty fix for undefined query params
        if (!isset($_GET['page'])) {
            $_GET['page'] = 'default';
        }

        // TODO: implement a router instead
        switch ($_GET['page']) {

            // render register particpant form
            default:
                $output .= $this->renderForms();
                break;

            // output courses data as JSON
            case 'data':
                echo $this->data();
                exit;
                break;

            // render registered course users & participants
            case 'list':
                $users = $this->user->listUsers();
                $output .= $this->renderUsersList($users);
                break;

        }

        return $output;
    }

}
