<?php
/**
 * Created by PhpStorm.
 * User:  YueLyu
 * Date:  11/14/15
 * Time:  9: 54 PM
 */
    echo $msg.'<br />';
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

    <img src="<?php
                if(file_exists(base_url('images/'. $houseInformation_item['largeImage']))){
                echo base_url('images/'. $houseInformation_item['largeImage']);
                }?>" />
