<?php
class User {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //register new user
    public function register($data){
        if(!empty($data['id'])){
            $this->db->query('UPDATE m_students_info SET firstname=:firstname, lastname=:lastname,dob=:dob,contactnumber=:contactnumber WHERE id=:id');
            $this->db->bind(':id',$data['id']);
        }else{
            $this->db->query('INSERT INTO m_students_info (firstname, lastname, dob,contactnumber) VALUES (:firstname, :lastname, :dob, :contactnumber)');
        }
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':contactnumber', $data['contactnumber']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    //find user by email
    public function findUserByContactnumber($contactnumber){
        $this->db->query('SELECT * FROM m_students_info WHERE contactnumber = :contactnumber');
        $this->db->bind(':contactnumber', $contactnumber);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //To fetch students list
    public function getStudentsList($page){
        $page  = (isset($page) && $page < 100000)? (int) $page : 1;
        $perPage = 1;
        $start = $perPage * ($page - 1);
        $this->db->query("SELECT * FROM m_students_info group by id");
        $total = 0;
        if($this->db->execute()){
            $total = $this->db->rowCount();
        }
        $totalPages = ceil($total / $perPage);
        $next = $page+1;
        $prev = $page-1;

        $paginatoinInfo = [
            "page"          => $page,
            "start"         => $start,
            "totalPages"    => $totalPages,
            "next"          => $next,
            "prev"          => $prev
        ];
        if(isset($page) && !empty($page)){
            $this->db->query("SELECT id,firstname,lastname,contactnumber FROM m_students_info group by id LIMIT $start, $perPage");
        }else{
            $this->db->query("SELECT id,firstname,lastname,contactnumber FROM m_students_info group by id");
        }
        $res = $this->db->resultSet();
        $data['res'] = json_decode(json_encode($res), true);
        $data['posts'] = ($this->db->rowCount() > 0) ? $this->db->resultSet() : "No Data Found";
        $data['pagination'] = $paginatoinInfo;
        return $data;
     }

    public function getStudentById($id){
        $this->db->query('SELECT * FROM m_students_info WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function deleteStudentById($id){
        $this->db->query("Delete FROM m_students_info WHERE id=:id");
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}