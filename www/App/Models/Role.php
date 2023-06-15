<?php

namespace App\Models;

use App\Utils\Database;
use \PDO;

class Role extends CoreModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * Retrieve a record from table roles
     *
     * @param int $id
     * @return Role
     */
    public static function find($id): Role
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `roles` WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $id]);
        
        $role = $pdoStatement->fetchObject(self::class); 
        return $role;
    }
    
    /**
     * Retrieve all records from table roles
     *
     * @return array
     */
    public static function findAll(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `roles`';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        
        $roles = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class); 
        return $roles;
    }

    /**
     * Insert a record in table roles
     *
     * @return boolean|null
     */
    public function insert(): ?bool
    {
        $pdo = Database::getPDO();
        $sql = 'INSERT INTO `roles` (name)
                VALUES (:name)';
        $pdoStatement = $pdo->prepare($sql);
        $insertedRows = $pdoStatement->execute([':name' => $this->name]);

        if($insertedRows > 0){
            $this->id = $pdo->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * Update a record in table roles
     *
     * @return boolean|null
     */
    public function update(): ?bool
    {
        $pdo = Database::getPDO();
        $sql = 'UPDATE `roles`
                SET 
                    name = :name,
                    updated_at = NOW(),
                WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $updatedRows = $pdoStatement->execute([
            ':name' => $this->name,
            ':id' => $this->id,
        ]);

        return ($updatedRows);
    }

    /**
     * Delete a record in table roles
     *
     * @return boolean|null
     */
    public function delete(): ?bool
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `roles` WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $deletedRows = $pdoStatement->execute([
            ':id' => $this->id,
        ]);

        return ($deletedRows);
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}