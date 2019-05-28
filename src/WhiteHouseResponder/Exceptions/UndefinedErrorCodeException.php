<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/27/19
 * Time: 10:12 PM
 */

namespace Emyoutis\WhiteHouseResponder\Exceptions;

use UnexpectedValueException;
use Emyoutis\WhiteHouseResponder\Replacer;

class UndefinedErrorCodeException extends UnexpectedValueException
{
    /**
     * @var string
     */
    private $errorCode;



    /**
     * UndefinedErrorCodeException constructor.
     *
     * @param string $errorCode
     */
    public function __construct(string $errorCode)
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
        return 'Undefined error code :errorCode.';
    }
}
