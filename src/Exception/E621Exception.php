<?php
/**
 * This file is part of the e621 API package.
 *
 * (c) Jack'lul <jacklulcat@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jacklul\E621API\Exception;

/**
 * Main class for E621 related exceptions
 */
class E621Exception extends \Exception
{
    const MESSAGE_DATA_INVALID = 'Data received from e621.net API is invalid';
    const MESSAGE_CLIENT_ERROR = 'HTTP Client error';

    /**
     * @var null|string
     */
    private $raw_result;

    /**
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     * @param string|null     $raw_result
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null, $raw_result = null)
    {
        $this->raw_result = $raw_result;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return null|string
     */
    public function getRawResult()
    {
        return $this->raw_result;
    }
}
