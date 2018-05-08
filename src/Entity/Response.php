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

use InvalidArgumentException;

/**
 * @method bool   getSuccess()   Is the request successful?
 * @method mixed  getResult()    Result of the request (usually array containing objects)
 * @method string getRawResult() Raw result of the request (usually JSON string)
 * @method string getReason()    Description of the unsuccessful / failed request
 */
class Response extends Entity
{
    /**
     * @param string $class
     * @param array  $result
     * @param string $raw_result
     */
    public function __construct($class, array $result = [], $raw_result = '')
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException('Class doesn\'t exist: ' . $class);
        }

        if (!is_array($result)) {
            throw new InvalidArgumentException('Argument "timeout" must be an array!');
        }

        if (isset($result['success']) && $result['success'] === false) {
            $data = [
                'success' => false,
                'reason'  => $result['reason'],
            ];
        } elseif (count($result) === 0) {
            $data = [
                'success' => true,
                'result'  => [],
            ];
        } else {
            if (isset($result[0])) {
                /** @var $class [] $result */
                foreach ($result as &$item) {
                    $item = new $class($item);
                }
            } else {
                /** @var $class $result */
                $result = new $class($result);
            }

            $data = [
                'success' => true,
                'result'  => $result,
            ];
        }

        $data['raw_result'] = $raw_result;

        parent::__construct($data);
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return (bool)$this->getSuccess();
    }
}
