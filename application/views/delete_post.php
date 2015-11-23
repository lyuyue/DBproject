<?php
echo $id;
echo $houseInformation_item['location'];
?>

    <?php echo $msg; ?>
    <?php echo form_open("HouseInformation/submitDeletePost"); ?>
        <input type="submit" name="btnLogin" class="btn" value = "Delete">
    </form>
