<div class="row">
    <div id="carousel-<?php echo $this->name; ?>" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            for ($i = 0; $i <= count($this->ids); $i++) {
                ?>
                <li data-target="#carousel-<?php echo $this->name; ?>" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? "active" : ""; ?>"></li>
                <?php
            }
            ?>

        </ol>
        <div class="carousel-inner">
            <?php
            $active = false;
            foreach (explode(",", $this->ids) as $id) {
                $curImage = wp_get_attachment_image_src($id, "large");
                if ($curImage) {
                    ?>
                    <div class="item<?php
                    if (!$active) {
                        echo ' active';
                        $active = true;
                    }
                    ?>">
                        <img src="<?php echo $curImage[0]; ?>" class="img-responsive"  alt="slider 1" />
                    </div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
        </div>

        <a class="left carousel-control" href="#carousel-<?php echo $this->name; ?>" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-<?php echo $this->name; ?>" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>