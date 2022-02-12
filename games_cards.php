<?php include "config.php";
    if($_GET['games']){
        $str="SELECT * FROM games,category where genre=c_id and games.id=" .$_GET['games'];
        /*echo $str;*/
        $games_cards = mysqli_fetch_assoc(mysqli_query($connection,$str));
        $str="SELECT * FROM `message` where m_out_id=" . $games_cards['id'];
        $person_message = mysqli_query($connection,$str);
    }
    else{
        $error=1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
	    <?php
	        if($error){
	            echo "404";
	        }
	        else {
                echo $games_cards['id'] . " - " . $games_cards['name'];
            }
	    ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Document</title>
	<?php include "header.php" ?>
	<link rel="stylesheet" href="style.css">
</head>
<body>
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
            <div class="wrapper_card">
                <?php
                    if($error){
                        echo "<h1>404</h1>";
                    }
                    else{
                ?>
                <div class="container">
                    <div class="content">
                        <div class="line">
                            <div class="line_img">
                                <!--http://placehold.it/350x350*/-->
                                <img src="\images\card\<?php
                                if($games_cards['g_image'])
                                    echo $games_cards['g_image'];
                                else
                                    echo "default.jpg";
                                ?>"/>
                            </div>
                            <div class="line_text">
                                <h2><?php echo $games_cards['name']; ?></h2>
                                <div class="info">
                                    Оценка: <span><?php echo $games_cards['mark'] ?></span>
                                </div>
                                <div class="info">
                                    Жанр: <span><?php echo $games_cards['c_name']; ?></span>
                                </div>
                                <div class="info">
                                    Разработчик: <span><?php echo $games_cards['dev'] ?></span>
                                </div>
                                <div class="line message">
                                    <h4>Последние сообщения</h4>
                                    <?php
                                        while($message = mysqli_fetch_assoc($person_message))
                                    { ?>
                                    <div class="article">
                                         <div class="art_description">
                                            <?php echo $message['m_message']; ?>
                                         </div>
                                         <div class="art_date"><?php echo $message['m_date']; ?></div>
                                    </div>
                                    <?php  } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>

  <style>
    	body {
            background: #f69a73;
        }
	    .wrapper_card{
            width:1000px;
            margin: 0 auto;
        }
	    .content{
	        width: 100%;
	        border: 2px solid black;
	        padding: 30px;
	        margin-top: 40px;
	        box-shadow:0px 0px 15px black;
	        background-color: white;
	    }
	    .line{
	        display: flex;
	         width: 100%;
	    }
        .line_text{
	        padding: 20px;
	        width: 50%;
            text-align: left;
	    }
	    .line.message{
	        display: block;
	        margin-top: 10px;
	    }
	    .line.message .article{
	        width: 100%
	        margin: 12px;
	    }
	    .line.message .art_date{
    	    font-size: 8px;
    	    color: #888;
            margin: 12px;
	    }
	    .info{
	        font-size: 26px;
	    }
	   .article{
	       display:flex;
           margin-top: 10px;
	   }
	   .line_img img{
	       height: 300px;
	       width: 100%;
	   }
	   @media (max-width: 710px){
           .line_img img{
        	   height:70px;
        	   width: 100%;
	       }
           
       }
       @media (max-width: 890px){
            .line_img img{
    	       height:170px;
    	       width: 100%;
	        }
           
       }
       @media (max-width: 995px){
            .wrapper_card{
               width: 900px;
            }

       }
       @media (max-width: 900px){
            .wrapper_card{
               width: 700px;
            }

       }
       @media (max-width: 700px){
            .wrapper_card{
               width: 500px;
            }

       }
       h2{
            margin-bottom: 20px;
       }
	</style>
<?php include "footer.php" ?>
</body>
</html>