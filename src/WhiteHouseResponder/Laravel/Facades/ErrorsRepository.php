<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/27/19
 * Time: 11:49 PM
 */

namespace EmiTis\WhiteHouseResponder\Laravel\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static void register(string $errorCode, string $developerMessage, string $userMessage, string $moreInfo)
 * @method static void getErrorInfo(string $errorCode)
 * @method static void errorHasBeenRegistered(string $errorCode)
 * @method static void errorHasNotBeenRegistered(string $errorCode)
 */
class ErrorsRepository extends Facade
{
    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'whitehouse.errors';
    }
}
