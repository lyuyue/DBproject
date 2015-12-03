<?php
foreach ($emailDetail as $Detail)
echo "Email ID: ".$Detail['id'];
echo "Send From: ".$Detail['sentBy'];
echo "Title: ".$Detail['title'];
echo "Send Time: ".$Detail['sendTime'];
echo "Send To: ".$Detail['receivedBy'];
echo "Content: ".$Detail['content'];
