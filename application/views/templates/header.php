<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/17/15
 * Time: 1:21 PM
 */
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>

    <!--link the bootstrap css file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">

</head>
<body>
    <ul class="nav nav-pills">
        <?php
            $url = site_url("main");
            echo '<li role="presentation" class="active"><a href="'.$url.'">Home</a></li>';

            if (! isset($_SESSION['login'])) {
                $url = site_url('login');
                echo '<li role="presentation"><a href="'.$url.'">Login</a></li>';
                $url = site_url('UserInformation/registerIndividual');
                echo '<li role="presentation"><a href="'.$url.'">Register</a></li>';
            }

            if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
                echo '<li class="">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    $url = site_url("UserInformation/viewProfile");
                    echo '<li><a href = "'.$url.'">My Profile</a></li>';
                    $url = site_url("UserInformation/resetPassword");
                    echo '<li><a href = "'.$url.'">Reset Password</a></li>';
                    if ($_SESSION['usertype'] == 2) {
                        $url = site_url("UserInformation/registerCorporate");
                        echo '<li><a href = "'.$url.'">Corporate Application</a></li>';
                    }
                    echo '<li role="separator" class="divider"></li>';
                    $url = site_url("Email");
                    echo '<li><a href="'.$url.'">My Emails</a></li>';
                    $url = site_url("HouseInformation/viewMyPosts");
                    echo '<li><a href="'.$url.'">My Posts</a></li>';
                    echo '<li role="separator" class="divider"></li>';
                    $url = site_url("Review/showMyReviews");
                    echo '<li><a href="'.$url.'">My Reviews</a></li>';
                    echo '<li role="separator" class="divider"></li>';
                    $url = site_url('Logout');
                    echo '<li><a href="'.$url.'">Log out</a></li>';
                echo '</ul>
                </li>';
            }

            IF (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 4) {
                echo '<li class="">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                $url = site_url("UserInformation/viewUnverifiedCorp");
                echo '<li><a href="'.$url.'">Verify Corporate</a></li>';
                echo '<li><a href="#">Verify Post</a></li>';

                echo '</ul>
                </li>';
            }
            IF (isset($_SESSION['login'])) {
                $url = site_url('HouseInformation/newPost');
                echo '<li role="presentation"><a href="'.$url.'">New Post</a></li>';
              }
        ?>
    </ul>
