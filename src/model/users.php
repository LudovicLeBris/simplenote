<?php

require_once('src/lib/database.php');

class User
{
    public int $userID;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
}

class UserRespository
{
    public DatabaseConnection $connection;

    private function _statement($sqlStatement)
    {
        return $this->connection->getConnection()->prepare($sqlStatement);
    }

    public function userExist($email): bool
    {
        $statement = $this->_statement("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);

        if ($statement->fetch() == 0)
        {
            return false;
        } else
        {
            return true;
        }
    }

    public function checkPassword($email, $password)
    {
        $statement = $this->_statement("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);

        $row = $statement->fetch();

        return (password_verify($password, $row['password']));

    }
    
    // public function getUsers(): array
    // {
    //     $statement = $this->_statement("SELECT * FROM users");

    //     $statement->execute();

    //     $users = [];

    //     while (($row = $statement->fetch()))
    //     {
    //         $user = new User();
    //         $user->userID = $row['userID'];
    //         $user->firstName = $row['firstName'];
    //         $user->lastName = $row['lastName'];
    //         $user->email = $row['email'];
    //         $user->password = $row['password'];

    //         $users[] = $user;
    //     }

    //     return $users;

    // }
    
    public function getUser($email)
    {
        $statement = $this->_statement(
            "SELECT userID, firstName, lastName, email FROM users WHERE email = :email"
        );
        $statement->execute([
            'email' => $email,
        ]);

        $row = $statement->fetch();

        $user = new User();
        $user->userID = $row['userID'];
        $user->firstName = $row['firstName'];
        $user->lastName = $row['lastName'];
        $user->email = $row['email'];

        return $user;
    }

    public function createUser($firstName, $lastName, $email, $password): bool
    {
        $statement = $this->_statement(
            "INSERT INTO users (firstName, lastName, email, password)
            VALUES (:firstName, :lastName, :email, :password)"
        );

        $success = $statement->execute([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return ($success > 0);

    }

    public function updateUser($userID, $firstName, $lastName): bool
    {
        $statement = $this->_statement(
            "UPDATE users SET firstName = :firstName, lastName = :lastName WHERE userID = :userID"
        );

        $success = $statement->execute([
            'userID' => $userID,
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);

        return ($success > 0);
    }

    public function updatePassword($userID, $newPassword): str
    {
        $statement = $this->_statement(
            "SELECT password FROM users WHERE userID = :userID"
        );

        $oldPassword = $statement->execute(['userID' => $userID]);
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if ($newPassword !== $oldPassword) {
            $newStatement = $this->connection->getConnection()->prepare(
                "INSERT INTO users (password) VALUES (:newpassword)"
            );

            $success = $newStatement->execute(['newpassword' => $newPassword]);

            return "Mot de passe modifié avec succès";
        } else {

            return "Le nouveau mot de passe doit être différent de l'ancien";
        }
    }

    public function deleteUser($userID): bool
    {
        $statement = $this->_statement(
            "DELETE FROM users WHERE userID = :userID"
        );

        $success = $statement->execute(['userID' => $userID]);

        return ($success > 0);
    }

}