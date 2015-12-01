<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/18/15
 * Time: 2:24 PM
 */
?>

<table id="postList" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Image</th>
        <th>Location</th>
        <th>BuildYear</th>
        <th>Bedroom Number</th>
        <th>Price</th>
        <th>Views</th>
        <th>AveRating</th>
    </tr>
    </thead>
</table>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('#postList').DataTable({
                "sAjaxSource": "main/allPosts",
                "aoColumns":
                    [
                        { 'mData': 'listImage' },
                        { 'mData': 'location' },
                        { 'mData': 'buildYear' },
                        { 'mData': 'brNumber' },
                        { 'mData': 'price' },
                        { 'mData': 'viewTimes' },
                        { 'mData': 'averageRating' },
                    ]
            });
        }
    );
</script>

