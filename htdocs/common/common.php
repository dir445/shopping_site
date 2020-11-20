<?php
    function sanitize($before) {
        foreach($before as $key=>$value) {
            $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
        }
        return $after;
    }

    function pulldown_number($name,$from,$to) {
        print "<select name=\"$name\">";
        for($i=$from;$i<=$to;$i++) {
            print "<option value=\"$i\">$i</option>";
        }
        print '</select>';
    }

    function pulldown_year() {
        pulldown_number('year',2017,2020);
    }

    function pulldown_month() {
        pulldown_number('month',1,12);
    }
    
    function pulldown_day() {
        pulldown_number('day',1,31);
    }

    function disp_member_login() {
        session_start();
        session_regenerate_id(true);
        if(isset($_SESSION['member_login'])==false) {
            print 'ようこそゲスト様　';
            print '<a href="member_login.html">会員ログイン</a><br />';
            print '<br />';
        } else {    
            print 'ようこそ';
            print $_SESSION['member_name'];
            print '様　';
            print '<a href="member_logout.php">ログアウト</a><br />';
            print '<br />';
        }
    }

    function check_staff_login($disp_staffname) {
        session_start();
        session_regenerate_id(true);
        if(isset($_SESSION['login'])==false) {
            print 'ログインされていません。<br />';
            print '<a href="../staff_login/staff_login.html>ログイン画面へ</a>';
            exit();
        } else if($disp_staffname) {
            print $_SESSION['staff_name'];
            print 'さんがログイン中<br />';
            print '<br /';
        }
    }

    function set_csfr_token() {
        $_SESSION['csfr_token'] = bin2hex(openssl_random_pseudo_bytes(16));
        return $_SESSION['csfr_token'];
    }

    function check_csfr_token($failed) {
        if(!isset($_POST['csfr_token'] , $_SESSION['csfr_token']) ||
            $_POST['csfr_token'] != $_SESSION['csfr_token']) {
            print $failed;
            exit();
        }
    }
?>
