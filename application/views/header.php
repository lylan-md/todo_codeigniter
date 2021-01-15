<div class="header pure-u-1" id="header">
    <div class="pure-g">
        <div class="pure-u-1-3 pure-u-sm-1-3">
            <span class="material-icons" id="button-open-left-panel" onclick="openPanel(this)">menu</span>
        </div>
        <input type="search" class="header-search-input pure-u-sm-1-3" placeholder="Search"></input>
        <div class="logout-block pure-u-2-3 pure-u-sm-1-3">
            <?php if(isset($this->session->email)) : ?>
                <form method="POST" action="<?php echo base_url() . index_page() . "/Login/logout"?>">
                    <span style="color: #ffffff;" id="email-span"><?php echo $this->session->email ?></span>
                    <button id="button-logout"><span class="material-icons">exit_to_app</span></button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>