<?php
/**
 * This file is part of the e621 API package.
 *
 * (c) Jack'lul <jacklulcat@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jacklul\E621API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException as GuzzleConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use jacklul\E621API\Entity\Generic;
use jacklul\E621API\Entity\Response;
use jacklul\E621API\Exception\ConnectException;
use jacklul\E621API\Exception\E621Exception;
use jacklul\E621API\Exception\LoginRequiredException;

/**
 * Simple object-oriented e621 API wrapper
 *
 * @method Response postCreate(array $params = null, array $options = null)
 * @method Response postUpdate(array $params = null, array $options = null)
 * @method Response postShow(array $params = null, array $options = null)
 * @method Response postCheckMd5(array $params = null, array $options = null)
 * @method Response postTags(array $params = null, array $options = null)
 * @method Response postIndex(array $params = null, array $options = null)
 * @method Response postFlag(array $params = null, array $options = null)
 * @method Response postDestroy(array $params = null, array $options = null)
 * @method Response postDeletedIndex(array $params = null, array $options = null)
 * @method Response postPopularByDay(array $params = null, array $options = null)
 * @method Response postPopularByWeek(array $params = null, array $options = null)
 * @method Response postPopularByMonth(array $params = null, array $options = null)
 * @method Response postRevertTags(array $params = null, array $options = null)
 * @method Response postVote(array $params = null, array $options = null)
 * @method Response tagIndex(array $params = null, array $options = null)
 * @method Response tagShow(array $params = null, array $options = null)
 * @method Response tagUpdate(array $params = null, array $options = null)
 * @method Response tagRelated(array $params = null, array $options = null)
 * @method Response tagAliasIndex(array $params = null, array $options = null)
 * @method Response tagImplicationIndex(array $params = null, array $options = null)
 * @method Response artistIndex(array $params = null, array $options = null)
 * @method Response artistCreate(array $params = null, array $options = null)
 * @method Response artistUpdate(array $params = null, array $options = null)
 * @method Response artistDestroy(array $params = null, array $options = null)
 * @method Response commentShow(array $params = null, array $options = null)
 * @method Response commentIndex(array $params = null, array $options = null)
 * @method Response commentSearch(array $params = null, array $options = null)
 * @method Response commentCreate(array $params = null, array $options = null)
 * @method Response commentUpdate(array $params = null, array $options = null)
 * @method Response commentDestroy(array $params = null, array $options = null)
 * @method Response commentHide(array $params = null, array $options = null)
 * @method Response commentUnhide(array $params = null, array $options = null)
 * @method Response commentVote(array $params = null, array $options = null)
 * @method Response blipCreate(array $params = null, array $options = null)
 * @method Response blipUpdate(array $params = null, array $options = null)
 * @method Response blipIndex(array $params = null, array $options = null)
 * @method Response blipShow(array $params = null, array $options = null)
 * @method Response blipHide(array $params = null, array $options = null)
 * @method Response blipUnhide(array $params = null, array $options = null)
 * @method Response wikiIndex(array $params = null, array $options = null)
 * @method Response wikiCreate(array $params = null, array $options = null)
 * @method Response wikiUpdate(array $params = null, array $options = null)
 * @method Response wikiShow(array $params = null, array $options = null)
 * @method Response wikiDestroy(array $params = null, array $options = null)
 * @method Response wikiLock(array $params = null, array $options = null)
 * @method Response wikiUnlock(array $params = null, array $options = null)
 * @method Response wikiRevert(array $params = null, array $options = null)
 * @method Response wikiHistory(array $params = null, array $options = null)
 * @method Response wikiRecentChanges(array $params = null, array $options = null)
 * @method Response noteIndex(array $params = null, array $options = null)
 * @method Response noteSearch(array $params = null, array $options = null)
 * @method Response noteHistory(array $params = null, array $options = null)
 * @method Response noteRevert(array $params = null, array $options = null)
 * @method Response noteUpdate(array $params = null, array $options = null)
 * @method Response userIndex(array $params = null, array $options = null)
 * @method Response userShow(array $params = null, array $options = null)
 * @method Response userRecordShow(array $params = null, array $options = null)
 * @method Response dmailCreate(array $params = null, array $options = null)
 * @method Response dmailInbox(array $params = null, array $options = null)
 * @method Response dmailShow(array $params = null, array $options = null)
 * @method Response dmailHide(array $params = null, array $options = null)
 * @method Response dmailUnhide(array $params = null, array $options = null)
 * @method Response dmailHideAll(array $params = null, array $options = null)
 * @method Response dmailUnhideAll(array $params = null, array $options = null)
 * @method Response dmailMarkAllRead(array $params = null, array $options = null)
 * @method Response forumCreate(array $params = null, array $options = null)
 * @method Response forumUpdate(array $params = null, array $options = null)
 * @method Response forumIndex(array $params = null, array $options = null)
 * @method Response forumSearch(array $params = null, array $options = null)
 * @method Response forumShow(array $params = null, array $options = null)
 * @method Response forumHide(array $params = null, array $options = null)
 * @method Response forumUnhide(array $params = null, array $options = null)
 * @method Response poolIndex(array $params = null, array $options = null)
 * @method Response poolShow(array $params = null, array $options = null)
 * @method Response poolUpdate(array $params = null, array $options = null)
 * @method Response poolCreate(array $params = null, array $options = null)
 * @method Response poolDestroy(array $params = null, array $options = null)
 * @method Response poolAddPost(array $params = null, array $options = null)
 * @method Response poolRemovePost(array $params = null, array $options = null)
 * @method Response setIndex(array $params = null, array $options = null)
 * @method Response setShow(array $params = null, array $options = null)
 * @method Response setCreate(array $params = null, array $options = null)
 * @method Response setUpdate(array $params = null, array $options = null)
 * @method Response setAddPost(array $params = null, array $options = null)
 * @method Response setRemovePost(array $params = null, array $options = null)
 * @method Response setDestroy(array $params = null, array $options = null)
 * @method Response setMaintainers(array $params = null, array $options = null)
 * @method Response setMaintainerIndex(array $params = null, array $options = null)
 * @method Response setMaintainerCreate(array $params = null, array $options = null)
 * @method Response setMaintainerDestroy(array $params = null, array $options = null)
 * @method Response setMaintainerApprove(array $params = null, array $options = null)
 * @method Response setMaintainerDeny(array $params = null, array $options = null)
 * @method Response setMaintainerBlock(array $params = null, array $options = null)
 * @method Response favoriteListUsers(array $params = null, array $options = null)
 * @method Response favoriteCreate(array $params = null, array $options = null)
 * @method Response favoriteDestroy(array $params = null, array $options = null)
 * @method Response postTagHistoryIndex(array $params = null, array $options = null)
 * @method Response postFlagHistoryIndex(array $params = null, array $options = null)
 * @method Response ticketCreate(array $params = null, array $options = null)
 * @method Response ticketIndex(array $params = null, array $options = null)
 * @method Response ticketShow(array $params = null, array $options = null)
 */
