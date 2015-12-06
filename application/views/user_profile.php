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
    </div>
    <button onclick="editProfile">Edit Profile</button>

<script type="text/javascript">
    function editProfile() {
        window.location.assign("UserInformation/editProfile");
    }
</script>