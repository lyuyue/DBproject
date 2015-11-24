<?php
echo $title.', userid='.$userid;
?>
        <?php echo form_open("UserInformation/submitRateUser/".$userid); ?>
        rating:   <input type="number" name="rating" id="rating" value="" size=20>
        <input type="submit" name="btnNew" class="btn" value = "Submit">
    </form>
