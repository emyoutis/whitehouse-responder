<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/27/19
 * Time: 10:05 PM
 */

namespace Emyoutis\WhiteHouseResponder;

use Closure;

class Response
{
    const HTTP_STATUS_SUCCESS      = 200;
    const HTTP_STATUS_CLIENT_ERROR = 400;
    const HTTP_STATUS_SERVER_ERROR = 500;

    const ERROR_KEYS = ['status', 'developerMessage', 'userMessage', 'errorCode', 'moreInfo'];

    /**
     * @var ErrorsRepository
     */
    protected $errorsRepository;

    /**
     * @var Closure
     */
    protected $formatter;



    /**
     * Response constructor.
     *
     * @param ErrorsRepository $errorsRepository
     */
    public function __construct(ErrorsRepository $errorsRepository)
    {
        $this->errorsRepository = $errorsRepository;
    }



    /**
     * Returns a success response based on the specified details.
     *
     * @param array $results
     * @param array $metadata
     *
     * @return array
     */
    public function success(array $results, array $metadata = [])
    {
        return $this->formatKeys(compact('metadata', 'results'));
    }



    /**
     * Returns an error response for the client errors based on the specified error code.
     *
     * @param string $errorCode
     * @param array  $replaces
     *
     * @return array
     */
    public function clientError(string $errorCode, array $replaces = [])
    {
        return $this->error($errorCode, static::HTTP_STATUS_CLIENT_ERROR, $replaces);
    }



    /**
     * Returns an error response for the server errors based on the specified error code.
     *
     * @param string $errorCode
     * @param array  $replaces
     *
     * @return array
     */
    public function serverError(string $errorCode, array $replaces = [])
    {
        return $this->error($errorCode, static::HTTP_STATUS_SERVER_ERROR, $replaces);
    }



    /**
     * Returns an error response for the errors based on the specified error code and status.
     *
     * @param string $errorCode
     * @param int    $status
     * @param array  $replaces
     *
     * @return array
     */
    public function error(string $errorCode, int $status, array $replaces = [])
    {
        $errorInfo = $this->prepareErrorInfo($errorCode, $replaces);

        $body = array_merge(
             array_flip(static::ERROR_KEYS), // this item is being merged to order the items in a proper way
             compact('status', 'errorCode'),
             $errorInfo
        );

        return $this->formatKeys($body);
    }



    /**
     * Replaces the given replaces array in all parts of the error information with the specified error code.
     *
     * @param string $errorCode
     * @param array  $replaces
     *
     * @return array
     */
    protected function prepareErrorInfo(string $errorCode, array $replaces)
    {
        $errorInfo = $this->getErrorInfo($errorCode);

        return Replacer::replaceArray($errorInfo, $replaces);
    }



    /**
     * Returns the information of an error with the specified error code.
     *
     * @param string $errorCode
     *
     * @return array
     */
    protected function getErrorInfo(string $errorCode)
    {
        return $this->errorsRepository->getErrorInfo($errorCode);
    }



    /**
     * Formats the given response array with the closure stored in the $formatter property and returns the formatted
     * version.
     *
     * @param array $response
     *
     * @return array
     */
    protected function formatKeys(array $response)
    {
        if (!$this->formatter) {
            return $response;
        }

        $keys   = array_keys($response);
        $values = array_values($response);

        $formattedKeys = array_map($this->formatter, $keys);

        return array_combine($formattedKeys, $values);
    }
}
