<?php  
require_once(ENTITIES_DIR  . "User.php");
require_once(ENTITIES_DIR  . "UserNull.php");
require_once(ENTITIES_DIR  . "Task.php");
require_once(ENTITIES_DIR  . "PreparedTask.php");

defined('BASEPATH') OR exit('No direct script access allowed');  

class Important extends CI_Controller 
{  
    public function __construct()
    {
        parent::__construct();

        $this->load->model('TaskModel');
        $this->load->model('UserModel');
    }

    public function index()
    {
        if (!$this->session->email)
        {
            redirect("Login");      
        }

        redirect("Important/show"); 
    }

    public function show()
    {
        if (!$this->session->email)
        {
            redirect("Login");  
        }

        $user   = $this->UserModel->getUser($this->session->email);
        $tasks  = $this->TaskModel->getTasks($user, array("important" => true));

        $data['task_list'] = array();

        foreach($tasks as $task)
        {
            $data['task_list'][] = array(
                "task_id"       => $task->getId(),
                "task_desc"     => $task->getDescription(),
                "is_done"       => $task->getIsDone(),
                "category"      => $task->getCategory(),
                "important"     => $task->getImportant(),
                "planned_on"    => $task->getPlannedOn(),
            );
        }

        $this->load->view('important', $data);
    }

    public function switchIsDoneTaskFlag($taskId)
    {
        $user   = $this->UserModel->getUser($this->session->email);
        $tasks  = $this->TaskModel->getTasks($user, array("id" => $taskId));
        
        if ($tasks)
        {
            $task = $tasks[0];
            $task->switchIsDone();
            $this->TaskModel->updateTask($task, $user);
        }

        redirect("Important/show");
    }

    public function switchImportantFlag($taskId)
    {
        $user   = $this->UserModel->getUser($this->session->email);
        $tasks  = $this->TaskModel->getTasks($user, array("id" => $taskId));
        
        if ($tasks)
        {
            $task = $tasks[0];
            $task->switchImportant();
            $this->TaskModel->updateTask($task, $user);
        }

        redirect("Important/show");
    }

    public function deleteTask($taskId)
    {
        $user   = $this->UserModel->getUser($this->session->email);
        $tasks  = $this->TaskModel->getTasks($user, array("id" => $taskId));
        
        if ($tasks)
        {
            $task = $tasks[0];
            $this->TaskModel->deleteTask($task, $user);
        }

        redirect("Important/show");
    }
}