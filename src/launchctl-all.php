<?php
/*
Requires
$name = "Service";
$id = "ServiceKey";
$launchd = "org.company.service";

*/
// ****************
//error_reporting(0);
require_once('workflows.php');

$LaunchDaemon = "/System/Library/LaunchDaemons";
$w = new Workflows();

function status($id, $name, $label) {
	global $LaunchDaemon, $w;
	if (!$id) { return; }
	
	// Check if server is loaded
	$command = "sudo launchctl load $LaunchDaemon/$label.plist 2>&1";
	exec($command, $output, $status);
	if ($status) { // Not Loaded
		$command = "sudo cp ./LaunchDaemons/$label.plist $LaunchDaemon/$label.plist";
		exec($command, $output, $status);
		if ($status) {
			$w->result( "$id-cp", $command, "Problem copying LaunchDaemon", "Run `$command` in Terminal", "icon-cache/$id.png" );
		}
		
		$command = "sudo launchctl load -F $LaunchDaemon/$label.plist 2>&1";
		exec($command, $output, $status);
		if ($status) {
			$w->result( "$id-load", $command, "Problem loading LaunchDaemon", "Run `$command` in Terminal", "icon-cache/$id.png" );
		}
	}
	
	// status
	$command = "sudo launchctl list | grep $label";
	exec($command, $output, $status);
	$status = ($status) ? "OFFLINE" : "ONLINE";
	$w->result( "$id-status", "$command", "$name: $status", "Ran `$command`", "icon-cache/$id.png", "no" );

}

$services = json_decode(file_get_contents("services.json"));
foreach($services as $service) {
	status($service->id, $service->name, $service->label);
}

//$w->result( "$id-$key", $command, "Install $name", $command, "icon-cache/$id.png" );


echo $w->toxml();
// ****************
?>