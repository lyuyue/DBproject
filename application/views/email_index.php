<table border='1'>
	<tr>
	<td><?php echo "Email ID"?></td>
	<td><?php echo "Sent From" ?></td>
	<td><?php echo "Title" ?></td>
	<td><?php echo "Send To" ?></td>
	<td><?php echo "Sent Time" ?></td>
	<td><?php echo "ReadStatus" ?></td>
	</tr>
<?php foreach ($emailInformation as $emailInformation_item): ?>
	<tr>
	<td><a href="Email/view/<?php echo $emailInformation_item['id'] ?>">View Detail</a></td>
	<td><?php echo $emailInformation_item['sendBy'] ?></td>
	<td><?php echo $emailInformation_item['title'] ?></td>
	<td><?php echo $emailInformation_item['sendTo'] ?></td>
	<td><?php echo $emailInformation_item['sendTime'] ?></td>
	<td><?php echo $emailInformation_item['readStatus'] ?></td>
	</tr>
<?php endforeach ?>
</table>