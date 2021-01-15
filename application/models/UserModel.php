<?php
class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function addUser($email, $password)
    {
        $data = array(
            'email'     => $email,
            'password'  => sha1($password)
        );
        
        return $this->db->insert('users', $data);
    }

    public function getUser($email, $password = null)
    {
        $this->db->where('email', $email);
        
        if ($password)
        {
            $this->db->where('password', sha1($password));
        }

        $result = $this->db->get("users");

        if ($result === false)
        {
            return false;
        }

        if ($result->num_rows())
        {
            $row = $result->row_array();
            return new User($row['id'], $row['email']);
        }
        else
        {
            return new UserNull();
        }
    }

    public function checkUserExists($email)
    {
        $queryCheckUserExists   = "SELECT IFNULL((SELECT `id` FROM `users` WHERE `email` = '$email'), -1) AS id";
        $resultCheckUserExists  = $this->db->query($queryCheckUserExists);
        return $resultCheckUserExists === false ? false : $resultCheckUserExists->row_array()['id'];
    }
}