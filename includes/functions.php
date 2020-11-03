<?php

// FACTORISATION DU CODE

require 'includes/config.php';
function inscription($email, $username, $password1, $password2, $conn)
{
    try {
        $sql1 = "SELECT * FROM users WHERE email = '{$email}'"; //Requête sur email dans la base de donnée
        $sql2 = "SELECT * FROM users WHERE username = '{$username}'"; //Requête sur username dans la base de donnée
        $res1 = $conn->query($sql1);
        $count_email = $res1->fetchColumn();
        if (!$count_email) { //vérification si l'email n'existe pas déjà
            $res2 = $conn->query($sql2);
            $count_user = $res1->fetchColumn();
            if (!$count_user) { //vérification si utilisateur n'existe pas déjà
                // LA PARTIE IMPORTANTE APRES LES 2 VERIFICATIONS
                if ($password1 === $password2) { //Le mot de passe et sa confirmation sont-ils identiques ?
                    $password1 = password_hash($password1, PASSWORD_DEFAULT);
                    $sth = $conn->prepare('INSERT INTO users (email, username, password) VALUES (:email, :username, :password)');
                    $sth->bindValue(':email', $email);
                    $sth->bindValue(':username', $username);
                    $sth->bindValue(':password', $password1);
                    $sth->execute();
                    echo 'L\'utilisateur est bien enregistré';
                } else { //mots de passe différents
                    echo 'Les mots de passe ne concordent pas';
                }
            } elseif ($count_user > 0) {
                echo 'Cet utilisateur existe déjà !';
            }
        } elseif ($count_email > 0) {
            echo 'Cette adresse existe déjà !';
        }
    } catch (PDOException $e) {
        echo 'Error: .$e->getMessage()';
    }
}
