
<table id="unverified_post" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>PostTime</th>
        <th>PostedBy</th>
        <th>Location</th>
        <th>BuildYear</th>
        <th>Bedroom Number</th>
        <th>Price</th>
    </tr>
    </thead>
</table>
<button type="button" onclick="verifySelectedPost()">Verify</button>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('#unverified_post').DataTable({
                "sAjaxSource": "unverifiedPost",
                "aoColumns":
                    [
                        { 'mData': 'id' },
                        { 'mData': 'postTime' },
                        { 'mData': 'username' },
                        { 'mData': 'location' },
                        { 'mData': 'buildYear' },
                        { 'mData': 'brNumber' },
                        { 'mData': 'price' }
                    ]
            });

            $('#unverified_post tbody').on( 'click', 'tr', function () {
                $(this).toggleClass('selected');
            });
        }
    );

    function verifySelectedPost() {
        var Selected = $(".selected");
        var result ='';
        for (i=0; i<Selected.length; i++) {
            result += Selected[i].firstChild.innerHTML + ',';
        }
        console.log(result);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("HouseInformation/verifyPost"); ?>",
            data:  { data : result },
            success: function() {window.location.reload();}
        });
    }
</script>
