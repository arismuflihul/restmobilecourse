<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Payment extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $payment = $this->db->get('payment')->result();

        } else {

            $this->db->where('id', $id);
            $payment = $this->db->get('payment')->result();
        }

        if ($payment){

            $this->response([
                'status'    => 'true',
                'data'      => $payment,
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
            'user_id'                  => $this->post('user_id'),
            'payment_type'               => $this->post('payment_type'),
            'course_id'        => $this->post('course_id'),
            'amount'      => $this->post('amount'),
            'date_added'            => $this->post('date_added'),
            'last_modified'         => $this->post('last_modified'),
            'admin_revenue'         => $this->post('admin_revenue'),
            'instructor_revenue'    => $this->post('instructor_revenue'),
            'instructor_payment_status'=> $this->post('instructor_payment_status'),
            'status'                => $this->post('status'),
            'trx'                   => $this->post('trx'),
              
        ];

        $insert = $this->db->insert('payment', $data);

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
            'user_id'                  => $this->post('user_id'),
            'payment_type'               => $this->post('payment_type'),
            'course_id'        => $this->post('course_id'),
            'amount'      => $this->post('amount'),
            'date_added'            => $this->post('date_added'),
            'last_modified'         => $this->post('last_modified'),
            'admin_revenue'         => $this->post('admin_revenue'),
            'instructor_revenue'    => $this->post('instructor_revenue'),
            'instructor_payment_status'=> $this->post('instructor_payment_status'),
            'status'                => $this->post('status'),
            'trx'                   => $this->post('trx'),
              
        ];

        $this->db->where('id', $id);

        $update = $this->db->update('payment', $data);

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
        $delete = $this->db->delete('payment');

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