<?php
/**
 * This file is part of the e621 API package.
 *
 * (c) Jack'lul <jacklulcat@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jacklul\E621API\Entity;

/**
 */
abstract class Entity
{
    /**
     * @param $data
     */
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param $method
     * @param $args
     *
     * @return mixed|null
     */
    public function __call($method, $args)
    {
        $property = strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', substr($method, 3)), '_'));

        if (substr($method, 0, 3) === 'get' && isset($this->$property)) {
            return $this->$property;
        }

        return null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode(get_object_vars($this));
    }
}
