<h2>Create a new Tag item</h2>
</php echo validation_errors();?>
<?php echo form_open('Email/create')?>
<label for="description">TagName</label>
<input type="input" name="description"/><br />
<input type="submit" name="submit" value="Create new tag" />
</form>