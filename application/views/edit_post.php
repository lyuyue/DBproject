<?php
echo $msg.'<br />'.'<br />';
echo $title;
?>
        <?php echo form_open("HouseInformation/submitEditPost/".$id); ?>
        build year:   <input type="text" name="buildYear" id="buildYear" value="<?php echo $post['buildYear']; ?>" size=20>
        location: <input type="text" name="location" id="location" value="<?php echo $post['location']; ?>" size=20>
        bedroom number: <input type="number" name="brNumber" id="brNumber" value="<?php echo $post['brNumber']; ?>" size=20>
        price: <input type="number" name="price" id="price" value="<?php echo $post['price']; ?>" size=20>
        description: <input type="text" name="description" id="description" value="<?php echo $post['description']; ?>" size=20>
        type name(1-apartment,2-house): <input type="number" name="typeName" id="typeName" value="<?php echo $post['typeName']; ?>" size=20>
        image name: <input type="text" name="largeImage" id="largeImage" value="<?php echo $post['largeImage']; ?>" size=20>
        <input type="submit" name="btnNew" class="btn" value = "Update">
    </form>
