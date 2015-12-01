<?php
echo $title;
?>
        <?php echo form_open("HouseInformation/submitNewPost"); ?>
        build year (YYYY-MM-DD):   <input type="text" name="buildYear" id="buildYear" value="" size=20>
        location: <input type="text" name="location" id="location" value="" size=20>
        bedroom number: <input type="number" name="brNumber" id="brNumber" value="" size=20>
        price: <input type="number" name="price" id="price" value="" size=20>
        description: <input type="text" name="description" id="description" value="" size=20>
        type name (1-apartment,2-house): <input type="number" name="typeName" id="typeName" value="" size=20>
        image name: <input type="text" name="largeImage" id="largeImage" value="" size=20>
        <input type="submit" name="btnNew" class="btn" value = "Submit">
    </form>
