<article>
    <center>
    <h1>Countries</h1>  
    <a href="countries/addcountry" class="add-new"><?php echo A::t('app', 'Add Country'); ?></a>
    <?php echo $actionMessage; ?>
    
    <p>
    <?php
            //A::t('app', 'Avatar')
            echo CWidget::create('CGridView', array(
                'model'=>'Countries',
                'actionPath'=>'countries/view',
                'defaultOrder'=>array('c_name'=>'ASC'),
                'passParameters'=>true,
                'pagination'=>array('enable'=>true, 'pageSize'=>10),
                'sorting'=>true,
                'filters'=>array(
                    'c_name'     => array('title'=>A::t('app', 'Country Name'), 'type'=>'textbox', 'operator'=>'like%', 'width'=>'100px', 'maxLength'=>'32'),
                    'c_capital'  => array('title'=>A::t('app', 'Country Capital'), 'type'=>'textbox', 'operator'=>'like%', 'width'=>'100px', 'maxLength'=>'32'),
                ),
                'fields'=>array(
                    'c_name'         => array('title'=>A::t('app', 'Country'), 'type'=>'label', 'class'=>'left', 'headerClass'=>'left', 'width'=>'110px'),
                    'c_capital'      => array('title'=>A::t('app', 'Capital City'), 'type'=>'label', 'class'=>'left', 'headerClass'=>'left', 'width'=>'110px'),
                    'c_code'         => array('title'=>A::t('app', 'Country Code'), 'type'=>'label', 'class'=>'left', 'headerClass'=>'left'),
                    'c_language'     => array('title'=>A::t('app', 'Language'), 'type'=>'label', 'class'=>'center', 'headerClass'=>'center', 'width'=>'110px'),
    
                ),
                'actions'=>array(
                    'edit'   => array('link'=>'countries/editcountry/id/{id}', 'title'=>A::t('app', 'Edit this record')),
                    'delete' => array('link'=>'countries/delete/id/{id}', 'title'=>A::t('app', 'Delete this record'), 'onDeleteAlert'=>true),
                ),
            ));
        ?> 
    </p>
</center>
</article>
