<?php
$db_host = '';
$db_user = '';
$db_pass = '';
$db_name = '';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('connection failed');

define('WP', 'mylogin2024');