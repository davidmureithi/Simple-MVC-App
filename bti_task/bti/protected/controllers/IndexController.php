<?php

class IndexController extends CController
{
    
	public function __construct()
	{
        parent::__construct();

		$this->_view->setMetaTags('title', 'BTIMILLMAN');
		$this->_view->setMetaTags('author', 'David Ndekere');
		$this->_view->setMetaTags('keywords', 'bti, david, task');
		$this->_view->setMetaTags('description', 'This is a Task.');
    }
	
	public function indexAction()
	{
        $this->_view->header = 'Welcome';
        $this->_view->text = '
			Welcome to BTI.
		';
        $this->_view->render('index/index');		
    }
	
}