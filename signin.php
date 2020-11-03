<?php
    $title = 'Identification - Le Chouette Coin';
    require 'includes/header.php';
    require 'includes/functions.php';

    if (!empty($_POST['submit_signup']) && !empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['username_signup'])) {
        $email = htmlspecialchars($_POST['email_signup']);
        $password1 = htmlspecialchars($_POST['password1_signup']);
        $password2 = htmlspecialchars($_POST['password2_signup']);
        $username = htmlspecialchars($_POST['username_signup']);

        inscription($email, $username, $password1, $password2, $conn);
    }

?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h2 class="display-6">Inscription</h2>
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="POST">
                <div class="form-group">
                    <label for="InputEmail1">Adresse email</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp"
                        name="email_signup" required>
                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email.</small>
                </div>

                <div class="form-group">
                    <label for="InputUsername1">Pseudo</label>
                    <input type="text" class="form-control" id="InputUsername1" aria-describedby="userHelp"
                        name="username_signup" required>
                    <small id="userHelp" class="form-text text-muted">Votre pseudo est unique.</small>
                </div>

                <div class="form-group">
                    <label for="InputPassword1">Mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password1_signup" required>
                </div>

                <div class="form-group">
                    <label for="InputPassword2">Confirmez votre mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword2" name="password2_signup" required>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="Check1" required>
                    <label class="form-check-label" for="Check1">J'accepte les <a href="#">conditions
                            d'utilisation</a></label>
                </div>

                <button type="submit" class="btn btn-primary" name="submit_signup"
                    value="inscription">S'inscrire</button>
            </form>
        </div>

        <div class="col-6">
            <h2 class="display-5">Connexion</h2>
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="POST">
                <div class="form-group">
                    <label for="InputEmail">Adresse email</label>
                    <input type="email" class="form-control" id="InputEmail" name="email_login" required>
                </div>

                <div class="form-group">
                    <label for="InputUsername">Pseudo</label>
                    <input type="text" class="form-control" id="InputUsername" name="username_login" required>
                </div>

                <div class="form-group">
                    <label for="InputPassword">Mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword" name="password_login" required>
                </div>

                <button type="submit" class="btn btn-primary" name="submit_login" value="Connexion">Se
                    connecter</button>
            </form>
        </div>
    </div>
</div>

<?php
    require 'includes/footer.php';
