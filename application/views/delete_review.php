<?php
echo 'Are you sure to delete this review?'.'<br />';
?>

<button>
  <a href="<?php echo site_url("Review/submitDelete/".$house."/".$user); ?>"
    >Yes</a>
</button>
<button>
  <a href="<?php echo site_url("HouseInformation/view/".$house); ?>"
    >No</a>
</button>
