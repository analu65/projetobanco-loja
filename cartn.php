<?php
session_start();
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

<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>
<table class="table">
<tbody>
<tr>
<td></td>
<td>Descrição</td>
<td>Qtd</td>
<td>Preço</td>
<td>Total</td>
</tr>
<?php
foreach ($_SESSION["shopping_cart"] as $key => $product){
?>
<tr>
<td>
<img src='<?php echo "fotos/".$product['foto1']." height=50 width=50"; ?>' />
</td>
<td><?php echo $product["descricao"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='codigo' value="<?php echo $key; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='codigo' value="<?php echo $key; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<?php for($i=1; $i<=5; $i++) { ?>
    <option value="<?php echo $i; ?>" <?php if($product["quantity"]==$i) echo "selected"; ?>><?php echo $i; ?></option>
<?php } ?>
</select>
</form>
</td>
<td><?php echo "R$".$product["preco"]; ?></td>
<td><?php echo "R$".$product["preco"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["preco"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "R$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>
  <?php
}else{
	echo "<h3>Seu carrinho esta vazio !</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>


</BODY>
</HTML>