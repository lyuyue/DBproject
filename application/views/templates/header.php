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

</head>
<body>
    <ul class="nav nav-pills">
       <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Profile</a></li>
        <li role="presentation"><a href="#">Messages</a></li>
        <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
            echo '<li class="">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    $url = site_url("UserInformation/viewProfile");
                    echo '<li><a href ="'.$url.'">My Profile</a></li>';
                    echo '<li><a href="#">Reset Password</a></li>';
                    echo '<li role="separator" class="divider"></li>';
                    echo '<li><a href="#">My Posts</a></li>';
                    echo '<li role="separator" class="divider"></li>';
                    echo '<li><a href="#">My Reviews</a></li>';
                    echo '<li role="separator" class="divider"></li>';
                    $url = site_url('Logout');
                    echo '<li><a href="'.$url.'">Log out</a></li>';
            echo '</ul>
                </li>';
            }
        ?>
    </ul>

