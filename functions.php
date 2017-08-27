<?php
function checkLog() {
	if(isset($_SESSION['engLog']) && isset($_SESSION['usrName']))
		return true;
	else
		return false;
}

function sendMessage($chatID, $messaggio, $token) {
    $url = "https://api.telegram.org/" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}