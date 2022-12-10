<?php
/**
 * User: taykh
 * Date: 12/7/2022
 * Time: 9:41 PM
 **/

namespace app\core;

use app\core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}