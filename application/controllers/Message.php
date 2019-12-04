<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Message extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('message_id');
        

        if ($id == '') {

            $message = $this->db->get('message')->result();

        } else {

            $this->db->where('message_id', $id);
            $message = $this->db->get('message')->result();
        }

        if ($message){

            $this->response([
                'status'    => 'true',
                'data'      => $message,
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
            'message_thread_code'    => $this->post('message_thread_code'),
            'message'                => $this->post('message'),
            'sender'                 => $this->post('sender'),
            'timestamp'              => $this->post('timestamp'),
            'read_status'            => $this->post('read_status'),
              
        ];

        $insert = $this->db->insert('message', $data);

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

        $id = $this->put('message_id');
        $data = [
            'message_thread_code'    => $this->post('message_thread_code'),
            'message'                => $this->post('message'),
            'sender'                 => $this->post('sender'),
            'timestamp'              => $this->post('timestamp'),
            'read_status'            => $this->post('read_status'),
              
        ];
        $this->db->where('message_id', $id);

        $update = $this->db->update('message', $data);

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

        $id = $this->delete('message_id');
        $this->db->where('message_id', $id);
        $delete = $this->db->delete('message');

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