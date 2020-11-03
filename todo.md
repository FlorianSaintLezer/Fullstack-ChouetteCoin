1. Créer une page d'accueil avec un lien vers la page de connexion.
2. Créer une connexion à la base de données (avec PDO) dans un config.php dans le dossier includes, qui contient tous fichiers qui seront inclus sur des pages.
3. Créer une base de données qui représente la structure de notre projet [le_chouette_coin>users,products,categories].
4. Créer un formulaire pour l'inscription des utilisateurs qui reprend les informations de connexion.
    -> Ne pas oublier l'action et la méthode POST du formulaire,
    -> ne pas oublier les name sur les input (pour les retrouver lors du $_POST),
    -> ** Rajouter des vérifications en front ** (optionnel).
5. Récupérer les données du formulaire en prenant soin de les sécuriser.
    -> htmlspecialchars sur nos variables $_POST,
    -> ** On peut aussi utiliser strip_tags **
6. Créer une logique pour l'ajout d'utilisateur dans la base de données.
    -> Un utilisateur doit forcément posséder un email, un mot de passe et un username et avoir cliqué sur le bouton d'inscription (1er if : avec !empty et isset),
    -> Un utilisateur ne peut pas avoir la même adresse email qu'un autre. Pour cela, nous comptons le nombre de fois que l'email est dans la base de données (2ème if). ,
    -> Un utilisateur ne peut pas avoir le même username qu'un autre. Pour cela, nous comptons le nombre de fois que ce username est dans la base de données (3ème if),
    -> Un utilisateur doit être sûr de son mot de passe (4ème if avec la vérification de la concordance des mots de passe entrés : "pass1=== $pass2"),
    -> LES MOTS DE PASSE SONT TOUJOURS CRYPTES DANS LA BASE DE DONNEES (RGPD 2018) - Le mot de passe doit être crypté avec la fonction password_hash (la clé PASSWORD_DEFAULT suffit, mais vous pouvez explorer les autres ! A savoir, les clés de hashage md5 et sha1 sont faciles à décrypter - NE PAS UTILISER)
    -> Créer une requête d'insertion avec la préparation de requête en PDO et des marqueurs nommés. (prepare(), :value et bindValue(:value))
7. Factoriser le code en créant une fonction qui réalise l'ajout d'utilisateurs à partir des variables nécessaires pour chaque utilisateur.