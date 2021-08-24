<?php
class StudentCourse {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //Subscribe course
    public function subscribe_course($subscribe_data){
       if($subscribe_data){
           foreach($subscribe_data as $s=>$c){
               foreach($c as $courseid){
                $this->db->query("SELECT 1 FROM `t_students_course_info` WHERE studentId='$s' and courseId=$courseid");
                $this->db->execute();
                if(!$this->db->single()){
                    $this->db->query('INSERT INTO `t_students_course_info` (studentId,courseId) VALUES (:studentId,:courseId)');
                    $this->db->bind(':studentId', $s);
                    $this->db->bind(':courseId', $courseid);
                    $this->db->execute();     
                }
               }
            }
            return true;
       }else{
           return false;
       } 
    }

    public function getSubscribedList(){
       $this->db->query("SELECT b.firstname,b.lastname,c.name as course FROM `t_students_course_info`a join m_students_info b on b.id=a.studentId join m_course_info c on c.id=a.courseId");
       return $this->db->resultSet();
    }
}