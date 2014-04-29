<?php

// this will set the version for us
$version = '1.1.6';

//
//
//  Creates a new version of our phar file and
//  updates the manifest.json and bin/sleeve files
//  accordingly with new version and sha1 hash
//
//

//
// update version in bin/sleeve
//
$contents = file_get_contents('bin/sleeve');
$find = "ApplicationFactory::make('Codesleeve Generator',";
$start = strpos($contents, $find) + strlen($find) + 2;
$newcontents = substr_replace($contents, $version, $start, 5);
file_put_contents('bin/sleeve', $newcontents);

//
// update version in manifest.json
//
$contents = file_get_contents('manifest.json');
$find = '"version": "';
$start = strpos($contents, $find) + strlen($find);
$newcontents = substr_replace($contents, $version, $start, 5);
file_put_contents('manifest.json', $newcontents);

//
// store the old sha1 from manifest.json
//
$oldsha1 = sha1_file('downloads/sleeve.phar');

//
// create new phar file
//
print "Creating new phar file (box build), this could take a a few minutes..." . PHP_EOL;
exec('box build');

//
// update the new sha1 in manifest.json
//
$newsha1 = sha1_file('downloads/sleeve.phar');
$newcontents = str_replace($oldsha1, $newsha1, $newcontents);
file_put_contents('manifest.json', $newcontents);
