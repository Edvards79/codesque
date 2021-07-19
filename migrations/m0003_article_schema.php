<?php

use app\core\Application;

class m0003_article_schema
{
	public function up()
	{
		$db = Application::$app->db;
		$SQL = "CREATE TABLE articles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            content TEXT(65532) NOT NULL,
            likes INT NOT NULL,
            dislikes INT NOT NULL,
            comment_ids TEXT(65532),
            created_by VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        );";
		$db->pdo->exec($SQL);
	}

	public function down()
	{
		$db = Application::$app->db;
		$SQL = "DROP TABLE articles;";
		$db->pdo->exec($SQL);
	} 
}


