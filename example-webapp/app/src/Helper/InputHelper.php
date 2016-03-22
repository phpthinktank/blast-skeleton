<?php
/**
 *
 * (c) Marco Bunge <marco_bunge@web.de>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Date: 22.03.2016
 * Time: 17:15
 *
 */

namespace WebAppExample\Helper;


class InputHelper
{
    private $input;

    /**
     * InputHelper constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }


    /**
     * Returns all entries. Optional filter input with given keys. You could
     * also set a default value for unknown key values.
     *
     * @param array $keys
     * @param null $default
     * @return array
     */
    public function all(array $keys = [], $default = null){
        if(empty($keys)){
            return $this->input;
        }

        $result = [];

        foreach($keys as $key){
            $result[$key] = $this->get($key, $default);
        }
        return $result;
    }

    /**
     * Get entry by name
     *
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->input[$key]) ? $this->input[$key] : $default;
    }

}
