<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use GoAOPBenchmark\ApplicationAspectKernel;

require_once __DIR__ . '/vendor/autoload.php';

// Initialize an application aspect container
$applicationAspectKernel = ApplicationAspectKernel::getInstance();
$applicationAspectKernel->init(
    array(
        'debug' => false,
        'cacheDir'  => __DIR__ . '/cache',
        'includePaths' => array(
            __DIR__
        )
    )
);

AnnotationRegistry::registerFile(__DIR__ . '/src/Annotations/Loggable.php');

$generator = new \GoAOPBenchmark\Generator();
for ($i = 0; $i < 100; $i++) {
    $generator->generateClass('GoAOPBenchmark\Generated', 'Generated'.$i, 100, __DIR__ . '/src/Generated/');
}
