 <?php
/**
* CountriesController
*
*This controller handles the business logic of the countries data layer/ view
*
* PUBLIC:                  PRIVATE
* -----------              ------------------
* __construct              
* indexAction
* editcountryAction
* addAction
* deleteAction
*/
class CountriesController extends CController
{

     public function __construct()
    {
        parent::__construct();

        // let us block access to the countries controller for not-logged in users
        CAuth::handleLogin();   
            
        $this->_loggedId = CAuth::getLoggedId();

        
        $this->_view->setMetaTags('title', 'BTI MILLMAN');
        $this->_view->setMetaTags('keywords', 'bti');
        $this->_view->setMetaTags('description', 'BTI task');
        
        $this->_view->activeLink = ('countries');
        $this->_view->viewRightMenu = false;
        $this->_view->errorField = '';
        $this->_view->actionMessage = '';

    }

    
    public function indexAction()
    {
        $this->redirect('countries/view');
    }

    /**
     * View countries action handler
     * this function is used to display our countries view
     */
    public function viewAction($msg = '')
    {
        $this->_view->activeLink = 'countries';
        switch($msg){
            case 'added': 
                $message = A::t('core', 'The adding operation has been successfully completed!');
                break;                      
            case 'updated': 
                $message = A::t('core', 'The updating operation has been successfully completed!');
                break;                      
            default:
                $message = '';                      
        }
        if(!empty($message)){
            $this->_view->actionMessage = CWidget::create('CMessage', array('success', $message, array('button'=>true)));
        }
        $this->_view->render('countries/view');
    }

    /**
     * Edit admin action handler
     * @param int $id The admin id 
     */
    public function editcountryAction($id = 0)
    
    {  
        $this->_view->activeLink = 'countries';
        $cnt = Countries::model()->findByPk((int)$id);
        if(!$cnt){
          $this->redirect('index/index');
        }

        $this->_view->isMyAccount = ($cnt->id == $this->_loggedId ? true : false);

        if($this->_view->isMyAccount == true) $this->_view->activeLink = 'myAccount';

        // allow access to edit other admins only to site owner or main admin
        if(!$this->_view->isMyAccount && !CAuth::isLoggedIn()){
            $this->redirect('login/index');
        }
        $this->_view->cnt = $cnt;
        $this->_view->c_name = 'Kenya';
        $this->_view->c_capital = '';
       
        $this->_view->render('countries/editcountry');
    }

       

    /**
     * My Account action handler
     * Calls the editAction with id of logged admin.
     */
    public function myAccountAction()
    {
        $this->_view->activeLink = 'myAccount';
        $this->editcountryAction($this->_loggedId);        
    }

    public function addcountryAction()
    {
         // allow access only to site owner or main admin
        if(!CAuth::isLoggedIn()){
            $this->redirect('backend/index');
        }
        $this->_view->render('countries/addcountry');   
    }
   

    /**
     * Delete admin action handler
     * @param int $id The admin id 
     */
    public function deleteAction($id = 0)
    {
        // allow access only to site owner or main admin
        if(!CAuth::isLoggedIn()){
            $this->redirect('login/index');
        }
    	    		
    	$msg = '';
    	$msgType = '';

        $cnt = Countries::model()->findByPk((int)$id);
               if(!$cnt)
                {
                    $this->redirect('countries/index');     
                }

        if(empty($cnt)){
            $msg = A::t('core', 'Operation Blocked');
            $msgType = 'error';
        
        	// delete the admin
        	}else if($cnt->delete()){
            	$msg = A::t('core', 'Record deleted successfully!');
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
    	$this->_view->render('countries/view');
    }

	
}


