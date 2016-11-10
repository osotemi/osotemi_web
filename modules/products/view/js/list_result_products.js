////////////////////////////////////////////////////////////////
function load_products_ajax() {
    //console.log("Are in list_products");
    //console.log(data);
    $.ajax({
        type: 'GET',
        url: "modules/products/controller/controller_products.class.php?load=true",
        //dataType: 'json',
        async: false
    }).success(function (data) {

        var json = JSON.parse(data);

        //alert(json.user.usuario);

        list_products(json);

    }).fail(function (xhr) {
        alert(xhr.responseText);
    });
}

////////////////////////////////////////////////////////////////
/*
function load_users_get_v1() {
    $.get("modules/users/controller/controller_users.class.php?load=true", function (data, status) {
        var json = JSON.parse(data);
        //$( "#content" ).html( json.msje );
        //alert("Data: " + json.user.usuario + "\nStatus: " + status);

        list_products(json);
    });
}

////////////////////////////////////////////////////////////////
function load_users_get_v2() {
    var jqxhr = $.get("modules/users/controller/controller_users.class.php?load=true", function (data) {
        var json = JSON.parse(data);
        console.log(json);
        list_products(json);
        //alert( "success" );
    }).done(function () {
        //alert( "second success" );
    }).fail(function () {
        //alert( "error" );
    }).always(function () {
        //alert( "finished" );
    });

    jqxhr.always(function () {
        //alert( "second finished" );
    });
}
*/
$(document).ready(function () {
    load_products_ajax();
    //load_users_get_v1();
    //load_users_get_v2();
});

function list_products(data) {
    var content = document.getElementById("content");
    var div_product = document.createElement("div");
    var parrafo = document.createElement("p");
    console.log("entrar entra");
    var msje = document.createElement("div");
    msje.innerHTML = "msje = ";
    msje.innerHTML += data.msje;

    var product_name = document.createElement("div");
    product_name.innerHTML = "Product name = ";
    product_name.innerHTML += data.product.product_name;

    var price = document.createElement("div");
    price.innerHTML = "Price = ";
    price.innerHTML += data.product.price + " €";

    var description = document.createElement("div");
    description.innerHTML = "Description = ";
    description.innerHTML += data.product.description;

    var discharge_date = document.createElement("div");
    discharge_date.innerHTML = "Discharge date = ";
    discharge_date.innerHTML += data.product.discharge_date;

    var expiry_date = document.createElement("div");
    expiry_date.innerHTML = "Expiry date = ";
    expiry_date.innerHTML += data.product.expiry_date;

    var provider_email = document.createElement("div");
    provider_email.innerHTML = "provider_email = ";
    provider_email.innerHTML += data.product.provider_email;

    var provider_phone = document.createElement("div");
    provider_phone.innerHTML = "Provider phone = ";
    provider_phone.innerHTML += data.product.provider_phone;

    console.log("Hasta pais");

    var country = document.createElement("div");
    country.innerHTML = "country = ";
    country.innerHTML += data.product.country;

    var province = document.createElement("div");
    province.innerHTML = "province = ";
    province.innerHTML += data.product.province;

    var city = document.createElement("div");
    city.innerHTML = "city = ";
    city.innerHTML += data.product.city;

    var season = document.createElement("div");
    season.innerHTML = "Season = " + data.product.season;
    //for(var i =0;i < data.product.season.length;i++){
    //    season.innerHTML += data.product.season[i];
    //}

    var category = document.createElement("div");
    category.innerHTML = "Category = ";
    //console.log(data.product.category);
    for(var i =0;i < data.product.category.length;i++){
        category.innerHTML += "<br> - "+data.product.category[i];
    }

    //arreglar ruta IMATGE!!!!!

    var cad = data.product.avatar;
    //console.log(cad);
    //var cad = cad.toLowerCase();
    var img = document.createElement("div");
    var html = '<img src="' + cad + '" height="75" width="75"> ';
    img.innerHTML = html;
    //alert(html);
    console.log(html);
    div_product.appendChild(parrafo);
    parrafo.appendChild(msje);
    parrafo.appendChild(product_name);
    parrafo.appendChild(price);
    parrafo.appendChild(description);
    parrafo.appendChild(discharge_date);
    parrafo.appendChild(expiry_date);
    parrafo.appendChild(provider_email);
    parrafo.appendChild(provider_phone);
    parrafo.appendChild(country);
    parrafo.appendChild(province);
    parrafo.appendChild(city);
    parrafo.appendChild(category);
    parrafo.appendChild(season);
    content.appendChild(div_product);
    content.appendChild(img);
    console.log(html);
}
