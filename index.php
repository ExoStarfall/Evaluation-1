<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,mozilla,chrome=1">
    <meta name="HandheldFriendly" content="true">>
    <title>Vapeur Douce</title>
    <meta name="description" content="Plats gourmands, cuisson parfaite!">
    <link rel="stylesheet" href="style.css">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://kahinadev5.go.yj.fr/eval/"> <!-- Défini l'adresse web -->
    <meta property="og:type" content="website"> <!-- Définit le type de contenu -->
    <meta property="og:title" content="Vapeur Douces"> <!-- Ici on met le titre, ne devant pas dépasser 95 caracères -->
    <meta property="og:description" content="Plats gourmands, cuisson parfaite!"> <!-- Ici on met la description utilisée pour les réseaux sociaux -->
    <meta property="og:image" content="https://kahinadev5.go.yj.fr/eval/img/imgvapeur.jpg"> <!-- Composante de l'aperçu , susciter le meilleur nombre de clics -->

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image"> <!--  -->
    <meta property="twitter:domain" content="kahinadev5.go.yj.fr">
    <meta property="twitter:url" content="https://kahinadev5.go.yj.fr/eval/">
    <meta name="twitter:title" content="Vapeur Douces">
    <meta name="twitter:description" content="Plats gourmands, cuisson parfaite!">
    <meta name="twitter:image" content="https://kahinadev5.go.yj.fr/eval/img/imgvapeur.jpg">



</head>
<!-- Ici on a les infos générales pour la partie visible par l'utilisateur -->

<body>
    <div id="logo">
        <h1> VAPEUR <br> DOUCE</h1>
    </div>
    <main>
        <form action="" method="POST">
            <label for="search">Que cherchez vous? </label>
            <input class="bar" type="text" id="search" name="search">
            <input class="btn" type="submit" value="Rechercher">
        </form>
    </main>
    <div class="result">
        <?php
        /* On va créer une fonction apivapeur*/
        function apivapeur()
        {
            if (isset($_POST['search'])) { /* ISSET va vérifier que la variable $search n'est pas nulle  */

                $curl = curl_init(); /*On définit une variable curl, cURL va communique directement avec le serveur , curl_init va initialiser cette session */

                $search = urlencode($_POST['search']); /*Ici on va créer une variable $search qui va servir d'ID, on va ensuite encoder la chaine de caractère pour la faire passer par l'URL */

                curl_setopt_array($curl, array(  /* Va fixer les options du transfert cURL ci dessous */
                    CURLOPT_URL => "https://api.hmz.tf/?id=$search", /*L'URL a aller chercher */
                    CURLOPT_RETURNTRANSFER => true, /* C'est un booléen, la commande va nous retourner les données sous forme de chaine de caractère */
                    CURLOPT_TIMEOUT => 30, /* Temps d'execution de la requête*/

                ));
                /* On execute la session */
                $response = curl_exec($curl); /* Variable qui va retourner les données*/
                /* ici on la ferme */
                curl_close($curl);

                $response = json_decode($response, true); /*On va lire les données avec json_decode*/

                /* Les différents eléments du JSON que je veux récupérer
                $response['message']['nom'];
                $response['message']['vapeur'];
                $response["message"]["vapeur"]["cuisson"];
                $response["message"]["vapeur"]["trempage"];
                $response["message"]["vapeur"]["niveau d'eau"];
              */
                /*On affiche le trempage pour les aliments où il est renseigné*/
                if (isset($response["message"]["vapeur"]["trempage"])) {
                    echo ('<p>Le temps de trempage est de  ' . htmlentities($response["message"]["vapeur"]["trempage"], ENT_QUOTES) . '</p>');
                } else echo ('<p> Le temps de trempage n\'est pas renseigné </p>');
                /*On affiche le niveau d'eau pour les aliments où il est renseigné */
                if (isset($response["message"]["vapeur"]["niveau d'eau"])) {
                    echo ("<p>Le niveau d'eau est de " . htmlentities($response["message"]["vapeur"]["niveau d'eau"], ENT_QUOTES) . "</p>");
                } else  echo '<p> Niveau d\'eau non renseigné </p>';
                /*On affiche le temps de cuisson des aliments, renseigné partout */
                if (isset($response["message"]["vapeur"]["cuisson"])) {
                    echo ('<p>Le temps de cuisson est de ' . htmlentities($response["message"]["vapeur"]["cuisson"], ENT_QUOTES) . '</p>');
                }
            }
        }
        apivapeur();
        ?>
    </div>
</body>

</html>