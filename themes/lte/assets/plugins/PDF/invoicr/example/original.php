<?php 

echo $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "logo.png".
	__DIR__ . DIRECTORY_SEPARATOR . "logo.png";
