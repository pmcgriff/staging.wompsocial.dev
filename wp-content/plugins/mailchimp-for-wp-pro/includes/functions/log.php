<?php
if( ! defined( "MC4WP_VERSION" ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
* Log a MailChimp for WordPress sign-up request
*
* @param string $email
* @param array $list_ids
* @param string $signup_method
* @param array $merge_vars
* @param int $form_id
* @param int $comment_id
* @param string $url
*
* @return boolean
*/
function mc4wp_log( $email, array $list_ids, $signup_method, $signup_type, array $merge_vars = array(), $form_id = null, $comment_id = null, $url = '' ) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'mc4wp_log';
	$list_ids = implode(',', $list_ids);

	return $wpdb->insert( $table_name, array(
			'email' => $email,
			'list_ids' => $list_ids,
			'signup_method' => $signup_method,
			'signup_type' => $signup_type,
			'form_ID' => $form_id,
			'comment_ID' => $comment_id,
			'merge_vars' => json_encode( $merge_vars ),
			'datetime' => current_time( 'mysql' ),
			'url' => $url
		)
	);

}

/**
* Query the MC4WP_Log table
* 
* @param array $args (optional)
* @return array 
*/
function mc4wp_get_logs( array $args = array() ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'mc4wp_log';

	$args = wp_parse_args( $args, array(
			'select' => '*',
			'email' => '',
			'signup_method' => '',
			'limit' => 1,
			'offset' => 0,
			'orderby' => 'id',
			'order' => 'DESC'
		) );

	extract( $args );
	$where = array();
	$params = array();

	$sql = "SELECT $select FROM {$table_name}";

	if ( !empty( $email ) ) {
		$where[]= "email LIKE %s";
		$params[] = $email. '%';
	}

	if ( !empty( $signup_method ) && in_array( $signup_method, array( 'form', 'checkbox' ) ) ) {
		$where[] = "signup_method = %s";
		$params[] = $signup_method;
	}

	if ( !empty( $where ) ) {
		$sql .= ' WHERE '. implode( ' AND ', $where );
	}

	$sql .= " ORDER BY $orderby $order LIMIT {$offset}, {$limit}";
	// prepare and run query
	$query = $wpdb->prepare( $sql, $params );

	if ( $select == 'COUNT(*)' ) {
		return (int) $wpdb->get_var( $query );
	} elseif ( $limit == 1 ) {
		return $wpdb->get_row( $query );
	} else {
		return $wpdb->get_results( $query );
	}

}

/**
* Delete one or multiple logs by ID
* @param array $ids
*/
function mc4wp_delete_logs( array $ids ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'mc4wp_log';

	$comma_separated_ids = implode( ',', $ids );
	return $wpdb->query( "DELETE FROM {$table_name} WHERE id IN ({$comma_separated_ids})" );
}
