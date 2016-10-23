<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>View Products</h1>
                <p>Click on product to see details</p>
            </div>
            <div class="col-sm-6">
                <ul class="breadcrumb pull-right">
                    <li><a href="index.php?module=main">Home</a></li>
                    <li>Products</li>
                    <li class="active">View</li>
                </ul>
            </div>
        </div>
    </div>
</section><!--/#title-->
<section >
    <div class="container">
        <div id="list_prod" class="row text-center pad-row">
            <?php
            if (isset($arrData) && !empty($arrData)) {
                foreach ($arrData as $product) {
                    //echo $productos['id'] . " " . $productos['nombre'] . "</br>";
                    //echo $productos['descripcion'] . " " . $productos['precio'] . "</br>";
                    ?>
                    <a id="prod" href="index.php?module=products&idProduct=<?php echo $product['id'] ?>" >
                        <img class="prodImg" src=<?php echo $product['avatar'] ?> alt="product" >
                        <p><?php echo $product['product_name'] ?></p>
                        <p id="p2"><?php echo $product['price'] ?>€</p>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
