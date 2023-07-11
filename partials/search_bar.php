<section class="search__bar">
    <img class="nature-12" src="images/nature-12.png" alt="banana">
    <img class="nature-1" src="images/nature-1.png" alt="strawberry">


    <form class="container search__bar-container" action="<?= ROOT_URL ?>search.php" method="GET">
        <div>
            <i class="uil uil-search"> </i>
            <input class="search__input" type="search" name="search" placeholder="Search your recipes here..">
        </div>
        <button type="submit" name="submit" class="btn">Go</button>

    </form>

</section>