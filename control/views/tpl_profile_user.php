<div class="box box-primary">
    <div class="box-header ">
        <h3 class="box-title" style="padding-top: 17px;"><?=$this->getLang(CTRL_USRE_PANEL)?></h3>
            <div class="box-footer clearfix no-border">
               <a class="btn btn-primary pull-right btn-flat" href="/control/profile/add/" ><?=$this->getLang(CTRL_ADD)?></a>
            </div>
    </div><!-- /.box-header -->
    <div class="box-body no-padding datatable">
        <table class="table">
            
            <?php foreach ($userProfile as $value) {?>
                <tr>
                    <td><?=$value[user_name].' '.$value[user_surname]?></td>
                    <td> 
                        <div class="tools">
                            <a href="/control/profile/useredit/?id=<?=$value[id]?>"><i class="fa fa-edit"></i></a>
                            <a href="?deleteid=<?=$value[id]?>"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div><!-- /.box-body -->

</div>