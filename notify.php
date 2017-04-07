<?php
/**************************
 * filename: notify.php
 * description: Notifies Slack when a service is down.
 * created by: Omar De La Hoz (oed7416@rit.edu)
 * created on: 04/07/17
***************************/

// Get settings file.
$settings = json_decode(file_get_contents('settings.json'), true);


// define the webhook.
define('SLACK_WEBHOOK', $settings['SLACK_WEBHOOK']);


// Write and format the message.
$msg = '*WARNING:* The service ' . $settings['SERVICE_URL'] . ' is down.';
$format_msg = array('payload' => json_encode(array('text' => $msg)));


// If the error notification hasn't been send, or
// it was sent an hour ago, send notification to
// Slack.
if(getRun() == "" || getRun() < time() - 3600){

	$c = curl_init(SLACK_WEBHOOK);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_POST, true);
	curl_setopt($c, CURLOPT_POSTFIELDS, $format_msg);
	curl_exec($c);
	curl_close($c);
	saveRun();
}

/**
 * Saves the time of the last run to a log
 * file.
 */
function saveRun(){

  	$fh = fopen('run.log', 'w+');
  	fwrite($fh, time());
  	fclose($fh);
}


/**
 * Gets the time of the last run.
 *
 * @return     <Int>  Last time error was sent.
 */
function getRun(){
  	$fh = fopen('run.log', 'r+');
  	$time = fgets($fh);
  	fclose($fh);
  	return $time;
}
?>