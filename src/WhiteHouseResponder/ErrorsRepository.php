<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/24/19
 * Time: 4:59 PM
 */

namespace WhiteHouseResponder;


class ErrorsRepository
{
    /**
     * @var array All the registered errors with their info.
     */
    protected $errors = [];



    /**
     * Registers a new error with the given information.
     *
     * @param $errorCode
     * @param $developerMessage
     * @param $userMessage
     * @param $moreInfo
     *
     * @return void
     */
    public function register($errorCode, $developerMessage, $userMessage, $moreInfo)
    {
        $this->errors[$errorCode] = compact('developerMessage', 'userMessage', 'moreInfo');
    }
}
