
<form action="" method="POST">
    <?php
    foreach ($listFields as $value) {
        $idntFieldLabel = '';
        $activFieldsLabel = '';
        $idntField = '';
        $activFields = '';
        $titleFields = '';
        $selectedOptionType = '';
        $fieldsOrder = '';
        $defaulFieldChecked = '';
        $defaulField = '';
        $typeEdit = '';
        $fieldValid = '';
        $calendar = '';
        $tableLink = '';
        $forAliasField = '';
        
        ?>
        <?php
        if (!empty($activListFields)) {
            foreach ($activListFields as $activListValue) {
                if ($activListValue[field_name] == $value['Field']) {
                    if ($activListValue[field_active] == 1) {
                        $activFields = 'checked';
                        $activFieldsLabel = '<small  class="label label-success">'.$this->getLang(CTRL_FIELD_ACTIVE).'</small>';
                    }
                    if ($activListValue[field_idnt] == 1) {
                        $idntField = 'checked';
                        $idntFieldLabel = '<small  class="label label-info">'.$this->getLang(CTRL_IDENTIFIER).'</small>';
                    }
                    if($activListValue[field_default] == 'on' && $activListValue[field_type] === 'checkbox'){$defaulFieldChecked = 'checked';}
                    if($activListValue[field_type] != 'checkbox'){$defaulField = $activListValue[field_default];}
                    $titleFields = $activListValue[field_title];
                    $selectedOptionType = $activListValue[field_type];
                    $fieldsOrder = $activListValue[field_order];
                    $typeEdit = $activListValue[field_type_edit];
                    if($activListValue[field_valid] == '1' ){$fieldValid = 'checked';}
                    if($activListValue[field_calendar] == '1' ){$calendar = 'checked';}
                    $tableLink = $activListValue[field_link_table] .'-'.$activListValue[field_link_field];
                    $forAliasField = $activListValue[field_for_alias];
                     
                }
            }
        }
        ?>
        <div class="box box-primary collapsed-box">
            <div class="box-header">
                <h5 class="box-title"><?= $value['Field'] ?></h5>
                <div class="box-tools pull-right">
                    <?= $idntFieldLabel ?>
                    <?= $activFieldsLabel ?>
                    <button type="button" class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body" style="display: none;">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="box box-info box-body">
                            <div class="form-group">
                                <input type="checkbox" id="exampleInputActiv_<?= $value[Field] ?>" class="form-control" name="fieldActive[<?= $value['Field'] ?>]"  <?= $activFields ?>>
                                <label for="exampleInputActiv_<?= $value[Field] ?>"><?=$this->getLang(CTRL_ACTIVATE_FIELD)?></label>
                            </div> 
                            <div class="form-group">
                                <input type="checkbox" id="exampleInputIdnt_<?= $value[Field] ?>" class="form-control" name="fieldIndt[<?= $value['Field'] ?>]" <?= $idntField ?>>
                                <label for="exampleInputIdnt_<?= $value[Field] ?>"><?=$this->getLang(CTRL_FIELD_IDENTIFIER)?></label>
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputName"><?=$this->getLang(CTRL_TITLE)?></label>
                                <input type="text" class="form-control" id="exampleInputName" placeholder="<?=$this->getLang(CTRL_TITLE)?>" name="fieldName[<?= $value['Field'] ?>]" value="<?= $titleFields ?>">
                            </div> 
                            <div class="form-group">
                                <label>Тип</label>
                                <select class="form-control" id="fieldType_<?= $value[Field] ?>" onchange="editProp('<?= $value[Field] ?>');" name="fieldType[<?= $value['Field'] ?>]">
                                    <option selected="" disabled=""><?=$this->getLang(CTRL_SELECT_TYPE)?></option>
                                    <option <?php if ($selectedOptionType == 'text') {echo 'selected';} ?> value="text"><?=$this->getLang(CTRL_TEXT_FIELD)?></option>
                                    <option <?php if ($selectedOptionType == 'textarea') {echo 'selected';} ?> value="textarea"><?=$this->getLang(CTRL_TEXTAREA)?></option>
                                    <option <?php if ($selectedOptionType == 'checkbox') {echo 'selected';} ?> value="checkbox"><?=$this->getLang(CTRL_CHECKBOX)?></option>
                                    <option <?php if ($selectedOptionType == 'select') {echo 'selected';} ?> value="select"><?=$this->getLang(CTRL_SELECT)?></option>
                                    <option <?php if ($selectedOptionType == 'date') { echo 'selected';} ?> value="date"><?=$this->getLang(CTRL_DATE)?></option>
                                    <option <?php if ($selectedOptionType == 'link') {echo 'selected';} ?> value="link"><?=$this->getLang(CTRL_LINK)?></option>
                                    <option <?php if ($selectedOptionType == 'file') {echo 'selected';} ?> value="file"><?=$this->getLang(CTRL_FILE)?></option>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputOrd"><?=$this->getLang(CTRL_ORDER)?></label>
                                <input type="text" class="form-control" id="exampleInputOrd" name="fieldOrder[<?= $value['Field'] ?>]" value='<?=$fieldsOrder?>'>
                            </div> 
                        </div>
                    </div>

                    <div class="col-md-6 clearInput">
                        <div class="box box-info box-body">
                            <div id="textSelect_<?= $value[Field] ?>" <?php if ($selectedOptionType == 'text') {echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                                <div class="form-group">
                                    <label for="exampleInputTextDefault"><?=$this->getLang(CTRL_DEF_TEXT)?></label>
                                    <input type="text" class="form-control" id="exampleInputTextDefault" placeholder="<?=$this->getLang(CTRL_DEF_TEXT)?>" name="fieldDefText[<?= $value['Field'] ?>]" value="<?=$defaulField?>">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="exampleInputEmpty_<?= $value[Field] ?>" class="form-control" name="fieldCheckEmpty[<?= $value['Field'] ?>]" <?=$fieldValid?>>
                                    <label for="exampleInputEmpty_<?= $value[Field] ?>"><?=$this->getLang(CTRL_CHECK_EMPTY)?></label>
                                </div>
                                <div class="form-group">
                                    <label ><?=$this->getLang(CTRL_SELECT_ALIAS)?></label>
                                    <?=$activListValue[field_for_alias]?>
                                    <select class="form-control" name="forAalias[<?= $value['Field'] ?>]">
                                        <option value=""></option>
                                       <?php
                                        foreach ($listFields as $forAlias){
                                            $select = '';
                                            if($forAliasField == $forAlias[Field]){
                                                $select = 'selected';
                                            }
                                            echo '<option '.$select.' value="'.$forAlias[Field].'">'.$forAlias[Field].'</option>';
                                        }
                                       ?>
                                    </select>
                                </div>
                                
                            </div>
                            <div id="textareaSelect_<?= $value[Field] ?>" <?php if ($selectedOptionType == 'textarea') {echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                                <div class="form-group">
                                    <label for="exampleInputTextDefault"><?=$this->getLang(CTRL_DEF_TEXT)?></label>
                                    <textarea class="form-control" placeholder="<?=$this->getLang(CTRL_DEF_TEXT)?>"  name="fieldDefTextarea[<?= $value['Field'] ?>]"><?=$defaulField?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?=$this->getLang(CTRL_EDITOR)?></label>
                                    <select class="form-control" name="fieldTypeEdit[<?= $value['Field'] ?>]">
                                        <option value=""><?=$this->getLang(CTRL_NO_EDITOR)?></option>
                                        <option <?php if ($typeEdit == 'edit_basic') {echo 'selected';} ?> value="edit_basic"><?=$this->getLang(CTRL_BASIC)?></option>  
                                        <option <?php if ($typeEdit == 'edit_full') {echo 'selected';} ?> value="edit_full"><?=$this->getLang(CTRL_FULL)?></option>
                                    </select>
                                </div> 
                            </div> 
                            <div id="checkboxSelect_<?= $value[Field] ?>" <?php if ($selectedOptionType == 'checkbox') {echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                                <div class="form-group">
                                    <input type="checkbox" id="exampleInputDefActive_<?= $value[Field] ?>" class="form-control"  <?=$defaulFieldChecked?>  name="fieldCheckbox[<?= $value['Field'] ?>]">
                                    <label for="exampleInputDefActive_<?= $value[Field] ?>"><?=$this->getLang(CTRL_DEF_ACTIVATE)?></label>
                                </div>
                            </div>
                            <div id="selectSelect_<?= $value[Field] ?>" <?php if ($selectedOptionType == 'select') {echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                                <div class="form-group">
                                    <label for="exampleInputSelect"><?=$this->getLang(CTRL_SELECTIONS)?></label>
                                    <input type="text" class="form-control" id="exampleInputSelect" placeholder="<?=$this->getLang(CTRL_OPTION_EXAMPLE)?>" name="fieldSelect[<?= $value['Field'] ?>]" value="<?=$defaulField?>">
                                </div>

                            </div>
                            <div id="dateSelect_<?= $value[Field] ?>" <?php if ($selectedOptionType == 'date') {echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                                <div class="form-group">
                                    <label><?=$this->getLang(CTRL_RECORD)?></label>
                                    <select class="form-control" name="fieldDataType[<?= $value['Field'] ?>]">
                                        <option  value="">Выберите тип</option>
                                        <option <?php if ($defaulField == 'date') {echo 'selected';} ?> value="date"><?=$this->getLang(CTRL_ONLY_DATE)?></option>
                                        <option <?php if ($defaulField == 'datetime') {echo 'selected';} ?> value="datetime"><?=$this->getLang(CTRL_DATETIME)?></option>
                                    </select>
                                </div>
                            </div>
                            <div id="linkSelect_<?= $value[Field] ?>" <?php if ($selectedOptionType == 'link') {echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>

                                <div class="form-group">
                                    <label><?=$this->getLang(CTRL_ASING_FIELD)?></label>
                                    <select class="form-control" name="fieldLink[<?= $value['Field'] ?>]">
                                        <option value=""><?=$this->getLang(CTRL_SELECT_FIELD)?></option>
                                        <?php
                                            foreach ($fieldsForTable as $tableKey => $tableVal) {

                                                foreach ($tableVal as $valField) {
                                                    $sel = '';
                                                     if ($tableLink == $tableKey.'-'.$valField[Field]) {$sel = 'selected';} 
                                                    echo "<option $sel  value='$tableKey-$valField[Field]'>" . $tableKey . ' - ' . $valField[Field] . '</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="fileSelect_<?= $value[Field] ?>" <?php if ($selectedOptionType == 'file') {echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>>
                                <?=$this->getLang(CTRL_NOT_CNFIG)?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
<?php } ?>
    <div class="box-footer clearfix no-border">
        <button class="btn btn-default pull-right " type="submit" name="save_fields" value="save_fields"><i class="fa fa-save"></i> <?=$this->getLang(CTRL_SAVE)?></button>
    </div>
</form>