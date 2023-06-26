<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends CoreController
{
    /**
     * Display the login page
     *
     * @return void
     */
    public function login(): void
    {
        $this->show('user/login');
    }

    /**
     * Processing the form for login
     *
     * @return void
     */
    public function loginPost(): void
    {

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $errorsList= [];

        $user = User::findByEmail($email);

        if(($user !== false) && (password_verify($password, $user->getPassword()))){
            $_SESSION['currentUserId'] = $user->getId();
            $_SESSION['currentUser'] = $user;

            $this->redirect('note-home');
        }

        $errorsList[] = 'Votre email ou votre mot de passe est incorrect';

        $this->show('user-login', [
            'errorsList' => $errorsList
        ]);
    }

    /**
     * Display the signup page
     *
     * @return void
     */
    public function signup(): void
    {
        $this->show('user/signup-edit', [
            'user' => new User()
        ]);
    }

    /**
     * Processing the form for signup
     *
     * @return void
     */
    public function signupPost(): void
    {
        $firstname = htmlspecialchars(filter_input(INPUT_POST, 'firstname'));
        $lastname = htmlspecialchars(filter_input(INPUT_POST, 'lastname'));
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $errorsList = [];

        if(empty($firstname)){
            $errorsList[] = 'Le prénom est obligatoire';
        }

        if(empty($lastname)){
            $errorsList[] = 'Le nom de famille est obligatoire';
        }

        if(empty($email)){
            $errorsList[] = 'L\'e-mail est obligatoire';
        }

        if(User::findByEmail($email)){
            $errorsList[] = 'L\'email est déja utilisé, vous ne pouvez pas créer deux comptes avec le même identifiant';
        }

        if(empty($password)){
            $errorsList[] = 'Le mot de passe est obligatoire';
        } else {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $specialChar = preg_match('@[\_\-\|\%\&\*\=\@\!\£]@', $password);
            if(!$uppercase || !$lowercase || !$number || !$specialChar || strlen($password) < 8){
                $errorsList[] = 'Le mot de passe ne respecte pas les critères';
            }
        }

        $newUser = new User();

        $newUser->setFirstname($firstname);
        $newUser->setLastname($lastname);
        $newUser->setEmail($email);
        $newUser->setPassword($password);
        $newUser->setRoleId(2);

        if(empty($errorsList)){
            if($newUser->save()){
                $this->redirect('user-login');
            }
            $errorsList[] = 'Erreur d\'enregistrement des données';
        }

        $this->show('user/signup-edit', [
            'user' => $newUser,
            'errorsList' => $errorsList 
        ]);
    }

    /**
     * Proccessing the logout of user
     *
     * @return void
     */
    public function logout(): void
    {
        session_destroy();
        $this->redirect('user-login');
    }

    /**
     * Display the account page with the user informations
     *
     * @param int $userId
     * @return void
     */
    public function account($userId): void
    {
        $this->show('user/account', [
            'user' => User::find($userId)
        ]);
    }

    /**
     * Display the page for updating a user
     *
     * @param int $userId
     * @return void
     */
    public function edit($userId): void
    {
        $this->show('user/signup-edit', [
            'user' => User::find($userId)
        ]);
    }

    /**
     * Processing the form for updating a user
     *
     * @param int $userId
     * @return void
     */
    public function editPost($userId): void
    {
        $firstname = htmlspecialchars(filter_input(INPUT_POST, 'firstname'));
        $lastname = htmlspecialchars(filter_input(INPUT_POST, 'lastname'));
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'email');

        $errorsList = [];

        if(empty($firstname)){
            $errorsList[] = 'Le prénom est obligatoire';
        }

        if(empty($lastname)){
            $errorsList[] = 'Le nom de famille est obligatoire';
        }

        if(empty($email)){
            $errorsList[] = 'L\'e-mail est obligatoire';
        }

        if(empty($password)){
            $errorsList[] = 'Le mot de passe est obligatoire';
        } else {
            if(!filter_var($password, FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=>"/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[\_\-\|\%\&\*\=\@\$]).{8,})\S$/")))){
                $errorsList[] = 'Le mot de passe ne respacte pas les critères';
            }
        }

        $user = User::find($userId);

        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRoleId(2);

        if(empty($errorsList)){
            if($user->save()){
                $this->redirect('user-account');
            }
            $errorsList[] = 'Erreur d\'enregistrement des données';
        }

        $this->show('user/signup-edit', [
            'user' => $user,
            'errorsList' => $errorsList 
        ]);

    }

    public function delete($userId)
    {
        $this->show('user/delete', [
            'user' => User::find($userId)
        ]);
    }

    public function deletePost($userId)
    {
        $errorsList = [];

        $user = User::find($userId);

        if($user->delete()){
            $this->redirect('note-home');
        }
        $errorsList[] = 'Erreur d\'accès aux données';

        $this->show('user/delete', ['id' => $user->getId()]);
    }
}