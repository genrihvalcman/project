<section class="content invoice profileBlock">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <span class="glyphicon glyphicon-user"></span> <?=$userData['user_surname'] . ' ' . $userData['user_name']?>
                <small class="pull-right"><?=$this->getLang(CTRL_DATE_REG)?>: <?= date('d.m.Y', strtotime($userData['data_created'])) ?></small>
            </h2>
        </div>
    </div>
    <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
           <img class='photoProfile photoProfileWidth' src='<?=CNTRL_IMG_AVATAR.$userData['user_avatar']?>'>
           <a href="/control/profile/edit/" class="btn btn-default btn-block" ><span class="glyphicon glyphicon-edit"></span><?=$this->getLang(CTRL_EDIT)?></a>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
              <?=$this->getLang(CTRL_PERSONAL_DATE)?><br>
                    <dl class="dl-horizontal dl-profile">
                        <dt><?=$this->getLang(CTRL_DATE_BIRTH)?>:</dt>
                        <dd><?= date('d.m.Y', strtotime($userData['user_birth'])) ?></dd>
                        <dt><?=$this->getLang(CTRL_EMAIL)?>:</dt>
                        <dd><?= $userData['user_email'] ?></dd>
                        <dt><?=$this->getLang(CTRL_COUNTRY)?>:</dt>
                        <dd><?= $userData['user_country'] ?></dd>
                        <dt><?=$this->getLang(CTRL_CITY)?>:</dt>
                        <dd><?= $userData['user_city'] ?></dd>
                    </dl>
        </div>
        <div class="col-sm-4 invoice-col">
            <dl class="dl-horizontal dl-profile">
                <br/>
                        <dt><?=$this->getLang(CTRL_TEL)?>:</dt>
                        <dd><?= $userData['user_tel'] ?></dd>
                        <dt><?=$this->getLang(CTRL_JOB_TITLE)?>:</dt>
                        <dd><?= $userData['type_role'] ?></dd>
                        <dt><?=$this->getLang(CTRL_LOGIN)?>:</dt>
                        <dd><?= $userData['user_login_no_hash'] ?></dd>
                        <dt><?=$this->getLang(CTRL_PASS)?>:</dt>
                        <dd><?= $userData['user_pass_no_hash'] ?></dd>
                    </dl>

        </div>
        <div class="col-xs-8">
            <blockquote style='font-size: 12px;'>     
                <p><?= $userData['user_about'] ?></p>   
            </blockquote>
        </div>
    </div>
</section>