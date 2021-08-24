<?php
class Course {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //register new user
    public function add($data){
        if(!empty($data['id'])){
            $this->db->query('UPDATE m_course_info SET name=:name, details=:details WHERE id=:id');
            $this->db->bind(':id',$data['id']);
        }else{
            $this->db->query('INSERT INTO m_course_info (`name`, details) VALUES (:name, :details)');
        }
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':details', $data['details']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    //find user by email
    public function findCourseByName($name){
        $this->db->query('SELECT * FROM m_course_info WHERE name = :name');
        $this->db->bind(':name', $name);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //To fetch course list
    public function getCourseList($page){
        $page  = (isset($page) && $page < 100000)? (int) $page : 1;
        $perPage = 1;
        $start = $perPage * ($page - 1);
        $this->db->query("SELECT * FROM m_course_info group by id");
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
        if(isset($page) && !empty($page))
            $this->db->query("SELECT id,`name`,details FROM m_course_info group by `id` LIMIT $start, $perPage;");
        else
            $this->db->query("SELECT id,`name`,details FROM m_course_info group by `id`");
        $res = $this->db->resultSet();
        $data['res'] = json_decode(json_encode($res), true);
        $data['posts'] = ($this->db->rowCount() > 0) ? $this->db->resultSet() : "No Data Found";
        $data['pagination'] = $paginatoinInfo;
        return $data;
    }

    //To get course details by Id
    public function getCourseDetailsById($id){
        $this->db->query('SELECT id,`name`,details FROM m_course_info WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function deleteCourseById($id){
        $this->db->query("Delete FROM m_course_info WHERE id=:id");
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}