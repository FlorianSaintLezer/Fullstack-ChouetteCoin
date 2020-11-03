<?php

// FACTORISATION DU CODE - PARCE QUE C'EST ZOULI ET QU'ON AIME QUAND C'EST PROPRE ET BIEN RANGÉ

require 'includes/config.php';

// FONCTION D'INSCRIPTION
function inscription($email, $username, $password1, $password2) //Création de la fonction avec les paramètres requis entre ()
{
    global $conn;

    try { //La série de tests
        $sql1 = "SELECT * FROM users WHERE email = '{$email}'"; //Requête sur email dans la base de donnée
        $sql2 = "SELECT * FROM users WHERE username = '{$username}'"; //Requête sur username dans la base de donnée
        $res1 = $conn->query($sql1); //Lance la requête sur la BDD
        $count_email = $res1->fetchColumn();
        if (!$count_email) { //vérification si l'email n'existe pas déjà
            $res2 = $conn->query($sql2);
            $count_user = $res2->fetchColumn();
            if (!$count_user) { //vérification si utilisateur n'existe pas déjà
                // LA PARTIE IMPORTANTE APRES LES 2 VERIFICATIONS
                if ($password1 === $password2) { //Le mot de passe et sa confirmation sont-ils identiques ?
                    $password1 = password_hash($password1, PASSWORD_DEFAULT);
                    $sth = $conn->prepare('INSERT INTO users (email, username, password) VALUES (:email, :username, :password)');
                    $sth->bindValue(':email', $email); //On lie la valeur :email de la requête à la variable
                    $sth->bindValue(':username', $username);
                    $sth->bindValue(':password', $password1);
                    $sth->execute();
                    echo '<div class="alert alert-success mt-2" role="alert">L\'utilisateur est bien enregistré !</div>';
                } else { //mots de passe différents
                    echo '<div class="alert alert-danger mt-2" role="alert">Les mots de passes ne sont pas identiques !</div>';
                }
            } elseif ($count_user > 0) {
                echo '<div class="alert alert-danger mt-2" role="alert">Cet utilisateur existe déjà !</div>';
            }
        } elseif ($count_email > 0) {
            echo '<div class="alert alert-danger mt-2" role="alert">Cette adresse mail existe déjà !</div>';
        }
    } catch (PDOException $e) {
        echo 'Error : '.$e->getMessage();
    }
}

// FONCTION DE CONNEXION
function connexion($email, $password)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email}'"; //Requête SQL - On cherche un email dans tous les users
        $res = $conn->query($sql);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        if ($user) { //L'utilisateur (adresse email) existe-t-il dans la base de données ?
            $db_password = $user['password'];
            if (password_verify($password, $db_password)) { //Le mot de passe enoyé correspond-il au mot de passe de la base de données ?
                $_SESSION['id'] = $user['id']; //Si oui     -> l'ID de la Session devient l'ID de l'utilisateur
                $_SESSION['email'] = $user['email']; //      -> l'email de la Session devient l'email de l'utilisateur
                $_SESSION['username'] = $user['username']; //-> le Username de la Session devient le Username de l'utilisateur
                echo '<div class="alert alert-success mt-2" role="alert">Vous êtes connecté !</div>';
                header('Location:index.php');
            } else { // Le mot de passe envoyé ne correspond pas au mot de passe de la BDD
                echo '<div class="alert alert-danger mt-2" role="alert">Mot de passe erroné !</div>';
                unset($_POST);
            }
        } else { // L'adresse email n'existe pas dans la BDD
            echo '<div class="alert alert-danger mt-2" role="alert">Adresse mail non reconnue !</div>';
            unset($_POST);
        }
    } catch (PDOException $e) {// Là c'est quand c'est la merde
        echo 'Error : '.$e->getMessage();
    }
}

// FONCTION D'AFFICHAGE DES DONNÉES
function affichage()
{
    global $conn;
    $sth = $conn->prepare('SELECT * FROM users');
    $sth->execute();

    $users = $sth->fetchALL(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        ?>
<tr>
    <th scope="row">
        <?php echo $user['id']; ?>
    </th>
    <td>
        <?php echo $user['email']; ?>
    </td>
    <td>
        <?php echo $user['username']; ?>
    </td>
    <td>
        <?php echo $user['password']; ?>
    </td>
</tr>
<?php
    }
}
