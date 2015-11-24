<?php
echo $id.','.$houseInformation_item['location'].','.$houseInformation_item['deleteStatus'];
?>
        <?php echo form_open("HouseInformation/submitDeletePost/".$id); ?>
        <input type="submit" name="btnDelete" class="btn" value = "Delete">
    </form>
