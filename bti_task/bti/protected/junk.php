<?php
CActiveRecord
class Register extends CActiveRecord
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register($name, $username, $password)
    {       //INSERT INTO users (name, username, password)VALUES(:name, :uname, :password)"
        $result = $this->_db->insert('
            INSERT id, role
            INTO '.CConfig::get('db.prefix').'accounts (name, username, password)
            VALUES (:name, :username, :password)',
            array(
                ':name'     => $name,
                ':username' => $username,
                ':password' => ((CConfig::get('password.encryption')) ? CHash::create(CConfig::get('password.encryptAlgorithm'), $password, CConfig::get('password.hashKey')) : $password)
            )
        );

        if(!empty($result)){
            $session = A::app()->getSession();
            $session->set('loggedRole', $result[0]['role']);
            $session->set('loggedIn', true);
            $session->set('loggedId', $result[0]['id']);
            return true;
        }else{
            return false;        
        }        
    }    
}
<article>
    <div class="panel-content">

    <?php echo $actionMessage; ?>

    <?php
            
        echo CWidget::create('CFormView', array(
            'action'=>'countries/update',
            'method'=>'post',
            'htmlOptions'=>array(
                'name'=>'frmEditMenu'
            ),
            'fields'=>array(
                
                    'act'         =>array('type'=>'hidden', 'value'=>'send'),
                    'c_name'    => array('type'=>'textbox', 'title'=>A::t('app', 'First Name'), 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
                    'c_capital' => array('type'=>'textbox', 'title'=>A::t('app', 'Last Name'), 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
                    'c_code'    => array('type'=>'textbox', 'title'=>A::t('app', 'Display Name'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
                    'c_language'=> array('type'=>'textbox', 'title'=>A::t('app', 'Display Name'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
                
                
            ),
            'buttons'=>array(
                'submit'=>array('type'=>'submit', 'value'=>'Update'),
                'cancel'=>array('type'=>'button', 'value'=>'Cancel', 'htmlOptions'=>array('name'=>'', 'onclick'=>"$(location).attr('href','menus/index');"))
            ),
            'events'=>array(
                'focus'=>array('field'=>$errorField)
            ),
            'return'=>true,
        ));
    ?>

    </div>
    <div class="panel-settings">
        This page provides you possibility to edit admin's profile information.
        Enter the data you need and click Update button to save the changes.
    </div>
    <div class="clear"></div>
</article>

public function editcountryAction($Id = null)
    {
        // block access to this action for not-logged users
        CAuth::handleLogin();   
        
        $this->_view->setMetaTags('title', 'Edit Menu | '.$this->_view->cmsName);
        $this->_view->activeLink = 'edit_menu';

        $cnt = Countries::model()->findByPk($Id);
        if(!$cnt){
            $this->redirect('countries/index/msg/wrong-id');
        }
        
        $this->_view->Id = $cnt->id;
        $this->_view->menuName = $cnt->name;
        $this->_view->sortOrder = $cnt->sort_order;                    
        $this->_view->render('countries/editcountry');
    }

    <?php 
        if(empty($cnt)){
            echo 'No menus found. Use "New Menu" menu to add menus.';
        }else{
        echo '<table class="table-records">
            <thead>
            <tr>
                <th align="left">Menu Name</th>
                <th width="170px" align="center">Order</th>
                <th align="center" width="90px">Actions</th>
            </tr>
            </thead>
            <tbody>';

            foreach ($cnt as $cat) { ?> 
                <tr>
                    <td align="left" style="cursor:pointer;" onclick="window.location.href='menus/edit/id/<?php echo $cat['id'] ?>'" title="Click to edit"><?php echo $cat['c_name']?></td>
                    <td align="center"><?php echo $cat['sort_order']?></td>
                    <td align="center">
                        <a href="menus/edit/id/<?php echo $cat['id'] ?>">Edit</a> |
                        <a href="menus/delete/id/<?php echo $cat['id'] ?>" onclick="if(!confirm('Are you sure you want to delete this menu?\nNote: this will make all its menu links invisible to your site visitors!'))return false;">Delete</a>
                    </td>
                </tr>
            <?php 
            }
            echo '</tbody>';
            echo '</table>';
            
            echo CWidget::create('CPagination', array(
                'actionPath'   => 'menus/index',
                'currentPage'  => $currentPage,
                'pageSize'     => $pageSize,
                'totalRecords' => $totalRecords,
                'linkType' => 1,
                'paginationType' => 'fullNumbers'
            ));    
        }
        ?>


        <?php
        $buttons['submit'] = array('type'=>'submit', 'value'=>A::t('app', 'Update'), 'htmlOptions'=>array('name'=>''));
       
            $buttons['cancel'] = array('type'=>'button', 'value'=>A::t('app', 'Cancel'), 'htmlOptions'=>array('name'=>'', 'class'=>'button white'));
        
    
        echo CWidget::create('CFormView', array(
            'model'=>'Countries',
            'primaryKey'=>$admin->c_id,
            'operationType'=>'edit',
            'action'=>'countries/editcountry/id/'.$admin->c_id,
            'successUrl'=>'countries/view/msg/updated',
            'cancelUrl'=>'countries/view',
            'method'=>'post',
            
            'htmlOptions'=>array(
                'name'=>'frmAdminEdit',
                'enctype'=>'multipart/form-data',
                'autoGenerateId'=>true
            ),
            'requiredFieldsAlert'=>true,
            'fieldSetType'=>'frameset',
            'fields'=>array(
                'separatorPersonal' =>array(
                    'separatorInfo' => array('legend'=>A::t('app', 'Personal Information')),
                    'c_name'    => array('type'=>'textbox', 'title'=>A::t('app', 'First Name'), 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
                    'c_capital' => array('type'=>'textbox', 'title'=>A::t('app', 'Last Name'), 'validation'=>array('required'=>true, 'type'=>'mixed', 'maxLength'=>32), 'htmlOptions'=>array('maxlength'=>'32')),
                    'c_code'    => array('type'=>'textbox', 'title'=>A::t('app', 'Display Name'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
                    'c_language'=> array('type'=>'textbox', 'title'=>A::t('app', 'Display Name'), 'validation'=>array('required'=>false, 'type'=>'mixed', 'maxLength'=>50), 'htmlOptions'=>array('maxlength'=>'50')),
                
                ),
            ),
            'buttons'=>$buttons,
            'messagesSource'=>'core',
            'return'=>true,
        ));
    ?>

    <?php

public function editAction($menuId = null)
    {
        // block access to this action for not-logged users
        CAuth::handleLogin();   
        
        $this->_view->setMetaTags('title', 'Edit Menu | '.$this->_view->cmsName);
        $this->_view->activeLink = 'edit_menu';

        $menus = Menus::model()->findByPk($menuId);
        if(!$menus){
            $this->redirect('menus/index/msg/wrong-id');
        }
        
        $this->_view->menuId = $menus->id;
        $this->_view->menuName = $menus->name;
        $this->_view->sortOrder = $menus->sort_order;                    
        $this->_view->render('menus/edit');
    }


    echo CWidget::create('CFormView', array(
            'action'=>'menus/update',
            'method'=>'post',
            'htmlOptions'=>array(
                'name'=>'frmEditMenu'
            ),
            'fields'=>array(
                'act'         =>array('type'=>'hidden', 'value'=>'send'),
                'menuId'      =>array('type'=>'hidden', 'value'=>$menuId),
                'menuIdLabel' =>array('type'=>'label', 'title'=>'Menu ID', 'value'=>$menuId),
                'menuName'    =>array('type'=>'textbox', 'title'=>'Menu Name', 'value'=>$menuName, 'mandatoryStar'=>true, 'htmlOptions'=>array('maxlength'=>'50', 'class'=>'text_header', 'encode'=>true)),
                'sortOrder'  =>array('type'=>'textbox', 'title'=>'Sort Order', 'value'=>$sortOrder, 'mandatoryStar'=>true, 'htmlOptions'=>array('maxlength'=>'3', 'style'=>'width:40px', 'encode'=>true)),
            ),
            'buttons'=>array(
                'submit'=>array('type'=>'submit', 'value'=>'Update'),
                'cancel'=>array('type'=>'button', 'value'=>'Cancel', 'htmlOptions'=>array('name'=>'', 'onclick'=>"$(location).attr('href','menus/index');"))
            ),
            'events'=>array(
                'focus'=>array('field'=>$errorField)
            ),
            'return'=>true,
        ));






























<article>
    <center>
    <h1><?php echo A::t('app', 'Countries')?></h1>
    
    <div class="content">
        <?php echo $actionMessage; ?>
        <a href="countries/addcountry" class="add-new"><?php echo A::t('app', 'Add Country'); ?></a>
        <?php
            //A::t('app', 'Avatar')
            echo CWidget::create('CGridView', array(
                'model'=>'Countries',
                'actionPath'=>'countries/view',
                'defaultOrder'=>array('c_name'=>'ASC'),
                'passParameters'=>true,
                'pagination'=>array('enable'=>true, 'pageSize'=>20),
                'sorting'=>true,
                'filters'=>array(
                    'c_name'     => array('title'=>A::t('app', 'Country Name'), 'type'=>'textbox', 'operator'=>'like%', 'width'=>'100px', 'maxLength'=>'32'),
                    'c_capital'  => array('title'=>A::t('app', 'Country Capital'), 'type'=>'textbox', 'operator'=>'like%', 'width'=>'100px', 'maxLength'=>'32'),
                ),
                'fields'=>array(
                    'c_name'         => array('title'=>A::t('app', 'Country Name'), 'type'=>'label', 'class'=>'left', 'headerClass'=>'left', 'width'=>'110px'),
                    'c_capital'      => array('title'=>A::t('app', 'Country Capital'), 'type'=>'label', 'class'=>'left', 'headerClass'=>'left', 'width'=>'110px'),
                    'c_code'         => array('title'=>A::t('app', 'Country Code'), 'type'=>'label', 'class'=>'left', 'headerClass'=>'left'),
                    'c_language'     => array('title'=>A::t('app', 'Country Language'), 'type'=>'label', 'class'=>'center', 'headerClass'=>'center', 'width'=>'110px'),
    
                ),
                'actions'=>array(
                    'edit'   => array('link'=>'countries/editcountry/id/{id}', 'title'=>A::t('app', 'Edit this record')),
                    'delete' => array('link'=>'countries/delete/id/{id}', 'title'=>A::t('app', 'Delete this record'), 'onDeleteAlert'=>true),
                ),
            ));
        ?> 
              
    </div>
</center>

</article>
















    /**
     * Edit admin action handler
     * @param int $id The admin id 
     */
    public function editAction($id = 0)
    {
        $this->_view->activeLink = 'countries';
                      
        //$this->_view->activeLink = 'admins';
        $cnt = Countries::model()->findByPk((int)$id);
        
        // allow access to edit other admins only to site owner or main admin
        if(!CAuth::isLoggedIn()){
            $this->redirect('login/index');
        }
        //$this->_view->admin = $cnt;        $this->_view->password = '';        $this->_view->passwordRetype = '';
       
        $this->_view->render('countries/editcountry');
    }

    /**
     * My Account action handler
     * Calls the editAction with id of logged admin.
     */
    public function myAccountAction()
    {
        $this->_view->activeLink = 'myAccount';
        $this->editAction($this->_loggedId);        
    }

    public function addcountryAction()
    {
        $this->_view->header = 'David';
        $this->_view->text = '
            This is a template for a simple login system website. It includes a few pages and simple structure<br>
            consists from header, footer and a central part. It also includes a protected area, that may be <br>
            accessed by access after login. Use it as a starting point to create something more unique.
            <br><br>
            Click links from the top menu to see the site in work.
        ';
        $this->_view->render('countries/addcountry');   
    }
   

    /**
     * Delete admin action handler
     * @param int $id The admin id 
     */
    public function deleteAction($id = 0)
    {
        // allow access only to site owner or main admin
        //if(!CAuth::isLoggedInAs('owner', 'mainadmin')){           $this->redirect('backend/index');        }
                    
        $msg = '';
        $msgType = '';
    
        //$admin = Admins::model()->findByPk((int)$id);     if(!$admin){            $this->redirect('countries/index');     }
        
        $cnt = Countries::model()->findByPk((int)$id);
               if(!$admin)
                {
                    $this->redirect('countries/index');     
                }
        

        // check if this delete operation is allowed
        if(1==2){ //!in_array($admin->role, array_keys($this->_view->rolesList))
            $msg = A::t('core', 'Operation Blocked Error Message');
            $msgType = 'error';
        // delete the admin
        }else if($cnt->delete()){
            $msg = A::t('core', 'Deleting operation has been successfully completed!');
            $msgType = 'success';
        }else{
            if(APPHP_MODE == 'demo'){
                $msg = CDatabase::init()->getErrorMessage();
            }else{
                $msg = A::t('core', 'An error occurred while deleting the record!');    
            }
            $msgType = 'error';
        }
        if(!empty($msg)){
            $this->_view->actionMessage = CWidget::create('CMessage', array($msgType, $msg, array('button'=>true)));
        }
        $this->_view->render('admins/view');
    }


    
}


