<?php
$conectar = mysql_connect('localhost', 'root', '', 'loja');
$db = mysql_select_db('loja')
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <div class="layout">
            <nav>
                <img src="fotossites/morcego.png" height="55" width="150" class="cabecalhoimagem" >
                <a href="home.html" class="botaocabecalho">HOME</a>
                <a href="login.html" class="botaocabecalho">LOGIN</a>
            </nav>
            </div>
            <div id="logo">
                <img src="fotossites/spectral.png" height="25" width="150">
            </div>
         </header>
         <div id="formulario">
         <form name="formulario" method="post" action="home.php">
            <select name="categoria">
                <option value="" selected="selected"> selecione...
                </option>
                <?php
            $query = mysql_query("SELECT codigo, nome from categoria");
            while($categorias = mysql_fetch_array($query)) { ?>
                <option value="<?php echo $categorias['codigo']?>">
                    <?php echo $categorias['nome']?>
                </option>
            <?php } ?>
            </select>
            <input type="submit" value="Enviar">

         </form>
        </div>
</body>