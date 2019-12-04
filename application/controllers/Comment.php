<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Comment extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $comment = $this->db->get('comment')->result();

        } else {

            $this->db->where('id', $id);
            $comment = $this->db->get('comment')->result();
        }

        if ($comment){

            $this->response([
                'status'    => 'true',
                'data'      => $comment,
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
            'body'                  => $this->post('body'),
            'user_id'               => $this->post('user_id'),
            'commentable_id'        => $this->post('commentable_id'),
            'commentable_type'      => $this->post('commentable_type'),
            'date_added'            => $this->post('date_added'),
            'last_modified'         => $this->post('last_modified'),
              
        ];

        $insert = $this->db->insert('comment', $data);

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
            'body'                  => $this->put('body'),
            'user_id'               => $this->put('user_id'),
            'commentable_id'        => $this->put('commentable_id'),
            'commentable_type'      => $this->put('commentable_type'),
            'date_added'            => $this->put('date_added'),
            'last_modified'         => $this->put('last_modified'),
             
        ];

        $this->db->where('id', $id);

        $update = $this->db->update('comment', $data);

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
        $delete = $this->db->delete('comment');

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