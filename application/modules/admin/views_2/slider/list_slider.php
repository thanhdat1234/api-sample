<div class="row" style="margin-bottom: 20px; margin-top: -15px;">
    <div class="col-sm-12">
        <h3>
        	<i class="fa fa-sliderpaper-o" style="color:<?php echo $color?>"></i><?php echo $title?>
        </h3>
    </div>
</div>
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-6">
        <div class="btn-group" id="bulk-action-container" style="display: none;">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Bulk Actions  <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" onclick="bulk_action('delete'); return false;">Delete</a></li>
                <li><a href="#" onclick="bulk_action('publish'); return false;">Publish</a></li>
                <li><a href="#" onclick="bulk_action('unpublish'); return false;">Unpublish</a></li>    
            </ul>
        </div>
    </div>
    <div class="col-md-4" style="height: 34px;">&nbsp;</div>
</div>
<div class="row" style="padding: 10px 0px;">
    <div class="col-md-6">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                <span id="view-title">All</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('admin/users/index');?>"> All</a></li>
                <li><a href="javascript:view_allstatus(1,'published');"> Published</a></li>
                <li><a href="javascript:view_allstatus(2,'unpublished');"> Unpublished</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="pull-right">
            <div class="pull-right">
             	<div class="form-inline" id="pagingControl">
	            <div class="form-group">
                    <label for="Page">Page: </label>
                    <select class="page form-control" >
                        <option selected="selected" value="1">1</option> 
                        <option  value="2">2</option>         
                        <option  value="3">3</option>         
                    </select>
                    <input type="hidden" value="1" class="page-hidden">
                </div>
             </div>
          	</div>        
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
    	<form action="<?php echo base_url('admin/slider/bulk_action');?>" method="post" id="frm-bulk-action">
    		<div class="table-responsive">
                <table  class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th style="width: 30px; background: #3c8dbc; color: white;">#</th>
                            <th style="width: 30px; background: #3c8dbc; color: white;"><input type="checkbox" id="check-all"></th>
                            <th style="width: 30px; background: #3c8dbc; color: white;"><?php front_lang('avarta');?></th>
                            <th style="width: 100px; background: #3c8dbc; color: white;"><?php front_lang('color');?></th>                         
                            <th style="width: 30px; background: #3c8dbc; color: white;"><?php front_lang('status');?></th>
                            <th style="width: 30px; background: #3c8dbc; color: white;"><?php front_lang('action');?></th>
                        </tr>   
                    </thead>
                    <?php if(!empty($result)){?>
                    <tbody id="result">
                            <?php $stt = 1?>
                            <?php foreach($result as $value): ?>
                                <tr id="record-<?php echo $value['id'];?>">
                                    <td><?php echo $stt++ ;?></td>
                                    <td><input type="checkbox" name="id[]" value="<?php echo (int)$value['id'];?>"></td>
                                    <td ><img src="<?php echo base_url('upload/slider').'/'.$value['images'];?>" width="100px" height="150px" alt=""></td>
                                    <td >
                                        <p><?php echo $value['color'];?></p>
                                    </td>
                                    <td>
                                        <?php if($value['status'] == 1){ ?>
                                            <span id="change-<?php echo  $value['id'];?>"><a class="label label-success" href="javascript:change_status(<?php echo $value['id']; ?>,'unpublish');">Activation</a></span>
                                        <?php }else{ ?>
                                            <span  id="change-<?php echo  $value['id'];?>"><a class="label label-danger" href="javascript:change_status(<?php echo $value['id']; ?>,'publish')">Not Activation</a></span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" onclick="User_Copy('<?php echo (int)$value["id"] ?>');" type="button">
                                            <i class="fa fa-files-o"></i>
                                        </button>
                                        <button class="btn btn-info btn-xs" onclick="slider_Edit('<?php echo (int)$value["id"] ?>');" type="button">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-xs" onclick="slider_Delete('<?php echo (int)$value["id"] ?>');" type="button">
                                            <i class="fa fa-minus-circle"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </tbody>
                    <?php }else{ ?>
                        <tbody>
                             <tr><?php echo "Không có dữ liệu" ;?></tr>
                        </tbody>   
                    <?php } ?>
                </table>
                <ul class="pagination pull-right">
                    <?php echo $this->pagination->create_links();?>
                </ul>
            </div>
    	</form>
    </div>
</div>
<div class="modal fade" id="search_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only"><?php echo 'Close'; ?></span>
                </button>
                <h4 class="modal-title"><?php echo 'User'; ?> <?php echo 'Search'; ?> </h4>
            </div>
            <form name="frm_User_Search" action="<?php echo base_url('admin/users/list_all');?>" id="frm_User_Search" method="post" class="form-horizontal" role="form" >
                <div class="modal-body">   
                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">
                            <?php echo "Username"; ?>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="users_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">
                            <?php echo  "Full Name"; ?>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="fullname">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">
                            <?php echo "Email"; ?>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">
                            <?php echo "Active"; ?>
                        </label>
                        <div class="col-sm-10">
                            <input type="checkbox" checked="" class="form-control" name="status">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="User_Search();"> <i class='fa fa-search'></i> <?php echo 'Search'; ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo 'Close'; ?></button>
            </div>
            
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {      
        $('.btn-index').css({display:'inline-block'});
        $('.btn-edit').css({display:'none'});
        $('.btn-copy').css({display:'none'});
        $('.btn-add').css({display:'none'});
        
        $('#check-all').on('ifChecked', function(event){
            $('input[name="id\[\]"]').iCheck('check');
            $('#bulk-action-container').show();
        });

        $('#check-all').on('ifUnchecked', function(event){
            $('input[name="id\[\]"]').iCheck('uncheck');
            $('#bulk-action-container').hide();
        });
            
        $('.pagination li a').click( function(event) {
             $(".content").mask("<?php echo 'Loading...'; ?>");
              $('.content').load($(this).attr('href'),function(){
                $(".content").unmask();
                $('.content input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});
                  $('.content input[type="radio"]').iCheck({radioClass: 'iradio_minimal'});
              });
            event.preventDefault();
        });
    });
    
    function Add(){
        $(".content").mask("<?php echo 'Loading...'; ?>");
        $('.content').load("<?php echo base_url('admin/slider/add');?>",function(){
            $(".contentt").unmask();
        });
    }

    function slider_Edit(id){
        $(".content").mask("<?php echo 'Loading...'; ?>");
        var page        = $('.pagination .active').text();
        var curent_page = '';
        if(page > 1){
            curent_page = page - 1;
        }else{
            curent_page = page;
        }
        var url = '<?php echo base_url("admin/slider/edit");?>'+'/'+id+'/'+curent_page;
        $.get(url,function(result){
            $(".contentt").unmask();
            if(result.error == 0){
                $('.content').html(result.content);
            }else if(result.error == 1){
                $.notification({type:"error",img:"",width:"400",content:"<i class='fa fa-times-circle fa-2x'></i> <?php echo 'There is an error, please check again!'; ?>",html:true,autoClose:true,timeOut:"1500",delay:"0",position:"topRight",effect:"fade",animate:"fadeUp",easing:"jswing",onStart:function(id){ console.log(' onStart : notification id = '+id); },onShow:function(id){ console.log(' onShow : notification id = '+id); },onClose:function(id){ console.log(' onClose : notification id = '+id); },duration:"300"});
                $('.content').load(obj.url);
            }
            $('.content input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});
            $('.content input[type="radio"]').iCheck({radioClass: 'iradio_minimal'}); 
        },'json');
    }

    function change_status(id,status){
        $(".content").mask("<?php echo 'Loading...'; ?>");
        var base_url = '<?php echo base_url("admin/slider/change_status");?>'; 
        $.post(base_url,{action:true,id:id,status:status}, function(results) {
            $(".content").unmask();
            var html = '';
            if(status == 'publish'){
                html += "<a href=\"javascript:change_status("+id+",'unpublish');\" class=\"label label-success\">Activation</a>";
            }else{
                html += "<a href=\"javascript:change_status("+id+",'publish')\" class=\"label label-danger\">Not Activation</a>"; 
            }
            $("#change-"+id).html(html);
        });
    }

    function slider_Delete(id){
     $.sModal({
            image:'<?php echo base_url("assets/admin");?>/img/confirm.png',
            content:'<?php echo "Do you want to delete this slider ?"; ?>',
            animate:'fadeDown',
            buttons:[
                        {
                            text:'<i class="fa fa-times-circle"></i> Delete',
                            addClass:'btn-danger',
                            click:function(m_id,data){
                                $(".content").mask("<?php echo 'Loading...'; ?>");
                                var url = '<?php echo base_url("admin/slider/delete");?>'+'/'+id;
                                $.get(url,function(result) {
                                    if(result.error == 0){
                                       $.notification({type:"success",img:"",width:"400",content:"<i class='fa fa-check fa-2x'></i> <?php echo 'User is deleted successfully'; ?>",html:true,autoClose:true,timeOut:"1500",delay:"0",position:"topRight",effect:"fade",animate:"fadeUp",easing:"jswing",onStart:function(id){ console.log(' onStart : notification id = '+id); },onShow:function(id){ console.log(' onShow : notification id = '+id); },onClose:function(id){ console.log(' onClose : notification id = '+id); },duration:"300"}); 
                                    }else{
                                       $.notification({type:"error",img:"",width:"400",content:"<i class='fa fa-times-circle fa-2x'></i> <?php echo 'There is an error, please check again!'; ?>",html:true,autoClose:true,timeOut:"1500",delay:"0",position:"topRight",effect:"fade",animate:"fadeUp",easing:"jswing",onStart:function(id){ console.log(' onStart : notification id = '+id); },onShow:function(id){ console.log(' onShow : notification id = '+id); },onClose:function(id){ console.log(' onClose : notification id = '+id); },duration:"300"});
                                    }
                                    $('.content').load(result.url,function(){
                                        $(".content").unmask();
                                        $('.content input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});
                                        $('.content input[type="radio"]').iCheck({radioClass: 'iradio_minimal'});
                                    });
                                    $.sModal('close',m_id);
                                },'json');
                            }
                        },
                        {
                            text:'Cancel',
                            click:function(id,data){
                                $.sModal('close',id);
                            }
                        },
                    ]
        });
    }

    function view_allstatus(id,status){
        var base_url = '<?php echo base_url("admin/users/index");?>'; 

        $.post(base_url,{action:'view-status',id:id,status:status}, function(results) {
            var html = '';
            if(id == 1){
                $('#view-title').html('Activated');
            }else if(id == 2){
                $('#view-title').html('Not Activated');
            }
            //load_result();
        });
    }
    
    function bulk_action(type){
        if (type != undefined){
            $.sModal({
                image:'<?php echo base_url("assets/admin");?>/img/confirm.png',
                content:'<?php echo "Do you want to delete this member ?"; ?>',
                animate:'fadeDown',
                buttons:[
                         {
                             text:'<i class="fa fa-times-circle"></i> OK',
                             addClass:'btn-danger',
                             click:function(m_id,data){
                                    $(".content").mask("<?php echo 'Loading...'; ?>");
                                    $.post($('#frm-bulk-action').attr('action')+'/'+type,$('#frm-bulk-action').serialize(),function(obj){
                                        $('.content').load(obj.url,function(){
                                           $('.content input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});
                                           $('.content input[type="radio"]').iCheck({radioClass: 'iradio_minimal'});
                                           $(".content").unmask();
                                           if (obj.error == 0){
                                             switch(obj.action){
                                               case 'delete':
                                                 $.notification({type:"success",img:"",width:"400",content:"<i class='fa fa-check fa-2x'></i> <?php echo 'User is deleted successfully'; ?>",html:true,autoClose:true,timeOut:"1500",delay:"0",position:"topRight",effect:"fade",animate:"fadeUp",easing:"jswing",onStart:function(id){ console.log(' onStart : notification id = '+id); },onShow:function(id){ console.log(' onShow : notification id = '+id); },onClose:function(id){ console.log(' onClose : notification id = '+id); },duration:"300"});
                                                 break;
                                               case 'publish':
                                                 $.notification({type:"success",img:"",width:"400",content:"<i class='fa fa-check fa-2x'></i> <?php echo 'User is activated successfully'; ?>",html:true,autoClose:true,timeOut:"1500",delay:"0",position:"topRight",effect:"fade",animate:"fadeUp",easing:"jswing",onStart:function(id){ console.log(' onStart : notification id = '+id); },onShow:function(id){ console.log(' onShow : notification id = '+id); },onClose:function(id){ console.log(' onClose : notification id = '+id); },duration:"300"});
                                               break;
                                               case 'unpublish':
                                                 $.notification({type:"success",img:"",width:"400",content:"<i class='fa fa-check fa-2x'></i> <?php echo 'User is deactivated successfully'; ?>",html:true,autoClose:true,timeOut:"1500",delay:"0",position:"topRight",effect:"fade",animate:"fadeUp",easing:"jswing",onStart:function(id){ console.log(' onStart : notification id = '+id); },onShow:function(id){ console.log(' onShow : notification id = '+id); },onClose:function(id){ console.log(' onClose : notification id = '+id); },duration:"300"});
                                               break;
                                           }
                                           }else{
                                                $.notification({type:"error",img:"",width:"400",content:"<i class='fa fa-times-circle fa-2x'></i> <?php echo 'There is an error, please check again!'; ?>",html:true,autoClose:true,timeOut:"1500",delay:"0",position:"topRight",effect:"fade",animate:"fadeUp",easing:"jswing",onStart:function(id){ console.log(' onStart : notification id = '+id); },onShow:function(id){ console.log(' onShow : notification id = '+id); },onClose:function(id){ console.log(' onClose : notification id = '+id); },duration:"300"});
                                           }
                                        });
                                      $.sModal('close',m_id);
                                    },'json');
                             }
                         },
                         {
                             text:'Cancel',
                             click:function(id,data){
                                 $.sModal('close',id);
                             }
                         },
                     ]
            });
        }
    }

    function Search_modal(){
        $('#search_modal').modal('show');
        $('.content input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});
        $('.content input[type="radio"]').iCheck({radioClass: 'iradio_minimal'}); 
    }

    function User_Search(){
        $(".content").mask("<?php echo 'Loading...'; ?>");
        $('#search_modal').modal('hide');
        var url  = $("#frm_User_Search").attr("action");
        var data = $("#frm_User_Search").serialize();
        $.post(url, data, function(html) {
            $('.content').html(html);
            $(".content").unmask();
            $('.content input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_minimal'});
            $('.content input[type="radio"]').iCheck({radioClass: 'iradio_minimal'}); 
        },'html');
    }
</script>