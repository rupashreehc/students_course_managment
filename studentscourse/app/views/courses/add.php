<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <h2 class="card-text">Add Course</h2>
            <p class="card-text">Please Fill out This form to add course details</p>
            </div>
            <?php $url_components = parse_url($_SERVER['REQUEST_URI']);
                $id = '';
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                    $id = isset($params['id'])!=''?$params['id']:'';
                }
            ?>
            <div class="card-body">
                    <form method="post" action="<?php echo URLROOT;?>/courses/add">
                    <input type="hidden" name="id"  value="<?=$id?>"/>
                    <div class="form-group">
                        <label for="name">Course Name<sub>*</sub></label>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_arr'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['name'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['name_arr'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Course Details<sub>*</sub></label>
                        <textarea name="details" COLS=40 ROWS=6  class="form-control form-control-lg  <?php echo (!empty($data['details_err'])) ? 'is-invalid' : '' ;?>" ><?php echo $data['details'] ;?></textarea>
                        <span class="invalid-feedback"><?php echo $data['details_err'] ;?> </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Submit">
                            </div>
                            
                        </div>
                    </div>
                   </form>
            </div>
            
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>