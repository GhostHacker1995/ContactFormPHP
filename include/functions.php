<?php

function len($string)
{
    $string = (string) $string;
    $string = trim($string);
    if (strlen($string) > 0) {
        return false;
    }
    return true;
}

function capitalize($stg)
{

    return ucwords(strtolower($stg));
}

function stroked_date_format($date)
{
    return date('m/d/Y', strtotime($date));
}

function picker_format($date)
{
    return date('d M Y', strtotime($date));
}

function db_date($date_db)
{
    $date_db = date('Y-m-d', strtotime($date_db));
    return $date_db;
}

function db_date_time($date_db)
{
    $date_db = date('Y-m-d H:i:s', strtotime($date_db));
    return $date_db;
}

function user_date($date_user)
{
    $date_user = date('D, d M Y', strtotime($date_user));
    if ($date_user == "Thursday, 01-Jan-1970") {
        $date_user = "Day-Month-Year";
    }
    return $date_user;
}

function user_date_time($date_user_time)
{
    $date_user = date('d M Y', strtotime($date_user_time));
    $time_user = date('h:i a', strtotime($date_user_time));
    return $date_user . " at " . $time_user;
}

function short_date($date_user)
{
    $date_user = date('d M Y', strtotime($date_user));
    if ($date_user == "Thursday, 01-Jan-1970") {
        $date_user = "Day-Month-Year";
    }
    return $date_user;
}

function user_time($user_time)
{
    if ($user_time == "00:00:00" || $user_time == NULL) {
        return "--:--";
    }

    $time_user = date('h:i a', strtotime($user_time));
    return $time_user;
}

function send_mail($RecipientName = "Douglas Chuck", $RecipientAddress = "chuckdarg@gmail.com", $Subject = "Booking for a hotel", $Message = "Hello Management, I am bookig for a room in a certain hotel I like", $auto_path = "")
{
    require $auto_path . 'mail/PHPMailerAutoload.php';

    // try {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Mailer = "smtp";
        $mail->Host = "mail.thrivetecug.com";
        $mail->Port = "26";

        //Recipients
        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";
        // $mail->SMTPSecure = 'tls';

        // $mail->From = "support@thrivetecug.com";
        $mail->From = "mwebembezijosh7@gmail.com";
        $mail->AddAddress('chuckdarg@gmail.com', 'Douglas Chuck'); // Add a recipient address
        $mail->AddCC('info@grayhost.co');

        // $mail->Username = "support@thrivetecug.com";
        // $mail->Password = "Support@2020";
        $mail->Username = 'mwebembezijosh7@gmail.com';
        $mail->Password = 'Engineerjosh7@1995';  
        $mail->SMTPDebug = false; // it can be false, 2 Enables verbose debug output

        // $mail->SMTPOptions = array(
        //     'ssl' => array(
        //         'verify_peer' => false,
        //         'verify_peer_name' => false,
        //         'allow_self_signed' => true
        //     )
        // );

        // $mail->FromName = $RecipientName;
        // foreach ($RecipientAddress as $key => $value) :
        //     $mail->From = "support@thrivetecug.com";
        //     $mail->AddAddress($value, $RecipientName);
        // endforeach;

        $mail->isHTML(true); // Set email format to HTML

        $mail->AddReplyTo("daglach7@gmail.com", "Booking for a hotel");
        $mail->Subject = $Subject;
        $mail->Body = $Message;
        $mail->WordWrap = 50;

        if (!$mail->Send()) {
            // echo 'Email was not sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
            return false;
        } else {
            echo 'Email has been sent.';
            return true;
        }

        // $mail->send(); 
        // echo 'Mailer error: ' . $mail->ErrorInfo;

    // } catch (Exception $e) { 
    //     echo 'Message could not be sent.'; 
    //     echo 'Mailer Error: ' . $mail->ErrorInfo; 
    // } 
}

function validEmail($email)
{
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make it easier to read or navigate
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }

    return $email;
}

function validPassword($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return false;
    }

    return $password;
}

function secure_url($string)
{
    //$string=urlencode($string);
    return $string;
}

function post_data_to_url($url, $data)
{


    $json = json_encode($data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Do not send to screen
    curl_setopt($ch, CURLOPT_USERAGENT, 'QUICKPOST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    //if($response)
    // $response=json_decode($response);
    return $response;
}

function get_request_name($uri_depth = 0)
{
    $url = $_SERVER['REQUEST_URI'];
    $clean_url = explode("?", $url);
    $url = $clean_url[0];
    $request = explode("/", $url);
    $parts = [];
    foreach ($request as $key => $value) {
        if ($key > $uri_depth) {
            $parts[] = $value;
        }
    }
    $request = implode("/", $parts);
    return $request;
}

function get_request_params()
{
    $url = $_SERVER['REQUEST_URI'];
    $request = explode("?", $url);
    if (isset($request[1])) {
        return $request[1];
    }
    return false;
}
