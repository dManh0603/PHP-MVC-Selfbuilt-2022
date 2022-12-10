<?php
/**
 * User: taykh
 * Date: 12/7/2022
 * Time: 1:06 PM
 **/

namespace app\core\db;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attribute) => ":$attribute", $attributes);

        $sql = self::prepare(
            "INSERT INTO $tableName (" . implode(',', $attributes) . ") 
            VALUES(" . implode(',', $params) . ")"
        );
        foreach ($attributes as $attribute) {
            $sql->bindValue(":$attribute", $this->{$attribute});
        }

        $sql->execute();
        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $conditions = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $sql = self::prepare("SELECT * FROM $tableName WHERE $conditions");
        foreach ($where as $key => $item) {
            $sql->bindValue(":$key", $item);
        }
        $sql->execute();

        return $sql->fetchObject(static::class);
    }

}