<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?=$this->getLang(CTRL_LIST_TABLE)?></h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <form action="" method="POST">
                    <table class="table table-hover">
                        <tr>
                            <th><?=$this->getLang(CTRL_ID)?></th>
                            <th><?=$this->getLang(CTRL_ON)?></th>
                            <th><?=$this->getLang(CTRL_TABLE_NAME)?></th>
                            <th><?=$this->getLang(CTRL_TABLE_TITLE)?></th>
                            <th><?=$this->getLang(CTRL_ICON)?></th>
                            <th><?=$this->getLang(CTRL_IN_MENU)?></th>
                            <th></th>
                        </tr>
                        <? foreach ($dataTable as $key => $value): ?>
                        <? if($value == '') : ?>  
                        <tr>
                            <td>no</td>
                            <td><input type="checkbox" name='t_active[<?= $key ?>]'  ></td>
                            <td><?= $key ?></td>
                            <td><input class="form-control input-sm pull-right" name="t_name[<?= $key ?>]" type="text" value=""></td>
                            <td><span class="icons_table" data-toggle="modal" href="#icons_table"><i class="fa fa-fw "><?=$this->getLang(CTRL_NO)?></i><input type="hidden" name="t_icon[<?= $key ?>]" value="fa-square-o"></span></td>
                            <td><input type="checkbox" name='t_show[<?= $key ?>]'></td>
                            <td></td>
                        </tr>   
                        <? else:?>  
                        <? foreach ($value as $val): ?>
                        <tr>
                            <td><?= $val['id'] ?></td>
                            <td><input type="checkbox" name='t_active[<?= $val['t_name'] ?>]' <? if($val['t_active'] == '1'):?> checked <? endif; ?>></td>
                            <td class="nameTable"><?= $val['t_name'] ?></td>
                            <td><input class="form-control input-sm pull-right" type="text" name="t_name[<?= $val['t_name'] ?>]" value="<?= $val['t_title'] ?>"></td>
                            <td><span class="icons_table" data-toggle="modal" href="#icons_table"><i class="fa fa-fw <?= $val['t_icon'] ?>"></i><input type="hidden" name="t_icon[<?= $val['t_name'] ?>]" value="<?= $val['t_icon'] ?>"></span></td>
                            <td><input type="checkbox" name='t_show[<?= $val['t_name'] ?>]' <? if($val['t_show'] == '1'):?> checked <? endif; ?>></td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-flat"><?=$this->getLang(CTRL_SELECT_ACTION)?></button>
                                    <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/control/table/fields/?table_name=<?= $val['t_name'] ?>" class=""><?=$this->getLang(CTRL_SETTING_FIELD)?></a></li>
                                        <li><a class="settingsTable" data-toggle="modal" href="#tableSettings" class=""><?=$this->getLang(CTRL_SETTING_TABLE)?></a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <? endforeach;?>
                        <? endif;?>
                        <? endforeach;?>
                    </table>
                    <div class="box-footer clearfix no-border">
                        <button class="btn btn-default pull-right " type="submit" name="save_table" value="save_table"><?=$this->getLang(CTRL_SAVE)?></button>
                    </div> 
                </form>
            </div><!-- /.box-body -->
            <div class="modal fade" id="tableSettings" data-backdrop="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"><i class="fa fa-table"></i> <?=$this->getLang(CTRL_SETTING_TABLE)?> - <span class="nametable"></span></h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="POST" action="/control/table/">
                                <input type="hidden" name="nametable" id="inputNameTable">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><?=$this->getLang(CTRL_CONTROLLER)?>: </span>
                                        <input name="nameController" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><?=$this->getLang(CTRL_ACTION)?>: </span>
                                        <input name="nameAction" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label><?=$this->getLang(CREL_LINK_TABLE)?> <span data-toggle="tooltip" data-original-title="<?=$this->getLang(CTRL_TIP_USE)?>">(?)</span></label>
                                    <select multiple size="5" class="form-control" id='t_table_link' name="t_table_link[]">
                                         <option value=''><?=$this->getLang(CREL_NO_LINK_TABLE)?></option>
                                        <?php
                                           foreach($dataTable as $key=>$valTble){
                                                   echo '<option value="'.$key.'">'.$key.'</option>';
                                                }
                                        ?>  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label ><?=$this->getLang(CTRL_TABLE_ADD_LANG)?> <span data-toggle="tooltip" data-original-title="<?=$this->getLang(CTRL_TIP_USE)?>">(?)</span></label>
                                    <select  multiple size="5" class="form-control" id='t_lang_link' name="t_lang_link[]">
                                            <option value=''><?=$this->getLang(CTRL_NO_TABLE_ADD_LANG)?></option>
                                            <?php
                                                foreach($dataTable as $key=>$valTble){
                                                   echo '<option value="'.$key.'">'.$key.'</option>';
                                                }
                                            ?>  
                                    </select>
                                </div>
                            
                        </div>
                        <div class="modal-footer clearfix">
                            <button class="btn btn-primary pull-right btn-flat " type="submit" name="save_table_setting" value="save_table_setting"><?=$this->getLang(CTRL_SAVE)?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="icons_table" data-backdrop="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><i class="fa fa-smile-o"></i> <?=$this->getLang(CTRL_SELECT_ICON)?> </h4>
                    </div>
                    <div class="box-body">
                        <section id="web-application">

                            <div class="row fontawesome-icon-list">
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-adjust"></i> fa-adjust</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-anchor"></i> fa-anchor</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-archive"></i> fa-archive</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows"></i> fa-arrows</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-h"></i> fa-arrows-h</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-arrows-v"></i> fa-arrows-v</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-asterisk"></i> fa-asterisk</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ban"></i> fa-ban</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bar-chart-o"></i> fa-bar-chart-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-barcode"></i> fa-barcode</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bars"></i> fa-bars</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-beer"></i> fa-beer</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bell"></i> fa-bell</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bell-o"></i> fa-bell-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bolt"></i> fa-bolt</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-book"></i> fa-book</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bookmark"></i> fa-bookmark</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bookmark-o"></i> fa-bookmark-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-briefcase"></i> fa-briefcase</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bug"></i> fa-bug</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-building-o"></i> fa-building-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bullhorn"></i> fa-bullhorn</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-bullseye"></i> fa-bullseye</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar"></i> fa-calendar</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-calendar-o"></i> fa-calendar-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-camera"></i> fa-camera</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-camera-retro"></i> fa-camera-retro</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-down"></i> fa-caret-square-o-down</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-left"></i> fa-caret-square-o-left</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-right"></i> fa-caret-square-o-right</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-caret-square-o-up"></i> fa-caret-square-o-up</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-certificate"></i> fa-certificate</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check"></i> fa-check</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-circle"></i> fa-check-circle</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-circle-o"></i> fa-check-circle-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-square"></i> fa-check-square</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-check-square-o"></i> fa-check-square-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle"></i> fa-circle</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-circle-o"></i> fa-circle-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-clock-o"></i> fa-clock-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cloud"></i> fa-cloud</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cloud-download"></i> fa-cloud-download</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cloud-upload"></i> fa-cloud-upload</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-code"></i> fa-code</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-code-fork"></i> fa-code-fork</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-coffee"></i> fa-coffee</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cog"></i> fa-cog</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cogs"></i> fa-cogs</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comment"></i> fa-comment</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comment-o"></i> fa-comment-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comments"></i> fa-comments</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-comments-o"></i> fa-comments-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-compass"></i> fa-compass</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-credit-card"></i> fa-credit-card</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-crop"></i> fa-crop</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-crosshairs"></i> fa-crosshairs</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-cutlery"></i> fa-cutlery</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dashboard"></i> fa-dashboard <span class="text-muted">(alias)</span></div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-desktop"></i> fa-desktop</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-dot-circle-o"></i> fa-dot-circle-o</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-download"></i> fa-download</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-edit"></i> fa-edit <span class="text-muted">(alias)</span></div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ellipsis-h"></i> fa-ellipsis-h</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ellipsis-v"></i> fa-ellipsis-v</div>
                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-envelope"></i> fa-envelope</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-envelope-o"></i> fa-envelope-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eraser"></i> fa-eraser</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exchange"></i> fa-exchange</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exclamation"></i> fa-exclamation</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exclamation-circle"></i> fa-exclamation-circle</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-exclamation-triangle"></i> fa-exclamation-triangle</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-external-link"></i> fa-external-link</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-external-link-square"></i> fa-external-link-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eye"></i> fa-eye</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-eye-slash"></i> fa-eye-slash</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-female"></i> fa-female</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fighter-jet"></i> fa-fighter-jet</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-film"></i> fa-film</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-filter"></i> fa-filter</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fire"></i> fa-fire</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-fire-extinguisher"></i> fa-fire-extinguisher</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flag"></i> fa-flag</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flag-checkered"></i> fa-flag-checkered</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flag-o"></i> fa-flag-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flash"></i> fa-flash <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-flask"></i> fa-flask</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder"></i> fa-folder</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder-o"></i> fa-folder-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder-open"></i> fa-folder-open</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-folder-open-o"></i> fa-folder-open-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-frown-o"></i> fa-frown-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gamepad"></i> fa-gamepad</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gavel"></i> fa-gavel</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gear"></i> fa-gear <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gears"></i> fa-gears <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-gift"></i> fa-gift</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-glass"></i> fa-glass</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-globe"></i> fa-globe</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-group"></i> fa-group <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-hdd-o"></i> fa-hdd-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-headphones"></i> fa-headphones</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heart"></i> fa-heart</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-heart-o"></i> fa-heart-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-home"></i> fa-home</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-inbox"></i> fa-inbox</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-info"></i> fa-info</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-info-circle"></i> fa-info-circle</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-key"></i> fa-key</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-keyboard-o"></i> fa-keyboard-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-laptop"></i> fa-laptop</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-leaf"></i> fa-leaf</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-legal"></i> fa-legal <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lemon-o"></i> fa-lemon-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-level-down"></i> fa-level-down</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-level-up"></i> fa-level-up</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lightbulb-o"></i> fa-lightbulb-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-location-arrow"></i> fa-location-arrow</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-lock"></i> fa-lock</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-magic"></i> fa-magic</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-magnet"></i> fa-magnet</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mail-forward"></i> fa-mail-forward <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mail-reply"></i> fa-mail-reply <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mail-reply-all"></i> fa-mail-reply-all</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-male"></i> fa-male</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-map-marker"></i> fa-map-marker</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-meh-o"></i> fa-meh-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-microphone"></i> fa-microphone</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-microphone-slash"></i> fa-microphone-slash</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus"></i> fa-minus</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-circle"></i> fa-minus-circle</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-square"></i> fa-minus-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-minus-square-o"></i> fa-minus-square-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mobile"></i> fa-mobile</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-mobile-phone"></i> fa-mobile-phone <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-money"></i> fa-money</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-moon-o"></i> fa-moon-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-music"></i> fa-music</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pencil"></i> fa-pencil</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pencil-square"></i> fa-pencil-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-pencil-square-o"></i> fa-pencil-square-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-phone"></i> fa-phone</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-phone-square"></i> fa-phone-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-picture-o"></i> fa-picture-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plane"></i> fa-plane</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus"></i> fa-plus</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-circle"></i> fa-plus-circle</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-square"></i> fa-plus-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-plus-square-o"></i> fa-plus-square-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-power-off"></i> fa-power-off</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-print"></i> fa-print</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-puzzle-piece"></i> fa-puzzle-piece</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-qrcode"></i> fa-qrcode</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-question"></i> fa-question</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-question-circle"></i> fa-question-circle</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-quote-left"></i> fa-quote-left</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-quote-right"></i> fa-quote-right</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-random"></i> fa-random</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-refresh"></i> fa-refresh</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-reply"></i> fa-reply</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-reply-all"></i> fa-reply-all</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-retweet"></i> fa-retweet</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-road"></i> fa-road</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rocket"></i> fa-rocket</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rss"></i> fa-rss</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-rss-square"></i> fa-rss-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-search"></i> fa-search</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-search-minus"></i> fa-search-minus</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-search-plus"></i> fa-search-plus</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share"></i> fa-share</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-square"></i> fa-share-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-share-square-o"></i> fa-share-square-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-shield"></i> fa-shield</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-shopping-cart"></i> fa-shopping-cart</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sign-in"></i> fa-sign-in</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sign-out"></i> fa-sign-out</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-signal"></i> fa-signal</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sitemap"></i> fa-sitemap</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-smile-o"></i> fa-smile-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort"></i> fa-sort</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-alpha-asc"></i> fa-sort-alpha-asc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-alpha-desc"></i> fa-sort-alpha-desc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-amount-asc"></i> fa-sort-amount-asc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-amount-desc"></i> fa-sort-amount-desc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-asc"></i> fa-sort-asc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-desc"></i> fa-sort-desc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-down"></i> fa-sort-down <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-numeric-asc"></i> fa-sort-numeric-asc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-numeric-desc"></i> fa-sort-numeric-desc</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sort-up"></i> fa-sort-up <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-spinner"></i> fa-spinner</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-square"></i> fa-square</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-square-o"></i> fa-square-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star"></i> fa-star</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half"></i> fa-star-half</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half-empty"></i> fa-star-half-empty <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half-full"></i> fa-star-half-full <span class="text-muted">(alias)</span></div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-half-o"></i> fa-star-half-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-star-o"></i> fa-star-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-subscript"></i> fa-subscript</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-suitcase"></i> fa-suitcase</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-sun-o"></i> fa-sun-o</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-superscript"></i> fa-superscript</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tablet"></i> fa-tablet</div>

                                <div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-tachometer"></i> fa-tachometer</div>


                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>  

    </div><!-- /.box -->
</div>
</div>