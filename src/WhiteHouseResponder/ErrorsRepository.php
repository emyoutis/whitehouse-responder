<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/24/19
 * Time: 4:59 PM
 */

namespace Emyoutis\WhiteHouseResponder;


use Emyoutis\WhiteHouseResponder\Exceptions\DuplicatedErrorCodeException;
use Emyoutis\WhiteHouseResponder\Exceptions\UndefinedErrorCodeException;

class ErrorsRepository
{
    /**
     * @var array|array[] All the registered errors with their info.
     */
    protected $errors = [];

    /**
     * @var bool Whether the exceptions should be thrown.
     */
    protected $exceptions = true;



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
            if ($this->exceptions) {
                throw new DuplicatedErrorCodeException($errorCode);
            } else {
                return;
            }
        }

        $this->errors[$errorCode] = compact('developerMessage', 'userMessage', 'moreInfo');
    }



    /**
     * Unregisters an error with the specified error code.
     *
     * @param string $errorCode
     */
    public function unregister(string $errorCode)
    {
        unset($this->errors[$errorCode]);
    }



    /**
     * Returns the information of a error with the given error code.
     *
     * @param string $errorCode
     *
     * @throws UndefinedErrorCodeException
     * @return array|null
     */
    public function getErrorInfo(string $errorCode)
    {
        if ($this->errorHasNotBeenRegistered($errorCode)) {
            if ($this->exceptions) {
                throw new UndefinedErrorCodeException($errorCode);
            } else {
                return null;
            }
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



    /**
     * Sets the value of the $exceptions property to `false`.
     *
     * @return void
     */
    public function disableExceptions()
    {
        $this->setExceptions(false);
    }



    /**
     * Sets the value of the $exceptions property to `true`.
     *
     * @return void
     */
    public function enableExceptions()
    {
        $this->setExceptions(true);
    }



    /**
     * Sets the value of the $exceptions property to the given value.
     *
     * @param bool $value
     *
     * @return void
     */
    public function setExceptions(bool $value)
    {
        $this->exceptions = $value;
    }
}
