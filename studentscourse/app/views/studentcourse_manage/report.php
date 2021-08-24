<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('register_success'); ?>
                <h2 class="card-text">Report</h2>
            </div>
            <div class="card-body">
            <form method="post" action="<?php echo URLROOT ;?>/studentcourse_manage/report">
                <table width="100%">
                    <thead><th>Students</th><th>Course</th></thead>
                    <tbody>
                        <?php if($data){foreach($data as $d){ ?>
                        <tr>
                        <td><?=$d['firstname'].' '.$d['lastname'] ?></td>
                        <td><?=$d['course'] ?></td>
                        </tr>
                        <?php }}?>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
</div>    
<?php require APPROOT . '/views/inc/footer.php'; ?>