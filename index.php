<?php
    session_start();
    include "config.php";
    if(!($_GET["page"])){// если нет page - get параметр
    $str = 'Location: index.php?page=1';
    if($_GET["name"])
        $str .= '&name=' . $_GET["name"];
        header($str);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TABLE</title>
	<?php include "header.php" ?>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&amp;subset=cyrillic-ext" rel="stylesheet">
    <style>
        .card{
            flex-direction: row;
        }
         /*Table*/
       table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            border-spacing: 0;
            text-align: center;
            width: 100%;
            margin-top: 30px;
            margin-right:auto;
            margin-left:auto;
        }
        th {
            background: white;
            color: black;
            padding: 10px 20px;
        }
        th, td {
            border-color: #f69a73;
            text-align:  center;
        }
        th:last-child {
            border-right: none;
        }
        td {
            padding: 10px 20px;
            background: white;
        }
        .text1{
            margin-top: 15px;
            text-align: left;
        }
        .first_tr{
            border-top: 1px solid;
        }
        input{
            border-color: #EFEFEF;
            border-radius: 5px;
        }
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            color: #333;
        }
        .sort{
            display: flex;
        }
        .wrapper{
            width:1200px;
            margin: 0 auto;
            margin-bottom: 30px;
        }
        footer{
            margin-bottom: 100px;
        }
         /*Pagination*/
        .pagination {
            gap: 10px;
            margin: 0 auto;
            justify-content: center;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            display: flex;
            justify-content: center;
        }

        .pagination a.active {
            background-color: #e98583;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
            background-color: #e98583;
            border-radius: 5px;
        }
    </style>
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
        <div class="intro__inner" style="margin-top: 200px">
            <h2 class="intro__suptitle">Creative Template</h2>
            <h1 class="intro__title">Welcome to MoGo</h1>

            <a class="btn" href="#">Learn More</a>
        </div>
    </div>

    <div class="slider">
        <div class="container">
            <div class="slider__inner">
                <div class="slider__item active">
                    <span class="slider__num">01</span>
                    Intro
                </div>
                <div class="slider__item">
                    <span class="slider__num">02</span>
                    Work
                </div>
                <div class="slider__item">
                    <span class="slider__num">03</span>
                    About
                </div>
                <div class="slider__item">
                    <span class="slider__num">04</span>
                    Contacts
                </div>
            </div>
        </div>
    </div>

</div><!-- /.intro -->

