<h2>Edit a review item</h2>
<?php echo "Current User Name: ".$name['username'].'<br />'.'<br />';
echo "Current House ID: ".$house.'<br />'.'<br />';
?>
</php echo validation_errors();?>
<?php echo form_open('Review/edit'."/".$house)?>
<label for="description">Review Content</label>
<textarea name="description"></textarea><br />

<input type="submit" name="submit" value="Edit new review" />
</form>