class E621
{
    /**
     * Library version
     *
     * @var string
     */
    const VERSION = '0.6.0';

    /**
     * Base URL for API calls
     *
     * @var string
     */
    const BASE_URI = 'https://e621.net';

    /**
     * Guzzle's Client object
     *
     * @var Client
     */
    private $client;

    /**
     * Handler for requests in progress
     *
     * @var callable
     */
    private $progress_handler;

    /**
     * Handler for debug logging
     *
     * @var callable
     */
    private $debug_log_handler;

    /**
     * Temporary handle for request logging
     *
     * @var resource
     */
    private $debug_log_stream_handle;

    /**
     * Authentication data (login and API key)
     *
     * @var array|null
     */
    private $auth;

    /**
     * @var bool
     */
    private $throw_exceptions = true;

    /**
     * E621 constructor
     *
     * @param array $options
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $options = [])
    {
        $default_options = [
            'base_uri' => self::BASE_URI,
            'headers'  => [
                'User-Agent' => 'E621API/' . self::VERSION . ' GuzzleHttp/' . Client::VERSION . ' PHP/' . PHP_VERSION,
                'Accept'     => 'application/json',
            ],
        ];

        $this->client = new Client(array_replace_recursive($default_options, $options));
    }

    /**
     * @param string $method
     * @param array  $data
     *
     * @return string
     * @throws \InvalidArgumentException
     * @throws LoginRequiredException
     * @throws ConnectException
     * @throws E621Exception
     */
    public function __call($method, array $data = [])
    {
        $method_config = Methods::lookupByName($method);
        $parameters = isset($data[0]) && is_array($data[0]) ? $data[0] : null;
        $options = isset($data[1]) && is_array($data[1]) ? $data[1] : null;

        if (isset($method_config['require_login']) && $method_config['require_login'] === true) {
            if (!isset($parameters['login']) || !isset($parameters['password_hash'])) {
                if (isset($this->auth['login']) && isset($this->auth['password_hash'])) {
                    $parameters['login'] = $this->auth['login'];
                    $parameters['password_hash'] = $this->auth['password_hash'];
                } else {
                    throw new LoginRequiredException($method);
                }
            }
        }

        return $this->request($method_config['path'], $method_config['method'], $parameters, $options, $method_config['class']);
    }

