<?php session_start(); 
include "../config.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?php include "../header.php" ?>
	<title>ADMIN PANEL</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
	<style>
        .btn{
            display: inline-block;
            vertical-align: top;
            padding: 8px 30px;
            border: 3px solid #fff;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            text-decoration: none;
            transition: background .1s linear, color .1s linear;
        }
        .btn:hover {
            background-color: #fff;
            color: #333;
        }
        span{
            font-size: 40px;
            text-align: center;
            color: yellow;
        }
        .header_menu{
            height:  200px;

        }
        .header_menu p{
            font-size: 50px;

        }
	</style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__logo">MoGo</div>
                <nav class="nav">
                    <a class="nav__link" href="../index.php">Table</a>
                    <a class="nav__link active" href="index.php">Admin Panel</a>
                    <a class="nav__link" href="../form.php">Add</a>
                </nav>
            </div>
        </div>
    </header>
    <div class="intro">
        <div class="container">
            <div class="intro__inner">
                <?php if($_SESSION['id']){ ?>
                                <div class="header_menu">
                                <?php echo "<p>Вы авторизированны как</p><span>" . $_SESSION['name'] . "</span>" ?>
                                </div>
                                  <a class="btn" href="logout.php" class="btn btn-sm animated-button gibson-two">Logout</a>
                                            <div class="section" id="games">
                                                <div class="header_text">Настройки</div>
                                                    <table>
                                                        <tr>
                                                            <th>Имя</th>
                                                            <th>Оценка</th>
                                                            <th>Жанр</th>
                                                            <th>Разработчик</th>
                                                            <th>Добавить/Сохранить</th>
                                                            <th>Удалить</th>
                                                        </tr>
                                                        <?php
                                                            echo "<tr><form class='first_tr' action='setting.php' method='post'>";
                                                            echo "<td><input required name='name' value='" .$games["name"] . "'></td>";
                                                            echo "<td><input required name='mark' value=''></td>";


                                                           echo "<td><select name='genre' required>";
                                                                $person_arr = mysqli_query($connection,'select * FROM category');
                                                                 while($category = mysqli_fetch_assoc($person_arr))
                                                                { //var_dump($category);
                                                                   echo "<option";
                                                                if($games['genre'] == $category['c_id']) echo " selected";
                                                                   echo " value='". $category['c_id'] ."';>". $category['c_name'] ."</option>";
                                                                }
                                                                echo "</select></td>";
                                                            echo "<td><input required name='dev' value=''></td>";
                                                            echo "<td><input type='submit' name='add_person' value='Добавить'>" .  "</td>";
                                                            echo "</form></tr>";
                                                        ?>
                                                        <?php
                                                            $str="SELECT * FROM games,category where genre=c_id";
                                                            $person_arr = mysqli_query($connection,$str);
                                                            while($games = mysqli_fetch_assoc($person_arr))
                                                            {
                                                                echo "<tr><form class='first_tr' action='setting.php' method='post'>";
                                                                echo "<td><input name='name' value='" .$games["name"] . "'></td>";
                                                                echo "<td><input name='mark' value='" .$games["mark"] . "'></td>";
                                                                echo "<td><select name='genre' class='select' required>";
                                                                $person_arr1 = mysqli_query($connection,'select * FROM category');
                                                                 while($category = mysqli_fetch_assoc($person_arr1))
                                                                { //var_dump($category);
                                                                   echo "<option";
                                                                   if($games['genre'] == $category['c_id']) echo " selected";
                                                                   echo " value='". $category['c_id'] ."';>". $category['c_name'] ."</option>";
                                                                }
                                                                echo "</select></td>";
                                                                echo "<td><input name='dev' value='" .$games["dev"] . "'></td>";
                                                                echo "<input type='hidden' name='id' value='". $games["id"] ."'>";
                                                                echo "<td><input type='submit' name='save_object' value='Сохранить'>" .  "</td>";
                                                                echo "<td><input type='submit' name='delete_object' value='Удалить'>" .  "</td>";

                                                                echo "</form></tr>";
                                                            }
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                            <?php
                                                } else {
                                            ?>
                                        <h2>Login</h2>
                                        <form id="login-form" method="post" action="login.php">
                                            <p>
                                                <input input type="text" name="login" value="" placeholder="Логин или Email" required><i class="validation"><span></span><span></span></i>
                                            </p>
                                            <p>
                                                <input type="password" name="password" value="" placeholder="Пароль" required><i class="validation"><span></span><span></span></i>
                                            </p>
                                            <p>
                                                <input type="submit" name="login_button" value="Войти">
                                            </p>
                                        </form>
                                        <div id="create-account-wrap">
                                            <p>Not a member? <a href="#">Create Account</a><p>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
</body>
</html>