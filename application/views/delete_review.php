<?php
echo $user;
echo $house;
echo $content;
?>

    <?php echo form_open("Review/delete/", $house); ?>
        <input type="submit" name="submitn" value = "Delete">
    </form>