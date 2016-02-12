<?php
    $this->_activeMenu = $this->_controller.'/'.$this->_action;
?>

<h1><?php echo $header; ?></h1>

<article>
    <p>
        Nothing much here. </br> 
        <?php 
	        if(CAuth::isLoggedIn()){
	         	echo '<p>Click on the countries tab on top to view a list of available countries or add you country of choice.</p>';
	     	}
        ?>
    </p>
</article>

<?php
    if(!CAuth::isLoggedIn()){
        echo CWidget::create('CMessage', array('info', 'Click <a href="login/index"><b>here</b></a> to log into the system as administrator.'));
    }
?>