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

        try {
            $result = $this->db->connection->prepare('INSERT INTO users (course, date, name, phone, email) VALUES (:course,:date,:name,:phone,:email)');
            $result->execute([
                'course' => $course,
                'date' => $date,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
            ]);
        } catch (\PDOException $e) {
            echo "ERROR!";
            print_r($e);
            return false;
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
