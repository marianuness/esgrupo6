<?php

include_once("conexao.php");

$sql = "INSERT INTO venda (id_venda, id_cliente,id_responsavel,ativa) VALUES (NULL,0,0,0)";
$resultado = mysqli_query($conexao, $sql);

header("Location: vendas_visualizar.php"); // redireciona de volta para a página de vizualização

?>