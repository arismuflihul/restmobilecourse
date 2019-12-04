<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Category extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $category = $this->db->get('category')->result();

        } else {

            $this->db->where('id', $id);
            $category = $this->db->get('category')->result();
        }

        if ($category){

            $this->response([
                'status'    => 'true',
                'data'      => $category,
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
            'code'                  => $this->post('code'),
            'name'                  => $this->post('name'),
            'parent'                => $this->post('parent'),
            'slug'                  => $this->post('slug'),
            'date_added'            => $this->post('date_added'),
            'last_modified'         => $this->post('last_modified'),
            'font_awesome_class'    => $this->post('font_awesome_class'),
            'thumbnail'             => $this->post('thumbnail'),
              
        ];

        $insert = $this->db->insert('category', $data);

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
            'code'                  => $this->put('code'),
            'name'                  => $this->put('name'),
            'parent'                => $this->put('parent'),
            'slug'                  => $this->put('slug'),
            'date_added'            => $this->put('date_added'),
            'last_modified'         => $this->put('last_modified'),
            'font_awesome_class'    => $this->put('font_awesome_class'),
            'thumbnail'             => $this->put('thumbnail'),
             
        ];

        $this->db->where('id', $id);

        $update = $this->db->update('category', $data);

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
        $delete = $this->db->delete('category');

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