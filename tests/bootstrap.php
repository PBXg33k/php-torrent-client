<?php
// Needed for isolated tests
$loader = require __DIR__ . "/../vendor/autoload.php";
$loader->addPsr4('Pbxg33k\\TorrentClient\\', __DIR__.'/../src');

ini_set('precision', 14);
ini_set('serialize_precision', 14);