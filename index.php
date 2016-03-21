<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use GoAOPBenchmark\ApplicationAspectKernel;
use AlexeyKupershtokh\LazyApcClassLoader\LazyApcClassLoader;

require_once __DIR__ . '/vendor/autoload.php';

//require_once __DIR__ . '/vendor/alexey-kupershtokh/lazy-apc-class-loader/src/LazyApcClassLoader.php';
//$loader = new LazyApcClassLoader('aop-benchmark', function() { return require_once __DIR__ . '/vendor/autoload.php'; });
//$loader->register(true);

function d($start)
{
    return (microtime(true) - $start) * 1000 ;
}

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
printf("kernel init %f \n", d($t));

$t = microtime(true);
AnnotationRegistry::registerFile(__DIR__ . '/src/Annotations/Loggable.php');
printf("annotation %f \n", d($t));

$t2 = microtime(true);
$t = microtime(true);
$i0 = new \GoAOPBenchmark\Generated\Generated0();
printf("class G0 loaded %f \n", d($t));

$t = microtime(true);
$i0 = new \GoAOPBenchmark\Generated\Generated0();
printf("class G0 instantiated %f \n", d($t));

$t = microtime(true);
$i1 = new \GoAOPBenchmark\Generated\Generated1();
printf("class G1 loaded %f \n", d($t));

$t = microtime(true);
$i1 = new \GoAOPBenchmark\Generated\Generated1();
printf("class G1 instantiated %f \n", d($t));

$instances = [];
$t = microtime(true);
for ($j = 2; $j < 10; $j++) {
    $c = '\GoAOPBenchmark\Generated\Generated' . $j;
    $instances[] = new $c();
}
printf("classes G2..G9 loaded %f \n", d($t));

$t = microtime(true);
for ($i = 1; $i < 10; $i++) {
    $i0->do0(1, 2, 3, 4, 5, 6);
}
printf("100 calls to a loggable method %f \n", d($t));

$t = microtime(true);
for ($i = 1; $i < 10; $i++) {
    $i0->do1(1, 2, 3, 4, 5, 6);
}
printf("100 calls to another loggable method %f \n", d($t));

$t = microtime(true);
for ($i = 1; $i < 10; $i++) {
    $i0->do1(1, 2, 3, 4, 5, 6);
}
printf("100 calls to the same loggable method %f \n", d($t));
printf("all %f \n", d($t2));
