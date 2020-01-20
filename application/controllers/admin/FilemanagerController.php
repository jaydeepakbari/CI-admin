<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class FilemanagerController extends CI_Controller {
	public $DIR_IMAGE = '';
	public $IMAGE_LIMIT = '';

	public function __construct(){
		parent::__construct();
		$this->DIR_IMAGE  = strtr(rtrim(FCPATH."assets/images/", '/\\'),'/\\',DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
		$this->IMAGE_LIMIT = 30;
	}

	public function index($page=1){
		$get = $this->input->get();

		$server = base_url('/');
		if (isset($get['filter_name'])) {
			$filter_name = rtrim(str_replace(array('*', '/', '\\'), '', $get['filter_name']), '/');
		} else {
			$filter_name = '';
		}

		if (isset($get['type']) && $get['type'] != 'undefined') {
			$type = $get['type'];
		} else {
			$type = '';
		}

		// Make sure we have the correct directory
		if (isset($get['directory'])) {
			$directory = rtrim($this->DIR_IMAGE . str_replace('*', '', $get['directory']), '/');
		} else {
			$directory = $this->DIR_IMAGE;
		}

		$directories = array();
		$files = array();

		$data['images'] = array();
		if (substr(str_replace('\\', '/', realpath($directory) . '/' . $filter_name), 0, strlen($this->DIR_IMAGE)) == str_replace('\\', '/', $this->DIR_IMAGE )) {
			$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);
			 
			if (!$directories) { $directories = array(); }

			$directories = array_map(function($v){
				return !endsWith($v,"cache") ? $v : '';
			}, $directories);
			$directories = array_filter($directories);

			$files = glob($directory . '/' . $filter_name . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

			if (!$files) {
				$files = array();
			}
		}
		
		$images = array_merge($directories, $files);
		$image_total = $images;
		$perPage = $this->IMAGE_LIMIT;
		$offset = ($page * $perPage) - $perPage;

		$images = new \Illuminate\Pagination\LengthAwarePaginator(
		    array_slice($image_total, $offset, $perPage, true),
		    count($image_total),
		    $perPage,
		    $page,
		    ['path' => route('admin.filemanager.index'), 'query' => $get]
		);

		$config['base_url']   = route('admin.filemanager.index');
		$config['use_page_numbers']   = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['total_rows']         = count($image_total);
		$config['per_page']           = $this->IMAGE_LIMIT;
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
			
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$url = '';
		if (isset($get['target'])) { $url .= '&target=' . $get['target']; }
		if (isset($get['thumb'])) { $url .= '&thumb=' . $get['thumb']; }

		foreach ($images->items() as $image) {
			$name = str_split(basename($image), 14);
			if (is_dir($image)) {
				$data['images'][] = array(
					'thumb' => '',
					'name'  => implode(' ', $name),
					'type'  => 'directory',
					'path'  => substr($image, strlen($this->DIR_IMAGE)),
					'href'  => route('admin.filemanager.index'). '?directory=' . urlencode(substr($image, strlen($this->DIR_IMAGE))) .$url,
				);
			} elseif (is_file($image)) {
				$data['images'][] = array(
					'thumb' => RImage::resize(substr($image, strlen($this->DIR_IMAGE)), 100, 100),
					'name'  => implode(' ', $name),
					'type'  => 'image',
					'path'  => substr($image, strlen($this->DIR_IMAGE)),
					'href'  => $server . 'image/' . substr($image, strlen($this->DIR_IMAGE))
				);
			}
		}
		

		if (isset($get['directory'])) {
			$data['directory'] = urlencode($get['directory']);
		} else {
			$data['directory'] = '';
		}

		if (isset($get['filter_name'])) {
			$data['filter_name'] = $get['filter_name'];
		} else {
			$data['filter_name'] = '';
		}

		if (isset($get['target'])) {
			$data['target'] = $get['target'];
		} else {
			$data['target'] = '';
		}

		if (isset($get['thumb'])) {
			$data['thumb'] = $get['thumb'];
		} else {
			$data['thumb'] = '';
		}

		$url = '';

		if (isset($get['directory'])) {
			$pos = strrpos($get['directory'], '/');

			if ($pos) {
				$url .= '&directory=' . urlencode(substr($get['directory'], 0, $pos));
			}
		}

		if (isset($get['target'])) {
			$url .= '&target=' . $get['target'];
		}

		if (isset($get['thumb'])) {
			$url .= '&thumb=' . $get['thumb'];
		}

		$data['parent'] = route('admin.filemanager.index'). '?user_token=' . $url;

		// Refresh
		$url = '';

		if (isset($get['directory'])) {
			$url .= '&directory=' . urlencode($get['directory']);
		}

		if (isset($get['target'])) {
			$url .= '&target=' . $get['target'];
		}

		if (isset($get['thumb'])) {
			$url .= '&thumb=' . $get['thumb'];
		}

		if (isset($get['filter_name'])) {
			$url .= '&filter_name=' . $get['filter_name'];
		}
	
		$data['refresh'] = route('admin.filemanager.index'). '?user_token=' . $url;

		$url = '';

		if (isset($get['directory'])) {
			$url .= '&directory=' . urlencode(html_entity_decode($get['directory'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($get['target'])) {
			$url .= '&target=' . $get['target'];
		}

		if (isset($get['thumb'])) {
			$url .= '&thumb=' . $get['thumb'];
		}

		$data['token'] = '';
		$this->load->view('admin/filemanager/modal', $data);
	}

	public function delete_photos(){
		$get = $this->input->post();
		$json = array();

		if (isset($get['path'])) {
			$paths = $get['path'];
		} else {
			$paths = array();
		}

		
		foreach ($paths as $path) {
			if ($path == $this->DIR_IMAGE || substr(str_replace('\\', '/', realpath($this->DIR_IMAGE . $path)), 0, strlen($this->DIR_IMAGE)) != str_replace('\\', '/', $this->DIR_IMAGE)) {
				$json['error'] = 'error_delete';
				break;
			}
		}

		if (!$json) {	
			foreach ($paths as $path) {
				$path = rtrim($this->DIR_IMAGE . $path, '/');
				if (is_file($path)) { unlink($path); } 
				elseif (is_dir($path)) {
					$files = array();
					$path = array($path);

					while (count($path) != 0) {
						$next = array_shift($path);
						foreach (glob($next) as $file) {
							if (is_dir($file)) {
								$path[] = $file . '/*';
							}
							$files[] = $file;
						}
					}

					rsort($files);

					foreach ($files as $file) {
						if (is_file($file)) {
							unlink($file);
						} elseif (is_dir($file)) {
							rmdir($file);
						}
					}
				}
			}

			$json['success'] = 'Photo Deleted Successfully';
		}

		echo json_encode($json);
	}

	public function upload_photos() {
		$get = $this->input->get();
		$json = array();
		
		if (isset($get['directory'])) {
			$directory = rtrim($this->DIR_IMAGE  . $get['directory'], '/');
		} else {
			$directory = $this->DIR_IMAGE;
		}

		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = 'error_directory';
		}


		if (!$json) {
			$files = array();

			if (!empty($_FILES['file']['name']) && is_array($_FILES['file']['name'])) {
				foreach (array_keys($_FILES['file']['name']) as $key) {
					$files[] = array(
						'name'     => $_FILES['file']['name'][$key],
						'type'     => $_FILES['file']['type'][$key],
						'tmp_name' => $_FILES['file']['tmp_name'][$key],
						'error'    => $_FILES['file']['error'][$key],
						'size'     => $_FILES['file']['size'][$key]
					);
				}
			}
			
			foreach ($files as $file) {
				if (is_file($file['tmp_name'])) {
					// Sanitize the filename
					$filename = basename(html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8'));

					// Validate the filename length
					if ((strlen($filename) < 3) || (strlen($filename) > 255)) {
						$json['error'] = 'error_filename';
					}

					$allowed = array('jpg','jpeg','gif','png');

					if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
						$json['error'] = 'error_filetype';
					}


					$allowed = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');

					if (!in_array($file['type'], $allowed)) {
						$json['error'] = 'error_filetype';
					}

					// Return any upload error
					if ($file['error'] != UPLOAD_ERR_OK) {
						$json['error'] = 'error_upload_' . $file['error'];
					}
				} else {
					$json['error'] = 'error_upload';
				}

				if (!$json) {
					move_uploaded_file($file['tmp_name'], $directory . '/' . $filename);
				}
			}
		}

		if (!$json) {
			$json['success'] = 'text_uploaded';
		}

		echo json_encode($json);
	}

	public function folder_create() {
		$get = $this->input->post();
		$json = array();

		if (isset($get['directory'])) {
			$directory = rtrim($this->DIR_IMAGE  . $get['directory'], '/');
		} else {
			$directory = $this->DIR_IMAGE;
		}

		if (!is_dir($directory)) {
			$json['error'] = 'error_directory';
		}


		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$folder = basename(html_entity_decode($get['folder'], ENT_QUOTES, 'UTF-8'));

			if ((strlen($folder) < 3) || (strlen($folder) > 128)) {
				$json['error'] = 'Folder name must be between 3 and 128';
			}

			// Check if directory already exists or not
			if (is_dir($directory . '/' . $folder)) {
				$json['error'] = 'error_exists';
			}
		}

		if (!isset($json['error'])) {
			mkdir($directory . '/' . $folder, 0777);
			chmod($directory . '/' . $folder, 0777);
			@touch($directory . '/' . $folder . '/' . 'index.html');

			$json['success'] = 'text_directory';
		}

		echo json_encode($json);
	}
}
