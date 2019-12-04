<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Course extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $comment = $this->db->get('course')->result();

        } else {

            $this->db->where('id', $id);
            $comment = $this->db->get('course')->result();
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
            'title'                 => $this->post('tittle'),
            'short_description'     => $this->post('short_description'),
            'description'           => $this->post('description'),
            'outcomes'              => $this->post('outcomes'),
            'language'              => $this->post('language'),
            'category_id'           => $this->post('category_id'),
            'sub_category_id'       => $this->post('sub_category_id'),
            'section'               => $this->post('section'),
            'requirements'          => $this->post('requirements'),
            'price'                 => $this->post('price'),
            'discount_flag'         => $this->post('discount_flag'),
            'discounted_price'      => $this->post('discounted_price'),
            'level'                 => $this->post('level'),
            'user_id'               => $this->post('user_id'),
            'thumbnail'             => $this->post('thumbnail'),
            'video_url'             => $this->post('video_url'),
            'date_added'            => $this->post('date_added'),
            'last_modified'         => $this->post('last_modified'),
            'visibility'            => $this->post('visibility'),
            'is_top_course'         => $this->post('is_top_course'),
            'is_admin'              => $this->post('is_admin'),
            'status'                => $this->post('status'),
            'course_overview_provider'=> $this->post('course_overview_provider'),
            'meta_keywords'         => $this->post('meta_keywords'),
            'meta_description'      => $this->post('meta_description'),
            'is_free_course'        => $this->post('is_free_course'),
        ];

        $insert = $this->db->insert('course', $data);

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
            'title'                 => $this->post('tittle'),
            'short_description'     => $this->post('short_description'),
            'description'           => $this->post('description'),
            'outcomes'              => $this->post('outcomes'),
            'language'              => $this->post('language'),
            'category_id'           => $this->post('category_id'),
            'sub_category_id'       => $this->post('sub_category_id'),
            'section'               => $this->post('section'),
            'requirements'          => $this->post('requirements'),
            'price'                 => $this->post('price'),
            'discount_flag'         => $this->post('discount_flag'),
            'discounted_price'      => $this->post('discounted_price'),
            'level'                 => $this->post('level'),
            'user_id'               => $this->post('user_id'),
            'thumbnail'             => $this->post('thumbnail'),
            'video_url'             => $this->post('video_url'),
            'date_added'            => $this->post('date_added'),
            'last_modified'         => $this->post('last_modified'),
            'visibility'            => $this->post('visibility'),
            'is_top_course'         => $this->post('is_top_course'),
            'is_admin'              => $this->post('is_admin'),
            'status'                => $this->post('status'),
            'course_overview_provider'=> $this->post('course_overview_provider'),
            'meta_keywords'         => $this->post('meta_keywords'),
            'meta_description'      => $this->post('meta_description'),
            'is_free_course'        => $this->post('is_free_course'),
        ];

        $this->db->where('id', $id);

        $update = $this->db->update('course', $data);

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
        $delete = $this->db->delete('course');

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