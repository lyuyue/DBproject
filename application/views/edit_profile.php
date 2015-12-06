<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 12/6/15
 * Time: 3:59 PM
 */?>

<?php echo form_open("UserInformation/editIndividualSubmit"); ?>
Email:      <input type="text" name="email" value="" size="20" placeholder="<?php echo $email;?>">
Phone:      <input type="text" name="phone" value="" size="20" placeholde="<?php echo $phone;?>">
<input type="submit" name="btnLogin" class="btn" value = "Sign Up">
</form>
