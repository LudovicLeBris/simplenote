<?php

namespace App\Models;

use App\Utils\Database;
use \PDO;

class User extends CoreModel
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $roleId;

    /**
     * Retrieve a user record from table users with email
     *
     * @param string $email
     * @return User
     */
    public function findByEmail($email): User
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `users` WHERE email = :email';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':email' => $email]);

        $user = $pdoStatement->fetchObject(self::class);

        return $user;
    }

    /**
     * Retrieve a record from table users
     *
     * @param int $id
     * @return User
     */
    public static function find($id): User
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `users` WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $id]);
        
        $user = $pdoStatement->fetchObject(self::class); 
        return $user;

    }

    /**
     * Retrieve all records from table users
     *
     * @return array
     */
    public static function findAll(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `users`';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        
        $users = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class); 
        return $users;
    }
    
    /**
     * Insert a record in table users
     *
     * @return boolean
     */
    public function insert(): bool
    {
        $pdo = Database::getPDO();
        $sql = 'INSERT INTO `users` (firstname, lastname, email, password, role_id)
                VALUES (:firstname, :lastname, :email, :password, :role_id)';
        $pdoStatement = $pdo->prepare($sql);
        $insertedRows = $pdoStatement->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role_id' => $this->roleId,
        ]);

        if($insertedRows > 0){
            $this->id = $pdo->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * Update a record in table users
     *
     * @return boolean|null
     */
    public function update(): ?bool
    {
        $pdo = Database::getPDO();
        $sql = 'UPDATE `users`
                SET 
                    firstname = :firstname,
                    lastname = :lastname,
                    email = :email,
                    role_id = :role_id
                WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $updatedRows = $pdoStatement->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':email' => $this->email,
            ':role_id' => $this->roleId,
            ':id' => $this->id,
        ]);

        return ($updatedRows);
    }

    /**
     * Delete a record in table users
     *
     * @return boolean|null
     */
    public function delete(): ?bool
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `users` WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $deletedRows = $pdoStatement->execute([
            ':id' => $this->id,
        ]);

        return ($deletedRows);
    }

    /**
     * Get the value of firstname
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string  $firstname
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string  $lastname
     *
     * @return  self
     */ 
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }
}