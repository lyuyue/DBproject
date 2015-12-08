<b> <?php echo $msg.'<br />'.'<br />';?></b>

<b> <?php echo 'HOUSE INFORMATION'.'<br />';?></b>
<?php
/**
 * Created by PhpStorm.
 * User:  YueLyu
 * Date:  11/14/15
 * Time:  9: 54 PM
 */
    echo 'location : '.$houseInformation_item['location'].'<br />';
    echo 'build year : '.$houseInformation_item['buildYear'].'<br />';
    echo 'bedroom number : '.$houseInformation_item['brNumber'].'<br />';
    echo 'price : '.$houseInformation_item['price'].'<br />';
    echo 'description : '.$houseInformation_item['description'].'<br />';
    echo 'verified : '.$houseInformation_item['verified'].'<br />';
    echo 'post time : '.$houseInformation_item['postTime'].'<br />';
    echo 'update time : '.$houseInformation_item['updateTime'].'<br />';
    echo 'view times : '.$houseInformation_item['viewTimes'].'<br />';
    echo 'averageRating : '.$houseInformation_item['averageRating'].'<br />';
?>

<p></p>
<b> <?php echo 'SELLER INFORMATION'.'<br />';?></b>
<?php
    echo 'username : '.$sellerInformation['username'].'<br />';
    echo 'email : '.$sellerInformation['email'].'<br />';
    echo 'phone : '.$sellerInformation['phone'].'<br />';
    echo 'averageRating : '.$sellerInformation['averageRating'].'<br />';
    if($corpInformation['id']){
      echo 'corpName : '.$corpInformation['corpName'].'<br />';
      echo 'registeredTime : '.$corpInformation['registeredTime'].'<br />';
      echo 'verificationTime : '.$corpInformation['verificationTime'].'<br />';
    }
?>
<img src= <?php
      if(file_exists('images/'. $houseInformation_item['largeImage'])){
        echo '"/images/'. $houseInformation_item['largeImage'].'" height="300" width="300"';
      }
      else{
        echo "";
      }?> />


<p></p>

<?php
  if(isset($_SESSION['login'])){

    $url = site_url("UserInformation/rateUser/".$sellerInformation['id']);
    echo '<button> <a href="'.$url.'"> Rate Seller</a> </button>';

    $url = site_url("HouseInformation/houseRating/".$houseInformation_item['id']);
    echo '<button> <a href="'.$url.'"> Rate House</a> </button>';

    $url = site_url("Review/create/".$houseInformation_item['id']);
    echo '<button> <a href="'.$url.'"> Add Review</a> </button>';

    if($sellerInformation['id'] == $_SESSION['id'] || $_SESSION['usertype'] == 4){
      $url = site_url('HouseInformation/editPost/'.$houseInformation_item['id']);
      echo '<button> <a href="'.$url.'"> Edit House Information</a> </button>';

      $url = site_url('HouseInformation/deletePost/'.$houseInformation_item['id']);
      echo '<button> <a href="'.$url.'"> Delete House Information</a> </button>';

      $url = site_url('HouseInformation/setPin/'.$houseInformation_item['id']);
      echo '<button> <a href="'.$url.'"> Set Pin</a> </button>';
    }

    $url = site_url('Tag/addTag'."/".$houseInformation_item['id']);
    echo '<button> <a href="'.$url.'"> Add Tag To The House</a> </button>';

    $url = site_url('Tag/create'."/".$houseInformation_item['id']);
    echo '<button> <a href="'.$url.'"> Add Tag To The Tag Library</a> </button>';

  }
?>

<hr />
<b> <?php echo 'TAGS'.'<br />';?></b>
<?php foreach ($tagStatistics as $ts_item):
        echo ' tag: '.$ts_item['description'].', counts: '.$ts_item['counts'].'<br />';
      endforeach; ?>

<hr />
<b> <?php echo 'REVIEWS'.'<br />';?></b>
<?php foreach ($reviewInfo as $review_item):
        echo ' posted by: '.$review_item['username'].', description: '.$review_item['description'].'<br />';
        if(isset($_SESSION['login'])){
          if( $_SESSION['id'] == $review_item['postedBy'] || $_SESSION['usertype'] == 4){
          $url = site_url('Review/edit/'.$houseInformation_item['id']);
          echo '<a href="'.$url.'"> Edit Review</a> ';

          echo "  ";

          $url = site_url('Review/delete/'.$houseInformation_item['id']."/".$review_item['postedBy']);
          echo '<a href="'.$url.'"> Delete Review</a> ';

          echo '<br />';
          }
        }
      endforeach; ?>

<hr />
