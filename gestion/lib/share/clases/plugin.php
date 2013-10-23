<?php
function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
	global $wp_filter, $merged_filters;
	$idx = _wp_filter_build_unique_id($tag, $function_to_add, $priority);
	$wp_filter[$tag][$priority][$idx] = array('function' => $function_to_add, 'accepted_args' => $accepted_args);
	unset( $merged_filters[ $tag ] );
	return true;
}
function has_filter($tag, $function_to_check = false) {
	global $wp_filter;
	$has = !empty($wp_filter[$tag]);
	if ( false === $function_to_check || false == $has )
		return $has;
	if ( !$idx = _wp_filter_build_unique_id($tag, $function_to_check, false) )
		return false;
	foreach ( array_keys($wp_filter[$tag]) as $priority ) {
		if ( isset($wp_filter[$tag][$priority][$idx]) )
			return $priority;
	}
	return false;
}
function apply_filters($tag, $value) {
	global $wp_filter, $merged_filters, $wp_current_filter;
	$args = array();
	$wp_current_filter[] = $tag;
	// Do 'all' actions first
	if ( isset($wp_filter['all']) ) {
		$args = func_get_args();
		_wp_call_all_hook($args);
	}
	if ( !isset($wp_filter[$tag]) ) {
		array_pop($wp_current_filter);
		return $value;
	}
	// Sort
	if ( !isset( $merged_filters[ $tag ] ) ) {
		ksort($wp_filter[$tag]);
		$merged_filters[ $tag ] = true;
	}
	reset( $wp_filter[ $tag ] );
	if ( empty($args) )
		$args = func_get_args();
	do {
		foreach( (array) current($wp_filter[$tag]) as $the_ )
			if ( !is_null($the_['function']) ){
				$args[1] = $value;
				$value = call_user_func_array($the_['function'], array_slice($args, 1, (int) $the_['accepted_args']));
			}
	} while ( next($wp_filter[$tag]) !== false );
	array_pop( $wp_current_filter );
	return $value;
}
function remove_filter($tag, $function_to_remove, $priority = 10, $accepted_args = 1) {
	$function_to_remove = _wp_filter_build_unique_id($tag, $function_to_remove, $priority);
	$r = isset($GLOBALS['wp_filter'][$tag][$priority][$function_to_remove]);
	if ( true === $r) {
		unset($GLOBALS['wp_filter'][$tag][$priority][$function_to_remove]);
		if ( empty($GLOBALS['wp_filter'][$tag][$priority]) )
			unset($GLOBALS['wp_filter'][$tag][$priority]);
		unset($GLOBALS['merged_filters'][$tag]);
	}
	return $r;
}
function current_filter() {
	global $wp_current_filter;
	return end( $wp_current_filter );
}
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
	return add_filter($tag, $function_to_add, $priority, $accepted_args);
}
function do_action($tag, $arg = '') {
	global $wp_filter, $wp_actions, $merged_filters, $wp_current_filter;
	if ( is_array($wp_actions) )
		$wp_actions[] = $tag;
	else
		$wp_actions = array($tag);
	$wp_current_filter[] = $tag;
	// Do 'all' actions first
	if ( isset($wp_filter['all']) ) {
		$all_args = func_get_args();
		_wp_call_all_hook($all_args);
	}
	if ( !isset($wp_filter[$tag]) ) {
		array_pop($wp_current_filter);
		return;
	}
	$args = array();
	if ( is_array($arg) && 1 == count($arg) && is_object($arg[0]) ) // array(&$this)
		$args[] =& $arg[0];
	else
		$args[] = $arg;
	for ( $a = 2; $a < func_num_args(); $a++ )
		$args[] = func_get_arg($a);
	// Sort
	if ( !isset( $merged_filters[ $tag ] ) ) {
		ksort($wp_filter[$tag]);
		$merged_filters[ $tag ] = true;
	}
	reset( $wp_filter[ $tag ] );
	do {
		foreach ( (array) current($wp_filter[$tag]) as $the_ )
			if ( !is_null($the_['function']) )
				call_user_func_array($the_['function'], array_slice($args, 0, (int) $the_['accepted_args']));

	} while ( next($wp_filter[$tag]) !== false );
	array_pop($wp_current_filter);
}
function did_action($tag) {
	global $wp_actions;
	if ( empty($wp_actions) )
		return 0;
	return count(array_keys($wp_actions, $tag));
}
function do_action_ref_array($tag, $args) {
	global $wp_filter, $wp_actions, $merged_filters, $wp_current_filter;
	if ( !is_array($wp_actions) )
		$wp_actions = array($tag);
	else
		$wp_actions[] = $tag;
	$wp_current_filter[] = $tag;
	// Do 'all' actions first
	if ( isset($wp_filter['all']) ) {
		$all_args = func_get_args();
		_wp_call_all_hook($all_args);
	}
	if ( !isset($wp_filter[$tag]) ) {
		array_pop($wp_current_filter);
		return;
	}
	// Sort
	if ( !isset( $merged_filters[ $tag ] ) ) {
		ksort($wp_filter[$tag]);
		$merged_filters[ $tag ] = true;
	}
	reset( $wp_filter[ $tag ] );
	do {
		foreach( (array) current($wp_filter[$tag]) as $the_ )
			if ( !is_null($the_['function']) )
				call_user_func_array($the_['function'], array_slice($args, 0, (int) $the_['accepted_args']));
	} while ( next($wp_filter[$tag]) !== false );
	array_pop($wp_current_filter);
}
function has_action($tag, $function_to_check = false) {
	return has_filter($tag, $function_to_check);
}
function remove_action($tag, $function_to_remove, $priority = 10, $accepted_args = 1) {
	return remove_filter($tag, $function_to_remove, $priority, $accepted_args);
}
function plugin_basename($file) {
	$file = str_replace('\\','/',$file); // sanitize for Win32 installs
	$file = preg_replace('|/+|','/', $file); // remove any duplicate slash
	$file = preg_replace('|^.*/' . PLUGINDIR . '/|','',$file); // get relative path from plugins dir
	return $file;
}
function register_activation_hook($file, $function) {
	$file = plugin_basename($file);
	add_action('activate_' . $file, $function);
}
function register_deactivation_hook($file, $function) {
	$file = plugin_basename($file);
	add_action('deactivate_' . $file, $function);
}
function _wp_call_all_hook($args) {
	global $wp_filter;
	reset( $wp_filter['all'] );
	do {
		foreach( (array) current($wp_filter['all']) as $the_ )
			if ( !is_null($the_['function']) )
				call_user_func_array($the_['function'], $args);
	} while ( next($wp_filter['all']) !== false );
}
function _wp_filter_build_unique_id($tag, $function, $priority) {
	global $wp_filter;
	// If function then just skip all of the tests and not overwrite the following.
	if ( is_string($function) )
		return $function;
	// Object Class Calling
	else if (is_object($function[0]) ) {
		$obj_idx = get_class($function[0]).$function[1];
		if ( !isset($function[0]->wp_filter_id) ) {
			if ( false === $priority )
				return false;
			$count = count((array)$wp_filter[$tag][$priority]);
			$function[0]->wp_filter_id = $count;
			$obj_idx .= $count;
			unset($count);
		} else
			$obj_idx .= $function[0]->wp_filter_id;
		return $obj_idx;
	}
	// Static Calling
	else if ( is_string($function[0]) )
		return $function[0].$function[1];
}
?>
