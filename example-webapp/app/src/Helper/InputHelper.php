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

    /**
     * Returns filtered input array with given array keys
     *
     * @param array $input
     * @param array $keys
     * @param null $default
     * @return array
     */
    public static function filterInputByKeys(array $input, array $keys, $default = null){
        $result = [];
        foreach($keys as $key){
            $result[$key] = isset($input[$key]) ? $input[$key] : $default;
        }
        return $result;
    }

}
