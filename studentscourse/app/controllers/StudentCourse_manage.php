<?php
class StudentCourse_manage extends Controller{
    public function __construct()
    {
        $this->studentcourseModel = $this->model('StudentCourse');
        $this->userModel = $this->model('User');
        $this->courseModel = $this->model('Course');
    }

    public function add(){
        $students = $this->userModel->getStudentsList($page='');
        if($students){
            $data['students'] = $students['res'];//json_decode(json_encode($students), true);
        }
        $course = $this->courseModel->getCourseList($page='');
        if($course){
            $data['course'] = $course['res'];;//json_decode(json_encode($course), true);
        }
        $this->view('studentcourse_manage/add',$data);
    }

    public function subscribe(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $students = $_POST['students'];
        $course = $_POST['course'];
        $students_arr =array();
        foreach($students as $i=>$st){
             if(isset($students_arr[$st])){
                if(!in_array($course[$i] ,$students_arr[$st])){
                    $students_arr[$st][] = $course[$i] ;
                }
            }else{
                $students_arr[$st][] = $course[$i] ;
            }
        }
         if($this->studentcourseModel->subscribe_course($students_arr)){
            redirect('studentcourse_manage/report');
        }else{
            flash('subscribe_success','Student subscribed for same course !');
        }
    }

    public function report(){
        $data = $this->studentcourseModel->getSubscribedList();
        if($data){
            $data = json_decode(json_encode($data), true);
            $this->view('studentcourse_manage/report', $data);  
        }
    }

}
