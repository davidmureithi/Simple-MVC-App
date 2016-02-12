<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
	<meta name="keywords" content="<?php echo CHtml::encode($this->_pageKeywords); ?>" />
	<meta name="description" content="<?php echo CHtml::encode($this->_pageDescription); ?>" />
    <meta name="author" author="<?php echo CHtml::encode($this->_pageAuthor); ?>">
    <meta name="generator" content="BTI - Login/Country Display Task">
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
                        (CAuth::isLoggedIn() == true) ? array('label'=>'Welcome', 'url'=>'#') : '',
						(CAuth::isLoggedIn() == true) ? array('label'=>'Countries', 'url'=>'countries/view') : '',
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
      <!-- <footer>
     
        <p class="copyright">Copyright &copy; <?php //echo @date('Y'); ?> BTI Task</p>
        <p class="powered by David Ndekere">powered by David Ndekere</p>
        
    </footer>   
    --> 
</body>
</html>