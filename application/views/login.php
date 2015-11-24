<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/5/15
 * Time: 9:47 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type = 'text/css'> <?php include 'css/home.css'; ?> </style>
<div id="container">
    <h1>Welcome to Douban Website</h1>

    <div id="body">
        <p>This is a Prototype of a Real Estate Information Website</p>
        <?php
            if (isset($msg)) {
                echo '<p>'.$msg.'</p>';
            }
        ?>
        <p>Please LOGIN here</p>
        <?php echo form_open('login/submitLogin'); ?>
            Username:   <input type="text" name="username" id="username" value="" size=20>
            Password:   <input type="password" name="password" id="password" value="" size="20">
            <input type="submit" name="btnLogin" class="btn" value = "Login">
        </form>

        <p>If you don't have an account, please REGISTER here</p>
        <button type="button" onclick="register()">Register</button>

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<script>
    function register() {
        window.location.href="<?php echo site_url("UserInformation/registerIndividual"); ?>";
    }
</script>