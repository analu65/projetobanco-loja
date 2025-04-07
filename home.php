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
                <option value="" selected="selected"> Categoria
                </option>
                <?php
            $query = mysql_query("SELECT codigo, nome from categoria");
            while($categorias = mysql_fetch_array($query)) { ?>
                <option value="<?php echo $categorias['codigo']?>">
                    <?php echo $categorias['nome']?>
                </option>
            <?php } ?>
            </select>
            <select name="marca">
         <option value="" selected="selected">Marca</option>

         <?php
         $query = mysql_query("SELECT codigo, nome FROM marca");
         while($marca = mysql_fetch_array($query))
         {?>
         <option value="<?php echo $marca['codigo']?>">
                        <?php echo $marca['nome']   ?></option>
         <?php }
         ?>
         </select>

         <select name="tipo">
         <option value="" selected="selected">Selecione...</option>

         <?php
         $query = mysql_query("SELECT codigo, nome FROM tipo");
         while($tipo = mysql_fetch_array($query))
         {?>
         <option value="<?php echo $tipo['codigo']?>">
                        <?php echo $tipo['nome']   ?></option>
         <?php }
         ?>
         </select>
            <input type="submit" name="enviar" value="Enviar">
         </form>
        </div>
        <?php

        if(isset($_POST['enviar'])) {
            $marca = (empty($_POST['marca']))? 'null' : $_POST['marca'];
            $categoria      = (empty($_POST['categoria']))? 'null' : $_POST['categoria'];
            $tipo           = (empty($_POST['tipo']))? 'null' : $_POST['tipo'];


            // marca
            if(($marca <> 'null') and ($categoria == 'null') and ($tipo == 'null')) {
                $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                FROM produto, marca, categoria, tipo
                WHERE produto.codmarca = marca.codigo
                and produto.codcategoria = categoria.codigo
                and produto.codtipo = tipo.codigo
                and marca.codigo = '$marca'";
                
            $seleciona_produtos = mysql_query($sql_produtos);
            }
            //categoria
            else if (($marca =='null') and ($categoria <> 'null') and ($tipo == 'null'))
            {
                $sql_produtos = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                            FROM produto, marca, categoria, tipo
                            WHERE produto.codmarca = marca.codigo
                            and produto.codcategoria = categoria.codigo
                            and produto.codtipo = tipo.codigo
                            and categoria.codigo = '$categoria'";

                    $seleciona_produtos = mysql_query($sql_produtos);

                    }
                //tipo
                else if (($marca == 'null') and ($categoria =='null') and ($tipo <> 'null'))
                {
                $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                        FROM produto, marca, categoria, tipo
                                        WHERE produto.codmarca = marca.codigo
                                        and produto.codcategoria = categoria.codigo
                                        and produto.codtipo = tipo.codigo
                                        and tipo.codigo = '$tipo'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
                }
            //marca e categoria 
            else if (($marca <> 'null' ) and ($categoria <> 'null') and ($tipo == 'null')) {
                $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                    FROM produto, marca, categoria, tipo
                                    WHERE produto.codmarca = marca.codigo
                                    and produto.codcategoria = categoria.codigo
                                    and produto.codtipo = tipo.codigo
                                    and marca.codigo = '$marca' and categoria.codigo = '$categoria'";
                                    
                $seleciona_produtos = mysql_query($sql_produtos);

            }
            //marca e tipo
            else if (($marca <> 'null') and ($categoria == 'null' ) and ($tipo <> 'null')) {
                $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                           FROM produto, marca, categoria, tipo
                           WHERE produto.codmarca = marca.codigo
                           and produto.codcategoria = categoria.codigo
                           and produto.codtipo = tipo.codigo
                           and marca.codigo = '$marca' and tipo.codigo = '$tipo'";
                           
            $seleciona_produtos = mysql_query($sql_produtos);

            }
            //categoria e tipo
            else if (($marca == 'null') and ($categoria <> 'null') and ($tipo <> 'null')) {
                $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                           FROM produto, marca, categoria, tipo
                           WHERE produto.codmarca = marca.codigo
                           and produto.codcategoria = categoria.codigo
                           and produto.codtipo = tipo.codigo
                           and categoria.codigo = '$categoria' and tipo.codigo = '$tipo'";
                           
            $seleciona_produtos = mysql_query($sql_produtos);

            }
            //marca categoria e tipo
            else if (($marca <> 'null') and ($categoria <> 'null') and ($tipo <> 'null')) {
                $sql_produtos       = "SELECT produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                FROM produto, marca, categoria, tipo
                WHERE produto.codmarca = marca.codigo
                and produto.codcategoria = categoria.codigo
                and produto.codtipo = tipo.codigo
                and marca.codigo = '$marca' and categoria.codigo = '$categoria' 
                and tipo.codigo = '$tipo' ";
                
            $seleciona_produtos = mysql_query($sql_produtos);

            }
            if(mysql_num_rows($seleciona_produtos) == 0)
   {
      echo '<h1>Desculpe, mas sua busca nao retornou resultados ... </h1>';
   }
   else
   {
      echo " <div class='titulo'><br><br>RESULTADOS <br><br></div>";
      while ($dados = mysql_fetch_object($seleciona_produtos))
      {
         echo $dados->descricao." <br><br> ";
         echo '<img src="fotos/'.$dados->foto1.'" height="150" width="150" />'." ";
         echo '<img src="fotos/'.$dados->foto2.'" height="150" width="150" />'. "<br>";
         echo "  Preço: ".$dados->preco." R$"."<br><br>";

      }
      }
   }
   ?>
</body>