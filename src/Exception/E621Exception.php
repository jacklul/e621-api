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

use Psr\Http\Message\ResponseInterface;

/**
 * Main class for E621 related exceptions
 */
class E621Exception extends \Exception
{
    const MESSAGE_CLIENT_ERROR = 'HTTP Client error';
    const MESSAGE_REQUEST_ERROR = 'HTTP Request error';
    const MESSAGE_DATA_INVALID = 'Data received from e621.net API is invalid';

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @param string                 $message
     * @param int                    $code
     * @param \Exception|null        $previous
     * @param ResponseInterface|null $response
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null, ResponseInterface $response = null)
    {
        $this->response = $response;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
