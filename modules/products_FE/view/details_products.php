<section >
    <div class="container">

        <?php
        if (isset($arrData) && !empty($arrData)) {
            ?>
            <div class="media">
                <div class="pull-left">
                    <img src="<?php echo $arrData['img']?>" class="img-product" >
                </div>
                <div class="media-body">
                    <h3 class="media-heading title-product"><?php echo $arrData['nombre'] ?></h3>
                    <p class="text-limited"><?php echo $arrData['descripcion'] ?></p>
                    <br>
                    <h5 class="special"> <strong>Price of product: <?php echo $arrData['precio'] ?>€</strong> </h5>


                </div>
            </div>
            <?php
        }
        ?>

    </div>
</section>
