<b> <?php echo $msg;?> </b>

<p></p>
<?php
echo 'Rate house: '.$id.'.';
?>
        <?php echo form_open("HouseInformation/submitHouseRating/".$id); ?>
        rating:   <input type="number" name="rating" id="rating" value="" size=20>
        <input type="submit" name="btnNew" class="btn" value = "Submit">
    </form>
