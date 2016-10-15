//Crear un plugin

jQuery.fn.fill_or_clean = function () {
    this.each(function () {
        //product name text handler
        if ($("#product_name").attr("value") == "") {
            $("#product_name").attr("value", "Introduce product name");
            $("#product_name").focus(function () {
                if ($("#product_name").attr("value") == "Introduce product name") {
                    $("#product_name").attr("value", "");
                }
            });
        }
        $("#product_name").blur(function () { //Onblur se activa cuando el usuario retira el foco
            if ($("#product_name").attr("value") == "") {
                $("#product_name").attr("value", "Introduce product name");
            }
        });

        //description textarea handler
        if ($("#description").attr("value") == "") {
            $("#description").attr("value", "Short product description");
            $("#description").focus(function () {
                if ($("#description").attr("value") =="Short product description") {
                    $("#description").attr("value", "");
                }
            });
        }
        $("#description").blur(function () {
            if ($("#description").val() == "") {
                $("#description").val("Short product description");
            }
        });

        //discharge date handler
        if ($("#discharge_date").attr("value") == "") {
            $("#discharge_date").attr("value", "mm/dd/yyyy");
            $("#discharge_date").focus(function () {
                if ($("#discharge_date").attr("value") == "mm/dd/yyyy") {
                    $("#discharge_date").attr("value", "");
                }
            });
        }
        $("#discharge_date").blur(function () {
            if ($("#discharge_date").attr("value") == "") {
                $("#discharge_date").attr("value", "mm/dd/yyyy");
            }
        });

        //description discharge data handler
        if ($("#expiry_date").attr("value") == "") {
            $("#expiry_date").attr("value", "mm/dd/yyyy");
            $("#expiry_date").focus(function () {
                if ($("#expiry_date").attr("value") == "mm/dd/yyyy") {
                    $("#expiry_date").attr("value", "");
                }
            });
        }
        $("#expiry_date").blur(function () {
            if ($("#expiry_date").attr("value") == "") {
                $("#expiry_date").attr("value", "mm/dd/yyyy");
            }
        });

        //provider_email discharge data handler
        if ($("#provider_email").attr("value") == "") {
            $("#provider_email").attr("value", "Introduce provider email");
            $("#provider_email").focus(function () {
                if ($("#provider_email").attr("value") == "Introduce provider email") {
                    $("#provider_email").attr("value", "");
                }
            });
        }
        $("#provider_email").blur(function () {
            if ($("#provider_email").attr("value") == "") {
                $("#provider_email").attr("value", "Introduce provider email");
            }
        });

        //provider_phone discharge data handler
        if ($("#provider_phone").attr("value") == "") {
            $("#provider_phone").attr("value", "Provider phone number");
            $("#provider_phone").focus(function () {
                if ($("#provider_phone").attr("value") == "Provider phone number") {
                    $("#provider_phone").attr("value", "");
                }
            });
        }
        $("#provider_phone").blur(function () {
            if ($("#provider_phone").attr("value") == "") {
                $("#provider_phone").attr("value", "Provider phone number");
            }
        });

        //price discharge data handler
        if ($("#price").attr("value") == "") {
            $("#price").attr("value", "0€");
            $("#price").focus(function () {
                if ($("#price").attr("value") == "0€") {
                    $("#price").attr("value", "");
                }
            });
        }
        $("#price").blur(function () {
            if ($("#price").attr("value") == "") {
                $("#price").attr("value", "Price");
            }
        });

    });//each
    return this;
};//function

//Solution to : "Uncaught Error: Dropzone already attached."

