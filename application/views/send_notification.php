<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 12/7/15
 * Time: 9:06 PM
 */
?>

<?php echo form_open('Email/sendNotification')?>

<label for="title">Title</label>
<input type="input" name="title"/><br />

<label for="content">Content</label>
<textarea name="content"></textarea><br />

<input type="submit" name="submit" value="Create new notification" />
</form>
