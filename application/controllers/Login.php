<?php  
require_once(ENTITIES_DIR  . "User.php");
require_once(ENTITIES_DIR  . "UserNull.php");

defined('BASEPATH') OR exit('No direct script access allowed');  

class Login extends CI_Controller 
{  
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('UserModel');
    }

    public function index()  
    {  
        if ($this->session->email)
        {
            redirect("MyDay");  
        }
        else
        {
            $this->load->view('login'); 
        }
    }  

    public function auth()
    {
        $email      = $this->input->post("email");
        $password   = $this->input->post("password");
        $action     = $this->input->post("action");
        
        switch ($action)
        {
            case "SignIn":
                $this->signIn($email, $password);
                break;
            case "Create":
                $this->create($email, $password);
                break;
            default:
                $this->session->login_error = "Internal error!";
                break;
        }

        $this->load->view('login');
    }

    public function signIn($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->session->login_error = "Invalid email!";   
            $this->load->view('login');
            return;
        }

        if (!strlen($password))
        {
            $this->session->login_error = "Empty password!";   
            $this->load->view('login');
            return;
        }

        $user = $this->UserModel->getUser($email, $password);

        if (is_a($user, "User"))
        {
            $this->session->email = $user->getEmail(); 
            redirect("MyDay");         
        }
        elseif (is_a($user, "UserNull"))
        {
            $this->session->login_error = "Password or Email incorrect!";                
        }
        else
        {
            $this->session->login_error = "Internal error!";      
        }
    }

    public function create($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->session->login_error = "Invalid email!";   
            $this->load->view('login');
            return;
        }

        if (!strlen($password))
        {
            $this->session->login_error = "Empty password!";   
            $this->load->view('login');
            return;
        }

        $resultUserExists = $this->UserModel->checkUserExists($email);

        if ($resultUserExists == -1)
        {
            if ($this->UserModel->addUser($email, $password))
            {
                $this->session->email = $email;
                redirect("Login");  
            }
            else
            {
                $this->session->login_error = "Internal error!";
            }
        }
        elseif ($resultUserExists === false)
        {
            $this->session->login_error = "Internal error!";
        }
        else
        {
            $this->session->login_error = "User exists!";      
        }
    }

    public function logout()  
    {  
        $this->session->unset_userdata('email');  
        redirect("Login");  
    }   
}