$(document).ready(function () {
    Dropzone.autoDiscover = false;
    //Datepicker///////////////////////////
    $(function (){
      $("#discharge_date").datepicker({
        dateFormat: 'mm/dd/yy',
        defaultDate: 'today',
        changeMonth: true,
        changeYear: true,
        minDate: -30, maxDate: +15,

      });

      $("#expiry_date").datepicker({
        dateFormat: 'mm/dd/yy',
        defaultDate: +30,
        changeMonth: true,
        changeYear: true,
        minDate: +0, maxDate: "+6M",

      });
    });

    //When we press the submit buttom of the form, we come here
    $("#submit_products").click(function () {
        validate_products();
    });

    //Control de seguridad para evitar que al volver atrás de la pantalla results a create, no nos imprima los datos
    $.get("modules/products/controller/controller_products.class.php?load_data=true",
        function (response) {
            //alert(response.product);
            if (response.product === "") {
                $("#product_name").val('');
                $("#price").val('');
                $("#description").val('');
                $("#discharge_date").val('');
                $("#expiry_date").val('');
                $("#provider_email").val('');
                $("#provider_phone").val('');
                var inputSeason = document.getElementsByClassName('radioBox');
                for (var i = 0; i < inputSeason.length; i++) {
                    if (inputSeason[i].checked) {
                        inputSeason[i].checked = false;
                    }
                }
                var inputCategory = document.getElementsByClassName('checkBox');
                for (var i = 0; i < inputCategory.length; i++) {
                    if (inputCategory[i].checked) {
                        inputCategory[i].checked = false;
                    }
                }

                //siempre que creemos un plugin debemos llamarlo, sino no funcionará
                $(this).fill_or_clean();
            } else {
                $("#product_name").val( response.product.product_name);
                $("#price").val(response.product.price);
                $("#description").val( response.product.description);
                $("#discharge_date").val( response.product.discharge_date);
                $("#expiry_date").val( response.product.expiry_date);
                $("#provider_email").val( response.product.provider_email);
                $("#provider_phone").val( response.product.provider_phone);

                var season = response.product.season;
                var inputSeason = document.getElementsByClassName('season');
                for (var i = 0; i < season.length; i++) {
                    for (var j = 0; j < inputSeason.length; j++) {
                        if(season[i] ===inputSeason[j] )
                            inputSeason[j].checked = true;
                    }
                }
                var category = response.product.category;
                var inputCategory = document.getElementsByClassName('category');
                for (var i = 0; i < category.length; i++) {
                    for (var j = 0; j < inputCategory.length; j++) {
                        if(category[i] ===inputCategory[j] )
                            inputCategory[j].checked = true;
                    }
                }
            }
        }, "json");
    //Dropzone function //////////////////////////////////
    $("#dropzone").dropzone({
        url: "modules/products/controller/controller_products.class.php?upload=true",
        addRemoveLinks: true,
        maxFileSize: 1000,
        dictResponseError: "An error has occurred on the server",
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
        init: function () {//Maneja barra de carga y mensaje
            this.on("success", function (file, response) {
                $("#progress").show();
                $("#bar").width('100%');
                $("#percent").html('100%');
                $('.msg').text('').removeClass('msg_error');
                $('.msg').text('Success Upload image!!').addClass('msg_ok').animate({'right': '300px'}, 300);
            });
        },
        complete: function (file) {
            //if(file.status == "success"){
            //alert("El archivo se ha subido correctamente: " + file.name);
            //}
        },
        error: function (file) {
            //alert("Error subiendo el archivo " + file.name);
        },
        removedfile: function (file, serverFileName) {

            var name = file.name;
            $.ajax({
                type: "POST",
                url: "modules/products/controller/controller_products.class.php?delete=true",
                data: "filename=" + name,
                success: function (data) {
                    $("#progress").hide();
                    $('.msg').text('').removeClass('msg_ok');
                    $('.msg').text('').removeClass('msg_error');
                    $("#e_avatar").html("");

                    var json = JSON.parse(data);

                    if (json.res === true) {
                        var element;
                        if ((element = file.previewElement) != null) {
                            element.parentNode.removeChild(file.previewElement);
                            //alert("Imagen eliminada: " + name);
                        } else {
                            false;
                        }
                    } else { //json.res == false, elimino la imagen también
                        var element;
                        if ((element = file.previewElement) != null) {
                            element.parentNode.removeChild(file.previewElement);
                        } else {
                            false;
                        }
                    }

                }
            });
        }
    });


    //Patterns
    var date_reg = /^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/;
    var string_reg = /^[A-Za-z0-9]{2,30}$/;
    var textarea_reg = /^[0-9A-Za-z]{4,120}$/;
    var email_reg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var phone_reg = /^(\+\d{2,3}\s)?[689]{1}\d{2}[\s]?\d{3}[\s]?\d{3}$/;
    var price_reg = /^[/d]{1,8}[.]?([\d]{1,2}?)$/;

    //realizamos funciones para que sea más práctico nuestro formulario
    $("#product_name").keyup(function () {
        if ($(this).val() != "" && string_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#price").keyup(function () {
        if ($(this).val() != "" && price_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#textarea_reg").keyup(function () {
        if ($(this).val() != "" && textarea_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#expiry_date, #discharge_date").keyup(function () {
        if ($(this).val() != "" && date_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#provider_email").keyup(function () {
        if ($(this).val() != "" && email_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#provider_phone").keyup(function () {
        if ($(this).val() != "" && phone_reg.test($(this).val())) {
            $(".error").fadeOut();
            return false;
        }
    });



});

function validate_products(){

    var result = true;
    //Get form elements by id
    var product_name = document.getElementById('product_name').value;
    var price = document.getElementById('price').value;
    var description = document.getElementById('description').value;
    var discharge_date = document.getElementById('discharge_date').value;
    var expiry_date = document.getElementById('expiry_date').value;
    var provider_email = document.getElementById('provider_email').value;
    var provider_phone = document.getElementById('provider_phone').value;
    var season = "";
    var inputSeason = document.getElementsByClassName('radioBox');
    //radioButton
    for (var i = 0; i < inputSeason.length; i++) {
        if (inputSeason[i].checked) {
            season = inputSeason[i].value;
        }
    }
    //Checkbox
    var category = [];
    var inputCategory = document.getElementsByClassName('checkBox');
    var category_numb = 0;
    for (var i = 0; i < inputCategory.length; i++) {
        if (inputCategory[i].checked) {
            category[category_numb] = inputCategory[i].value;
            category_numb++;
        }
    }


    //Patterns
    var date_reg = /^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/;
    var string_reg = /^[\sA-Za-z0-9]{2,30}$/;
    var textarea_reg = /^[\s0-9A-Za-z]{5,230}$/;
    var email_reg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var phone_reg = /^(\+\d{2,3}\s)?[689]{1}\d{2}\s\d{3}\s\d{3}$/;
    var price_reg = /^[/d]{1,8}[.]?([\d]{1,2}?)$/;

    console.log(price);
    $(".error").remove();


    //product name error handler
    if ($("#product_name").val() == "" || $("#product_name").val() == "Introduce product name") {
        $("#product_name").focus().after("<span class='error'>Introduce product name</span>");
        result = false;
        return false;
    } else if (!string_reg.test($("#product_name").val())) {
        $("#product_name").focus().after("<span class='error'>Name must be 2 to 30 characters</span>");
        result = false;
        return false;
    }

    //product name error handler
    if ($("#price").val() == "" || $("#price").val() == "0€") {
        $("#price").focus().after("<span class='error'>Product must have a price</span>");
        result = false;
        return false;
    } else if (!string_reg.test($("#price").val())) {
        $("#price").focus().after("<span class='error'>Price must be between 0 and 99999999</span>");
        result = false;
        return false;
    }

    //description error handler
    if ($("#description").val() == "" || $("#description").val() == "Short product description") {
        $("#description").focus().after("<span class='error'>Introduce a short description of the product</span>");
        result = false;
        return false;
    } else if (!textarea_reg.test($("#description").val())) {// $("#description").val().length < 12 || $("#description").val().length > 230
        $("#description").focus().after("<span class='error'>Description must be 5 to 230 characters</span>");
        result = false;
        return false;
    }

    //discharge_date error handler
    else if ($("#discharge_date").val() == "" || $("#discharge_date").val() == "mm/dd/yyyy") {
        $("#discharge_date").focus().after("<span class='error'>the discharge date of the product is necessary</span>");
        result = false;
        return false;
    } else if (!date_reg.test($("#discharge_date").val())) {
        $("#discharge_date").focus().after("<span class='error'>error format date (mm/dd/yyyy)</span>");
        console.log($("#discharge_date").val());
        result = false;
        return false;
    }

    //expiry_date error handler
    else if ($("#expiry_date").val() == "" || $("#expiry_date").val() == "mm/dd/yyyy") {
        $("#expiry_date").focus().after("<span class='error'>The expiry date of the product is necessary</span>");
        result = false;
        return false;
    } else if (!date_reg.test($("#expiry_date").val())) {
        $("#expiry_date").focus().after("<span class='error'>error format date (mm/dd/yyyy)</span>");
        result = false;
        return false;
    }

    //provider_email error handler
    if ($("#provider_email").val() == "" || $("#provider_email").val() == "Introduce provider email") {
        $("#provider_email").focus().after("<span class='error'>Introduce provider email</span>");
        result = false;
        return false;
    } else if (!email_reg.test($("#provider_email").val())) {
        $("#provider_email").focus().after("<span class='error'>Error format email (example@example.com).</span>");
        result = false;
        return false;
    }

    //provider_phone error handler
    if ($("#provider_phone").val() == "" || $("#provider_phone").val() == "Provider phone number") {
        $("#provider_phone").focus().after("<span class='error'>Provider phone number</span>");
        result = false;
        return false;
    } else if (!phone_reg.test($("#provider_phone").val())) {
        $("#provider_phone").focus().after("<span class='error'>Error format phone (+34 666 666 666).</span>");
        result = false;
        return false;
    }
    //Checkbox error handler
    if(category_numb<=1){
        $("#e_category").focus().after("<span class='error'>At less 2 categories</span>");
        result = false;
        return false;
    }


    //Si ha ido todo bien, se envian los datos al servidor
    if (result) {
        var data = {"product_name": product_name, "price": price, "description": description, "discharge_date": discharge_date,
        "expiry_date": expiry_date, "provider_email": provider_email, "provider_phone": provider_phone,
        "season": season, "category": category };
        var data_products_JSON = JSON.stringify(data);

        $.post('modules/products/controller/controller_products.class.php',
                {discharge_products_json: data_products_JSON},
        function (response) {
            //console.log(response);

            if (response.success) {
                window.location.href = response.redirect;//redirect = result_products ||
            }
        }, "json").fail(function (xhr) {
            //console.log(xhr.responseJSON);
            if (xhr.responseJSON.error.product_name)
                $("#product_name").focus().after("<span  class='error1'>" + xhr.responseJSON.error.product_name + "</span>");

            if (xhr.responseJSON.error.price)
                $("#price").focus().after("<span  class='error1'>" + xhr.responseJSON.error.price + "</span>");

            if (xhr.responseJSON.error.description)
                $("#description").focus().after("<span  class='error1'>" + xhr.responseJSON.error.description + "</span>");

            if (xhr.responseJSON.error.discharge_date)
                $("#discharge_date").focus().after("<span  class='error1'>" + xhr.responseJSON.error.discharge_date + "</span>");

            if (xhr.responseJSON.error.expiry_date)
                $("#expiry_date").focus().after("<span  class='error1'>" + xhr.responseJSON.error.expiry_date + "</span>");

            if (xhr.responseJSON.error.provider_email)
                $("#provider_email").focus().after("<span  class='error1'>" + xhr.responseJSON.error.provider_email + "</span>");

            if (xhr.responseJSON.error.provider_phone)
                $("#provider_phone").focus().after("<span  class='error1'>" + xhr.responseJSON.error.provider_phone + "</span>");

            if (xhr.responseJSON.error.season)
                $("#season").focus().after("<span  class='error1'>" + xhr.responseJSON.error.season + "</span>");

            if (xhr.responseJSON.error.category)
                $("#e_category").focus().after("<span  class='error1'>" + xhr.responseJSON.error.category + "</span>");

            if (xhr.responseJSON.error_avatar)
                $("#dropzone").focus().after("<span  class='error1'>" + xhr.responseJSON.error_avatar + "</span>");

            if (xhr.responseJSON.success1) {
                if (xhr.responseJSON.img_avatar !== "/PhpProject1/media/default-avatar.png") {
                    //$("#progress").show();
                    //$("#bar").width('100%');
                    //$("#percent").html('100%');
                    //$('.msg').text('').removeClass('msg_error');
                    //$('.msg').text('Success Upload image!!').addClass('msg_ok').animate({ 'right' : '300px' }, 300);
                }
            } else {
                $("#progress").hide();
                $('.msg').text('').removeClass('msg_ok');
                $('.msg').text('Error Upload image!!').addClass('msg_error').animate({'right': '300px'}, 300);
            }
        });
    }

}
