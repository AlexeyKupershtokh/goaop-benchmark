<?php

namespace GoAOPBenchmark;

use Go\Core\AspectKernel;
use Go\Core\AspectContainer;
use GoAOPBenchmark\Aspects\LoggingAspect;

/**
 * Application Aspect Kernel
 */
class ApplicationAspectKernel extends AspectKernel
{

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new LoggingAspect());
    }
}
