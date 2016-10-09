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
    alert(data.product);
    var content = document.getElementById("content");
    var div_product = document.createElement("div");
    var parrafo = document.createElement("p");

    var msje = document.createElement("div");
    msje.innerHTML = "msje = ";
    msje.innerHTML += data.msje;
    
    var product_name = document.createElement("div");
    product_name.innerHTML = "Product name = ";
    product_name.innerHTML += data.product.product_name;
    
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
    /*
    var user = document.createElement("div");
    user.innerHTML = "user = ";
    user.innerHTML += data.user.user;
    
    var pass = document.createElement("div");
    pass.innerHTML = "pass = ";
    pass.innerHTML += data.user.pass;

    var email = document.createElement("div");
    email.innerHTML = "email = ";
    email.innerHTML += data.user.email;
    
    var en_lvl = document.createElement("div");
    en_lvl.innerHTML = "en_lvl = ";
    en_lvl.innerHTML += data.user.en_lvl;
    
    var interests = document.createElement("div");
    interests.innerHTML = "interests = ";
    for(var i =0;i < data.user.interests.length;i++){
    interests.innerHTML += " - "+data.user.interests[i];
    }
    */
    //arreglar ruta IMATGE!!!!!
    
    var cad = data.product.avatar;
    //console.log(cad);
    //var cad = cad.toLowerCase();
    var img = document.createElement("div");
    var html = '<img src="' + cad + '" height="75" width="75"> ';
    img.innerHTML = html;
    //alert(html);

    div_product.appendChild(parrafo);
    parrafo.appendChild(msje);
    parrafo.appendChild(product_name);
    parrafo.appendChild(description);
    parrafo.appendChild(discharge_date);
    parrafo.appendChild(expiry_date);
    parrafo.appendChild(provider_email);
    /*parrafo.appendChild(en_lvl);
    parrafo.appendChild(user);
    parrafo.appendChild(pass);   
    parrafo.appendChild(email);
    parrafo.appendChild(interests);*/
    content.appendChild(div_product);
    content.appendChild(img);
}