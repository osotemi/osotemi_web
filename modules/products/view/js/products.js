//Crear un plugin

jQuery.fn.fill_or_clean = function () {
    this.each(function () {
        console.log("placeholder Handlers");
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
    });//each
    return this;
};//function

$(document).ready(function () {

    $(this).fill_or_clean(); //siempre que creemos un plugin debemos llamarlo, sino no funcionará
    
    //Patterns
    var date_reg = /^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/;
    var string_reg = /^[A-Za-z0-9]{2,30}$/;
    var textarea_reg = /^[0-9A-Za-z]{4,120}$/;
    var email_reg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var phone_reg = /^\+\d{2,3}\s[689]{1}\d{2}\s\d{3}\s\d{3}$/;
    
    $("#submit_products").click(function () {
        $(".error").remove();
        
        //product name error handler
        if ($("#product_name").val() == "" || $("#product_name").val() == "Introduce product name") {
            $("#product_name").focus().after("<span class='error'>Introduce product name</span>");
            return false;
        } else if (!string_reg.test($("#product_name").val())) {
            $("#product_name").focus().after("<span class='error'>Name must be 2 to 30 letters</span>");
            return false;
        }
        //description error handler
        else if ($("#description").val() == "" || $("#description").val() == "Short product description") {
            $("#description").focus().after("<span class='error'>Introduce a short description of the product</span>");
            return false;
        } else if (!textarea_reg.test($("#description").val())) {
            $("#description").focus().after("<span class='error'>Description must be 5 to 180 letters</span>");
            return false;
        }
        //discharge_date error handler
        
        else if ($("#discharge_date").val() == "" || $("#discharge_date").val() == "mm/dd/yyyy") {
            $("#discharge_date").focus().after("<span class='error'>mm/dd/yyyy</span>");
            return false;
        } else if (!date_reg.test($("#discharge_date").val())) {
            $("#discharge_date").focus().after("<span class='error'>error format date (mm/dd/yyyy)</span>");
            console.log($("#discharge_date").val());
            return false;
        }
        //expiry_date error handler
        else if ($("#expiry_date").val() == "" || $("#expiry_date").val() == "mm/dd/yyyy") {
            $("#expiry_date").focus().after("<span class='error'>mm/dd/yyyy</span>");
            return false;
        } else if (!date_reg.test($("#expiry_date").val())) {
            $("#expiry_date").focus().after("<span class='error'>error format date (mm/dd/yyyy)</span>");
            return false;
        }
        //provider_email error handler
        if ($("#provider_email").val() == "" || $("#provider_email").val() == "Introduce provider email") {
            $("#provider_email").focus().after("<span class='error'>Introduce provider email</span>");
            return false;
        } else if (!email_reg.test($("#provider_email").val())) {
            $("#provider_email").focus().after("<span class='error'>Error format email (example@example.com).</span>");
            return false;
        }
        //provider_phone error handler
        if ($("#provider_phone").val() == "" || $("#provider_phone").val() == "Provider phone number") {
            $("#provider_phone").focus().after("<span class='error'>Provider phone number</span>");
            return false;
        } else if (!phone_reg.test($("#provider_phone").val())) {
            $("#provider_phone").focus().after("<span class='error'>Error format phone (+34 666 666 666).</span>");
            return false;
        }
        console.log("Antes de submit");
        $("#form_products").submit();
        $("#form_products").attr("action", "index.php?module=products");
    });
    
    //realizamos funciones para que sea más práctico nuestro formulario
    $("#product_name").keyup(function () {
        console.log("Entra en keyup");
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