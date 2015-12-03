<h2><?php echo $title; ?></h2>
<?php
echo $id.','.$sellerInformation['username'].','.$sellerInformation['email'];
?>

<?php echo form_open("UserRating/rateUser/".$sellerInformation['id']); ?>
<input type="submit" name="btnNew" class="btn" value = "Rate">
</form>
