<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 10:54 AM
 */
?>
    <div class = 'profile_container'>
        <p>Username:   <?php echo $username; ?></p>
        <p>Email:      <?php echo $email; ?></p>
        <p>Phone:      <?php echo $phone; ?></p>
        <p>Authority:
            <?php
                echo "<br>";
                foreach ($authority as $row) {
                    echo "      ".$row['privilege'];
                    echo "<br>";
                }
            ?></p>
    </div>
    <button><a href="editProfile">Edit Profile</a></button>
