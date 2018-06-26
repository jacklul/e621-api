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
 * Thrown when executing action that requires logging in
 */
class LoginRequiredException extends E621Exception
{
    /**
     * @param string $action
     */
    public function __construct($action)
    {
        if (empty($action)) {
            parent::__construct('Logging in is required but no login data was provided');
        } else {
            parent::__construct('Method "' . $action . '" requires logging in but no login data was provided');
        }
    }
}
