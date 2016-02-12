<?php
    $this->_activeMenu = 'login/index';
?>

<div style="width:400px; margin:50px auto;">
<center><h3 style="color:#ccc;">kindly login in here</h3></center>
<?php echo $actionMessage; ?>

<fieldset>
    <legend>Login</legend>
    
    <?php
        // draw login form
        echo CWidget::create('CFormView', array(
            'action'=>'login/run',
            'method'=>'post',
            'htmlOptions'=>array(
                'name'=>'frmLogin'
            ),
            'fields'=>array(
                'act'     =>array('type'=>'hidden', 'value'=>'send'),
                'username'=>array('type'=>'textbox', 'value'=>$username, 'title'=>'Username', 'mandatoryStar'=>false, 'htmlOptions'=>array('maxlength'=>'32', 'autocomplete'=>'off')),
                'password'=>array('type'=>'password', 'value'=>$password, 'title'=>'Password', 'mandatoryStar'=>false, 'htmlOptions'=>array('maxLength'=>'20')),
            ),
            'buttons'=>array(
                'submit'=>array('type'=>'submit', 'value'=>'Login'),
            ),
            'events'=>array(
                'focus'=>array('field'=>$errorField)
            ),
            'return'=>true,
        ));    
    ?>
    
</fieldset>
</div>
