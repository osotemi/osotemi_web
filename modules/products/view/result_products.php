<section id="contact-page">
    <div class="container">
        <div class="center">        
            <h2>ADD PRODUCT</h2>
            <p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div> 
        <div class="row contact-wrap"> 
            <div class="status alert alert-success" style="display: none"></div>
            <?php
            $product = $_SESSION['product'];
            $message = $_SESSION['message'];

            foreach ($product as $indice => $valor) {
                if ($indice == 'category') {
                    echo "<br><b>Interests:</b><br>";
                    $category = $product['category'];
                    foreach ($category as $indice => $valor) {
                        echo "<b>---> $indice</b>: $valor<br>";
                    }
                } else {
                    echo "<br><b>$indice</b>: $valor";
                }
            }
            echo "<br>" . "<b style='color:green'>" . $message;
            ?>
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#contact-page-->