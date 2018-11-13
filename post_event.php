<?php
session_start();
if(isset($_POST['event_post'])){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"moud.in/beta/missioncoordination/events/index");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$_POST);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	$result = json_decode($server_output, true);
	curl_close ($ch);
	$_SESSION['add_res'] = $result;
	header("Location: event-list.php");
	die();

}else{
	echo "Invalid Activity";
}
?>