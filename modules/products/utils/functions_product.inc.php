<?php
function validate_product( $value ) {

    $error = array();
    $valid = true;
    $filter = array(
        'product_name' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^\D{2,30}$/')
        ),

        'price' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^[\W\d]*(\.\d{1})?\d{0,1}$/')
        ),

        'description' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^[\s0-9A-Za-z]{5,230}$/')
        ),

        'discharge_date' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/')
        ),
        'expiry_date' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/')
        ),
        'provider_email' => array(
            'filter' => FILTER_CALLBACK,
            'options' => 'valida_email'
        ),

        'provider_phone' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^(\+\d{2,3}\s)?[689]{1}\d{2}\s\d{3}\s\d{3}$/')
        ),

        'discount_percent' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^[0-99 ]1$/i')
        ),
    );

    $result = filter_var_array($value, $filter);

    if(count($value['category']) <= 1){
        $error['category'] = "Please, select 2 or more categories";
        $valid = false;
    }


    if ($result['discharge_date'] && $result['expiry_date']) {
        $valid_dates = valida_dates($result['discharge_date'], $result['expiry_date']);

        if (!$valid_dates) {
            $error['discharge_date'] = "Expiry date can't be greater than discharge date";
            $valid = false;
        }
    }

    if ($result != null && $result) {


        if (!$result['product_name']) {
            $error['product_name'] = 'Product name must be 2 to 20 letters';
            $valid = false;
        }

        if (!$result['price']) {
            $error['price'] = 'Price must be a number with maxim 2 decimal number';
            $valid = false;
        }

        if (!$result['description']) {
            $error['description'] = 'Description must have more than 5 characters and less than 230';
            $valid = false;
        }

        if (!$result['discharge_date']) {
            if($_POST['discharge_date'] == ""){
                $error['discharge_date'] = "Any product must have a discharge date";
                $valid = false;
            }else{
                $error['discharge_date'] = 'Error format date (mm/dd/yyyy)';
                $valid = false;
            }
        }

        if (!$result['expiry_date']) {
            if($_POST['expiry_date'] == ""){
                $error['expiry_date'] = "This field can't be empty";
                $valid = false;
            }else{
            $error['expiry_date'] = 'Error format date (mm/dd/yyyy)';
            $valid = false;
            }
        }

        if (!$result['provider_email']) {
            $error['provider_email'] = 'error format email (example@example.com)';
            $valid = false;
        }

        if (!$result['provider_phone']) {
            $error['provider_phone'] = 'Phone must be 9 to 12 characters';
            $valid = false;
        }

        if (!$result['discount_percent']) {
            $error['discount_percent'] = "Discount must be between 0 and 99";
            $valid = false;
        }


    } else {
        $valid = false;
    };

    $result['season'] = $value['season'];
    $result['category'] = $value['category'];

    $return = array('result' => $valid, 'error' => $error, 'data' => $result);

    return $return;
}

// validate dates of product
function valida_dates($discharge_day, $expiry_day) {
    //conole.log( $discharge_day + "" + $expiry_day);
    $discharge_day = date("m/d/Y", strtotime($discharge_day));
    $expiry_day = date("m/d/Y", strtotime($expiry_day));

    $discharge_day_arr = explode('/', $discharge_day);
    $expiry_day_arr = explode('/', $expiry_day);

    $dateOne = new DateTime($discharge_day_arr[2] . "-" . $discharge_day_arr[0] . "-" . $discharge_day_arr[1]);
    $dateTwo = new DateTime($expiry_day_arr[2] . "-" . $expiry_day_arr[0] . "-" . $expiry_day_arr[1]);

    if ($dateOne < $dateTwo) {
        return true;
    }
    return false;
}

//validate email
function valida_email($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (filter_var($email, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^.{5,50}$/')))) {
            return $email;
        }
    }
    return false;
}
