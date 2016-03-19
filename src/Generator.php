<?php

namespace GoAOPBenchmark;

class Generator
{
    /**
     * @param string $namespace
     * @param string $name
     * @param int $numberOfMethods
     * @return string
     */
    public function generateClassContents($namespace, $name, $numberOfMethods)
    {
        $contents = <<<CODE
<?php

namespace $namespace;

use GoAOPBenchmark\Annotations\Loggable;

class $name
{
CODE;
        for ($i = 0; $i < $numberOfMethods; $i++) {
            $contents .= <<<CODE

    /**
     * @Loggable()
     */
    public function do$i(\$a, \$b, \$c, \$d, \$e, \$f)
    {
        return __METHOD__;
    }

CODE;
        }
        $contents .= <<<CODE
}
CODE;
        return $contents;
    }

    /**
     * @param string $namespace
     * @param string $name
     * @param int $numberOfMethods
     * @param string $dir
     */
    public function generateClass($namespace, $name, $numberOfMethods, $dir)
    {
        $contents = $this->generateClassContents($namespace, $name, $numberOfMethods);
        file_put_contents($dir.$name.'.php', $contents);
        chmod($dir.$name.'.php', 0777);
    }
}
