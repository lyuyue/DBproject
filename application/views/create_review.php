<h2>Create a new review item</h2>
<?php echo "Current User ID: ".$user.'<br />'.'<br />';
echo "Current House ID: ".$house.'<br />'.'<br />';
?>
</php echo validation_errors();?>
<?php echo form_open('Review/create')?>
<label for="description">Review Content</label>
<textarea name="description"></textarea><br />

<input type="submit" name="submit" value="Create new review" />
</form>
