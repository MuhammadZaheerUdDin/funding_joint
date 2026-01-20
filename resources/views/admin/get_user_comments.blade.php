<div class="row comment-box" style="padding-left: 20px;width:100%">
<?php
foreach ($comments as $key => $value) {
?>	
<div class="chat-container <?php if($value['commenter_id'] != 1) echo 'darker';?>" style="width:100%">
  <!-- <img src="/funding_joint/public/assets/img/person-icon.png" alt="Avatar" style="width:100%;" class="<?php echo ($value['commenter_id'] != 1)?'right':'';?>"> -->
  	<p>
  	<?php 
  		if($value['commenter_id'] != 1){
	  		if(isset($value['user']) && !empty($value['user']) ) 
	  			echo $value['user']['first_name']; 
	  		elseif(isset($value['seller']) && !empty($value['seller'])) 
	  			echo $value['seller']['first_name'];	
  		}else{
  			echo "Admin";
  		}
	?> : 
	</p>
	<p><?php echo $value['comment'] ?> <span class="<?php echo ($value['commenter_id'] != 1)?'time-right':'time-right';?> pull-right">{{$value['created_at']}}</span></p>
 
</div>
<?php
}
?>
</div>

<style>

.comments{
    height: 314px;
    overflow-y: scroll;
    margin-bottom: 5px;
}
.comment-box{
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;

}

.chat-container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  width: : 100% !important;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.chat-container::after {
  content: "";
  clear: both;
  display: table;
}

.chat-container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.chat-container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>

