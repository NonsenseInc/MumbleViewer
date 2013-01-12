<pre><?php
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

	if($murmur->is_online())
	{
		$response = $murmur->get_status();

		print_r($response['channels']);
print_r($response['users']);
print_r($response['original']);
	}
?></pre>
