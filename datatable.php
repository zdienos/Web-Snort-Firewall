<?php
require_once('config.php');
require_once('functions.php');

$query = mysqli_query($conn, "SELECT sig_name, timestamp, ip_src, inet_ntoa(ip_src) vip_src, ip_dst, inet_ntoa(ip_dst) vip_dst, status FROM acid_event ORDER BY timestamp DESC");
$count = mysqli_num_rows($query);
$i = 1;
$data = array();

if(!empty($count)) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	    array_push($data, array('id'=>$i,'sig_name'=>$row['sig_name'],'ip_src'=>$row['vip_src'],'ip_dst'=>$row['vip_dst'],'timestamp'=>$row['timestamp']));

        $i++;
	}
}

echo json_encode($data);