<b> <?php echo $msg;?> </b>

<p></p>
<?php
echo 'Rate user: '.$UserInformation['username'].'.';
?>
        <?php echo form_open("UserInformation/submitRateUser/".$userid); ?>
        rating:   <input type="number" name="rating" id="rating" value="" size=20>
        <input type="submit" name="btnNew" class="btn" value = "Submit">
    </form>
