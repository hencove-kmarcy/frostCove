<?php
// ? silence is golden
// ? code is poetry

/**
 * gets file names and paths within a directory at one depth
 * uses scandir to return an associated array of filenames and paths
 *
 * @param [string] $dir
 * @return array
 */
function get_dir_filenames_and_paths($dir)
{

	if (!is_dir($dir)) {
		return;
	}

	$finalArray = [];
	// remove '.' and '..' from the scandir
	$found = array_diff(scandir($dir), array('.', '..'));

	// capture only the name of the file
	foreach ($found as $item) {
		$finalArray[str_replace('.php', '', $item)] = $dir . $item;
	}

	//
	return $finalArray;
}