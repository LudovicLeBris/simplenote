<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= ($user->getId())? $router->generate('user-account', ['id' => $user->getId()]) : $router->generate('user-login')?>">Retour</a>
        <?php if($user->getId()): ?><a href="<?= $router->generate('user-delete', ['id' => $user->getId()]) ?>">Supprimer le compte</a><?php endif ?>
    </div>

    <section class="signupForm">
        <form action="" method="POST">
            <div>
                <label for="firstname">Prénom</label>
                <input 
                    type="text" 
                    name="firstname" 
                    id="firstname" 
                    placeholder="John" 
                    <?= (isset($user))? 'value='.$user->getFirstname() : '' ?>
                >
            </div>
            <div>
                <label for="lastname">Nom de famille</label>
                <input 
                    type="text" 
                    name="lastname" 
                    id="lastname" 
                    placeholder="Legend" 
                    <?= (isset($user))? 'value='.$user->getLastname() : '' ?>
                >
            </div>
            <div>
                <label for="email">E-mail</label>
                <input 
                    type="text" 
                    name="email" 
                    id="email" 
                    placeholder="exemple@mail.fr"
                    <?= (isset($user))? 'value='.$user->getEmail() :'' ?>
                >
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="hidden" name="tokenCsrf" value="<?= $tokenCsrf ?>">
                <input type="submit" value="<?= ($user->getId())? 'Modifier' : 'S\'inscrire' ?>">
            </div>
        </form>
    </section>


</main>