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
 * @method bool getSuccess()
 * @method mixed getResult()
 */
class Response extends Entity
{
    /**
     * @param array $result
     * @param string $class
     *
     * @throws InvalidArgumentException
     */
    public function __construct($class, array $result = [])
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
                'reason' => $result['reason']
            ];
        } elseif (count($result) === 0) {
            $data = [
                'success' => true,
                'result' => []
            ];
        } else {
            if (isset($result[0])) {
                /** @var $class[] $result */
                foreach ($result as &$item) {
                    $item = new $class($item);
                }
            } else {
                /** @var $class $result */
                $result = new $class($result);
            }

            $data = [
                'success' => true,
                'result' => $result
            ];
        }

        parent::__construct($data);
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return (bool) $this->getSuccess();
    }
}
