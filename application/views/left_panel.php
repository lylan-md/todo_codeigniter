<div class="left-panel pure-u-sm-8-24 pure-u-md-6-24 pure-u-xl-4-24" id="left-panel">
    <div class="left-panel-logo-block elem-left-panel pure-u-1-1">
        <a href="<?php echo base_url() . index_page() . "/MyDay"?>" style="float: left;"><img src="<?php echo base_url(); ?>includes/img/favicon.png" alt="Logo" style="width: 40px;"></a>
        <h1 style="float: left; margin: 0 0 0 5px; padding-top: 6px;">To Do</h1>
        <span class="material-icons" id="button-close-left-panel" onclick="closePanel(this)">menu_open</span>
    </div>
    <ul class="elem-left-panel pure-u-1-1">
        <a class="menu-list-item" id="menu-list-myday" href="<?php echo base_url() . index_page() . "/MyDay/show"?>"><span class="material-icons">wb_sunny</span>My Day</a>
        <a class="menu-list-item" id="menu-list-important" href="<?php echo base_url() . index_page() . "/Important/show"?>"><span class="material-icons">label_important</span>Important</a>
        <a class="menu-list-item" id="menu-list-planned" href="<?php echo base_url() . index_page() . "/Planned/show"?>"><span class="material-icons">calendar_today</span>Planned</a>
        <a class="menu-list-item" id="menu-list-tasks" href="<?php echo base_url() . index_page() . "/Tasks/show"?>"><span class="material-icons">home</span>Tasks</a>
    </ul>
</div>