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
        Corporation name: <input type="text" name="corpname" value="" size="20">
        <input type="submit" name="btnLogin" class="btn" value = "Sign Up">
    </form>