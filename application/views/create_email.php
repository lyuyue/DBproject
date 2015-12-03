<h2>Create a new email item</h2>
</php echo validation_errors();?>
<?php echo form_open('Email/create')?>

<label for="title">Title</label>
<input type="input" name="title"/><br />

<label for="sendTo">Receiver</label>
<input type="input" name="sendTo"/><br />

<label for="content">Content</label>
<textarea name="content"></textarea><br />

<input type="submit" name="submit" value="Create new email" />
</form>
