<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ajax extends CI_Controller
{

    public function set_or_delete_basket()
    {
        $this->load->library('session');
        $urun_id = $this->input->post('urun_id');
        $urun_adet = $this->input->post('urun_adet');
        $urun_adet = ($urun_adet < 0) ? 1 : $urun_adet;
        if (is_numeric($urun_id) && is_numeric($urun_adet)) {
            if ($this->session->userdata("oturum") && $this->session->userdata("kullanici_id") && $this->session->userdata("oturum") == true) {
                $this->load->database();
                $kullanici_id = $this->session->userdata("kullanici_id");
                $basket_query = $this->db->get_where('sepet', array('user_id' => $kullanici_id, 'product_id' => $urun_id));
                $basket_num_rows = $basket_query->num_rows();
                if ($basket_num_rows == 0) {
                    $basket_data = array(
                        'user_id' => $kullanici_id,
                        'product_id' => $urun_id,
                        'product_qty' => $urun_adet,
                    );
                    $this->db->insert('sepet', $basket_data);
                    echo "added";
                } else {
                    $this->db->where('user_id', $kullanici_id);
                    $this->db->where('product_id', $urun_id);
                    $this->db->delete('sepet');
                    echo "deleted";
                }
            } else {
                if (!$this->session->userdata("sepet")) {
                    $this->session->set_userdata("sepet", array());
                }
                $sepet_array = $this->session->userdata("sepet");
                if (!array_key_exists($urun_id, $sepet_array)) {
                    $urun_array = array(
                        "product_id" => $urun_id,
                        "product_qty" => $urun_adet,
                    );
                    $sepet_array[$urun_id] = $urun_array;
                    $this->session->set_userdata("sepet", $sepet_array);
                    echo "added";
                } else {
                    $sepet_array = $this->session->userdata("sepet");
                    unset($sepet_array[$urun_id]);
                    $this->session->set_userdata("sepet", $sepet_array);
                    echo "deleted";
                }
            }
        }
    }
}
