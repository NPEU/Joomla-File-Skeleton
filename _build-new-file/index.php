#!/usr/bin/php5
<?php
// Parse command line arguments into the $_GET variable:
parse_str(implode('&', array_slice($argv, 1)), $_GET);

echo 'Owner: ' . $_GET['owner'] . "\n";
echo 'Name: ' . $_GET['name'] . "\n";
echo 'Description: ' . $_GET['description'] . "\n";

$owner       = ucwords($_GET['owner']);
$name        = ucwords($_GET['name']);
$lc_name     = strtolower($name);
$uc_name     = strtoupper($name);
$file_lc_name = 'file_' . str_replace(' ', '', $lc_name);
$file_uc_name = strtoupper(str_replace(' ', '', $file_lc_name));

$description = $_GET['description'];

include_once('_functions.php');

$new_dir     = dirname(__DIR__) . '/__builds/' . $file_lc_name;

copy_dir(__DIR__ . '/_file_filename', $new_dir);

perform_renames(
    $new_dir,
    array('_filename', str_replace(' ', '', $lc_name)),
    array(
        '{{OWNER}}'         => $owner,
        '{{NAME}}'          => $name,
        '{{NAME-NO-SPACE}}' => str_replace(' ', '', $name),
        '{{DESCRIPTION}}'   => $description,
        '_filename'         => str_replace(' ', '', $lc_name),
        '{{MONTH}}'         => date('F'),
        '{{YEAR}}'          => date('Y')
    )
);
?>