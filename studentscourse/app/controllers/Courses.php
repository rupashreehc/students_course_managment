<?php
class Courses extends Controller{
    public function __construct()
    {
        $this->courseModel = $this->model('Course');
    }

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => isset($_POST['id'])?trim($_POST['id']):'',
                'name' => trim($_POST['name']),
                'details' => trim($_POST['details']),
                'name_arr' => '',
                'details_arr' => ''
            ];

            //valide course name
            if(empty($data['name'])){
                $data['name_arr'] = 'Please enter course name';
            }else{
                if(empty($data['id'])){
                    if($this->courseModel->findCourseByName($data['name'])){
                        $data['name_arr'] = 'Course already exist';
                    }
                }
            }
            //validate course details
            if(empty($data['details'])){
                $data['details_err'] = 'Please enter course details';
            }
            if(empty($data['name_arr']) && empty($data['details_err'])){
                if($this->courseModel->add($data)){
                    flash('course_success', 'Course details updated');
                    redirect('courses/list');
                }
            }else{
                $this->view('courses/add', $data);
            }
            
        }else{
        //     //init data
            $data = [
                'name' => '',
                'details' => '',
                'name_err' => '',
                'details_err' => '',
                
            ];
            //load view
            $this->view('courses/add', $data);          
        }
    }
    
    //to load courselist view
    function list(){
        if (!isset ($_GET['start']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['start'];  
        }
        $data = $this->courseModel->getCourseList($page);
        $this->view('courses/list', $data);  
    }

    function edit(){
        if(!$_GET['id']){
            return false;
        }
        $data = $this->courseModel->getCourseDetailsById($_GET['id']);
        if($data){
            $data = json_decode(json_encode($data), true);
            $this->view('courses/add', $data);  
        }
    }
    
    function delete(){
        if(!$_GET['id']){
            return false;
        }
        $data = $this->courseModel->deleteCourseById($_GET['id']);
        if($data){
            flash('delete_success', 'Course details deleted successfully');
            redirect('courses/list'); 
        }
    }
}