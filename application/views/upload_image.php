<b> <?php echo 'Upload image for post '.$id;?> <b/>

<html>
<head>
<title>Upload Form</title>
</head>
<body>
  <?php foreach ($error as $item):?>
  <li><?php echo $item;?></li>
  <?php endforeach; ?>

<?php echo form_open_multipart('HouseInformation/uploadImage/'.$id);?>
<input type="file" name="userfile" size="20" />

<br />

<input type="submit" value="upload image" />

</form>

</body>
</html>

</button>
<?php
    $url = site_url('HouseInformation/view/'.$id);
    echo '<button> <a href="'.$url.'"> upload later</a> </button>';
