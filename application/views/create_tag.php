<h2>Create a new tag item</h2>
</php echo validation_errors();?>
<?php echo form_open('Tag/create')?>
<label for="description">Tag Name</label>
<input type="input" name="description"/><br />

<input type="submit" name="submit" value="Create new tag" />
</form>