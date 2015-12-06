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
        <th>Id</th>
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
                "aoColumnDefs":
                    [
                        {
                            'aTargets': [0],
                            'mData': 'id',
                            "mRender" : function (data, type, full) {
                                url = <?php echo "'".site_url("HouseInformation/view")."/'"; ?>;
                                return "<a href='" + url + data +"'>" + data + "</a>";
                            }
                        },
                        {
                            'aTargets': [1],
                            'mData':
                            <?php
                                if (isset($_SESSION['viewPreference']) && ($_SESSION['viewPreference'] ==1)) {
                                    echo  "'largeImage',";
                                } else { echo "'listImage',";}
                            ?>

                            'mRender' : function (data, type, full) {
                                return "<img src='/images/"+data+"' />";
                            }
                        },
                        {
                            'aTargets': [2],
                            'mData': 'location' },
                        {
                            'aTargets': [3],
                            'mData': 'buildYear' },
                        {
                            'aTargets': [4],
                            'mData': 'brNumber' },
                        {
                            'aTargets': [5],
                            'mData': 'price' },
                        {
                            'aTargets': [6],
                            'mData': 'viewTimes' },
                        {
                            'aTargets': [7],
                            'mData': 'averageRating' },
                    ]
            });
        }
    );
</script>

