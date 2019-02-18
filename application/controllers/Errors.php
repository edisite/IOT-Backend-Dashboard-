<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller {

	// Override 404 error
	// Match with $route['404_override'] value from /application/config/routes.php
	public function page_missing()
	{
		redirect(base_url().'storefront');
	}
}