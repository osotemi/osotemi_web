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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
    <link rel="stylesheet" href="view/css/form.css">
    <section id="registration" class="container">
        <div class="status alert alert-success" style="display: none"></div>
        <form id="form_products" name="form_products" class="center">
            <fieldset class="registration-form">
                <!--Product name input-->
                <div class="form-group">
                    <input type="text" id = "product_name" name="product_name" placeholder="Introduce product name" class="form-control" >
                    <div id="e_name"></div>
                </div>
                <div class="form-group">
                    <p style="text-align:left;">Price</p>
                    <input type="text" id="price" name="price" class="form-control" placeholder="0€"  >
                </div>
                <!--TextArea description-->
                <div class="form-group">
                    <textarea type="textarea" id = "description" name="description" placeholder="Short product description" class="form-control"></textarea>
                    <div id="e_last_name"></div>
                </div>
                <!-- <div class="form-group">
                    <text class="form-control" id="dragndrop" name="dragndrop" rows="3" cols"50" placeholder="Future image drag & drop" readonly="readonly"></text>
                </div> -->
                <!--TextArea discharge_date-->
                <div class="form-group">
                    <input class="form-control" id="discharge_date" type="text"  name="discharge_date" placeholder="mm/dd/yyyy" readonly="readonly">
                    <div id="discharge_date"></div>
                </div>
                <!--TextArea expiry_date-->
                <div class="form-group">
                    <input class="form-control" id="expiry_date" type="text"  name="expiry_date" placeholder="mm/dd/yyyy" readonly="readonly">
                    <div id="expiry_date"></div>
                </div>
                <div class="form-group">
                    <!--Provincias -->
                </div>
                <!--Provider email field -->
                <div class="form-group">
                    <input type="text" id="provider_email" name="provider_email" class="form-control" placeholder="Introduce provider email">
                    <div id="e_email"></div>
                </div>
                <div class="form-group">
                    <input id="provider_phone" name = "provider_phone" type="text"  class="form-control" placeholder="Provider phone number">
                    <div id="e_provider_phone"></div>
                </div>
                <!--Product season -->
                <div class="form-group">
                    <p style="text-align:left;">Product season</p>
                    <input type="radio" id="season" name="season" value="Winter" class="radioBox">Winter</input>
  					<input type="radio" id="season" name="season" value="Spring" class="radioBox">Spring</input><br>
  					<input type="radio" id="season" name="season" value="Summer" class="radioBox">Summer</input><br>
  					<input type="radio" id="season" name="season" value="Autumn" class="radioBox">Autumn</input><br>
  					<input type="radio" id="season" name="season" value="Navidad" class="radioBox">Navidad</input><br>
  					<input type="radio" id="season" name="season" value="All" class="radioBox" checked="checked">All</input><br>
  					<div id="e_season"></div>
                </div>
                <!-- Product categories -->
                <div class="form-group">
                    <p style="align:left;">Product category</p>
                    <input style="text-align:left;" name="category[0]" type="checkbox" class="checkBox" value="Electronics"/>Electronics<br>
  					<input style="text-align:left;" name="category[1]" type="checkbox" class="checkBox" value="Home appliances"/>Home appliances<br>
  					<input style="text-align:left;" name="category[2]" type="checkbox" class="checkBox" value="Electronic games"/>Electronic games<br>
  					<input style="text-align:left;" name="category[3]" type="checkbox" class="checkBox" value="Smart appliances"/>Smart appliances<br>
  					<input style="text-align:left;" name="category[4]" type="checkbox" class="checkBox" value="Other"/>Other<br>
  					<div id="e_category"></div>
                </div>
                <!--Ask if has discount
                <div class="form-group">
                    <p style="text-align:left;">Product discount</p>
                    <input type="radio" id="discount" name="discount" value="yes"  >Yes</input>
					          <input type="radio" id="discount" name="discount" value="no" >No</input>
                </div>
                -->
                <!--If has discount, how much?

                <div class="form-group">
                    <p style="text-align:left;">Product discount percent</p>
                    <input id="discount_percent" name="discount_percent" class="form-control" placeholder="Discount percent" type="text" id="discount_percent">
                </div>
                -->
                <br />
                <br />
                <div class="form-group" id="progress">
                    <div id="bar"></div>
                    <div id="percent">0%</div >
                </div>
                <div class="msg"></div>
                <br/>
                <div id="dropzone" class="dropzone"></div><br/>
                <br/>
                <br/>

                <div class="form-group">
                    <button type="button" id ="submit_products" name="submit_products" class="btn btn-success btn-md btn-block" value="submit">Submit</button>

                </div>
            </fieldset>
        </form>
    </section><!--/#registration-->