    /**
     * Main method for making requests
     *
     * @param string $path
     * @param string $method
     * @param array  $data
     * @param array  $options
     * @param string $class
     *
     * @return Response
     * @throws \InvalidArgumentException
     * @throws ConnectException
     * @throws E621Exception
     */
    private function request($path = 'post/index.json', $method = 'GET', array $data = null, array $options = null, $class = null)
    {
        if (empty($path)) {
            throw new \InvalidArgumentException('Argument "path" cannot be empty');
        }

        if (strtoupper($method) === 'GET') {
            $request_options = ['query' => $data];
        } elseif (strtoupper($method) === 'POST') {
            $request_options = $this->prepareRequestParams($data);
        } else {
            throw new \InvalidArgumentException('Unsupported request method');
        }

        ($this->progress_handler !== null && is_callable($this->progress_handler)) && $request_options['progress'] = $this->progress_handler;
        ($this->debug_log_handler !== null && is_callable($this->debug_log_handler)) && $request_options['debug'] = $this->createDebugStream();

        if (is_array($options)) {
            $request_options = array_replace_recursive($request_options, $options);
        }

        try {
            $response = $this->client->request($method, $path, $request_options);
            $raw_result = (string)$response->getBody();
            $result = json_decode($raw_result, true);

            if (!is_array($result)) {
                if ($this->throw_exceptions === true) {
                    throw new E621Exception(E621Exception::MESSAGE_DATA_INVALID, 0, null, $response);
                } else {
                    $result = [
                        'reason' => E621Exception::MESSAGE_DATA_INVALID,
                        'error'  => 'Response couldn\'t be decoded into array',
                    ];
                }
            }
        } catch (GuzzleConnectException $e) {
            if ($this->throw_exceptions === true) {
                throw new ConnectException($e);
            } else {
                $result = [
                    'reason' => ConnectException::MESSAGE,
                    'error'  => $e->getMessage(),
                ];
            }
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $this->debugLog($e);

            if ($response !== null && $response->getBody() !== null) {
                $raw_result = (string)$response->getBody();
                $result = json_decode($raw_result, true);

                if (!is_array($result)) {
                    $result = 'Request resulted in a `' . $e->getResponse()->getStatusCode() . ' ' . $e->getResponse()->getReasonPhrase() . '` response';

                    if ($this->throw_exceptions === true) {
                        throw new E621Exception($result, 0, $e, $response);
                    }

                    $result = [
                        'reason' => ConnectException::MESSAGE,
                        'error'  => $result,
                    ];
                }
            } else {
                if ($this->throw_exceptions === true) {
                    throw new E621Exception(E621Exception::MESSAGE_REQUEST_ERROR, 0, $e, $response);
                } else {
                    $result = [
                        'reason' => ConnectException::MESSAGE,
                        'error' => $e->getMessage(),
                    ];
                }
            }
        } catch (GuzzleException $e) {
            if ($this->throw_exceptions === true) {
                throw new E621Exception(E621Exception::MESSAGE_CLIENT_ERROR, 0, $e);
            } else {
                $result = [
                    'reason' => E621Exception::MESSAGE_CLIENT_ERROR,
                    'error'  => $e->getMessage(),
                ];
            }
        } finally {
            $this->endDebugStream();
        }

        // Search for result class if we don't have one, this shouldn't happen but fail safe should be left anyway
        if (empty($class)) {
            $class = Generic::class;
            $method_config = Methods::lookupByPath($path);

            if ($method_config !== null) {
                $class = $method_config['class'];
            }
        }

        /** @noinspection PhpUndefinedVariableInspection */
        return new Response($class, $result, isset($raw_result) ? $raw_result : null);
    }

