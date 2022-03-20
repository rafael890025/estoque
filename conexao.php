<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 07/05/2020
 */

require_once('config.php');

try {
    $pdo = new PDO("mysql:dbname=$banco; host=$host", "$usuario", "$senha");

} catch (PDOException $e) {
    echo "Erro do Banco de Dados: ".$e->getMessage();
} catch (Exception $e) {
    echo "Erro genérico: ".$e->getMessage();
}
?>