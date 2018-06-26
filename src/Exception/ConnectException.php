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
 * Thrown when connection with the API cannot be established
 */
class ConnectException extends E621Exception
{
    const MESSAGE = 'Connection to e621.net API failed or timed out';

    /**
     * @param \Exception $previous
     */
    public function __construct(\Exception $previous = null)
    {
        parent::__construct(self::MESSAGE, 0, $previous);
    }
}
