<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Detail Product</h1>
                <p>Detail of the selected product</p>
            </div>
            <div class="col-sm-6">
                <ul class="breadcrumb pull-right">
                    <li><a href="index.php?module=main">Home</a></li>
                    <li>Products</li>
                    <li><a href="index.php?module=products">View</a></li>
                    <li class="active">Detail</li>
                </ul>
            </div>
        </div>
    </div>
</section><!--/#title-->
<section >
    <div class="container">
        <div id="details_prod" class="row text-center pad-row">
            <?php
            //print_r($producto);
            //die();
            if (isset($arrData) && !empty($arrData)) {
                ?>
                <div id="details" class="col-md-4  col-sm-4">
                    <!--<i class="fa fa-desktop fa-5x"></i>-->
                    <!--<img src="view/img/product.jpg" alt="product" height="70" width="70">-->
                    <img class="prodImg" src="<?php echo $arrData['avatar'] ?>" alt="product">

                    <div id="container">
                        <h4> <strong><?php echo $arrData['name'] ?></strong> </h4>
                        <br />
                        <p>
                            <strong>Description: <br/></strong><?php echo $arrData['description'] ?>
                        </p>
                        <p>
                            <strong>Titration:</strong> <?php echo $arrData['titration'] ?>
                        </p>
                        <h2> <strong>Price: <?php echo $arrData['price'] ?>€</strong> </h5>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
