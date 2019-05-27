<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/24/19
 * Time: 4:59 PM
 */

namespace WhiteHouseResponder;


use WhiteHouseResponder\Exceptions\DuplicatedErrorCodeException;
use WhiteHouseResponder\Exceptions\UndefinedErrorCodeException;

class ErrorsRepository
{
    /**
     * @var array|array[] All the registered errors with their info.
     */
    protected $errors = [];



    /**
     * Registers a new error with the given information.
     *
     * @param string $errorCode
     * @param string $developerMessage
     * @param string $userMessage
     * @param string $moreInfo
     *
     * @throws DuplicatedErrorCodeException
     * @return void
     */
    public function register(string $errorCode, string $developerMessage, string $userMessage, string $moreInfo)
    {
        if ($this->errorHasBeenRegistered($errorCode)) {
            throw new DuplicatedErrorCodeException($errorCode);
        }

        $this->errors[$errorCode] = compact('developerMessage', 'userMessage', 'moreInfo');
    }



    /**
     * Returns the information of a error with the given error code.
     *
     * @param string $errorCode
     *
     * @return array
     */
    public function getErrorInfo(string $errorCode)
    {
        if ($this->errorHasNotBeenRegistered($errorCode)) {
            throw new UndefinedErrorCodeException($errorCode);
        }

        return $this->errors[$errorCode];
    }



    /**
     * Checks if the specified error code has been registered.
     *
     * @param string $errorCode
     *
     * @return bool
     */
    public function errorHasBeenRegistered(string $errorCode)
    {
        return array_key_exists($errorCode, $this->errors);
    }



    /**
     * Checks if the specified error code has not been registered.
     *
     * @param string $errorCode
     *
     * @return bool
     */
    public function errorHasNotBeenRegistered(string $errorCode)
    {
        return !$this->errorHasBeenRegistered($errorCode);
    }
}
