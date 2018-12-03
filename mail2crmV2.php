<?php

$link = mysql_connect("<SERVER_ADDRESS>", "<USER>", "<PASSWORD>");

include_once("/www/source/codebase/crm-models/Email.php");

$mode = $argv[1];
$path = $argv[2];
$email = $argv[3];
$domain = $argv[4];

if($mode=='send') $mode = ".Sent/cur";
if($mode=='receive') $mode = "cur";

// Archive email headers to db
$path = "/home/vmail/".$domain."/".$email."archive/".$mode."/".$path;

$archive = EmailArchive::archiveEmail($path);

// Search CRM for address
if($archive) {
	EmailArchive::cacheEmailToCrm($archive['newid'], $archive['lookup'], $archive['date'], $archive['domain']);
}

?>
