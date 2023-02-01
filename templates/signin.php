<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
</head>
<body>
    <h1>Création de compte</h1>
    <a href="../index.php">Annuler</a><br><br>
    <div>
        <form action="../index.php?action=createuser" method="post">
            <div>
                <label for="email" >E-mail</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password" >Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label for="firstName" >Prénom</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>
            <div>
                <label for="lastName" >Nom de famille</label>
                <input type="text" name="lastName" id="lastName">
            </div>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</body>
</html>