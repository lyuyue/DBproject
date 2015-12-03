<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 3:28 PM
 */
?>

<table id="review" class="display" cellspacing="0" width="100%">
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
            $('#review').DataTable({
                "sAjaxSource": "myReviews",
                "aoColumns":
                    [
                        { 'mData': 'belongsTo' },
                        { 'mData': 'description' },
                    ]
            });
        }
    );
</script>
