<section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Registration</h1>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.php?module=main">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">Products</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->     
    <script type="text/javascript" src="modules/products/view/js/products.js" ></script>
    <section id="registration" class="container">
        <div class="status alert alert-success" style="display: none"></div>
        <form id="form_products" name="form_products" method="post" class="center">
            <fieldset class="registration-form">
                <!--Product name input-->
                <div class="form-group">
                    <input type="text" id = "product_name" name="product_name" placeholder="Introduce product name" class="form-control" 
                    value="<?php
                        if (!isset($error['product_name'])) {
                            echo $_POST ? $_POST['product_name'] : "";
                        }
                        ?>" >
                    <div id="e_name"><?php
                        if (isset($error['product_name'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['product_name'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <!--TextArea description-->
                <div class="form-group">
                    <textarea type="textarea" id = "description" name="description" placeholder="Short product description" class="form-control"
                    value=""><?php
                        if (!isset($error['description'])) {
                            echo $_POST ? $_POST['description'] : "";
                        }
                        ?></textarea>
                    <div id="e_last_name"><?php
                        if (isset($error['description'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['description'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <!-- <div class="form-group">
                    <text class="form-control" id="dragndrop" name="dragndrop" rows="3" cols"50" placeholder="Future image drag & drop" readonly="readonly"></text>
                </div> -->
                <!--TextArea discharge_date-->
                <div class="form-group">
                    <input class="form-control" id="discharge_date" type="text"  name="discharge_date" placeholder="mm/dd/yyyy" readonly="readonly"
                    value="<?php
                        if (!isset($error['discharge_date'])) {
                            echo $_POST ? $_POST['discharge_date'] : "";
                        }
                        ?>">
                    <div id="e_birth_date"><?php
                        if (isset($error['discharge_date'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['discharge_date'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <!--TextArea expiry_date-->
                <div class="form-group">
                    <input class="form-control" id="expiry_date" type="text"  name="expiry_date" placeholder="mm/dd/yyyy" readonly="readonly"
                    value="<?php
                        if (!isset($error['expiry_date'])) {
                            echo $_POST ? $_POST['expiry_date'] : "";
                        }
                        ?>">
                    <div id="e_birth_date"><?php
                        if (isset($error['expiry_date'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['expiry_date'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <div class="form-group">
                    <!--Provincias -->
                </div>
                <!--Provide3r email field -->
                <div class="form-group">
                    <input type="text" id="provider_email" name="provider_email" class="form-control" placeholder="Introduce provider email" 
                    value="<?php
                        if (!isset($error['provider_email'])) {
                            echo $_POST ? $_POST['provider_email'] : "";
                        }
                        ?>">
                    <div id="e_email"><?php
                        if (isset($error['provider_email'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['provider_email'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <div class="form-group">
                    <input id="provider_phone" name = "provider_phone" type="text"  class="form-control" placeholder="Provider phone number" 
                    value="<?php
                        if (!isset($error['provider_phone'])) {
                            echo $_POST ? $_POST['provider_phone'] : "";
                        }
                        ?>">
                    <div id="e_provider_phone"><?php
                        if (isset($error['provider_phone'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['provider_phone'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <!--Product season -->
                <div class="form-group">
                    <p style="text-align:left;">Product season</p>
                    <input type="radio" id="season" name="season" value="Winter" >Winter</input>
					<input type="radio" id="season" name="season" value="Spring" >Spring</input>
					<input type="radio" id="season" name="season" value="Summer" >Summer</input>
					<input type="radio" id="season" name="season" value="Autumn" >Autumn</input>
					<input type="radio" id="season" name="season" value="Navidad" >Navidad</input>
					<div id="e_season"><?php
                        if (isset($error['season'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['season'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <!-- Product categories -->
                <div class="form-group">
                    <p style="text-align:left;">Product category</p>
                    <input style="text-align:left;" name="category[0]" type="checkbox" />Electronics<br>
					<input style="text-align:left;" name="category[1]" type="checkbox" />Home appliances<br>
					<input style="text-align:left;" name="category[2]" type="checkbox" />Electronic games<br>
					<input style="text-align:left;" name="category[3]" type="checkbox" />Smart appliances<br>
					<input style="text-align:left;" name="category[4]" type="checkbox" />Other<br>
					<div id="e_category"><?php
                        if (isset($error['category'])) {
                            print ("<BR><span style='color: #ff0000'>" . "* " . $error['category'] . "</span><br/>");
                        }
                        ?></div>
                </div>
                <!--Ask if has discount -->
                <div class="form-group">
                    <p style="text-align:left;">Product discount</p>
                    <input type="radio" id="discount" name="discount" value="yes"  >Yes</input>
					<input type="radio" id="discount" name="discount" value="no" >No</input>
                </div>
                <!--If has discount, how much? -->
                <div class="form-group">
                    <p style="text-align:left;">Product discount percent</p>
                    <input name="discount_percent" class="form-control" placeholder="Discount percent" type="text" id="discount_percent" 
                    value="<?php echo $_POST ? $_POST['discount_percent']:""; ?>" >
                </div>
                <div class="form-group">
                    <button type="button" id ="submit_products" name="submit_products" class="btn btn-success btn-md btn-block" value="submit">Submit</button>
                     
                </div>
            </fieldset>
        </form>
    </section><!--/#registration-->
