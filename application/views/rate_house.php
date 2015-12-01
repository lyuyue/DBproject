<?php
echo $title.', postid='.$id.','.$msg;
?>
        <?php echo form_open("HouseInformation/submitRatePost/".$id); ?>
        rating:   <input type="number" name="rating" id="rating" value="" size=20>
        <input type="submit" name="btnNew" class="btn" value = "Submit">
    </form>
