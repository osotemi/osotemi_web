<script type="text/javascript" src="modules/products_FE/view/js/jquery.bootpag.min.js"></script>
<script type="text/javascript" src="modules/products_FE/view/js/list_products.js" ></script>
<div id="results"></div>

<center>
<form name="search_prod" id="search_prod" class="search_prod">
    <input type="text" value="" placeholder="Search Product ..." class="input_search" id="keyword" list="datalist">
    <!-- <div id="results_keyword"></div> -->
    <input name="Submit" id="Submit" class="button_search" type="button" />

</form>
</center>

<div id="results"></div>

<center>
    <div class="pagination_prods"></div>
</center>

<!-- modal window  -->

<section >
    <div class="container" id="product">


        <div class="media">
            <div class="pull-left">
                <div id="img_product" class="img_product"></div>
            </div>
            <div class="media-body">
                <div id="text-product">
                <h3 class="media-heading title-product"  id="nom_product"></h3>
                <p class="text-limited" id="desc_product" ></p>
                <br>
                <h5 > <strong  id="price_product"></strong> </h5>
                </div>

            </div>
        </div>


    </div>
</section>
