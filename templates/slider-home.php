<div id="home-carousel" class="carousel slide carousel-fade home-carousel" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#home-carousel" data-slide-to="1"></li>
        <li data-target="#home-carousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php
        include("slides/slide-1.php");
        include("slides/slide-2.php");
        include("slides/slide-3.php");
        ?>
    </div>

    <a class="left carousel-control" href="#home-carousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#home-carousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
