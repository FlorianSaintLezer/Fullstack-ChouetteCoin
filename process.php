<?php

    $title = 'Processing - Le Chouette Coin';
    require 'includes/header.php';

    //VERROUILLAGE D'ACCES : Est-ce que le moyen d'accéder à cette page est différent d'une méthode POST (formulaire) ?
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        // méthode d'accès différente -> Page inaccessible, message d'erreur
        echo "<div class='alert alert-danger'> La page à laquelle vous tentez d'accéder n'existe pas </div>";

    //Méthode d'accès valide (POST)
        // Le elseif va servir au traitement du formulaire de création de produits
        // elseif -> Est-ce que l'utilisateur veut submit le formulaire ?
    } elseif (isset($_POST['product_submit'])) {
        // Si oui -> Est-ce que TOUS les champs ont été renseignés ?
        if (!empty($_POST['product_name']) && !empty($_POST['product_description']) && !empty($_POST['product_price']) && !empty($_POST['product_city']) && !empty(['product_category'])) {
            //Si oui -> création des variables avec les données entrées dans le formulaire
            $name = strip_tags($_POST['product_name']);
            $description = strip_tags($_POST['product_description']);
            $price = intval(strip_tags($_POST['product_price']));
            $city = strip_tags($_POST['product_city']);
            $category = strip_tags($_POST['product_category']);
            $user_id = $_SESSION['id']; // Seule la variable user_id correspond à l'ID de la session en cours (donc de l'utilisateur connecté qui crée l'annonce)
            ajoutProduits($name, $description, $price, $city, $category, $user_id); //Exécution de la fonction ajoutProduits
        } else {
            echo "<div class='alert alert-danger'> Tous les champs sont requis !</div>";
        }
    }
    require 'includes/footer.php';
