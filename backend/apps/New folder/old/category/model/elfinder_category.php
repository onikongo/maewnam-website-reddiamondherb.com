<?php

error_reporting(1); // Set E_ALL for debuging

include_once '../../../../libs/elFinder/php/elFinderConnector.class.php';
include_once '../../../../libs/elFinder/php/elFinder.class.php';
include_once '../../../../libs/elFinder/php/elFinderVolumeDriver.class.php';
include_once '../../../../libs/elFinder/php/elFinderVolumeLocalFileSystem.class.php';

function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

$opts = array(
	// 'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			'path'          => '../../../../img/category/',         // path to files (REQUIRED)
			'URL'           => '/img/category/', // URL to files (REQUIRED)
			'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
		)
	)
);
//			'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../../upload/', // URL to files (REQUIRED)


// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

?>