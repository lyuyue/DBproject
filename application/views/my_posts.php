<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 8:12 PM
 */
?>

<table id="posts" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Position</th>
    </tr>
    </thead>
</table>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('#posts').DataTable({
                "sAjaxSource": "myPosts",
                "aoColumns":
                    [
                        { 'mData': 'postedBy' },
                        { 'mData': 'location' },
                    ]
            });
        }
    );
</script>

