<div class="row ">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><?=$titleBlock?></h3>
        </div>
        <div class="box-body ">
         <form action="" method="POST">
            <div class="col-md-6">
              <?php
              if(!empty($userProfile[user_avatar])){
                  $userAvatar = $userProfile[user_avatar];
              }else{ 
                  $userAvatar = 'avatar11.png';
                  }
              ?>
                    <div class="form-group" style='text-align: center;' >
                        <img data-toggle="modal" href="#avatarUser" style="width: 217px;" class='photoProfile editPhotoProfile' src='<?=CNTRL_IMG_AVATAR . $userAvatar ?>'>
                        <input type="hidden" class='srcImgProfile' name='user_avatar'  class="form-control"  value="<?=$userAvatar?>">
                            <p><?=$this->getLang(CTRL_CLICK_PHOTO)?></p>
                    </div>
                    <div class="form-group">
                        <label ><?=$this->getLang(CTRL_JOB_TITLE)?></label>
                        <select class='form-control' name="type_user">
                           <?php
                                foreach ($userRole as $val){
                                    $select = '';
                                    if($val[id] == $userProfile[type_user]){$select = 'selected';} 
                                    echo '<option '.$select.' value="'.$val[id].'">'.$val[type_role].'</option>';
                                }
                           ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label ><?=$this->getLang(CTRL_NAME)?></label>
                        <input  required type="text" class="form-control"  value="<?=$userProfile[user_name]?>" name='user_name'>
                    </div>
                    <div class="form-group">
                        <label ><?=$this->getLang(CTRL_SURNAME)?></label>
                        <input required type="text" class="form-control"  value="<?=$userProfile[user_surname]?>" name='user_surname'>
                    </div>

                    <div class="form-group">
                        <label ><?=$this->getLang(CTRL_EMAIL)?></label>
                        <input type="email" class="form-control"  value="<?=$userProfile[user_email]?>" name='user_email'>
                    </div>
                    <div class="form-group">
                        <label ><?=$this->getLang(CTRL_TEL)?></label>
                        <input type="text" class="form-control"  value="<?=$userProfile[user_tel]?>" name='user_tel'>
                    </div>

            </div>
            <div class="col-md-6 ">
                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_DATE_BIRTH)?></label>
                    <input type="text"   class="form-control calendar_birthDate"   value="<?= date('d.m.Y', strtotime($userProfile['user_birth'])) ?>" name='user_birth'>
                </div>

                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_COUNTRY)?></label>
                    <input type="text" class="form-control"  value="<?=$userProfile[user_country]?>" name='user_country'>
                </div>
                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_CITY)?></label>
                    <input type="text" class="form-control"  value="<?=$userProfile[user_city]?>" name='user_city'>
                </div>
                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_LOGIN)?> <span class="errValidate"></span></label>
                    <input type="text" class="form-control logonProgile"  value="<?=$userProfile[user_login_no_hash]?>" name='user_login_no_hash'>
                </div>
                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_PASS)?>  <span class="errValidate"></span></label>
                    <input type="password" class="form-control passProfile"  value="<?=$userProfile[user_pass_no_hash]?>" name='user_pass_no_hash'>
                </div>
                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_RE_PASS)?>  <span class="errValidate"></span></label>
                    <input type="password" class="form-control repeatPassProfile"  value="<?=$userProfile[user_pass_no_hash]?>">
                </div>
                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_ABOUT)?></label>
                    <textarea class="form-control" rows="3" name='user_about'><?=$userProfile[user_about]?></textarea>
                </div>
                <div class="form-group">
                    <label ><?=$this->getLang(CTRL_ACCESS_TABLE)?></label>
                    <select  multiple size="5" class="form-control" id='t_lang_link' name="user_access[]">
                            <option value=''><?=$this->getLang(CTRL_NO_ACCESS)?></option>
                            <?php
                             foreach ($accessTableSql as $value) {
                               $selected = '';
                               if($userProfile[user_access] !== 'all'){
                                   $userCheckAccess = explode(',', $userProfile[user_access]);
                                   foreach ($userCheckAccess as $valueAccess) {
                                     if($valueAccess == $value[id]){
                                       $selected = 'selected'; 
                                     }
                                   }     
                               }else{
                                    $selected = 'selected';
                               }
                               echo '<option '.$selected.' value="'.$value[id].'">'.$value[t_title].'</option>';
                           }
                            ?>  
                    </select>                    

                </div>

            </div>
            <div class="clearfix"></div>
            <div class="box-footer clearfix">
                <button type="submit" class="btn btn-primary pull-right btn-flat" name="<?=$actionButton?>" id="validErrButton" value="1"><?=$this->getLang(CTRL_SAVE)?></button>
                <a  class="btn btn-danger pull-right btn-flat" onclick="history.back()" ><?=$this->getLang(CTRL_CANCEL)?></a>
            </div>
            </form>
        </div>
        
               <div class="modal fade" id="avatarUser" data-backdrop="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"><i class="fa fa-picture-o"></i> <?=$this->getLang(CTRL_USER_AVATAR)?> </h4>
                        </div>
                        <div class="modal-body selectAvtr">
                                    <?php
                                    $i = 1;
                                        foreach ($userAvtarVar as $valueImg) {
                                            echo '<img rel="'.$valueImg.'" class="avtr_'.$i.'" src="'.CNTRL_IMG_AVATAR.$valueImg.'">';
                                            $i++;
                                        }
                                    ?>
                            
                        </div>
                </div>
            </div>
        </div>           
</div>
</div>
    
    


