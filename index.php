<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use GoAOPBenchmark\ApplicationAspectKernel;
use AlexeyKupershtokh\LazyApcClassLoader\LazyApcClassLoader;

//require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/vendor/alexey-kupershtokh/lazy-apc-class-loader/src/LazyApcClassLoader.php';
$loader = new LazyApcClassLoader('aop-benchmark', function() { return require_once __DIR__ . '/vendor/autoload.php'; });
$loader->register();

$t = microtime(true);
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
var_dump('kernel init', microtime(true) - $t);

$t = microtime(true);
AnnotationRegistry::registerFile(__DIR__ . '/src/Annotations/Loggable.php');
var_dump('annotation', microtime(true) - $t);

$generator = new \GoAOPBenchmark\Generator();
for ($i = 0; $i < 100; $i++) {
    $generator->generateClass('GoAOPBenchmark\Generated', 'Generated'.$i, 100, __DIR__ . '/src/Generated/');
}

$t = microtime(true);
$i0 = new \GoAOPBenchmark\Generated\Generated0();
var_dump('class G0 loaded', microtime(true) - $t);

$t = microtime(true);
$i1 = new \GoAOPBenchmark\Generated\Generated1();
var_dump('class G1 loaded', microtime(true) - $t);

$t = microtime(true);
for ($i = 1; $i < 100; $i++) {
    $i0->do0(1, 2, 3, 4, 5, 6);
}
var_dump('100 calls to a loggable method', microtime(true) - $t);

var_dump(get_included_files());