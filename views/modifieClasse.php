<?php
$id=$match['params']['idClasse'] ?? 0;
$classe=\App\Classe::getClasseById($id);