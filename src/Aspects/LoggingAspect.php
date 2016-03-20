<?php

namespace GoAOPBenchmark\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;

class LoggingAspect implements Aspect
{
    /**
     * Method that will be called before real method
     *
     * @param MethodInvocation $invocation Invocation
     * @Before("@execution(GoAOPBenchmark\Annotations\Loggable)")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        #print $invocation->getMethod()->getName();
//        $obj = $invocation->getThis();
//        echo 'Calling Before Interceptor for method: ',
//        is_object($obj) ? get_class($obj) : $obj,
//        $invocation->getMethod()->isStatic() ? '::' : '->',
//        $invocation->getMethod()->getName(),
//        '()',
//        ' with arguments: ',
//        json_encode($invocation->getArguments()),
//        "<br>\n";
    }
}
