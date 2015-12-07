<?php
echo "House Id: ".$house.'<br />'.'<br />';
echo "Tag From Tag Library:";
?>
<?php echo form_open('Tag/addTag'."/".$house)?>
<select name='selection'>
	<?php foreach($tag as $tag_item): ?>
	<option <?php echo "value = ".$tag_item['id'].">"?><?php echo $tag_item['description']?></option>	
	<?php endforeach ?>
</select>
<?php
echo '<br />'.'<br />';
?>


<input type="submit" name="submit" value="Comfirm Adding Tag" />
</form>