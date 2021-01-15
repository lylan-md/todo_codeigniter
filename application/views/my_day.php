<!DOCTYPE html>
<html>
    <head>
        <title>My Day</title>
        <?php $this->load->view('head.php'); ?>
    </head>
    <body>
        <?php $this->load->view('left_panel.php'); ?>
        <div class="pure-u-1 pure-u-sm-16-24 pure-u-md-18-24 pure-u-xl-20-24" id="content-wrapper">
            <?php $this->load->view('header.php'); ?>
            <div class="pure-u-1-1" id="content-block">
                <div class="content-block-header">
                    <h1>My Day</h1>
                    <h3 id="cur-date">Saturday, 3 October</h3>
                </div>
                <hr>
                <input type="text" id="content-block-add" class="pure-u-1-1" onchange="handleInputTask(this, this.value, '<?php echo base_url() . index_page(); ?>')" placeholder="Add task">
                <div class="content-block-list" id="task-list-block">
                    <?php foreach($task_list as $task): ?>
                        <div class="content-block-list-item pure-u-1-1" style="vertical-align: middle;">
                            <div class="pure-u-2-24 pure-u-md-1-24">
                                <input type="checkbox" <?php if ($task['is_done']) echo "checked"; ?> class="checkbox-is-done" onclick="redirect('<?php echo base_url() . index_page() . "/MyDay/switchIsDoneTaskFlag/" . $task['task_id']; ?>')">
                            </div>
                            <div class="pure-u-18-24 pure-u-md-21-24">
                                <span style="text-decoration: <?php echo $task['is_done'] ? "line-through" : "none"; ?>"><?php echo $task['task_desc']; ?></span>
                            </div>
                            <div class="pure-u-3-24 pure-u-md-2-24" style="float: right;">
                                <span class="material-icons favorite-icon-<?php echo $task['important'] ? "checked" : "unchecked"; ?>" onclick="redirect('<?php echo base_url() . index_page() . "/MyDay/switchImportantFlag/" . $task['task_id']; ?>')"><?php echo $task['important'] ? "star" : "star_border"; ?></span>
                                <span class="material-icons delete-task-icon" onclick="redirect('<?php echo base_url() . index_page() . "/MyDay/deleteTask/" . $task['task_id']; ?>')">delete_outline</span>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </body>
    <script>
        function handleInputTask(input, taskDescription, baseUrl)
        {
            if (taskDescription.length)
            {
                var request = new XMLHttpRequest();
                request.open('POST', baseUrl + '/MyDay/add', false);
                request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                var requestData = "task_description=" + taskDescription;
                request.send(requestData);

                redirect(baseUrl + "/MyDay/show");
            }
        }

        function redirect(url)
        {
            window.location.href = url;
        }

        var options = { weekday: 'long', day: 'numeric', month: 'long'};
        document.getElementById("cur-date").innerHTML = new Intl.DateTimeFormat('en-US', options).format(new Date());
        document.getElementById("menu-list-myday").classList.add("selected");
    </script>
</html>