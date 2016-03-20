<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use GoAOPBenchmark\ApplicationAspectKernel;
use AlexeyKupershtokh\LazyApcClassLoader\LazyApcClassLoader;

require_once __DIR__ . '/vendor/autoload.php';

$generator = new \GoAOPBenchmark\Generator();
for ($i = 0; $i < 100; $i++) {
    $generator->generateClass('GoAOPBenchmark\Generated', 'Generated'.$i, 10, __DIR__ . '/src/Generated/');
}
