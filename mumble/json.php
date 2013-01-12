<?php
	require_once('classes/MurmurQuery.php');

	$settings		=	array
	(
		'host'		=>	'10.0.10.100',
		'port'		=>	27800,
		'timeout'	=>	5000,
		'format'	=>	'json'
	);

	$murmur = new MurmurQuery();
	$murmur->setup($settings);
	$murmur->query();

	function recursive_unset(&$array, $unwanted_key) {
		unset($array[$unwanted_key]);
		foreach ($array as &$value) {
			if (is_array($value)) {
				recursive_unset($value, $unwanted_key);
			}
		}
	}

	if($murmur->is_online())
	{
		$json = $murmur->get_status(true);
		$json = json_decode($json, true);

		//foreach ($json as $key => $value)
		recursive_unset($json, "description");
		recursive_unset($json, "comment");
		echo json_encode($json);
	}
?>