<div class="wrapper">
                <div class="sort">
                    <form action="" method="get">
                        <div class="text1">Поиск</div>
                        <input type="text" name="name" >
                        <input type="submit" value="Поиск">
                    </form>
                </div>
                <table>
                  <tr>
                    <th>Имя</th>
                    <th>Оценка</th>
                    <th>Жанр</th>
                    <?php
                        if(isMobile())
                        echo"</tr><tr>";
                    ?>
                    <th <?php if(isMobile()) echo 'colspan="2"';?>>Разработчик</th>
                    <th>Удалить</th>
                  </tr>
                  <?php
                      $str="SELECT * FROM games,category where genre=c_id";
                      if($_GET['name']){
                        $str=$str . " and (name like '%" . $_GET["name"] . "%')";
                      }
                      $limit_kol = 2;
                      $limit_start = ((int)$_GET["page"] - 1) * $limit_kol;
                      $str .= " limit " . $limit_start . "," . $limit_kol;
                      $person_arr = mysqli_query($connection,$str);
                      while($games = mysqli_fetch_assoc($person_arr))
                      {
                        echo "<tr><form class='first_tr' action='setting.php' method='post'>";
                        echo "<td><a href='games_cards.php?games=". $games["id"] ."'>" . $games["name"] . "</a></td>";
                        echo "<td>" . $games["mark"] . "</td>";
                        echo "<td>" . $games["c_name"] . "</td>";
                        if(isMobile())
                            echo"</tr><tr>";
                            echo "<td ";
                        if(isMobile()) echo 'colspan="2"';
                            echo ">" . $games["dev"] . "</td>";
                            echo "<input type='hidden' name='id' value='". $games["id"] ."'>";
                        if(isset($_SESSION["id"]) and $_SESSION["id"] == 1)
                            echo "<td><input type='submit' name='delete_object' value='Удалить'>" .  "</td>";
                            echo "</form></tr>";
                      }
                  ?>
                 </table>

            <?php
                $pagination_kol = mysqli_fetch_assoc(mysqli_query($connection,"SELECT CEILING(COUNT(*)/" . $limit_kol . ") as kol FROM `games`"))['kol'];
                echo "<div class='pagination'>";
                for($i = 1;$i <= $pagination_kol;$i++){
                    echo "<a href ='/index.php?page=" . $i . "'";
                if($i == $_GET["page"])
                    echo 'class="active"';
                    echo ">" . $i . "</a>";
                }
                echo "</div>";
            ?>
        </div>
 <section class="section">
        <div class="container">

            <div class="section__header">
                <h3 class="section__suptitle">What we do</h3>
                <h2 class="section__title">Story about us</h2>
                <div class="section__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>

            <div class="card">
                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img">
                            <img src="/images/about/1.jpg" alt="">
                        </div>
                        <div class="card__text">super team</div>
                    </div>
                </div>

                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img">
                            <img src="/images/about/2.jpg" alt="">
                        </div>
                        <div class="card__text">super team</div>
                    </div>
                </div>

                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img">
                            <img src="/images/about/3.jpg" alt="">
                        </div>
                        <div class="card__text">super team</div>
                    </div>
                </div>
            </div>

        </div><!-- /.container -->
    </section>



    <div class="statistics">
        <div class="container">

            <div class="stat">
                <div class="stat__item">
                    <div class="stat__count">42</div>
                    <div class="stat__text">Web Design Projects</div>
                </div>
                <div class="stat__item">
                    <div class="stat__count">123</div>
                    <div class="stat__text">happy client</div>
                </div>
                <div class="stat__item">
                    <div class="stat__count">15</div>
                    <div class="stat__text">award winner</div>
                </div>
                <div class="stat__item">
                    <div class="stat__count">99</div>
                    <div class="stat__text">cup of coffee</div>
                </div>
                <div class="stat__item">
                    <div class="stat__count">24</div>
                    <div class="stat__text">members</div>
                </div>
            </div>

        </div>
    </div>



    <section class="section">
        <div class="container">

            <div class="section__header">
                <h3 class="section__suptitle">We work with</h3>
                <h2 class="section__title">Amazing Services</h2>
            </div>

            <div class="services">
                <div class="services__item  services__item--border">
                    <img class="services__icon" src="/images/services/photography.png" alt="">

                    <div class="services__title">Photography</div>
                    <div class="services__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</div>
                </div>
                <div class="services__item  services__item--border">
                    <img class="services__icon" src="/images/services/webdesign.png" alt="">

                    <div class="services__title">Web Design</div>
                    <div class="services__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</div>
                </div>
                <div class="services__item  services__item--border">
                    <img class="services__icon" src="/images/services/creativity.png" alt="">

                    <div class="services__title">Creativity</div>
                    <div class="services__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</div>
                </div>
                <div class="services__item">
                    <img class="services__icon" src="/images/services/seo.png" alt="">

                    <div class="services__title">seo</div>
                    <div class="services__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</div>
                </div>
                <div class="services__item">
                    <img class="services__icon" src="/images/services/css-html.png" alt="">

                    <div class="services__title">Css/Html</div>
                    <div class="services__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</div>
                </div>
                <div class="services__item">
                    <img class="services__icon" src="/images/services/digital.png" alt="">

                    <div class="services__title">digital</div>
                    <div class="services__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</div>
                </div>
            </div>

        </div><!-- /.container -->
    </section>



    <section class="section  section--devices">
        <div class="container">

            <div class="section__header">
                <h3 class="section__suptitle">For all devices</h3>
                <h2 class="section__title">Unique design</h2>
            </div>

            <div class="devices">
                <img class="devices__item" src="/images/ipad.png" alt="">
                <img class="devices__item  devices__item--iphone" src="/images/iphone.png" alt="">
            </div>

        </div>
    </section>



    <section class="section">
        <div class="container">

            <div class="section__header">
                <h3 class="section__suptitle">Service</h3>
                <h2 class="section__title">what we do</h2>
                <div class="section__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>

            <div class="wedo">
                <div class="wedo__item">
                    <img class="wedo__img" src="/images/wedo.jpg" alt="">
                </div>

                <div class="wedo__item">

                    <div class="accordion">
                        <div class="accordion__item">
                            <div class="accordion__header">
                                <img class="accordion__icon" src="/images/services/photography.png" alt="">
                                <div class="accordion__title">Photography</div>
                            </div>
                            <div class="accordion__content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>

                        <div class="accordion__item active">
                            <div class="accordion__header">
                                <img class="accordion__icon" src="/images/services/creativity.png" alt="">
                                <div class="accordion__title">Creativity</div>
                            </div>
                            <div class="accordion__content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <div class="accordion__header">
                                <img class="accordion__icon" src="/images/services/webdesign.png" alt="">
                                <div class="accordion__title">web design</div>
                            </div>
                            <div class="accordion__content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div><!-- /.accordion -->

                </div><!-- /.wedo__item -->
            </div><!-- /.wedo -->

        </div>
    </section>



    <div class="section  section--gray">
        <div class="container">

            <div class="reviews">
                <a class="reviews__btn  reviews__btn--prev" href="#">Prev</a>
                <a class="reviews__btn  reviews__btn--next" href="#">Next</a>

                <div class="reviews__item">
                    <img class="reviews__photo" src="/images/avatar.png" alt="">
                    <div class="reviews__text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.”</div>
                    <div class="reviews__author">Jon Doe</div>
                </div>
            </div>

        </div>
    </div>



    <section class="section">
        <div class="container">

            <div class="section__header">
                <h3 class="section__suptitle">Who we are</h3>
                <h2 class="section__title">Meet our team</h2>
                <div class="section__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>

            <div class="card">
                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img">
                            <img src="/images/team/1.jpg" alt="">
                        </div>
                        <div class="card__text">
                            <div class="social">
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card__info">
                        <div class="card__name">Matthew Dix</div>
                        <div class="card__prof">Graphic Design</div>
                    </div>
                </div><!-- /.card__item -->

                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img">
                            <img src="/images/team/2.jpg" alt="">
                        </div>
                        <div class="card__text">
                            <div class="social">
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card__info">
                        <div class="card__name">Christopher Campbell</div>
                        <div class="card__prof">Branding/UX design</div>
                    </div>
                </div><!-- /.card__item -->

                <div class="card__item">
                    <div class="card__inner">
                        <div class="card__img">
                            <img src="/images/team/3.jpg" alt="">
                        </div>
                        <div class="card__text">
                            <div class="social">
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                                <a class="social__item" href="#" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card__info">
                        <div class="card__name">Michael Fertig </div>
                        <div class="card__prof">Developer</div>
                    </div>
                </div><!-- /.card__item -->

            </div><!-- /.card -->

        </div><!-- /.container -->
    </section>



    <div class="section  section--gray">
        <div class="container">

            <div class="logos">
                <div class="logos__item">
                    <img class="logos__img" src="/images/logos/1.png" alt="">
                </div>
                <div class="logos__item">
                    <img class="logos__img" src="/images/logos/2.png" alt="">
                </div>
                <div class="logos__item">
                    <img class="logos__img" src="/images/logos/3.png" alt="">
                </div>
                <div class="logos__item">
                    <img class="logos__img" src="/images/logos/4.png" alt="">
                </div>
                <div class="logos__item">
                    <img class="logos__img" src="/images/logos/5.png" alt="">
                </div>
                <div class="logos__item">
                    <img class="logos__img" src="/images/logos/6.png" alt="">
                </div>
            </div>

        </div>
    </div>



    <section class="section">
        <div class="container">
            <div class="section__header">
                <h3 class="section__suptitle">What we do</h3>
                <h2 class="section__title">some of our work</h2>
                <div class="section__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>

        <div class="works">
            <div class="works__col">
                <div class="works__item">
                    <img class="works__image" src="/images/works/1.jpg" alt="">
                    <div class="works__info">
                        <div class="works__title">creatively designed</div>
                        <div class="works__text">Lorem ipsum dolor sit</div>
                    </div>
                </div>
                <div class="works__item">
                    <img class="works__image" src="/images/works/2.jpg" alt="">
                    <div class="works__info">
                        <div class="works__title">creatively designed</div>
                        <div class="works__text">Lorem ipsum dolor sit</div>
                    </div>
                </div>
            </div>

            <div class="works__col">
                <div class="works__item">
                    <img class="works__image" src="/images/works/3.jpg" alt="">
                    <div class="works__info">
                        <div class="works__title">creatively designed</div>
                        <div class="works__text">Lorem ipsum dolor sit</div>
                    </div>
                </div>
                <div class="works__item">
                    <img class="works__image" src="/images/works/4.jpg" alt="">
                    <div class="works__info">
                        <div class="works__title">creatively designed</div>
                        <div class="works__text">Lorem ipsum dolor sit</div>
                    </div>
                </div>
            </div>

            <div class="works__col">
                <div class="works__item">
                    <img class="works__image" src="/images/works/5.jpg" alt="">
                    <div class="works__info">
                        <div class="works__title">creatively designed</div>
                        <div class="works__text">Lorem ipsum dolor sit</div>
                    </div>
                </div>
            </div>

            <div class="works__col">
                <div class="works__item">
                    <img class="works__image" src="/images/works/6.jpg" alt="">
                    <div class="works__info">
                        <div class="works__title">creatively designed</div>
                        <div class="works__text">Lorem ipsum dolor sit</div>
                    </div>
                </div>
                <div class="works__item">
                    <img class="works__image" src="/images/works/7.jpg" alt="">
                    <div class="works__info">
                        <div class="works__title">creatively designed</div>
                        <div class="works__text">Lorem ipsum dolor sit</div>
                    </div>
                </div>
            </div>
        </div><!-- /.works -->
    </section>



    <div class="section">
        <div class="container">

            <div class="reviews">
                <a class="reviews__btn  reviews__btn--prev" href="#">Prev</a>
                <a class="reviews__btn  reviews__btn--next" href="#">Next</a>

                <div class="reviews__item">
                    <img class="reviews__photo" src="/images/avatar.png" alt="">
                    <div class="reviews__text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.”</div>
                    <div class="reviews__author">Jon Doe</div>
                </div>
            </div>

        </div>
    </div>



    <section class="section  section--clients">
        <div class="container">

            <div class="section__header">
                <h3 class="section__suptitle">Happy Clients</h3>
                <h2 class="section__title">What people say</h2>
            </div>

            <div class="clients">
                <div class="clients__item">
                    <img class="clients__photo" src="/images/clients/1.png" alt="">
                    <div class="clients__content">
                        <div class="clients__name">Matthew Dix</div>
                        <div class="clients__prof">Graphic Design</div>
                        <div class="clients__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</div>
                    </div>
                </div>

                <div class="clients__item">
                    <img class="clients__photo" src="/images/clients/2.png" alt="">
                    <div class="clients__content">
                        <div class="clients__name">Nick Karvounis</div>
                        <div class="clients__prof">Graphic Design</div>
                        <div class="clients__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</div>
                    </div>
                </div>

                <div class="clients__item">
                    <img class="clients__photo" src="/images/clients/3.png" alt="">
                    <div class="clients__content">
                        <div class="clients__name">Jaelynn Castillo </div>
                        <div class="clients__prof">Graphic Design</div>
                        <div class="clients__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</div>
                    </div>
                </div>

                <div class="clients__item">
                    <img class="clients__photo" src="/images/clients/4.png" alt="">
                    <div class="clients__content">
                        <div class="clients__name">Mike Petrucci</div>
                        <div class="clients__prof">Graphic Design</div>
                        <div class="clients__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</div>
                    </div>
                </div>
            </div><!-- /.clients -->

        </div><!-- /.container -->
    </section>



    <section class="section">
        <div class="container">

            <div class="section__header">
                <h3 class="section__suptitle">Our stories</h3>
                <h2 class="section__title">Latest blog</h2>
            </div>

            <div class="blog">
                <div class="blog__item">
                    <div class="blog__header">
                        <a href="#">
                            <img class="blog__photo" src="/images/blog/1.jpg" alt="">
                        </a>
                        <div class="blog__date">
                            <div class="blog__date-day">15</div>
                            Jan
                        </div>
                    </div>
                    <div class="blog__content">
                        <div class="blog__title">
                            <a href="#">Lorem ipsum dolor sit amet</a>
                        </div>
                        <div class="blog__text">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                    <div class="blog__footer">
                        <div class="blog-stat">
                            <span class="blog-stat__item">
                                <i class="far fa-eye"></i> 542
                            </span>
                            <span class="blog-stat__item">
                                <i class="far fa-comment-dots"></i> 17
                            </span>
                        </div>
                    </div>
                </div>

                <div class="blog__item">
                    <div class="blog__header">
                        <a href="#">
                            <img class="blog__photo" src="/images/blog/2.jpg" alt="">
                        </a>
                        <div class="blog__date">
                            <div class="blog__date-day">15</div>
                            Jan
                        </div>
                    </div>
                    <div class="blog__content">
                        <div class="blog__title">
                            <a href="#">Lorem ipsum dolor sit amet</a>
                        </div>
                        <div class="blog__text">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                    <div class="blog__footer">
                        <div class="blog-stat">
                            <span class="blog-stat__item">
                                <i class="far fa-eye"></i> 542
                            </span>
                            <span class="blog-stat__item">
                                <i class="far fa-comment-dots"></i> 17
                            </span>
                        </div>
                    </div>
                </div>

                <div class="blog__item">
                    <div class="blog__header">
                        <a href="#">
                            <img class="blog__photo" src="/images/blog/3.jpg" alt="">
                        </a>
                        <div class="blog__date">
                            <div class="blog__date-day">15</div>
                            Jan
                        </div>
                    </div>
                    <div class="blog__content">
                        <div class="blog__title">
                            <a href="#">Lorem ipsum dolor sit amet</a>
                        </div>
                        <div class="blog__text">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                    <div class="blog__footer">
                        <div class="blog-stat">
                            <span class="blog-stat__item">
                                <i class="far fa-eye"></i> 542
                            </span>
                            <span class="blog-stat__item">
                                <i class="far fa-comment-dots"></i> 17
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- /.blog -->

        </div><!-- /.container -->
    </section>



    <section class="section  section--map">
        <div class="container">
            <div class="map">
                <h2 class="map__title">
                    <div><i class="fas fa-map-marker-alt"></i></div>
                    <a href="https://goo.gl/maps/F8YpeCGqwrG2" target="_blank">Open Map</a>
                </h2>
            </div>
        </div>
    </section>




    <footer class="footer">
        <div class="container">

            <div class="footer__inner">
                <div class="footer__col  footer__col--first">
                    <div class="footer__logo">MoGo</div>
                    <div class="footer__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>

                    <div class="footer__social">
                        <div class="footer__social-header">
                            <b>15k</b> followers
                        </div>
                        <div class="footer__social-content">
                            Follow Us:
                            <a href="#" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <form class="subscribe" action="/" method="post">
                        <input class="subscribe__input" type="email" name="name" placeholder="Your Email...">
                        <button class="subscribe__btn" type="submit">Subscribe</button>
                    </form>
                </div><!-- /.footer__col -->

                <div class="footer__col  footer__col--second">
                    <div class="footer__title">Blogs</div>

                    <div class="blogs">
                        <div class="blogs__item">
                            <img class="blogs__img" src="/images/blog/1.jpg" alt="">
                            <div class="blogs__content">
                                <a class="blogs__title" href="#">Lorem ipsum dolor sit amet, consectetur adipiscing</a>
                                <div class="blogs__date">Jan 9, 2016</div>
                            </div>
                        </div>

                        <div class="blogs__item">
                            <img class="blogs__img" src="/images/blog/2.jpg" alt="">
                            <div class="blogs__content">
                                <a class="blogs__title" href="#">Lorem ipsum dolor</a>
                                <div class="blogs__date">Jan 9, 2016</div>
                            </div>
                        </div>

                        <div class="blogs__item">
                            <img class="blogs__img" src="/images/blog/3.jpg" alt="">
                            <div class="blogs__content">
                                <a class="blogs__title" href="#">Lorem ipsum dolor sit amet, consectetur adipiscing</a>
                                <div class="blogs__date">Jan 9, 2016</div>
                            </div>
                        </div>
                    </div><!-- /.blogs -->
                </div>

                <div class="footer__col  footer__col--third">
                    <div class="footer__title">Instagram</div>

                    <div class="instagram">
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/1.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/2.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/3.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/4.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/5.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/6.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/7.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/8.jpg" alt="">
                        </a>
                        <a class="instagram__item" href="#" target="_blank">
                            <img src="/images/instagram/9.jpg" alt="">
                        </a>
                    </div>
                </div>

            </div><!-- /.footer__inner -->

            <div class="copyright">
                © 2016 MoGo free PSD template by <span>Laaqiq</span>
            </div>

        </div><!-- /.container -->
    </footer>

</div><!-- /.page -->


</body>
</html>
