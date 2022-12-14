<?php
/**
 * User: taykh
 * Date: 12/6/2022
 * Time: 3:42 PM
 **/

use dmanh0603\phpmvc\Application;

class m0002_add_password_col_to_Users
{
    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL ");
    }

    public function down()
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE users DROP COLUMN password");
    }
}