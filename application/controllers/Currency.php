<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Currency extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $currency = $this->db->get('currency')->result();

        } else {

            $this->db->where('id', $id);
            $currency = $this->db->get('currency')->result();
        }

        if ($currency){

            $this->response([
                'status'    => 'true',
                'data'      => $currency,
            ], REST_Controller::HTTP_OK);

        } else {

            $this->response([
                'status'    => 'false',
                'message'      => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);

        }
    }


    public function index_post(){

        $data = [
            'id'                  => $this->post('id'),
            'name'                => $this->post('name'),
            'code'                => $this->post('code'),
            'symbol'              => $this->post('symbol'),
            'paypal_supported'    => $this->post('paypal_supported'),
            'stripe_supported'    => $this->post('stripe_supported'),
              
        ];

        $insert = $this->db->insert('currency', $data);

        if ($insert){

            $this->response([
                'status'    => 'Success',
                'message'   => 'Added a resource',
                'data'      => $data
            ], REST_Controller::HTTP_CREATED);

        } else {

            $this->response([
                'status'    => 'false',
                'message'   => 'Fail',
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index_put(){

        $id = $this->put('id');
        $data = [
            'id'                  => $this->post('id'),
            'name'                => $this->post('name'),
            'code'                => $this->post('code'),
            'symbol'              => $this->post('symbol'),
            'paypal_supported'    => $this->post('paypal_supported'),
            'stripe_supported'    => $this->post('stripe_supported'),
              
        ];
        $this->db->where('id', $id);

        $update = $this->db->update('currency', $data);

        if ($update){

            $this->response([
                'status'    => 'Success',
                'message'   => 'Updated a resource',
                'data'      => $update,
            ], REST_Controller::HTTP_OK);

        } else {

            $this->response([
                'status'    => 'false',
                'message'   => 'Fail',
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index_delete(){

        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('currency');

        if ( $id == null ) {

            $this->response([
                'status'    => 'false',
                'message'      => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);

        } else {

            if ($delete){

                $this->response([
                    'status'    => 'Success',
                    'id'        => $id,
                    'message'   => 'deleted',
                ], REST_Controller::HTTP_OK);

            } else {

                $this->response([
                    'status'    => 'false',
                    'message'   => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);

            }

            

        }

    } 
}