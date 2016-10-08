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
        /*
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
        //description discharge date handler
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
        //description discharge date handler
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
        //provider_email discharge date handler
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
        //provider_phone discharge date handler
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
        */
    });//each
    return this;
};//function

//Solution to : "Uncaught Error: Dropzone already attached."

$(document).ready(function () {
    Dropzone.autoDiscover = false;
    //Datepicker///////////////////////////
    $(function (){
      $("#discharge_date").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '2015:2016',

      });

      $("#expiry_date").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '2016:2020',

      });
    });

    //When we press the submit buttom of the form, we come here
    $("#submit_products").click(function () {
        validate_products();
    });

    //Control de seguridad para evitar que al volver atrás de la pantalla results a create, no nos imprima los datos



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
    var phone_reg = /^\+\d{2,3}\s[689]{1}\d{2}\s\d{3}\s\d{3}$/;

    //realizamos funciones para que sea más práctico nuestro formulario
    $("#product_name").keyup(function () {
        if ($(this).val() != "" && string_reg.test($(this).val())) {
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


    //Patterns
    var date_reg = /^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/;
    var string_reg = /^[A-Za-z0-9]{2,30}$/;
    var textarea_reg = /^[0-9A-Za-z]{4,120}$/;
    var email_reg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var phone_reg = /^\+\d{2,3}\s[689]{1}\d{2}\s\d{3}\s\d{3}$/;


    $(".error").remove();
      
    //product name error handler
    if ($("#product_name").val() == "" || $("#product_name").val() == "Introduce product name") {
        $("#product_name").focus().after("<span class='error'>Introduce product name</span>");
        result = false;
        return false;
    } else if (!string_reg.test($("#product_name").val())) {
        $("#product_name").focus().after("<span class='error'>Name must be 2 to 30 letters</span>");
        result = false;
        return false;
    }
    /*
    //description error handler
    else if ($("#description").val() == "" || $("#description").val() == "Short product description") {
        $("#description").focus().after("<span class='error'>Introduce a short description of the product</span>");
        result = false;
        return false;
    } else if (!textarea_reg.test($("#description").val())) {
        $("#description").focus().after("<span class='error'>Description must be 5 to 180 letters</span>");
        result = false;
        return false;
    }
    //discharge_date error handler

    else if ($("#discharge_date").val() == "" || $("#discharge_date").val() == "mm/dd/yyyy") {
        $("#discharge_date").focus().after("<span class='error'>mm/dd/yyyy</span>");
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
        $("#expiry_date").focus().after("<span class='error'>mm/dd/yyyy</span>");
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
    */

    //Si ha ido todo bien, se envian los datos al servidor
    if (result) {
        var data = {"product_name": product_name};

        var data_products_JSON = JSON.stringify(data);
        console.log(data_products_JSON);
        $.post('modules/products/controller/controller_products.class.php',
                {discharge_products_json: data_products_JSON},
        function (response) {
            console.log(response);
            
            if (response.success) {
                window.location.href = response.redirect;//redirect = result_products ||  
            }
        }, "json").fail(function (xhr) {
            console.log(xhr.responseJSON);
            if (xhr.responseJSON.error.product_name)
                $("#product_name").focus().after("<span  class='error1'>" + xhr.responseJSON.error.product_name + "</span>");
            /*
            if (xhr.responseJSON.error.description)
                $("#description").focus().after("<span  class='error1'>" + xhr.responseJSON.error.description + "</span>");

            if (xhr.responseJSON.error.discharge_date)
                $("#discharge_date").focus().after("<span  class='error1'>" + xhr.responseJSON.error.discharge_date + "</span>");

            if (xhr.responseJSON.error.expiry_date)
                $("#expiry_date").focus().after("<span  class='error1'>" + xhr.responseJSON.error.expiry_date + "</span>");

            if (xhr.responseJSON.error.provider_email)
                $("#provider_email").focus().after("<span  class='error1'>" + xhr.responseJSON.error.provider_email + "</span>");

            if (xhr.responseJSON.error.season)
                $("#season").focus().after("<span  class='error1'>" + xhr.responseJSON.error.season + "</span>");

            if (xhr.responseJSON.error.category)
                $("#category").focus().after("<span  class='error1'>" + xhr.responseJSON.error.category + "</span>");

            if (xhr.responseJSON.error.discount)
                $("#discount").focus().after("<span  class='error1'>" + xhr.responseJSON.error.discount + "</span>");

            if (xhr.responseJSON.error.discount_percent)
                $("#discount_percent").focus().after("<span  class='error1'>" + xhr.responseJSON.error.discount_percent + "</span>");

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
            }*/
        });
    }

}
