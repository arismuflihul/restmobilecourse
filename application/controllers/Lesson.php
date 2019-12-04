<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Lesson extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    public function index_get() {

        $id = $this->get('id');
        

        if ($id == '') {

            $lesson = $this->db->get('lesson')->result();

        } else {

            $this->db->where('id', $id);
            $lesson = $this->db->get('lesson')->result();
        }

        if ($lesson){

            $this->response([
                'status'    => 'true',
                'data'      => $lesson,
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
            'title'                  => $this->post('title'),
            'duration'               => $this->post('duration'),
            'course_id'        => $this->post('course_id'),
            'section_id'      => $this->post('section_id'),
            'video_type'            => $this->post('video_type'),
            'video_url'         => $this->post('video_url'),
            'date_added'        => $this->post('date_added'),
            'last_modified'     => $this->post('last_modified'),
            'lesson_type'       => $this->post('lesson_type'),
            'attachment'        => $this->post('attachment'),
            'attachment_id'     => $this->post('attachment_id'),
            'summary'           => $this->post('summary'),
            'order'             => $this->post('order'),
              
        ];

        $insert = $this->db->insert('lesson', $data);

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

        $update = $this->db->update('lesson', $data);

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
        $delete = $this->db->delete('lesson');

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