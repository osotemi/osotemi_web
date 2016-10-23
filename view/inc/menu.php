<div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="view/img/logo.png" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class= <?php if($_GET['module'] == "main"){ echo "active";}else{ echo "";} ?> >
                        <a href="index.php?module=main">Home</a>
                    </li>
                    <li class="dropdown <?php if($_GET['module'] == "products"){ echo "active";}else{ echo "";} ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products<i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?module=products&view=create_products">Create</a></li>
                            <li><a href="index.php?module=products">View</a></li>
                        </ul>
                    </li>
                    <!--
                    <li class= <?php/* if($_GET['module'] == "products"){ echo "active";}else{ echo "";} */?> >
                        <a href="index.php?module=products&view=create_products">Products</a>
                    </li>
                    -->
                    <li class= <?php if($_GET['module'] == "pricing"){ echo "active";}else{ echo "";} ?> >
                        <a href="index.php?module=pricing">Pricing</a>
                    </li>
                    <li class= <?php if($_GET['module'] == "services"){ echo "active";}else{ echo "";} ?> >
                        <a href="index.php?module=services">Services</a>
                    </li>
                    <li class= <?php if($_GET['module'] == "portfolio"){ echo "active";}else{ echo "";} ?> >
                        <a href="index.php?module=portfolio">Portfolio</a>
                    </li>
                    <li class= <?php if($_GET['module'] == "contact"){ echo "active";}else{ echo "";} ?> >
                        <a href="index.php?module=contact">Contact</a>
                    </li>

                </ul>
            </div>
        </div>
    </header><!--/header-->
