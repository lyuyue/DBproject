<?php
echo 'Are you sure to delete post '.$id.'?'.'<br />';
?>

<button>
  <a href="<?php echo site_url("HouseInformation/submitDeletePost/".$id); ?>"
    >Yes</a>
</button>
<button>
  <a href="<?php echo site_url("HouseInformation/view/".$id); ?>"
    >No</a>
</button>
