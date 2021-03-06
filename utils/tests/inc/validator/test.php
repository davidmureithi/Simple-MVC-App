<?php

$content = '';
$span = 1;
foreach($test_data as $key => $val){
	$content .= '<h2>'.$key.'</h2>';
	$content .= '<table class="result">';
	$content .= '<tr>';
	$span_temp = $span;
	while($span_temp--) $content .= '<th width="170px">Test Arguments</th><th width="100px">Result Value</th><th>Conclusion</th>';		
	$content .= '<tr>';
	$count = 0;
	foreach($val as $v_key => $v_val){
		if($count++ % $span == 0) $content .= '</tr><tr>';
		$parameters = (!is_array($v_val)) ? array($v_val) : $v_val;
		$result = call_user_func_array(array('CValidator', $key), $parameters);
		$content .= '<td>'.$v_val.'</td>
					 <td>'.($result ? 'true' : 'false').'</td>
					 <td>'.($result ? '<span class="ok">ok</span>' : '<span class="failed">failed</span>').'</td>';
	}
	$content .= '</tr>';
	$content .= '</table>';	
}

if(!count($test_data)){
	$content .= '<span class="failed">Wrong parameter passed! No tests were run.</span>';	
}

