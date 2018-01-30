<?php
require_once('config.php');
require_once('functions.php');

$query = mysqli_query($conn, "SELECT sig_name, timestamp, ip_src, inet_ntoa(ip_src) vip_src, ip_dst, inet_ntoa(ip_dst) vip_dst, status FROM acid_event ORDER BY timestamp DESC");
$count = mysqli_num_rows($query);
$token = "bot401943496:AAGmuYrpTEjMv4VFrJV9CwveqOUgycsR5P4";
$chatid = "120634987";

if(!empty($count)) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	    if($row['status'] == 0) {
	        $content = "ALARM " . $row['sig_name'] . " from " . $row['vip_src'] . " to " . $row['vip_dst'] . " at " . $row['timestamp'];
		    sendMessage($chatid, $content, $token);

		    $update = mysqli_query($conn, "UPDATE acid_event SET status = '1' WHERE sig_name = '$row[sig_name]' AND timestamp = '$row[timestamp]' AND ip_src = '$row[ip_src]' AND ip_dst = '$row[ip_dst]'");
	    }
	}
}