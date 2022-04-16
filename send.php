<?php
$recaptcha = $_POST['g-recaptcha-response'];
 
if(!empty($recaptcha)) {
    $recaptcha = $_REQUEST['g-recaptcha-response'];
    $secret = 'секретный ключ';
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret ."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0");
    $curlData = curl_exec($curl);
    curl_close($curl); 
    $curlData = json_decode($curlData, true);
    if($curlData['success']) {
        $firstname = $_POST['firstname'];
        $Lastname = $_POST['Lastname'];
        $Email = $_POST['Email'];
        $numberPhone = $_POST['numberPhone'];
        $Age = $_POST['Age'];
        $weight = $_POST['weight'];

        $firstname = htmlspecialchars($firstname);
        $Lastname = htmlspecialchars($Lastname);
        $Email = htmlspecialchars($Email);
        $numberPhone = htmlspecialchars($numberPhone);
        $Age = htmlspecialchars($Age);
        $weight = htmlspecialchars($weight);
        
        $firstname = urldecode($firstname);
        $Lastname = urldecode($Lastname);
        $Email = urldecode($Email);
        $numberPhone = urldecode($numberPhone);
        $Age = urldecode($Age);
        $weight = urldecode($weight);

        $firstname = trim($firstname);
        $Lastname = trim($Lastname);
        $Email  = trim($Email);
        $numberPhone = trim($numberPhone);
        $Age = trim($Age);
        $weight  = trim($weight);

        if (mail("char1k59@mail.ru", "Заявка с сайта", "Имя:".$firstname.
        ".Фамилия: ".$Lastname.
        " Email: ".$Email. 
        "numberPhone: ".$numberPhone.
        "weight: ".$weight.
        " Age: "
        .$Age 
        "From: info@satename.ru \r\n")){  
        echo "Сообщение успешно отправлено"; 
        } else { 
        echo "При отправке сообщения возникли ошибки";
        }
    } else {
        echo "Подтвердите, что вы не робот и попробуйте еще раз";
    }
}
else {
    echo "поставьте галочку в поле 'Я не робот' для отправки сообщения";
}
?>