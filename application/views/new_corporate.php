<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/23/15
 * Time: 11:05 PM
 */
?>
    <?php echo $msg; ?>
    <?php echo form_open("UserInformation/registerCorporateSubmit"); ?>
        Username:   <input type="text" name="username" value="" size="20" placeholder="username">
        Password:   <input type="password" name="pwd" id="pwd" value="" size=20>
        Password again: <input type="password" name="pwd_again" id="new_pwd_again" value="" size="20">
        Email:      <input type="text" name="email" value="" size="20">
        Phone:      <input type="text" name="phone" value="" size="20">
        Corporation name: <input type="text" name="corpname" value="" size="20">
        <input type="submit" name="btnLogin" class="btn" value = "Sign Up">
    </form>