<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/27/19
 * Time: 11:51 PM
 */

namespace WhiteHouseResponder\Laravel\Facades;


use Illuminate\Support\Facades\Facade;


/**
 * @method static array success(array $results, array $metadata = [])
 * @method static array clientError(string $errorCode, array $replaces = [])
 * @method static array serverError(string $errorCode, array $replaces = [])
 * @method static array error(string $errorCode, int $status, array $replaces = [])
 */
class Response extends Facade
{
    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'whitehouse.response';
    }
}
