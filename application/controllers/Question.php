<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Question extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $question = $this->db->get('question')->result();

        } else {

            $this->db->where('id', $id);
            $question = $this->db->get('question')->result();
        }

        if ($question){

            $this->response([
                'status'    => 'true',
                'data'      => $question,
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
            'quiz_id'               => $this->post('quiz_id'),
            'title'        => $this->post('title'),
            'type'      => $this->post('type'),
            'number_of_option'            => $this->post('number_of_option'),
            'option'         => $this->post('options'),
            'correct_answers'        => $this->post('correct_answers'),
            'order'     => $this->post('order'),
              
        ];

        $insert = $this->db->insert('question', $data);

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
            'id'                  => $this->put('id'),
            'quiz_id'               => $this->put('quiz_id'),
            'title'        => $this->put('title'),
            'type'      => $this->put('type'),
            'number_of_option'            => $this->put('number_of_option'),
            'option'         => $this->put('options'),
            'correct_answers'        => $this->post('correct_answers'),
            'order'     => $this->put('order'),
              
        ];

        $this->db->where('id', $id);

        $update = $this->db->update('question', $data);

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
        $delete = $this->db->delete('question');

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