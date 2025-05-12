<?php session_start(); 
$status=""; 
if (isset($_POST['action']) && $_POST['action'] == "remove" && isset($_POST["codigo"])) {
    if (!empty($_SESSION["shopping_cart"])) {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($_POST["codigo"] == $key) {
                unset($_SESSION["shopping_cart"][$key]);
                $status = "<div class='box' style='color:red;'>Produto foi removido do carrinho !</div>";
            }
        }
        if (empty($_SESSION["shopping_cart"])) {
            unset($_SESSION["shopping_cart"]);
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "change" && isset($_POST["codigo"])) {
    $qty = (int)$_POST["quantity"];
    if (isset($_SESSION["shopping_cart"][$_POST["codigo"]])) {
        $_SESSION["shopping_cart"][$_POST["codigo"]]["quantity"] = $qty;
        $status = "<div class='box' style='color:green;'>Quantidade atualizada!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<HEAD>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <TITLE>Carrinho Compras </TITLE>
    <link rel="stylesheet" href="estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        .carrinho {
            max-width: 900px;
            margin: 30px auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
        }
        
        .titulo_carrinho {
            font-size: 30px;
            text-align: center;
            padding: 15px;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        
        .tabela {
            width: 100%;
            margin-top: 20px;
        }
        
        
        .tabela tr:first-child {
            background-color: #2b2b2b;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }
        
        .tabela td {
            padding: 15px 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
            vertical-align: middle;
        }
        
        .tabela tr:last-child td {
            border-bottom: none;
            padding-top: 20px;
            font-size: 18px;
        }
        .tabela img {
            border-radius: 5px;
            object-fit: cover;
        }
        
        
        .remover {
            border: none;
            border-radius: 25px;
            background-color: #f2f2f2;
            color: #333;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .quantidade {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 80px;
        }
        
        .caixa_mensagem {
            text-align: center;
            margin: 15px auto;
            max-width: 600px;
        }
        
        .caixa_mensagem .box {
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .continuar_comprando {
            border: none;
            border-radius: 25px;
            background-color: #2b2b2b;
            color: white;
            padding: 10px 30px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 20px auto;
            transition: background-color 1s;
        }
        
        h3 {
            text-align: center;
            color: #2b2b2b;
            padding: 50px 0;
            font-size: 20px;
            letter-spacing: 0.5px;
        }
        
        
        .carrinho_div {
            position: absolute;
            right: 20px;
            top: 20px;
        }
        
        .carrinho_div span {
            background-color: #2b2b2b;
            color: white;
            border-radius: 50%;
            padding: 3px 8px;
            font-size: 14px;
            position: absolute;
            top: -5px;
            right: -5px;
        }
    </style>
</HEAD>
<BODY>
    <header>
        <div class="layout">
            <nav>
                <img src="fotossites/morcego.png" height="55" width="150" class="cabecalhoimagem">
                <a href="home.php" class="botaocabecalho">HOME</a>
                <a href="login.html" class="botaocabecalho">LOGIN</a>
            </nav>
        </div>
        <?php
        if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
        ?>
        <div class="carrinho_div">
            <a href="cartn.php">
                <img src="fotossites/carrinho.png" height="50" width="50" />
                <span><?php echo $cart_count; ?></span>
            </a>
        </div>
        <?php
        }
        ?>
        <div id="logo">
            <img src="fotossites/spectral.png" height="25" width="150">
        </div>
    </header>

    <div class="carrinho">
    <h2 class="titulo_carrinho">🛒 Meu Carrinho de Compras</h2>
    <?php if(isset($_SESSION["shopping_cart"])){
        $total_price = 0; ?>
        <table class="tabela">
            <tbody>
                <tr>
                    <td></td>
                    <td>Descrição</td>
                    <td>Qtd</td>
                    <td>Preço</td>
                    <td>Total</td>
                </tr>
                
                <?php foreach ($_SESSION["shopping_cart"] as $key => $product){ ?>
                <tr>
                    <td>
                        <img src="fotos/<?php echo $product['foto']; ?>" height="50" width="50" />
                    </td>
                    <td><?php echo $product["descricao"]; ?><br />
                        <form method='post' action=''>
                            <input type='hidden' name='codigo' value="<?php echo $key; ?>" />
                            <input type='hidden' name='action' value="remove" />
                            <button type='submit' class='remover'>Remover Item</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action=''>
                            <input type='hidden' name='codigo' value="<?php echo $key; ?>" />
                            <input type='hidden' name='action' value="change" />
                            <select name='quantity' class='quantidade' onChange="this.form.submit()">
                                <?php for($i=1; $i<=5; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php if($product["quantity"]==$i) echo "selected"; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </td>
                    <td><?php echo "R$".$product["preco"]; ?></td>
                    <td><?php echo "R$".$product["preco"]*$product["quantity"]; ?></td>
                </tr>
                <?php $total_price += ($product["preco"]*$product["quantity"]); } ?>
                <tr>
                    <td colspan="5" align="right">
                        <strong>TOTAL: <?php echo "R$".$total_price; ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php }else{
        echo "<h3>Seu carrinho esta vazio !</h3>";
    } ?>
    </div>

    <div style="clear:both;"></div>

    <div class="caixa_mensagem" style="margin:10px 0px;">
        <?php echo $status; ?>
    </div>

    <?php if(isset($_SESSION["shopping_cart"])){ ?>
    <a href="home.php" class="continuar_comprando">Continuar Comprando</a>
    <?php } ?>
</BODY>
</HTML>