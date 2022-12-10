<?php
/**
 * User: taykh
 * Date: 12/2/2022
 * Time: 1:41 PM
 **/

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
    const STATUS_DELETED = 2;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function save()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class,
            ]],
            'password' => [self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => '8'],
                [self::RULE_MAX, 'max' => '32'],

            ],
            'confirmPassword' => [self::RULE_REQUIRED, [
                self::RULE_MATCH, 'match' => 'password'
            ]],
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }

    public function labels(): array
    {

        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm password',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}