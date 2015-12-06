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
                        	'aTargets':[1],
                        	'mData': 'belongsTo',
                        	"mReander":function (data,type,full)
                        	{
                        		url=<?php echo "'".site_url("Review/edit")."/'"; ?>;
                        		return "<a href='" + url + data +"'>" + data + "</a>";
                        		
                        	} },
                        { 
                        	'aTargets':[2],
                        	'mData': 'description' },
                    ]
            });
        }
    );
</script>
