<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
	<meta name="keywords" content="<?php echo CHtml::encode($this->_pageKeywords); ?>" />
	<meta name="description" content="<?php echo CHtml::encode($this->_pageDescription); ?>" />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP Simple Login System">
    <title><?php echo CHtml::encode($this->_pageTitle); ?></title>
    
    <base href="<?php echo A::app()->getRequest()->getBaseUrl(); ?>" />

    <?php echo CHtml::cssFile("templates/default/css/main.css"); ?>
    <?php echo CHtml::cssFile("templates/custom/css/bootstap.min.css"); ?>
    <?php echo CHtml::cssFile("templates/custom/css/style.css") ?>

	<?php echo CHtml::scriptFile('http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'); ?>
	<?php echo CHtml::scriptFile('templates/default/js/main.js'); ?>
    <?php echo CHtml::scriptFile("templates/custom/js/jquery-1.11.3.min.js"); ?>
    <?php echo CHtml::scriptFile("templates/custom/js/bootstap.min.js"); ?>
    <?php echo CHtml::scriptFile("templates/custom/js/bti.js"); ?>
</head>
<body>
    <header>
        <nav>
            <?php
                CWidget::create('CMenu', array(
                    'items'=>array(
                        array('label'=>'BTI MILLMAN', 'url'=>'index/index'),
                        (CAuth::isLoggedIn() == true) ? array('label'=>'Welcome', 'url'=>'page/dashboard') : '',
						(CAuth::isLoggedIn() == true) ? array('label'=>'My Account', 'url'=>'account/edit') : '',
                     ),
                    'type'=>'horizontal',					
                    'selected'=>$this->_activeMenu,
					'return'=>false
                ));
            ?>
			
            <?php
                CWidget::create('CMenu', array(
                    'items'=>array(
                        (CAuth::isLoggedIn() == true) ? array('label'=>'Logout', 'url'=>'login/logout') : 
                        array('label'=>'Login', 'url'=>'login/index'),
                        array('label'=>'Register', 'url'=>'register/index'),
                    ),
                    'type'=>'horizontal',
					'class'=>'user_menu',
                    'selected'=>$this->_activeMenu,
					'return'=>false
                ));
            ?>
        </nav>
    </header>
    <section>
        <?php
            CWidget::create('CBreadCrumbs', array(
                'links'=>$this->_breadCrumbs,
				'return'=>false
            ));
        ?>        
        <?php echo A::app()->view->getContent(); ?>
    </section>
    <footer>
        <p class="copyright">Copyright &copy; <?php echo @date('Y'); ?> Your Site</p>
        <p class="powered"><?php echo A::powered(); ?></p>
    </footer>    
</body>
</html>