    /**
     * Prepare request params for POST request, convert to multipart when needed
     *
     * @param array $data
     *
     * @return array
     */
    private function prepareRequestParams(array $data)
    {
        $has_resource = false;
        $multipart = [];

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $multipart[] = ['name' => $key, 'contents' => $value];
                continue;
            }

            foreach ($value as $multiKey => $multiValue) {
                is_resource($multiValue) && $has_resource = true;
                $multiName = $key . '[' . $multiKey . ']' . (is_array($multiValue) ? '[' . key($multiValue) . ']' : '') . '';
                $multipart[] = ['name' => $multiName, 'contents' => (is_array($multiValue) ? reset($multiValue) : $multiValue)];
            }
        }

        if ($has_resource) {
            return ['multipart' => $multipart];
        }

        return ['form_params' => $data];
    }

    /**
     * Get the stream handle of the temporary debug output
     *
     * @return bool|resource
     */
    private function createDebugStream()
    {
        if ($this->debug_log_stream_handle === null) {
            $this->debug_log_stream_handle = fopen('php://temp', 'w+b');
        }

        return $this->debug_log_stream_handle;
    }

    /**
     * Write to debug log
     *
     * @param $message
     */
    private function debugLog($message)
    {
        $this->debug_log_handler !== null && is_callable($this->debug_log_handler) && call_user_func($this->debug_log_handler, $message);
    }

    /**
     * Write the temporary debug stream to log and close the stream handle
     */
    private function endDebugStream()
    {
        if (is_resource($this->debug_log_stream_handle)) {
            rewind($this->debug_log_stream_handle);
            $this->debugLog('E621 API Verbose HTTP Request output:' . PHP_EOL . stream_get_contents($this->debug_log_stream_handle) . PHP_EOL);
            fclose($this->debug_log_stream_handle);
            $this->debug_log_stream_handle = null;
        }
    }

    /**
     * Set progress handler
     *
     * @param callable|null $progress_handler
     *
     * @throws \InvalidArgumentException
     */
    public function setProgressHandler($progress_handler)
    {
        if ($progress_handler !== null && is_callable($progress_handler)) {
            $this->progress_handler = $progress_handler;
        } elseif ($progress_handler === null) {
            $this->progress_handler = null;
        } else {
            throw new \InvalidArgumentException('Argument "progress_handler" must be a callable');
        }
    }

    /**
     * Set debug log handler
     *
     * @param callable|null $debug_log_handler
     *
     * @throws \InvalidArgumentException
     */
    public function setDebugLogHandler($debug_log_handler)
    {
        if ($debug_log_handler !== null && is_callable($debug_log_handler)) {
            $this->debug_log_handler = $debug_log_handler;
        } elseif ($debug_log_handler === null) {
            $this->debug_log_handler = null;
        } else {
            throw new \InvalidArgumentException('Argument "debug_log_handler" must be a callable');
        }
    }

    /**
     * Set login data globally
     *
     * @param $login
     * @param $api_key
     *
     * @throws \InvalidArgumentException
     */
    public function login($login, $api_key)
    {
        if (empty($login) || !is_string($login)) {
            throw new \InvalidArgumentException('Argument "login" cannot be empty and must be a string');
        }

        if (empty($login) || !is_string($api_key)) {
            throw new \InvalidArgumentException('Argument "api_key" cannot be empty and must be a string');
        }

        $this->auth = [
            'login'         => $login,
            'password_hash' => $api_key,
        ];
    }

    /**
     * Deletes login data
     */
    public function logout()
    {
        $this->auth = null;
    }

    /**
     * When set to true all requests to the API will not longer throw any exceptions
     * on errors but will return Response object with appropriate fields set instead.
     * You should avoid using this!
     *
     * @param bool $value
     */
    public function throwExceptions($value = true)
    {
        $this->throw_exceptions = $value;
    }

    /**
     * Set custom Guzzle client instance
     *
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
