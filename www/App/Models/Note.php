<?php

namespace App\Models;

use App\Utils\Database;
use \PDO;

class Note extends CoreModel
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $user_id;

    /**
     * Retrieve a record from table notes
     *
     * @param int $id
     * @return Note
     */
    public static function find($id, $currentUser=null): Note
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `notes` WHERE id = :id AND user_id = :user_id';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([
            ':id' => $id,
            ':user_id' => $currentUser
        ]);
        
        $note = $pdoStatement->fetchObject(self::class); 
        return $note;
    }

    /**
     * Retrieve all records from table notes
     *
     * @return array
     */
    public static function findAll($currentUser=null): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `notes` WHERE user_id = :user_id';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([
            ':user_id' => $currentUser,
        ]);
        
        $notes = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class); 
        return $notes;
    }

    /**
     * Insert a record in table notes
     *
     * @return boolean
     */
    public function insert(): bool
    {
        $pdo = Database::getPDO();
        $sql = 'INSERT INTO `notes` (title, content, user_id)
                VALUES (:title, :content, :user_id)';
        $pdoStatement = $pdo->prepare($sql);
        $insertedRows = $pdoStatement->execute([
            ':title' => $this->title,
            ':content' => $this->content,
            ':user_id' => $this->user_id,
        ]);

        if($insertedRows > 0){
            $this->id = $pdo->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * Update a record in table notes
     *
     * @return boolean|null
     */
    public function update(): ?bool
    {
        $pdo = Database::getPDO();
        $sql = 'UPDATE `notes`
                SET 
                    title = :title,
                    content = :content,
                    updated_at = NOW() 
                WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $updatedRows = $pdoStatement->execute([
            ':title' => $this->title,
            ':content' => $this->content,
            ':id' => $this->id,
        ]);

        return ($updatedRows);
    }

    /**
     * Delete a record in table notes
     *
     * @return boolean|null
     */
    public function delete(): ?bool
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `notes` WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $deletedRows = $pdoStatement->execute([
            ':id' => $this->id,
        ]);

        return ($deletedRows);
    }


    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of user_id
     *
     * @return  int
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @param  int  $user_id
     *
     * @return  self
     */ 
    public function setUser_id(int $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
}