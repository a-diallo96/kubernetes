<?php
if (isset($_POST['US_login']) && isset($_POST['US_password'])) {
    session_start();
    include 'connect.php';

    ini_set('display_errors', '1');

    try {
        // Prépare la requête avec hashage SHA2 côté MySQL
        $sql = "SELECT * FROM utilisateurs WHERE US_login = ? AND US_password = SHA2(?, 256)";
        $stmt = $db->prepare($sql);

        // Bind des paramètres en s'assurant que ce sont des strings
        $stmt->bindParam(1, $_POST['US_login'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST['US_password'], PDO::PARAM_STR);

        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res) {
            // Utilisateur trouvé : on stocke en session et redirige
            $_SESSION['login'] = $res['US_login'];
            header("Location: home.php");
            exit();
        } else {
            // Aucun utilisateur correspondant : retour à la page login
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur SQL, afficher ou logger l'erreur et rediriger
        error_log("Erreur SQL: " . $e->getMessage());
        header("Location: BADUSER.html");
        exit();
    }
} else {
    // Si login ou mot de passe non fourni
    header("Location: index.php");
    exit();
}
?>