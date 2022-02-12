<?php session_start();
include "../config.php";
include "module.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?php include "../header.php" ?>
	<title>ADMIN PANEL</title>
	<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.10.1/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.10.1/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.10.1/dist/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="../style.css">
     <link rel="stylesheet" href="style.css">
	<style>

	</style>
</head>
<body>
	<div id="modal-close-default" uk-modal>

	    <div class="uk-modal-dialog uk-modal-body">

	        <button class="uk-modal-close-default" type="button" uk-close></button>

	        <h2 class="uk-modal-title"></h2>

	        <p></p>

	    </div>

	</div>
	<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="header__logo">MoGo</div>

            <nav class="nav">
                <a class="nav__link active" href="index.php">Table</a>
                <a class="nav__link" href="admin/index.php">Admin Panel</a>
                <a class="nav__link" href="form.php">Add</a>
            </nav>
        </div>
    </div>
</header>


<div class="intro">
    <div class="container">
        <div class="intro__inner">
             <div class="uk-container">
   	<?php
   	$products = getProducts($connection);
   ?>
   <div class="uk-child-width-1-3@m" uk-grid>
   	<?php foreach($products as $product) { ?>
<div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top">
                <img src="images/light.jpg" alt="">
            </div>
            <div class="uk-card-body">
                <h3 class="uk-card-title"><?php echo $product['p_name'] ?></h3>
                <p><?php echo $product['p_coast'] ?></p>
              <button class="uk-button uk-button-default" type="button" uk-toggle="target: #modal-close-default">Узнать больше</button>
            </div>
        </div>
    </div>
   		<?php } ?>
   </div>
        </div>
    </div>

</div>
</body>
</html>