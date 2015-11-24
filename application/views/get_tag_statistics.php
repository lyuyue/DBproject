<?php echo $title;

foreach ($tagStatistics as $ts_item):

  echo ' '.$ts_item['tagId'].','.$ts_item['counts'];
endforeach; ?>
