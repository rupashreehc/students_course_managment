<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('register_success'); ?>
                <h2 class="card-text">Course</h2>
            </div>
            <div class="card-body">
            <form method="post" action="<?php echo URLROOT ;?>/courses/list">
                <table width="100%">
                    <thead><th></th><th>Course name</th><th>Details</th><th></th></thead>
                    <tbody>
                        <?php 
                        if($data){
                        foreach($data['res'] as $d){ 
                            $id = $d['id']; 
                        ?>
                        <tr>
                        <td style="width:100px"><a href="<?php echo URLROOT ."/courses/edit?id=$id";?>" >Edit</a></td>
                        <td style="width:100px"><?=$d['name'] ?></td>
                        <td style="width:100px"><?=$d['details'] ?></td>
                        <td style="width:100px"><a href="<?php echo URLROOT ."/courses/delete?id=$id";?>">Delete</a></td>
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