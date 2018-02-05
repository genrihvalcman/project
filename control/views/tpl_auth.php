<div class="bg-black">
  <div class="form-box" id="login-box">
                                  
            <div class="header"><?=$this->getLang(CTRL_AUTH)?></div>
            <form action="/control/auth/" method="post">
                <div class="body bg-gray">
                    <? if(!empty($error)):?>
                        <div class="callout callout-danger">
                            <h4><?=$this->getLang(ERROR_AUTH)?></h4>
                            <p><?=$error?></p>
                        </div>
                    <? endif; ?>
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" placeholder="<?=$this->getLang(CTRL_LOGIN)?>"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="<?=$this->getLang(CTRL_PASS)?>"/>
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block" name="user_auth" value='<?=$this->getLang(CTRL_ENTER)?>'><?=$this->getLang(CTRL_ENTER)?></button>  
                    
                </div>
            </form>
            <div class="logo_auth">Advokat </div>
        </div> 
</div>
