<article>
	<h1><?php echo A::t('app', 'Edit Country') ?></h1>
	    <div class="panel-content">

	<?php echo $actionMessage; ?>

    <?php
        $buttons['submit'] = array('type'=>'submit', 'value'=>A::t('app', 'Update'), 'htmlOptions'=>array('name'=>''));
       
        if(!$isMyAccount){
        	$buttons['cancel'] = array('type'=>'button', 'value'=>A::t('app', 'Cancel'), 'htmlOptions'=>array('name'=>'', 'class'=>'button white'));
        }
    
		echo CWidget::create('CDataForm', array(
			'model'=>'Countries',
			'primaryKey'=>$cnt->id,
			'operationType'=>'edit',
			'action'=>'countries/editcountry/id/'.$cnt->id,
			'successUrl'=>'countries/view/country/updated',
			'cancelUrl'=>'countries/view',
			'method'=>'post',
			'passParameters'=>true,
			'htmlOptions'=>array(
				'name'=>'frmCountryEdit',
				'enctype'=>'multipart/form-data',
				'autoGenerateId'=>true
			),
			'requiredFieldsAlert'=>true,
			'fieldSetType'=>'frameset',
			'fields'=>array(
				'separatorCountry' =>array(
					'separatorInfo' => array('legend'=>A::t('app', 'Update Country Information')),
					'c_name'    => array('type'=>'textbox', 'title'=>A::t('app', 'Country Name'), 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
					'c_capital' => array('type'=>'textbox', 'title'=>A::t('app', 'Capital City'), 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
					'c_code'    => array('type'=>'textbox', 'title'=>A::t('app', 'Country Code'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
					'c_language'=> array('type'=>'textbox', 'title'=>A::t('app', 'Language'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
				
				),
			),
			'buttons'=>$buttons,
			'messagesSource'=>'core',
			'return'=>true,
		));
    ?>
    </div>
    <div class="panel-settings">
        This page enables us to edit the country Table.
    </div>
    <div class="clear"></div>
</article>
