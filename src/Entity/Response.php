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
 * @method bool   getSuccess()   Was the request successful?
 * @method mixed  getResult()    Result of the request (usually array containing objects, empty array when no results)
 * @method string getRawResult() Raw result of the request (usually JSON string)
 * @method string getReason()    Reason why the request failed (returned by the API) - is safe to be displayed to the user, in case of internal errors this is set to safe to display value
 * @method string getMessage()   Description of the failure reason (returned by the API) - not always available
 * @method string getError()     Returns internal error description (timeouts, connection issues) - it is NOT safe to display this to the users (can contain sensitive information)
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
            throw new InvalidArgumentException('Argument "result" must be an array');
        }

        if (isset($result['error'])) {    // Internal errors
            $data = [
                'success' => false,
                'reason'  => $result['reason'],
                'error'  => $result['error'],
            ];
        } elseif (isset($result['success']) && $result['success'] === false) {    // Errors coming from the API
            $data = [
                'success' => false,
                'reason'  => $result['reason'],
            ];

            if (isset($result['message'])) {
                $data['message'] = $result['message'];
            }
        } elseif (count($result) === 0) {   // Empty results
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
