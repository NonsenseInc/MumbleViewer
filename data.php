<?php
	require_once('classes/MurmurQuery.php');

	$settings		=	array
	(
		'host'		=>	'10.0.10.100', // <- insert server address
		'port'		=>	27800,
		'timeout'	=>	5000,
		'format'	=>	'json'
	);

	$murmur = new MurmurQuery();
	$murmur->setup($settings);
	$murmur->query();

	function buildTree(array &$elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parent'] == $parentId) {
				$children = buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] += $children;
				}
				$branch[$element['id']] = $element;
				unset($elements[$element['id']]);
			}
		}
		return $branch;
	}

	function insertUsers(&$channels, $users) {
		foreach ($users as $user) foreach ($channels as &$channel) {
			if ($channel['id'] == $user['channel']) $channel['children'] += array('u'.$user['userid'] => $user);
		}

	}

	function printTree($tree) {
		static $id = 0;
		print('<ul id=\'ul'.$id++.'\'>');
		foreach ($tree as $branch) {
			if (isset($branch['userid'])) {
				$classes = '';
				if ($branch['bytespersec'] > 0) $classes .= ' speaking';
				if ($branch['selfMute']) $classes .= ' mute';
				if ($branch['suppress']) $classes .= ' suppress';
				if ($branch['selfDeaf']) $classes .= ' deaf';
				if ($branch['userid'] > -1) $classes .= ' auth';
				print('<li class=\'user'.$classes.'\'>');
			} else print('<li class=\'channel\'>');

			print($branch['name']);
			if (isset($branch['children'])) printTree($branch['children']);
			print('</li>');
		}
		print('</ul>');
	}

	if($murmur->is_online())
	{
		$response = $murmur->get_status();
		$channels = $response['channels'];
		$users = $response['users'];

		usort($channels, function ($a, $b) {
			if ($a['position'] == $b['position']) return 0;
			return ($a['position'] < $b['position']) ? -1 : 1;
		});

		foreach ($channels as &$channel) {
			$channel['children'] = array();
			unset($channel['description']);
		}

		foreach ($users as &$user) {
			unset($user['comment']);
		}

		insertUsers($channels, $users);
		$tree = buildTree($channels);

		printTree($tree);
	}
?>
