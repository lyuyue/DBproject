<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 2:13 PM
 */

?>
    <?php echo $msg; ?>
    <?php echo form_open("UserInformation/submitNewPassword"); ?>
        Password:   <input type="password" name="pwd" id="pwd" value="" size=20>
        New Password:   <input type="password" name="new_pwd" id="new_pwd" value="" size="20">
        New Password again: <input type="password" name="new_pwd_again" id="new_pwd_again" value="" size="20">
        <input type="submit" name="btnLogin" class="btn" value = "Submit New Password">
    </form>
