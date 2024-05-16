<?php
// Inclure le fichier de connexion à la base de données
include_once "bdd.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Actualités</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
        <h1>Actualités</h1>
        <nav class="navbar">
            <ul>
                <li><a href="code.php">News</a></li>
            <?php
            // Requête SQL pour récupérer toutes les catégories
            $sql_categories = "SELECT * FROM Categorie";
            $result_categories = $conn->query($sql_categories);

            if ($result_categories->rowCount() > 0) {
                // Afficher les liens vers chaque catégorie
                while ($row_category = $result_categories->fetch(PDO::FETCH_ASSOC)) {
                    $categorie_id = $row_category['id'];
                    $libelle = $row_category['libelle'];

                    echo "<li><a href='code.php?categorie=$categorie_id'>$libelle</a></li>";
                }
            } else {
                echo "<li>Aucune catégorie trouvée.</li>";
            }
            ?>
            </ul>
        </nav>
    </div>

    <div class="container">

        <div class="articles">
            <?php
            // Récupérer les actualités pour la catégorie sélectionnée (si spécifiée dans l'URL)
            $filter_category = isset($_GET['categorie']) ? $_GET['categorie'] : null;

            // Requête SQL pour récupérer les dernières actualités par catégorie
            $sql_articles = "SELECT * FROM Article";
            if ($filter_category) {
                $sql_articles .= " WHERE categorie = $filter_category";
            }
            $sql_articles .= " ORDER BY dateCreation DESC LIMIT 5";

            $result_articles = $conn->query($sql_articles);

            if ($result_articles->rowCount() > 0) {
                // Afficher les actualités
                while ($row_article = $result_articles->fetch(PDO::FETCH_ASSOC)) {
                    $titre = $row_article['titre'];
                    $contenu = $row_article['contenu'];

                    echo "<h2>$titre</h2>";
                    echo "<p>$contenu</p>";
                }
            } else {
                echo "Aucune actualité trouvée pour cette catégorie.";
            }
            ?>
        </div>
    </div>
</body>
</html>
