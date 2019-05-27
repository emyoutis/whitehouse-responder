<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/24/19
 * Time: 4:59 PM
 */

namespace WhiteHouseResponder;


use WhiteHouseResponder\Exceptions\DuplicatedErrorCodeException;

class ErrorsRepository
{
    /**
     * @var array All the registered errors with their info.
     */
    protected $errors = [];



    /**
     * Registers a new error with the given information.
     *
     * @param int|string $errorCode
     * @param string     $developerMessage
     * @param string     $userMessage
     * @param string     $moreInfo
     *
     * @throws DuplicatedErrorCodeException
     * @return void
     */
    public function register($errorCode, $developerMessage, $userMessage, $moreInfo)
    {
        if ($this->errorHasBeenRegistered($errorCode)) {
            throw new DuplicatedErrorCodeException($errorCode);
        }

        $this->errors[$errorCode] = compact('developerMessage', 'userMessage', 'moreInfo');
    }



    /**
     * Checks if the specified error code has been registered.
     *
     * @param int|string $errorCode
     *
     * @return bool
     */
    public function errorHasBeenRegistered($errorCode)
    {
        return array_key_exists($errorCode, $this->errors);
    }



    /**
     * Checks if the specified error code has not been registered.
     *
     * @param int|string $errorCode
     *
     * @return bool
     */
    public function errorHasNotBeenRegistered($errorCode)
    {
        return !$this->errorHasBeenRegistered($errorCode);
    }
}
