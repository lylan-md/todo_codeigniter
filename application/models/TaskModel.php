<?php
class TaskModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function addTask(PreparedTask $task, User $user)
    {
        $data = array(
            "user_id"       => $user->getId(),
            "description"   => $task->getDescription(),
            "is_done"       => (int) $task->getIsDone(),
            "category_id"   => $task->getCategory(),
            "important"     => (int) $task->getImportant(),
            "planned_on"    => $task->getPlannedOn()
        );

        return $this->db->insert("tasks", $data);
    }

    public function getTasks(User $user, $filters = array())
    {
        $this->db->where("user_id", $user->getId());

        foreach ($filters as $key => $value)
        {
            $this->db->where($key, $value);
        }

        $this->db->order_by("is_done", "ASC");

        $resultGetTasks = $this->db->get("tasks");

        if ($resultGetTasks === false)
        {
            return [];
        }

        $tasks = array();

        foreach ($resultGetTasks->result_array() as $row)
        {
            $task       = new Task($row['id'], $row['description'], (bool) $row['is_done'], $row['category_id'], (bool) $row['important'], $row['planned_on']);
            $tasks[]    = $task;
        }

        return $tasks;
    }

    public function deleteTask(Task $task, User $user)
    {
        $this->db->where("user_id", $user->getId());
        $this->db->where("id", $task->getId());
        return $this->db->delete("tasks");
    }

    public function updateTask(Task $task, User $user)
    {
        $this->db->set("description", $task->getDescription());
        $this->db->set("is_done", (int) $task->getIsDone());
        $this->db->set("category_id", $task->getCategory());
        $this->db->set("important", (int) $task->getImportant());
        $this->db->set("planned_on", $task->getPlannedOn());

        $this->db->where("user_id", $user->getId());
        $this->db->where("id", $task->getId());

        return $this->db->update("tasks");
    }
}