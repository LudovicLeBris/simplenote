<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;

class AdminController extends CoreController
{
    /**
     * Display the home page for administration
     *
     * @return void
     */
    public function home(): void
    {
        $this->show('admin/home', ['totalUsersCount' => User::getUsersCount()]);
    }

    /**
     * Display the page with all users
     *
     * @return void
     */
    public function list(): void
    {
        $this->show('admin/list', [
            'users' => User::findAll()
        ]);
    }

    public function edit($userId)
    {
        $this->show('admin/edit', [
            'user' => User::findWithRole($userId),
            'roles' => Role::findAll(),
        ]);
    }

    public function editPost($userId)
    {
        $roleId = (filter_input(INPUT_POST, 'role'));

        $errorsList = [];

        if(empty($roleId)){
            $errorsList[] = 'Le rôle est obligatoire';
        }

        $user = User::find($userId);
        $user->setRoleId($roleId);

        if(empty($errorsList)){
            if($user->save()){
                $this->redirect('admin-list');
            }
            $errorsList[] = 'Erreur d\'enregistrement des données';
        }

        $this->show('admin/edit', [
            'user' => $user,
            'roles' => Role::findAll(),
            'errorsList' => $errorsList
        ]);
    }

}