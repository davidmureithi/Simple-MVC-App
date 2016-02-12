<article>
    <h1><?php echo A::t('app', 'Add New Country'); ?></h1>
    <div class="panel-content">
   
    <?php echo $actionMessage; ?>
    
    <?php
		echo CWidget::create('CDataForm', array(
			'model'=>'Countries',
			'operationType'=>'add',
			'action'=>'countries/addcountry',
			'successUrl'=>'countries/view/country-added',
			'cancelUrl'=>'countries/index',
			'method'=>'post',
			'htmlOptions'=>array(
				'name'=>'frmCountryAdd',
				'enctype'=>'multipart/form-data',
				'autoGenerateId'=>true
			),
			'requiredFieldsAlert'=>true,
			'fieldSetType'=>'frameset',
			'fields'=>array(
				'separatorCountry' =>array(
					'separatorInfo' => array('legend'=>A::t('app', 'Country Information')),
					'c_name'    => array('type'=>'textbox', 'title'=>A::t('app', 'Country Name'), 'default'=>'', 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
					'c_capital'     => array('type'=>'textbox', 'title'=>A::t('app', 'Capital City'), 'default'=>'', 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
					'c_code'  => array('type'=>'textbox', 'title'=>A::t('app', 'Country Code'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
					'c_language'  => array('type'=>'textbox', 'title'=>A::t('app', 'Country Language'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
				),
								
			),
			'buttons'=>array(
			   'submit' => array('type'=>'submit', 'value'=>A::t('app', 'Add'), 'htmlOptions'=>array('name'=>'')),
			   'cancel' => array('type'=>'button', 'value'=>A::t('app', 'Cancel'), 'htmlOptions'=>array('name'=>'', 'class'=>'button white')),
			),
			'messagesSource'=>'core',
			'return'=>true,
		));
    ?>    
    </div>
    <div class="panel-settings">
        Add country page.
    </div>
    <div class="clear"></div>
</article>
