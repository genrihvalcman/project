<div class="box box-primary">

    <div class="box-header ">
        <h3 class="box-title" style="padding-top: 17px;"><?=$this->getLang(CTRL_DATA_TABLE)?></h3>
            <div class="box-footer clearfix no-border">
               <?php if(empty($errorSelectField)){?> <a class="btn btn-primary pull-right btn-flat" href="/control/datatable/action/?tbl=<?=$whereTable?>" ><?=$this->getLang(CTRL_ADD)?></a><?php } ?>
            </div>
    </div><!-- /.box-header -->
    
     <div class="nav-tabs-custom">
                <ul class="nav nav-tabs linkLang">

                    <li <?php if($active == ''){echo 'class="active"';} ?> ><a href="/control/datatable/?tbl=<?=$desckTable[t_name]?>"><?=$desckTable[t_title]?></a></li>
                  <?php
                    foreach ($dataLinkLangTable as $key => $valueLink){ 
                        if($valueLink !==''){
                           $activeClass = '';
                           if($active == $key){$activeClass = 'class="active"';}
                           echo '<li '.$activeClass.' ><a href="/control/datatable/?tbl='.$desckTable[t_name].'&linktbl='.$key.'" >'.$valueLink.'</a></li>';  
                       }
                  }
                  ?>
                  
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" >
                        <table class="table">
                          <?php
                              if(!empty($errorSelectField)){echo $errorSelectField;}else{}

                              echo $dataTableTr;
                          ?>

                      </table>
                            <div class="box-tools clearfix">
                                <?=$pageLink?>
                            </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
</div>