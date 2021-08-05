<?php
session_start();
use Slim\Slim;
$app = new Slim();

$app->config('debug', true);

require_once 'site.php';
require_once 'functions.php';

$app->run();