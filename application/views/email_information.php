<?php
foreach ($emailDetail as $Detail)
echo "Email ID: ".$Detail['id'].'<br />'.'<br />';
echo "Send From: ".$Detail['sentBy'].'<br />'.'<br />';
echo "Title: ".$Detail['title'].'<br />'.'<br />';
echo "Send Time: ".$Detail['sendTime'].'<br />'.'<br />';
echo "Send To: ".$Detail['receivedBy'].'<br />'.'<br />';
echo "Content: ".$Detail['content'].'<br />'.'<br />';
