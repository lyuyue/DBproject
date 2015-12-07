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
        <th>Post Id</th>
        <th>Description</th>
    </tr>
    </thead>
</table>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('#review').DataTable({
                "sAjaxSource": "myReviews",
                "aoColumnDefs":
                    [
                        {
                            'aTargets': [0],
                            'mData': 'belongsTo',
                            "mRender" : function (data, type, full) {
                                url = <?php echo "'".site_url("HouseInformation/view")."/'"; ?>;
                                return "<a href='" + url + data +"'>" + data + "</a>";
                            }
                        },
                        {
                            'aTargets': [1],
                            'mData': 'description'
                        },
                    ]
            });
        }
    );
</script>
