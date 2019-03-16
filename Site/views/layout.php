<html>
    <head>
        <link rel="stylesheet" href="/css/main.css"/>
        <?php echo $this->renderCss();?>
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
        <?php echo $this->renderJs();?>
    </head>
    <body>
        <div class="header">
            <h1>Тестовое задание (блог) </h1>
        </div>

        <div class="menu">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="?action=form">Добавление данных</a></li>
            </ul>

            <div class="auth-form">
                    <?php if (! $this->getApp()->getAuth()->isAuthorized()):?>
                        <form method="post" action="/?controller=auth&action=login">
                            <label>Авторизация<input type="password" name="password" placeholder="Введите пароль"/></label>
                            <input type="submit" value="Ok"/>
                        </form>
                    <?php else: ?>
                        <a href="/?controller=auth&action=logout">Выйти</a>
                    <?php endif; ?>
            </div>
        </div>

        <div class="content">
            <?php include $this->getTemplateName(); ?>
        </div>

        <div class="footer">
            Рубцов Василий Викторович, 2019
        </div>

    </body>
</html>