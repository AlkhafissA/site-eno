<?php
$mot_de_passe = 'Sira2101'; 
$mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);
echo "Mot de passe haché : " . $mot_de_passe_hache;
?>