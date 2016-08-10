<?php
// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

	'connectionString' => 'mysql:host=localhost;dbname=seaweed',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => 'BlackID85',
	'charset' => 'utf8',
    'schemaCachingDuration' => 3600,
    'enableParamLogging' => true,
    'enableProfiling' => true,

);