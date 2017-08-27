<?php
session_start();

require_once('config.php');

$username = mysqli_real_escape_string($conn, $_POST['username']);

echo $username;