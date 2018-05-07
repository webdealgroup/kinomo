<?php
    
    //header("Content-type: text/html;charset=utf-8");
    session_start();
    require_once('site/libs/mysql.php'); // порядок подключения обязателен


    require_once('site/libs/smarty/Smarty.class.php');
    include_once('site/modules/aModule.class.php');

    function getRequest()
    {
        $params = array_merge($_GET, $_POST);
        reset($params);
        while(list($key,$value) = each($params)){
            if (gettype($params[$key]) != "array"){
                if (get_magic_quotes_gpc()){
                    $value = stripslashes(trim($value));
                }
                $params[$key] = $value;
            }
        } 
        return $params; 
    }


    if($_POST['send_msg']=='true')
    { 
        
        //echo "<pre>"; print_r($_POST); echo "</pre>"; //die(); 
        
        $message = array();
        $k = 0;
        foreach($_POST as $n=>$v)
        {
            if ($k>0)
            {
                
                if($n == 'day')
                {
                    $message[$k]['name'] = $n;
                    $message[$k]['txt'] = "1 день";
                }
                elseif($n == 'hour')
                {
                    $message[$k]['name'] = $n;
                    $message[$k]['txt'] = "1 час";
                }
                else
                {
                    $message[$k]['name'] = $n;
                    $message[$k]['txt'] = $v;

                }
            }
            $k++;
        }

        $uploaddir = '/var/www/html/shtampovik.ru/upload/';
        $uploadfile = $uploaddir . basename($_FILES['my_filename']['name']);

        if (move_uploaded_file($_FILES['my_filename']['tmp_name'], $uploadfile)) {
            //echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }

        $_SESSION['smarty']->assign('uploadfile', '/upload/'.basename($_FILES['my_filename']['name']));
        $_SESSION['smarty']->assign('message', $message);

        require_once "site/libs/SendMailSmtpClass.php"; // подключаем класс
         
        $mailSMTP = new SendMailSmtpClass('mail@webdeal.group', 'HzBpHuLn', 'ssl://smtp.yandex.ru', 'штамповик.рф', 465);
        // $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'имя отправителя');
         
        // заголовок письма
        /**/
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: MAIL <mail@webdeal.group>\r\n"; // от кого письмо
        
        $result =  $mailSMTP->send(
                                        '4999732707@mail.ru', 
                                        'Заказ штамповик.рф', 
                                        $_SESSION['smarty']->fetch('mail.tpl'), 
                                        $headers
        ); // отправляем письмо
        // $result =  $mailSMTP->send('Кому письмо', 'Тема письма', 'Текст письма', 'Заголовки письма');
        if($result === true){
            //echo "ok2"; die();
        }else{
            echo "Письмо не отправлено. Ошибка: " . $result;
        }
    }

    class router extends aModule{
        function execute($arr)
        {
            
            if (empty($arr['q']))
            {
                $arr['q']='/index';
            } // если пусто, считаем что это index
            $alias = split("[\/]+", $arr['q']); // разбираем строку
            foreach($alias as $a)   {if($a!='') {$post[] = $a; $aliases[] = $a;}}
            $page = "";
            
            foreach($post as $k=>$v) {if ($k==0) {$page .= $v;}else{$page .= "/".$v;}}

            $dir = $post;                    // $dir[0] - алиас модуля
            $post = array_reverse($post);    // $post[0] - алиас запрашиваемой страницы
            
            //echo "<pre style='display:none;'>"; print_r($page); echo "</pre>"; //die();

            //$pages = rows('SELECT * FROM pages WHERE active = 1 ORDER BY sort ASC');
            //$_SESSION['smarty']->assign('pages', $pages); 

            //$categories = rows('SELECT * FROM categories WHERE active = 1 ORDER BY sort ASC');
            //$_SESSION['smarty']->assign('categories', $categories); 

            $template = 'index.tpl';
            /*
            foreach($pages as $k=>$p) 
            { 
                if($p['alias'] == $page) 
                { 
                    $template = 'page.tpl'; 
                    $_SESSION['smarty']->assign('p_index', $k);
                }
            }
            
            foreach($categories as $k=>$c) 
            { 
                if($c['alias'] == $page) 
                { 
                    $template = 'cat.tpl';
                    $_SESSION['smarty']->assign('p_index', $k);
                }
            }
            */


            print ($_SESSION['smarty']->fetch($template));
        }
    }

    $rout = new router();
    $rout->execute(getRequest()); 
?>