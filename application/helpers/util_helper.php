<?php

function dateFormat($date){
	return date("d M Y h:i A",strtotime($date));
}

function endsWith($haystack, $needle){
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function makePaginate(&$query, $config){
	$limit = $query->perPage();
	$total = $query->total();
	$page  = $query->currentPage();
	$first = $total > 0 ? (($page * $limit) - $limit +1) : 0;
	$last  = ($total > ($page * $limit)) ? ($page * $limit) : $total;

	$query->paginate_text = "Showing <span>". ($first) ."</span> to <span>". $last ."</span> of <span>". $total ."</span> entries";

	$config['use_page_numbers']   = TRUE;
	$config['reuse_query_string'] = TRUE;
	$config['total_rows']         = $total;
	$config['per_page']           = $limit;
	$config['full_tag_open']      = '<ul class="pagination m-0 ml-auto">';
	$config['full_tag_close']     = '</ul>';
	$config['num_tag_open']       = '<li class="page-item">';
	$config['num_tag_close']      = '</li>';
	$config['cur_tag_open']       = '<li class="page-item active"><span class="page-link">';
	$config['cur_tag_close']      = '<span class="sr-only">(current)</span></span></li>';
	$config['next_tag_open']      = '<li class="page-item">';
	$config['next_tagl_close']    = '<span aria-hidden="true">&raquo;</span></li>';
	$config['prev_tag_open']      = '<li class="page-item">';
	$config['prev_tagl_close']    = '</li>';
	$config['first_tag_open']     = '<li class="page-item">';
	$config['first_tagl_close']   = '</li>';
	$config['last_tag_open']      = '<li class="page-item">';
	$config['last_tagl_close']    = '</li>';
	$config['next_link']          = 'Next <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><polyline points="9 18 15 12 9 6"></polyline></svg>';
	$config['prev_link']          = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><polyline points="15 18 9 12 15 6"></polyline></svg> Prev';
	$config['attributes']         = array('class' => 'page-link');
		
	$ci = &get_instance();
	$ci->pagination->initialize($config);
	$query->paginate = $ci->pagination->create_links();
}

function set_message($type, $message){
	$ci = &get_instance();
	$ci->session->set_flashdata($type, $message);
}

function bcrypt_hash($password, $work_factor = 8){    
    if (! function_exists('openssl_random_pseudo_bytes')) {
        throw new Exception('Bcrypt requires openssl PHP extension');
    }

    if ($work_factor < 4 || $work_factor > 31) $work_factor = 8;
    $salt = 
        '$2a$' . str_pad($work_factor, 2, '0', STR_PAD_LEFT) . '$' .
        substr(
            strtr(base64_encode(openssl_random_pseudo_bytes(16)), '+', '.'), 
            0, 22
        )
    ;

    return crypt($password, $salt);
}

function bcrypt_check($password, $stored_hash, $legacy_handler = NULL){
    if (bcrypt_is_legacy_hash($stored_hash)) {
        if ($legacy_handler) return call_user_func($legacy_handler, $password, $stored_hash);
        else throw new Exception('Unsupported hash format');
    }

    return crypt($password, $stored_hash) == $stored_hash;
}

function bcrypt_is_legacy_hash($hash) { return substr($hash, 0, 4) != '$2a$'; }

function token($length_of_string=10){ 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    return substr(str_shuffle($str_result),0, $length_of_string); 
} 