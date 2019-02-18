<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Monitoring
 *
 * @author edisite
 */
class Monitoring extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('Googlemaps');
        $this->load->model('M_data');
    }
    public function index() {
        $name = isset($_SESSION['name']) ?: 'Superadmin';

        $Wiw = $this->M_data->get_lat($name);

        if($name == 'Superadmin')
        {
                $config['center'] = ''.$Wiw.'';
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);
        }
        else
        {
                $config['center'] = ''.$Wiw.''; //-5.7773016, 106.1161286
                $config['zoom'] = 11;
                $this->googlemaps->initialize($config);
        }


        $infoMarkers = $this->M_data->get_map($name);
        foreach ($infoMarkers as $infoMarker) {
            $marker = array();
            if(empty($infoMarker->lat) && empty($infoMarker->lng)){
                $infoMarker->lat = '-6.244815';
                $infoMarker->lng = '106.860372';
                $infoMarker->name = 'Default';
                $infoMarker->address = 'Default';
            }
            
            $marker['position'] = $infoMarker->lat.",".$infoMarker->lng;
            $marker['infowindow_content'] = "<p align='center'><b>".$infoMarker->name."</b></p>".$infoMarker->address;
            $this->googlemaps->add_marker($marker);
        }

        
        $circle = array();
        $circle['center'] = ''.$Wiw.'';
        $circle['radius'] = '10000';
        $this->googlemaps->add_circle($circle);
        

        $this->mViewData['map'] = $this->googlemaps->create_map();
        $this->render('monitoring/maps_view');
    }
}
