<!DOCTYPE html>
<html>
    <head>
        <title>To Do</title>
        <?php $this->load->view('head.php'); ?>
    </head>
    <body>
        <?php $this->load->view('left_panel.php'); ?>
        <div class="pure-u-1 pure-u-sm-16-24 pure-u-md-18-24 pure-u-xl-20-24" id="content-wrapper">
            <?php $this->load->view('header.php'); ?>
            <div class="pure-u-1-1" id="content-block">
                <div class="content-block-header">
                    <h1><span class="material-icons">calendar_today</span>Planned</h1>
                </div>
                <hr>
                <input type="text" id="content-block-add" class="pure-u-19-24" onchange="handleInputTask('<?php echo base_url() . index_page(); ?>')" placeholder="Add task">
                <input type="date" id="content-block-date" class="pure-u-5-24" onchange="handleInputTask('<?php echo base_url() . index_page(); ?>')">
                <div class="content-block-list" id="task-list-block">
                    <?php foreach($task_list as $task): ?>
                        <div class="content-block-list-item pure-u-1-1" style="vertical-align: middle;">
                            <div class="pure-u-2-24 pure-u-md-1-24">
                                <input type="checkbox" <?php if ($task['is_done']) echo "checked"; ?> class="checkbox-is-done" onclick="redirect('<?php echo base_url() . index_page() . "/Planned/switchIsDoneTaskFlag/" . $task['task_id']; ?>')">
                            </div>
                            <div class="pure-u-18-24 pure-u-md-21-24">
                                <span style="text-decoration: <?php echo $task['is_done'] ? "line-through" : "none"; ?>"><?php echo $task['task_desc']; ?></span>
                            </div>
                            <div class="pure-u-3-24 pure-u-md-2-24" style="float: right;">
                                <span class="material-icons favorite-icon-<?php echo $task['important'] ? "checked" : "unchecked"; ?>" onclick="redirect('<?php echo base_url() . index_page() . "/Planned/switchImportantFlag/" . $task['task_id']; ?>')"><?php echo $task['important'] ? "star" : "star_border"; ?></span>
                                <span class="material-icons delete-task-icon" onclick="redirect('<?php echo base_url() . index_page() . "/Planned/deleteTask/" . $task['task_id']; ?>')">delete_outline</span>
                            </div>
                            <div class="content-block-list-item-planned-date" style="display: <?php echo $task['planned_on'] ? "block" : "none"; ?>;">
                                <span style="font-size: 80%; color: #8c8c8c;">Planned on: </span>
                                <span style="font-size: 80%; color: #788cde;"><?php echo $task['planned_on'] ? $task['planned_on'] : ""; ?></span>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </body>
    <script>
        function handleInputTask(baseUrl)
        {
            var textInput = document.getElementById("content-block-add");
            var dateInput = document.getElementById("content-block-date");
            var taskDescription = textInput.value;
            var datePlanned = dateInput.value;

            if (taskDescription.length && datePlanned.length)
            {
                var request = new XMLHttpRequest();
                request.open('POST', baseUrl + '/Planned/add', false);
                request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                var requestData = "task_description=" + taskDescription + "&planned_on=" + datePlanned;
                request.send(requestData);

                redirect(baseUrl + "/Planned/show");
            }
        }

        function redirect(url)
        {
            window.location.href = url;
        }

        document.getElementById("menu-list-planned").classList.add("selected");
    </script>
</html>