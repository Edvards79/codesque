<?php

use app\core\Application;

class m0004_comment_schema
{
	public function up()
	{
		$db = Application::$app->db;
		$SQL = "CREATE TABLE comments (
            id INT AUTO_INCREMENT PRIMARY KEY,
            author VARCHAR(255) NOT NULL,
            content VARCHAR(255) NOT NULL,
            likes INT NOT NULL,
            dislikes INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        ";
		$db->pdo->exec($SQL);
	}

	public function down()
	{
		$db = Application::$app->db;
		$SQL = "DROP TABLE comments;";
		$db->pdo->exec($SQL);
	} 
}

