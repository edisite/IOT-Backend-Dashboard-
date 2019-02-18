<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_data extends CI_Model {


   
    public function get_map($name)
    {
    
        $sql = $this->db->query("SELECT name, address, lat,lng FROM `fsm_location`");

        return $sql->result();  
    }
    public function get_lat($name)
    {
        $lat = 0;
        $lng = 0;
        $Ngeng = $this->db->query("SELECT lat, lng FROM fsm_location limit 1");

        $Ihik = $Ngeng->result();
        if($Ihik){
            foreach ($Ihik as $v) {
                $lat = $v->lat;
                $lng = $v->lng;
            }
        }

        if(empty($lat)){
            $lat = '-6.244815';
        }
        if(empty($lng)){
            $lat = '106.860372';
        }
        
        $bekakak = $lat.', '.$lng;

        return $bekakak;
    }


}
