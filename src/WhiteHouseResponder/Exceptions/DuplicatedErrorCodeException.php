<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/24/19
 * Time: 6:26 PM
 */

namespace WhiteHouseResponder\Exceptions;


use UnexpectedValueException;
use WhiteHouseResponder\Replacer;

class DuplicatedErrorCodeException extends UnexpectedValueException
{
    /**
     * @var int|string
     */
    private $errorCode;



    /**
     * DuplicatedErrorCodeException constructor.
     *
     * @param $errorCode
     */
    public function __construct($errorCode)
    {
        $this->errorCode = $errorCode;

        parent::__construct($this->getMessageContent());
    }



    /**
     * Returns the value of the $errorCode property.
     *
     * @return int|string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }



    /**
     * Returns the content of the exception's message.
     *
     * @return string
     */
    public function getMessageContent()
    {
        return Replacer::replace($this->getMessageTemplate(), [
             'errorCode' => $this->getErrorCode(),
        ]);
    }



    /**
     * Returns the template of the exception's message.
     *
     * @return string
     */
    private function getMessageTemplate()
    {
        return 'The error :errorCode has been registered.';
    }
}
