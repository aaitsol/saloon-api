<?php 
    // echo "<pre>";
    // print_r($categoryBudget);
    // echo "</pre>";
?>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active">予算</li>
    </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
            <?php $this->Layout->sessionFlash(); ?>
        </div><!--/.row-->
        <!-- Manual Expenses Table -->
        <div class="panel panel-default">
            <div class="panel-heading">
                予算
                <div class="col-md-4" style="float: right;">
                    <a class="btn btn-primary exp_btn" style="float: right;" data-toggle="modal" data-target="#addManualExpense" data-id="0">予算を追加</a>
                </div>
            </div>
            
            <div class="panel-body">
                <div class="table-responsive">
                <table id="dataTables-example1" class="table table-bordered data-table-custom Calendar-table jts_table">
                    <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Category Name</th>
                        <th>予算</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                        foreach ($categoryBudget['Budget'] as $record) {
                     ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $record['category_name'] ?></td>
                            <td><?php echo $record['budget'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>S. No.</th>
                        <th>Category Name</th>
                        <th>予算</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
                </div>
        </div>







<!-- Modal -->
<div class="modal fade" id="addManualExpense" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">予算を追加</h4>
          <span id="msg" style="color: red;"></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <form action="javascript:void(0)" id="frm_add_budget">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php  echo ($this->Form->input('main_category_id', array('options'=>$categoryBudget['user_category'],'div'=>false,  'label' => 'Category',  "class" => "form-control az_test")));?>
                    </div>                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php  echo ($this->Form->input('category_id', array('options'=>'','div'=>false,  'label' => 'Sub Category',  "class" => "form-control")));?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo ($this->Form->input('date', array('div' => false, 'label' => '日付', 'type' => 'text','readonly'=>'true', "class" => "form-control", 'id'=>'date'))); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo ($this->Form->input('price', array('div' => false, 'label' => '金額', 'type'=>'text', 'id'=>'price', "class" => "form-control","maxlength"=>30))); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <a id="submit" action="javascript:void(0);" class="btn btn-primary">送信</a>
                </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
        </div>
      </div>
      
    </div>
  </div>



<script>
$(document).ready(function(){
    // var status;
    var is_fixed;
    $('.exp_btn').on('click',function(){
        is_fixed = $(this).attr("data-id");
    });
    var category_id;
    $('.az_test').on('change',function(){
        // console.log("hello");
        category_id = $(this).val();
        // status = $(this).attr("data-ongoing-value");
        // console.log(category_id);
        $.ajax({
            url: "get_sub_categories",
            type: 'post',
            data: {'id':category_id},
            success: function(result){
                // console.log(result);
                $("#category_id").html(result);
            }
        });
    });
    
    $('#submit').click(function(){
        var data = $( "#frm_add_budget" ).serialize();
        // console.log(data);
        $.ajax({
            url: "add_budget",
            type: 'post',
            data: data,
            success: function(result){
                console.log(result);
                // $('#msg').text(result.msg);
                setTimeout("location.href = 'budget_list'",2000);
            }
        });
    });

});

</script>

<?php 
    echo $this->Html->script(
                        array(
                            'datepicker/jquery.js',
                            'datepicker/jquery.datetimepicker.full.js'
                        ));
    echo $this->Html->css(array('datepicker/jquery.datetimepicker.css'));
?>
 <link
     rel="stylesheet"
     href="http://code.jquery.com/ui/1.9.0/themes/smoothness/jquery-ui.css" />

<script>
 jQuery(document).ready(function () {
    'use strict';
    jQuery('#date').datetimepicker({
    // format:'Y-m-d H:i'
    format:'Y-m-d',
    timepicker:false
    });
});   
</script>