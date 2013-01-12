<?php
	require_once('mumbleChannelViewer.php');
	$dataUrl = 'http://ggaming.de/mumble/json.php';
	echo MumbleChannelViewer::render($dataUrl, 'json');
?>