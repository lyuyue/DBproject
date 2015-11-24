<h2>Create a new review item</h2>
<table border='1'>
	<tr>
	<td><?php echo $id ?></td>
	<td><?php echo $house ?></td>
	</tr>
</table>
</php echo validation_errors();?>
<?php echo form_open('Review/create')?>
<label for="description">Review Content</label>
<textarea name="description"></textarea><br />

<input type="submit" name="submit" value="Create new review" />
</form>
