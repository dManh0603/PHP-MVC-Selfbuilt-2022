<?php
/**
 * User: taykh
 * Date: 12/5/2022
 * Time: 4:46 PM
 **/

class m0001_initial
{
    public function up()
    {
        $db = \dmanh0603\phpmvc\Application::$app->db;
        $sql = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY ,
            email VARCHAR(255) NOT NULL ,
            firstname VARCHAR(255) NOT NULL ,
            lastname VARCHAR(255) NOT NULL ,
            status TINYINT NOT NULL ,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ) ENGINE =INNODB";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \dmanh0603\phpmvc\Application::$app->db;
        $sql = "DROP TABLE users;";
        $db->pdo->exec($sql);
    }
}