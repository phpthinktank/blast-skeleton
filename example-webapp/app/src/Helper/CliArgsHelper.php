<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 22.03.2016
 * Time: 17:54
 *
 */

namespace WebAppExample\Helper;

/**
 * Create a associative array from args.
 *
 * convert --uri=/ to $arguments['uri'] => '/'
 *
 *
 * @package WebAppExample\Helper
 */
class CliArgsHelper
{

    /**
     * @var array
     */
    private $arguments = [];

    /**
     * CliToHttpHelper constructor.
     * @param $args
     */
    public function __construct($args)
    {
        $this->arguments = $this->convertArgvToArguments($args);
    }

    /**
     * @param $args
     * @return array
     */
    private function convertArgvToArguments($args){
        $result = [];
        foreach($args as $arg){
            $pair = implode('=', trim($arg, '--'));
            if(2 === count($pair)){
                $result[$pair[0]] = $pair[1];
            }
        }

        return $result;
    }

    /**
     * Get an argument by name
     *
     * @param $name
     * @param null $default
     * @return null
     */
    public function get($name, $default = null){
        return isset($this->arguments[$name]) ? $this->arguments[$name] : $default;
    }



}
