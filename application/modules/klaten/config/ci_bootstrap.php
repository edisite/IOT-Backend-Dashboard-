<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'IOT PDAM KLATEN',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),
	    
	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(                                     
                        
//                        'plugins/jquery-countto/jquery.countTo.js',
//                        'plugins/raphael/raphael.min.js',
//                        'plugins/morrisjs/morris.js',
//                        'js/demo.js',
//                        'documentation/js/app.js',
//                        'plugins/bootstrap/js/bootstrap.js',
//                        'plugins/jquery-sparkline/jquery.sparkline.js'  ,
//                        'plugins/bootstrap-select/js/bootstrap-select.js',
//                        'plugins/jquery-slimscroll/jquery.slimscroll.js',
//                        'plugins/bootstrap-notify/bootstrap-notify.js',
//                        'js/pages/index.js',                       
//                        'plugins/jquery/jquery.min.js', 
//                        'plugins/chartjs/Chart.bundle.js',
//                        'plugins/node-waves/waves.js',
                        'https://code.highcharts.com/highcharts.js',
                        'https://code.highcharts.com/modules/exporting.js',
                        'https://code.highcharts.com/modules/export-data.js',
                        'https://code.highcharts.com/highcharts-more.js'
                        
		),
		'foot'	=> array(                                                                  
     
                        'plugins/jquery/jquery.min.js',
                        'plugins/bootstrap/js/bootstrap.js',
                        'plugins/bootstrap-select/js/bootstrap-select.js',
                        'plugins/jquery-slimscroll/jquery.slimscroll.js',
                        'plugins/node-waves/waves.js',
                        'plugins/jquery-countto/jquery.countTo.js',                    
//                        'plugins/raphael/raphael.min.js',
//                        'plugins/morrisjs/morris.js',
//                        'plugins/chartjs/Chart.bundle.js',
//                        'plugins/flot-charts/jquery.flot.js',
//                        'plugins/flot-charts/jquery.flot.resize.js',
//                        'plugins/flot-charts/jquery.flot.pie.js',
//                        'plugins/flot-charts/jquery.flot.categories.js',
//                        'plugins/flot-charts/jquery.flot.time.js',
//                        'plugins/jquery-sparkline/jquery.sparkline.js',
                    //
                        'plugins/jquery-inputmask/jquery.inputmask.bundle.js',
                        'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
                        'plugins/dropzone/dropzone.js',
                        'plugins/jquery-inputmask/jquery.inputmask.bundle.js',
                        'plugins/multi-select/js/jquery.multi-select.js',
                        'plugins/jquery-spinner/js/jquery.spinner.js',
                        'plugins/bootstrap-tagsinput/bootstrap-tagsinput.js',
                        'plugins/nouislider/nouislider.js',
                    //  datatables
                        //   q<!-- Autosize Plugin Js -->
                        'plugins/autosize/autosize.js',
                        //   q <!-- Moment Plugin Js -->
                        'plugins/momentjs/moment.js',
                        
                        'plugins/ion-rangeslider/js/ion.rangeSlider.js',
                        'js/pages/ui/range-sliders.js',
                    
                        'plugins/nestable/jquery.nestable.js',
                        'js/pages/ui/sortable-nestable.js',
                    
                        //   q<!-- Bootstrap Material Datetime Picker Plugin Js -->
                        'plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
                       
                        'js/pages/forms/basic-form-elements.js',

//                      'js/pages/ui/range-sliders.js',
                    //  Validation
                        'plugins/jquery-validation/jquery.validate.js',
                        'plugins/sweetalert/sweetalert.min.js',
                        'plugins/jquery-steps/jquery.steps.js',
                        

                    //  <!-- Jquery DataTable Plugin Js -->
                        'plugins/jquery-datatable/jquery.dataTables.js',
                        'plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js',
                        'plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js',
                        'plugins/jquery-datatable/extensions/export/buttons.flash.min.js',
                        'plugins/jquery-datatable/extensions/export/jszip.min.js',
                        'plugins/jquery-datatable/extensions/export/pdfmake.min.js',
                        'plugins/jquery-datatable/extensions/export/vfs_fonts.js',
                        'plugins/jquery-datatable/extensions/export/buttons.html5.min.js',
                        'plugins/jquery-datatable/extensions/export/buttons.print.min.js',
                        'js/pages/tables/editable-table.js',
                        'plugins/editable-table/mindmup-editabletable.js',
                        //
                        
                        // Custom Js
                        'js/admin.js',
                        'js/pages/tables/jquery-datatable.js' ,                   
                        'js/pages/forms/advanced-form-elements.js',
                        'js/pages/forms/form-validation.js',
                        'js/pages/index.js', 
                        'js/demo.js',
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
                        'https://fonts.googleapis.com/css?family=Roboto:400,700%20subset=latin,cyrillic-ext',
                        'https://fonts.googleapis.com/icon?family=Material+Icons',
                        'plugins/bootstrap/css/bootstrap.css',
                        'plugins/node-waves/waves.css',
                        'plugins/animate-css/animate.css',
                    
                        'plugins/ion-rangeslider/css/ion.rangeSlider.css',
                        'plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css',
                        //datepicker
                        'plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
                        //<!-- JQuery Nestable Css -->
                        'plugins/nestable/jquery-nestable.css',    
                   
                        'plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css',
                        'plugins/dropzone/dropzone.css',
                        'plugins/multi-select/css/multi-select.css',
                        'plugins/jquery-spinner/css/bootstrap-spinner.css',
                        'plugins/bootstrap-tagsinput/bootstrap-tagsinput.css',
                        'plugins/bootstrap-select/css/bootstrap-select.css',
                        'plugins/nouislider/nouislider.min.css',
                        
                        //Alert validation
                        'plugins/sweetalert/sweetalert.css',
                        
                        //dattables
                        'plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css',
                        'plugins/morrisjs/morris.css',
                        'plugins/waitme/waitMe.css',
                        'css/style.css',
                        'css/themes/all-themes.css',    
		)
	),


	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> 'web',
			'icon'		=> 'home',
		),	
                
                'reportreealtime' => array(
			'name'		=> 'Realtime',
			'url'		=> '',
			'icon'		=> 'insert_chart',
                        'children'  => array(
                            'Multi Sensor'      => 'report/MultiSensorRealtime',
                            'Diagram'           => 'http://pdam.iot-integrasi.com/dashboard/home/Xdbeuxb1737vshendj/?id=2392842429hhsfs8sjgrwr83dwjeg83',
			)
                        
		),
                'freereport' => array(
			'name'		=> 'Report',
			'url'		=> '',
			'icon'		=> 'insert_chart',
                        'children'  => array(
                            '2 Sensors'		=> 'report/R2sensor',
                            'Multi Sensor'	=> 'report/R4sensor',
                            'Periodic'          => 'report/multidate',
			)
                        
		),
