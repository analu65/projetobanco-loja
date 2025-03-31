<?php 
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('loja');

if(isset($_POST['gravar'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $sql = "insert into categoria (codigo, nome) values ('$codigo', '$nome')";
    $resultado = mysql_query($sql);
    if ($resultado == TRUE) {
        echo "dados gravados com sucesso.";
    }
    else {
        echo "erro ao gravar os dados";
    }

}
if(isset($_POST['excluir'])) {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $sql = "delete from categoria where codigo = '$codigo'";
    $resultado = mysql_query($sql);
    if ($resultado == TRUE) {
        echo "dados excluidos com sucesso.";
    }
    else {
        echo "erro ao excluir os dados.";
    }
}
?>