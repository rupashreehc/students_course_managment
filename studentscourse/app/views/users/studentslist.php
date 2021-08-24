<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('register_success'); ?>
                <h2 class="card-text">Students</h2>
            </div>
            <div class="card-body">
            <form method="post" action="<?php echo URLROOT ;?>/users/getStudentsList">
                <table width="100%">
                    <thead><th></th><th>Firstname</th><th>Lastname</th><th></th></thead>
                    <tbody>
                        <?php 
                            if($data['res']){
                            foreach($data['res'] as $d){ 
                            $id = $d['id']; 
                        ?>
                        <tr>
                        <td><a href="<?php echo URLROOT ."/users/edit?id=$id";?>" >Edit</a></td>
                        <td><?=$d['firstname'] ?></td>
                        <td><?=$d['lastname'] ?></td>
                        <td><a href="<?php echo URLROOT ."/users/delete?id=$id";?>">Delete</a></td>
                        </tr>
                        <div>
                        <center>
                        <ul>
                        <?php }
                            for($page=1;$page<=$data['pagination']['totalPages'];$page++) {  
                                echo "<a href = '?start=$page'>".$page."</a>";  
                            }  
                        }?>
                        </ul>
                        </center>
                        </div>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>