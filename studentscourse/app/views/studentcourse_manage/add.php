<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <h2 class="card-text">Subscribe Course</h2>
            <p class="card-text">Student Course Registeration</p>
            </div>
            <div class="card-body">
            <form method="post" id="insert_form">
                <table width="100%" id="studentcourse_grid">
                    <tr><td>Student</td><td>Course</td><td></td></tr>
                    <tr>
                        <td>
                            <select name='students[]' class="form-control form-control-lg">
                                <?php if($data['students']){
                                    foreach($data['students'] as $student){
                                ?>
                                <option value="<?=$student['id']?>"><?=$student['firstname'].''.$student['lastname']?></option>
                                <?php }} ?>
                            </select>
                        </td>
                        <td>
                            <select name='course[]' class="form-control form-control-lg">
                                <?php if($data['course']){
                                    foreach($data['course'] as $course){
                                ?>
                                <option value="<?=$course['id']?>"><?=$course['name']?></option>
                                <?php }} ?>
                            </select>
                        </td>
                        <td><input type="button" name="add" value="+" class="add_btn" /></td>
                    </tr>
                </table>
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
<script type="text/javascript">
    var ttl_students = "<?=count($data['students']);?>" ; 
    var cnt = 0;                               
    jQuery(document).ready(function(){
        jQuery(document).on('click', '.add_btn', function(){
        cnt++;
        if(cnt >=ttl_students){
            alert(" Max Student count already added");
            return false;
        }
        var html = ''; 
        html += '<tr>';
        html += '<td><select name="students[]" class="form-control form-control-lg students"> <?php if($data['students']){foreach($data['students'] as $student){?><option value="<?=$student['id']?>"><?=$student['firstname'].''.$student['lastname']?></option><?php }} ?></select></td>';
        html += '<td><select name="course[]" class="form-control form-control-lg course"> <?php if($data['course']){foreach($data['course'] as $course){?><option value="<?=$course['id']?>"><?=$course['name']?></option><?php }} ?></select></td>';
        html += '<td><button type="button" name="remove" class="remove_btn">-</button></td></tr>';
        html += '</tr>';
        jQuery('#studentcourse_grid').append(html);   
    

        $(document).on('click', '.remove_btn', function(){
        $(this).closest('tr').remove();
        });
    });

    var st_subscribed_cnt = 0;
    var error = "";
    
    $('.students').each(function(){
    var st = [];
    st.push($(this).val());
    st_subscribed_cnt++;
    if(jQuery.inArray($(this).val(), st) > 1){
          error += "<p>Same Student is subscribed for "+count+" Row</p>";
          return false;
       }
    });

    $('#insert_form').on('submit', function(event){
    event.preventDefault();
    var form_data = $(this).serialize();
    if(error == ''){
    $.ajax({
        url:"<?php echo URLROOT;?>/studentcourse_manage/subscribe",
        method:"POST",
        data:form_data,
        success:function(data){
          if(data == 'ok'){
            $('#studentcourse_grid').find("tr:gt(0)").remove();
            $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
          }
        }
    });
    }else{
        $('#error').html('<div class="alert alert-danger">'+error+'</div>');
    }
   }); 
});                              
</script>    
<?php require APPROOT . '/views/inc/footer.php'; ?>