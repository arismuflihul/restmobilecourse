<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Users extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $users = $this->db->get('users')->result();

        } else {

            $this->db->where('id', $id);
            $users = $this->db->get('users')->result();
        }

        if ($users){

            $this->response([
                'status'    => 'true',
                'data'      => $users,
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
            'id'            => $this->post('id'),
            'first_name'           => $this->post('first_name'),
            'last_name'               => $this->post('last_name'),
            'email'             => $this->post('email'),
            'password'          => $this->post('password'),
            'social_links'      => $this->post('social_links'),
            'biography'         => $this->post('biography'),
            'role_id'           => $this->post('role_id'),
            'date_added'        => $this->post('date_addded'),
            'last_modified'      => $this->post('last_modified'),
            'watch_history'     => $this->post('watch_history'),
            'wishlist'          => $this->post('wishlist'),
            'title'             => $this->post('tittle'),
            'paypal_keys'       => $this->post('paypal_keys'),
            'stripe_keys'       => $this->post('stripe_key'),
            'verification_code' => $this->post('verification_code'),
            'status'            => $this->post('status')
        ];

        $insert = $this->db->insert('users', $data);

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
            'title'             => $this->put('title'),
            'duration'          => $this->put('duration'),
            'course_id'         => $this->put('course_id'),
            'section_id'        => $this->put('section_id'),
            'video_type'        => $this->put('video_type'),
            'video_url'         => $this->put('video_url'),
            'date_added'        => $this->put('date_added'),
            'last_modified'     => $this->put('last_modified'),
            'lesson_type'       => $this->put('lesson_type'),
            'attachment'        => $this->put('attachment'),
            'attachment_id'     => $this->put('attachment_id'),
            'summary'           => $this->put('summary'),
            'order'             => $this->put('order'),
              
        ];

        $this->db->where('id', $id);

        $update = $this->db->update('users', $data);

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
        $delete = $this->db->delete('users');

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