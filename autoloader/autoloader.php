<?php

require_once 'Psr4AutoloaderClass.php';

// instantiate the loader
$loader = new Itro\BarcodeGenerator\Psr4AutoloaderClass;

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('Itro\ItroNidoManager', realpath(__DIR__ . '/../src/itro/barcode_generator'));
//$loader->addNamespace('Foo\Bar', '/path/to/packages/foo-bar/tests');
