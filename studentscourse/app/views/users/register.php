<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <h2 class="card-text">Create Account</h2>
            <p class="card-text">Please Fill out This form to register with us</p>
            </div>
            <?php $url_components = parse_url($_SERVER['REQUEST_URI']);
                $id = '';
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                    $id = isset($params['id'])!=''?$params['id']:'';
                }
            ?>
            <div class="card-body">
                    <form method="post" action="<?php echo URLROOT;?>/users/register">
                    <input type="hidden" name="id"  value="<?=$id?>"/>
                    <div class="form-group">
                        <label for="firstname">First Name<sub>*</sub></label>
                        <input type="text" name="firstname" class="form-control form-control-lg <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['firstname'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['firstname_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name<sub>*</sub></label>
                        <input type="text" name="lastname" class="form-control form-control-lg <?php echo (!empty($data['lastname_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['lastname'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['lastname_err'] ;?> </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="dob">DOB<sub>*</sub></label>
                        <input type="date" name="dob" class="form-control form-control-lg <?php echo (!empty($data['dob_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['dob'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['dob_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="contactnumber">Contact Number<sub>*</sub></label>
                        <input type="text" name="contactnumber" class="form-control form-control-lg <?php echo (!empty($data['contactnumber_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['contactnumber'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['contactnumber_err'] ;?> </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Register">
                            </div>
                            
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>