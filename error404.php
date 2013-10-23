<?php
header ( "HTTP/1.0 404 Not Found" );
$fname = $_SERVER ["DOCUMENT_ROOT"] . "/404.log";
$file = file_get_contents ( $fname );
if (! $file) {
	$file = "";
}
$file .= $_SERVER ["REQUEST_URI"] . "\r\n";
file_put_contents ( $fname, $file );

header ( "location:/" );
?>