<?php
class Users extends Controller{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => isset($_POST['id'])?trim($_POST['id']):'',
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'dob' => trim($_POST['dob']),
                'contactnumber' => trim($_POST['contactnumber']),
                'firstname_err' => '',
                'lastname_err' => '',
                'dob_err' => '',
                'contactnumber_err' => '' 
            ];

            //valide firstname
            if(empty($data['firstname'])){
                $data['firstname_err'] = 'Please enter firstname';
            }

            //validate lastname
            if(empty($data['lastname'])){
                $data['lastname_err'] = 'Please enter lastname';
            }

            //validate dateofbirth
            if(empty($data['dob']) || !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data['dob'])){
                $data['dob_err'] = 'Please enter valid date of birth';
            }
            
           if(empty($data['contactnumber']) || !preg_match("/^[0-9]{10}+$/",$data['contactnumber'])){
                $data['contactnumber_err'] = 'Please enter valid contact number';
            }else{
                //check for contactnumber
                if(empty($data['id'])){
                    if($this->userModel->findUserByContactnumber($data['contactnumber'])){
                        $data['contactnumber_err'] = 'Contact number already exist';
                    }
                }
            }
            //make sure error are empty
            if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['dob_err']) && empty($data['contactnumber_err'])){
                if($this->userModel->register($data)){
                    flash('register_success', 'Student details updated');
                    redirect('users/studentslist');
                }
            }else{
                $this->view('users/register', $data);
            }
        }else{
            //init data
            $data = [
                'firstname' => '',
                'lastname' => '',
                'dob' => '',
                'contactnumber' => '',
                'firstname_err' => '',
                'lastname_err' => '',
                'dob_err' => '',
                'contactnumber_err' => '' 
            ];
            //load view
            $this->view('users/register', $data);          
        }
    }

    function studentslist(){
        if (!isset ($_GET['start']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['start'];  
        }
        $data = $this->userModel->getStudentsList($page);
        $this->view('users/studentslist', $data);
        
    }
   
    function edit(){
        if(!$_GET['id']){
            return false;
        }
        $data = $this->userModel->getStudentById($_GET['id']);
        if($data){
            $data = json_decode(json_encode($data), true);
            $this->view('users/register', $data);  
        }
    }

    function delete(){
        if(!$_GET['id']){
            return false;
        }
        $data = $this->userModel->deleteStudentById($_GET['id']);
        if($data){
            flash('register_success', 'Student data deleted successfully');
            redirect('users/studentslist'); 
        }
    }
}