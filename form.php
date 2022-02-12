<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ADD</title>
	<?php include "header.php" ?>
	<link rel="stylesheet" href="style.css">
</head>
<body>
   <header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="header__logo">MoGo</div>
            <nav class="nav">
                <a class="nav__link" href="index.php">Table</a>
                <a class="nav__link" href="admin/index.php">Admin Panel</a>
                <a class="nav__link active" href="form.php">Add</a>
            </nav>
        </div>
    </div>
</header>
<div class="intro">
    <div class="container">
        <div class="intro__inner" style="margin-top: 200px">
            <form class="decor" method="post" action="setting.php">
               <div class="form-inner">
                  <h3>Добавить</h3>
                  <input type="text" name="name" placeholder="Введите имя" required>
                  <input type="number" min="0" max="10" name="mark" placeholder="Введите оценку" required>
                  <!--<input type="text" name="genre"  maxlength="40" placeholder="Введите жанр" required>-->
                  <input type="text" name="dev"  maxlength="40" placeholder="Введите разработчика" required>
                  <p class="text">Выберите жанр:</p>
                  <select name="genre" required>
                      <?php
                         $person_arr = mysqli_query($connection,'select * FROM category');
                         while($category = mysqli_fetch_assoc($person_arr))
                                { //var_dump($category);
                                   echo "<option value='". $category['c_id'] ."'>". $category['c_name'] ."</option>";
                                }
                      ?>
                  </select>
                  <input type="submit" name="add_object" value="Отправить">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php include "footer.php" ?>
<style>
 /*Form*/
        form{
          margin-top: 50px;
        }
        * {
           box-sizing: border-box;
        }
        .decor {
           position: relative;
           max-width: 400px;
           margin: 50px auto 0;
           background: white;
           border-radius: 30px;
        }
        .form-inner {
           padding: 50px;
        }
        .form-inner input, .form-inner textarea {
           display: block;
           width: 100%;
           padding: 0 20px;
           margin-bottom: 10px;
           background: #E9EFF6;
           line-height: 40px;
           border-width: 0;
           border-radius: 20px;
           font-family: 'Roboto', sans-serif;
        }
        .form-inner input[type="submit"] {
           margin-top: 30px;
           background: #f69a73;
           border-bottom: 4px solid #d87d56;
           color: white;
           font-size: 14px;
        }
        .form-inner textarea {
           resize: none;
        }
        .form-inner h3 {
           margin-top: 0;
           font-family: 'Roboto', sans-serif;
           font-weight: 500;
           font-size: 24px;
           color: #707981;
        }
        select{
            width: 100%;
            border-radius: 20px;
            background: #E9EFF6;
            border: none;
            height: 40px;
            padding: 0 20px;
            font-family: 'Roboto', sans-serif;
            color: #787689;

        }
        .text{
            padding: 0 20px;
            font-family: 'Roboto', sans-serif;
            color: #787689;
            text-align: left;
        }
</style>
</body>
</html>