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
                <div class="content-block-header" id="header">
                    <h1 style="text-align: center;">Welcome to lylan To Do manager.</h1>
                </div>
                <hr>
                <div class="login-form">
                    <?php if($this->session->login_error) : ?>
                        <span class="login-error-box pure-u-4-5 pure-u-md-2-5 pure-u-xl-1-5"><?php echo $this->session->login_error; $this->session->unset_userdata('login_error'); ?></span>
                    <?php endif; ?>
                    <form action="<?php echo base_url() . index_page() . "/login/auth"; ?>" method="POST" onsubmit="return validateLogInForm(this)">
                        <input class="pure-u-4-5 pure-u-md-2-5 pure-u-xl-1-5" name="email" type="email" id="email-login" placeholder="Your email..">
                        <br>
                        <input class="pure-u-4-5 pure-u-md-2-5 pure-u-xl-1-5" name="password" type="password" id="password-login" placeholder="Your password..">
                        <br>
                        <button class="pure-u-10-24 pure-u-md-7-24 pure-u-xl-3-24" type="submit" name="action" value="SignIn">Sign In</button>
                        <button class="pure-u-10-24 pure-u-md-7-24 pure-u-xl-3-24" type="submit" name="action" value="Create">Create account</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>