<?php
/**
 * ApPHP Framework tests script
 *
 * This script will run tests on framework and existing applications
 */

$arr_projects = array(
    'framework'   => array('name'=>'Framework', 'path'=>''),
    'hello-world' => array('name'=>'Hello World', 'path'=>'../../demos/hello-world/protected/controllers/'),
    'static-site' => array('name'=>'Static Site', 'path'=>'../../demos/static-site/protected/controllers/'),
    'login-system' => array('name'=>'Simple Login System', 'path'=>'../../demos/login-system/protected/controllers/'),
    'simple-blog' => array('name'=>'Simple Blog Site', 'path'=>'../../demos/simple-blog/protected/controllers/'),
    'simple-cms' => array('name'=>'Simple CMS Site', 'path'=>'../../demos/simple-cms/protected/controllers/')
);
$arr_actions = array();
$arr_operations = array();

$project    = isset($_GET['project']) ? filter_var($_GET['project'], FILTER_SANITIZE_STRING) : '';
$action     = isset($_GET['action']) ? filter_var($_GET['action'], FILTER_SANITIZE_STRING) : '';
$operation  = isset($_GET['operation']) ? filter_var($_GET['operation'], FILTER_SANITIZE_STRING) : '';
$content    = '<h2>Tester</h2>To run new test select a Project and then an appropriate Action from the left dropdown boxes.';

////////////////////////////////////////////////////////////////////////////

$default_project = (isset($arr_projects[$project]) && $project != 'framework') ? $project : 'hello-world';

include_once('inc/functions.inc.php');
include_once('inc/header.inc.php');

////////////////////////////////////////////////////////////////////////////

if(!empty($project) && !empty($action) && !empty($operation)){
    $start_time = get_microtime();
}

if($project == 'framework'){
    $arr_actions = array('validator'=>'Validator', 'filter'=>'Filter');
    if(isset($arr_actions[$action])){
        if(file_exists('inc/'.$action.'/data.php')){
            include('inc/'.$action.'/data.php');  
            if(isset($prepare_data) && is_array($prepare_data)){
                $arr_operations['all'] = 'General Test (all)';
                foreach($prepare_data as $key => $val){
                    $arr_operations[$key] = $key;
                }
            }
            if($operation != ''){
                $test_data = array();
                if($operation === 'all'){
                    $test_data = $prepare_data;
                }else{
                    if(isset($prepare_data[$operation])) $test_data[$operation] =  $prepare_data[$operation];
                }
                include('inc/'.$action.'/test.php');
            }        
        }else{
            $content = '<span class="failed">Cannot open "inc/'.$action.'/data.php".</span>';	
        }
    }else if(!empty($action)){
        $content = '<span class="failed">Wrong parameter passed! Cannot find "'.$action.'" action.</span>';
    }
}else if(isset($arr_projects[$project])){
    $arr_actions = array('controller'=>'Controller');
    if(isset($arr_actions[$action])){
        if(file_exists('inc/'.$action.'/data.php')){
            include('inc/'.$action.'/data.php');  
            if(isset($prepare_data) && is_array($prepare_data)){
                $arr_operations['all'] = 'General Test (all)';
                foreach($prepare_data as $key => $val){
                    if($key == 'SetupController') continue;
                    $arr_operations[$key] = $key;
                }
            }
            if($operation != ''){
                $test_data = array(); 
                if($operation === 'all'){
                    $test_data = $prepare_data;
                }else{
                    if(isset($prepare_data[$operation])) $test_data[$operation] =  $prepare_data[$operation];
                }
                include('inc/'.$action.'/test.php');
            }        
        }else{
            $content = '<span class="failed">Cannot open "inc/'.$action.'/data.php".</span>';	
        }
    }else if(!empty($action)){
        $content = '<span class="failed">Wrong parameter passed! Cannot find "'.$action.'" action.</span>';
    }
}

if(!empty($project) && !empty($action) && !empty($operation)){
    $end_time = get_microtime();
    $exec_time = round((float)$end_time - (float)$start_time, 4).' sec.';                        
    
    $content .= '<hr/>Time to complete test: '.$exec_time;    
    $content .= '<br />';    
}

////////////////////////////////////////////////////////////////////////////

render_file(array(
    'arr_projects' => $arr_projects,
    'arr_actions' => $arr_actions,
    'arr_operations' => $arr_operations,
    'project' => $project,
    'action'  => $action,
    'content' => $content
));
