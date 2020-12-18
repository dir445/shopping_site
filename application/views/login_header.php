<?php if (!$session->isAuthenticated() || is_null($session->get('login'))) : ?>
    ログインされていません。 
    <a href="/staff/login">ログイン画面へ</a>
<?php else:?>
    <?php print $session->get('staff_name');?>さんがログイン中 
    <a href="/staff/logout">ログアウト</a>
    <br />
<?php endif?>
<br />