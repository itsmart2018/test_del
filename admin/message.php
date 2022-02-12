/*
Сделать меню для админа
*/
<?php if(isset($_SESSION["id"]) and $_SESSION["id"] == 1) ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/form.php">Добавить</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Просмотр</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/">Админ панель</a>
      </li>
    </ul>
  </div>
</nav>
<a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
<img width="25" src="Menu_icon.png" alt="">
</a>
<style>
    .navbar-nav {
        margin: 0 auto;
    }
    .nav-link {
        width: 100px;
        
    }
</style>