<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/24/15
 * Time: 10:59 AM
 */
?>

<table id="unverified_corp" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>CorpName</th>
        <th>RegisteredTime</th>
    </tr>
    </thead>
</table>
<button type="button" onclick="verifySelected()">Verify</button>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('#unverified_corp').DataTable({
                "sAjaxSource": "unverifiedCorp",
                "aoColumns":
                    [
                        { 'mData': 'id' },
                        { 'mData': 'corpName' },
                        { 'mData': 'registeredTime'}
                    ]
            });

            $('#unverified_corp tbody').on( 'click', 'tr', function () {
                $(this).toggleClass('selected');
            });
        }
    );

    function verifySelected() {
        var Selected = $(".selected");
        var result ='';
        for (i=0; i<Selected.length; i++) {
            result += Selected[i].firstChild.innerHTML + ',';
        }
        console.log(result);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("UserInformation/verifyCorporateUser"); ?>",
            data:  { data : result },
            success: function() {window.location.reload();}
        });
    }
</script>