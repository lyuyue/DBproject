<b> <?php
      if($imageType == 1){
      echo 'Upload large image for post '.$id;
    }
    else{
      echo 'Upload list image for post '.$id;
    } ?> <b/>

<html>
<head>
<title>Upload Form</title>
</head>
<body>
  <?php foreach ($error as $item):?>
  <li><?php echo $item;?></li>
  <?php endforeach; ?>

<?php echo form_open_multipart('HouseInformation/uploadImage/'.$id.'/'.$imageType);?>
<input type="file" name="userfile" size="20" />

<br />

<input type="submit" value="upload image" />

</form>

</body>
</html>
