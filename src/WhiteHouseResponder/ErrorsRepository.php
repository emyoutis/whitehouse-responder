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
    protected static $errors = [];



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
    public static function register($errorCode, $developerMessage, $userMessage, $moreInfo)
    {
        if (static::errorHasBeenRegistered($errorCode)) {
            throw new DuplicatedErrorCodeException($errorCode);
        }

        static::$errors[$errorCode] = compact('developerMessage', 'userMessage', 'moreInfo');
    }



    /**
     * Checks if the specified error code has been registered.
     *
     * @param int|string $errorCode
     *
     * @return bool
     */
    public static function errorHasBeenRegistered($errorCode)
    {
        return array_key_exists($errorCode, static::$errors);
    }



    /**
     * Checks if the specified error code has not been registered.
     *
     * @param int|string $errorCode
     *
     * @return bool
     */
    public static function errorHasNotBeenRegistered($errorCode)
    {
        return !static::errorHasBeenRegistered($errorCode);
    }
}
