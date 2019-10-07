<?php

require_once "database.php";

class User
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function register()
    {
        // TODO: validation!

        extract($_POST);
        $name = $company;

        $result = $this->db->connection->prepare('INSERT INTO users (course, date, name, phone, email) VALUES (:course,:date,:name,:phone,:email)');
        $result->execute([
            'course' => $course,
            'date' => $date,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
        ]);

        $application_id = $this->db->connection->lastInsertId();
        $haveAdditionalParticipants = true;
        $i = 0;

        // loop through participants and create a db entry for each
        while ($haveAdditionalParticipants) {
            ++$i;

            if (isset($_POST['participant' . $i . '_name'])) {
                echo "have participant #$i...<br>";

                // create participant
                $name = $_POST['participant' . $i . '_name'];
                $phone = $_POST['participant' . $i . '_phone'];
                $email = $_POST['participant' . $i . '_email'];

                debug([
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                ]);

                // create participant in db
                $result = $this->db->connection->prepare('INSERT INTO participants (application_id, name, phone, email) VALUES (:application_id,:name,:phone,:email)');
                $result->execute([
                    'application_id' => $application_id,
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                ]);

            } else {
                $haveAdditionalParticipants = false;
            }
        }
    }

    public function listUsers()
    {
        $query = $this->db->connection->prepare("SELECT * FROM users");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

}
