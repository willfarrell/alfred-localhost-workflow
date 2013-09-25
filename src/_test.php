<?php

// Apache
$name = "Apache";
$id = "apache";
$launchctl = "org.apache.httpd";


// redis
$name = "redis";
$id = "redis";
$launchctl = "org.redis.redis-server";


// MySQL
/*$name = "MySQL";
$id = "mysql";
$commands = array(
	"start" => "sudo mysqld start",
	"stop" => "sudo mysqld stop",
	"restart" => "sudo mysqld restart",
	"status" => "sudo mysqld status",
	"install" => "sudo mysqld status"
);*/

// TEST
$name = "redis";
$id = "apache";
$launchctl = "org.redis.redis-server";

// ****************
require_once("launchctl.php");
// ****************
?>