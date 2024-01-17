


<header class="navbar">
    <div class="logo">
        <a href="../../index.php"><img src="../../images/logo.png" alt="Logo"></a>
    </div>
    <div class="search">
        <form action="../vyhledavac.php" method="get">
            <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Vyhledat">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="icons">
        <i class="fa-solid fa-heart"></i>
        <a href="../../kosik.php"><i class="fa-solid fa-bag-shopping"></i></a>
        <a href="../../prihlaseni.php"><i class="fa-solid fa-user"></i></a>
    </div>
</header>