<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use GoAOPBenchmark\ApplicationAspectKernel;
use AlexeyKupershtokh\LazyApcClassLoader\LazyApcClassLoader;

require_once __DIR__ . '/vendor/autoload.php';

//require_once __DIR__ . '/vendor/alexey-kupershtokh/lazy-apc-class-loader/src/LazyApcClassLoader.php';
//$loader = new LazyApcClassLoader('aop-benchmark', function() { return require_once __DIR__ . '/vendor/autoload.php'; });
//$loader->register(true);
function s()
{
    $ci = count(get_included_files());
    return array(microtime(true), $ci);
}
function d($s)
{
    $t = microtime(true);
    $ci = count(get_included_files());
    return sprintf('%f (+%d)', ($t - $s[0]) * 1000, $ci - $s[1]);
}

$t = s();
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
printf("kernel init %s \n", d($t));

$t = s();
AnnotationRegistry::registerFile(__DIR__ . '/src/Annotations/Loggable.php');
printf("annotation %s \n", d($t));

$t2 = s();
$t = s();
$i0 = new \GoAOPBenchmark\Generated\Generated0();
printf("class G0 loaded %s \n", d($t));

$t = s();
$i0 = new \GoAOPBenchmark\Generated\Generated0();
printf("class G0 instantiated %s \n", d($t));

$t = s();
$i1 = new \GoAOPBenchmark\Generated\Generated1();
printf("class G1 loaded %s \n", d($t));

$t = s();
$i1 = new \GoAOPBenchmark\Generated\Generated1();
printf("class G1 instantiated %s \n", d($t));

$instances = [];
$t = s();
for ($j = 2; $j < 10; $j++) {
    $c = '\GoAOPBenchmark\Generated\Generated' . $j;
    $instances[] = new $c();
}
printf("classes G2..G9 loaded %s \n", d($t));

$t = s();
for ($i = 1; $i < 10; $i++) {
    $i0->do0(1, 2, 3, 4, 5, 6);
}
printf("100 calls to a loggable method %s \n", d($t));

$t = s();
for ($i = 1; $i < 10; $i++) {
    $i0->do1(1, 2, 3, 4, 5, 6);
}
printf("100 calls to another loggable method %s \n", d($t));

$t = s();
for ($i = 1; $i < 10; $i++) {
    $i0->do1(1, 2, 3, 4, 5, 6);
}
printf("100 calls to the same loggable method %s \n", d($t));
printf("all %s \n", d($t2));
