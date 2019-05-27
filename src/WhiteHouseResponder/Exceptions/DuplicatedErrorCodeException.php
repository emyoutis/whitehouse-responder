<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/24/19
 * Time: 6:26 PM
 */

namespace EmiTis\WhiteHouseResponder\Exceptions;


use UnexpectedValueException;
use EmiTis\WhiteHouseResponder\Replacer;

class DuplicatedErrorCodeException extends UnexpectedValueException
{
    /**
     * @var string
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
        return 'The error :errorCode is already registered.';
    }
}