//                'fullpage' => array(
//			'name'		=> 'Production',
//			'url'		=> 'report/production',
//			'icon'		=> 'insert_chart',
//		),
                'seach' => array(
			'name'		=> 'Searching Sensor',
			'url'		=> 'report/DeviceSearch',
			'icon'		=> 'search',
		),
                'alarm' => array(
			'name'		=> 'Setting Alarm',
			'url'		=> '',
			'icon'		=> 'alarm',
                        'children'  => array(
				'Group'             => 'Report/AlmCreateGroup',
				'Member'            => 'Report/AlmCreateMember',
				'Setting Alarm'     => 'report/setalarm',
			)
		),
                'thing' => array(
			'name'		=> 'Things',
			'url'		=> 'things',
			'icon'		=> 'create_new_folder',                        
		),
                'recon' => array(
			'name'		=> 'Recon',
			'url'		=> 'report/recon',
			'icon'		=> 'create_new_folder',                        
		),
                'origin' => array(
			'name'		=> 'Backup CSV',
			'url'		=> 'Origin',
			'icon'		=> 'widgets',
		),
//                'panel' => array(
//			'name'		=> 'Admin Panel',
//			'url'		=> 'panel',
//			'icon'		=> 'widgets',
//			'children'  => array(
//				'Admin Users'			=> 'panel/admin_user',
//				'Create Admin User'		=> 'panel/admin_user_create',
//				'Admin User Groups'		=> 'panel/admin_user_group',
//			)
//		),
		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'logout',
		)
	),

	// Login page
	'login_url' => 'klaten/login',

	// Restricted pages
	'page_auth' => array(
		'user/create'				=> array('webmaster', 'admin', 'manager'),
		'user/group'				=> array('webmaster', 'admin', 'manager'),
		'panel'					=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'               => array('webmaster'),
		'panel/admin_user_group'                => array('webmaster'),
		'util'					=> array('webmaster'),
		'util/list_db'				=> array('webmaster'),
		'util/backup_db'			=> array('webmaster'),
		'util/restore_db'			=> array('webmaster'),
		'util/remove_db'			=> array('webmaster'),
		'things'                                => array('webmaster'),
		'recon'                                 => array('webmaster'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'theme-blue',
			'admin'		=> 'theme-blue',
			'manager'	=> 'theme-teal',
			'staff'		=> 'theme-blue',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_admin';