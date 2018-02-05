<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><?= $namePage ?></h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body" id="dataTable">
       
        <form action="" method="POST" > 
            <?php
                foreach ($structurePage as $value) {
                    echo $value;
                }
            ?>
            <div class="box-footer clearfix">
                <button type="submit" class="btn btn-primary pull-right btn-flat" name="<?=$actionBotton?>" value="1"><?=$this->getLang(CTRL_SAVE)?></button>
                <a  class="btn btn-danger pull-right btn-flat" onclick="history.back()" ><?=$this->getLang(CTRL_CANCEL)?></a>
            </div>
        </form>    
    </div>
</div>

