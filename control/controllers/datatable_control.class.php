<?php

class DataTable_Control extends ControlController {

    function __construct() {
        parent::__construct();
        $this->authUser();
    }

    function action_index() {

        if ($this->request->deleteid) {
            $this->model->deleltWhere($this->request->tbl, 'id = ?', array($this->request->deleteid));
        }
        
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_datatable_view', CNTRL_DIR_TPL);
                
        $linkLangTable = $this->model->rowSelectFieldWhere('t_lang_link', 'fmw_control_table', 't_name = ?', array($this->request->tbl));
        $linkLangTableArr = explode(',', $linkLangTable[t_lang_link]);
        
        $nameLinkLangTable = array();
        foreach ($linkLangTableArr as $valueLangTableName) {
            
            if($this->userAccess === 'all' || empty($this->userAccess) ){
                $langTableName = $this->model->rowSelectFieldWhere('t_title', 'fmw_control_table', 't_name = ?', array($valueLangTableName));
            }else{
                $accessIdTable = explode(',', $this->userAccess);
                foreach ($accessIdTable as $valueIdAccess) {
                    $langTableName = $this->model->rowSelectFieldWhere('t_title', 'fmw_control_table', 't_name = ? AND id = ?', array($valueLangTableName,$valueIdAccess));
                    
                } 
            }
            if(!empty($langTableName)){
                if($langTableName[t_title] == ''){
                  $nameLinkLangTable[$valueLangTableName] = $valueLangTableName;
                }else{
                   $nameLinkLangTable[$valueLangTableName] = $langTableName[t_title];  
                }  
            }
        }
        $this->view->setTemplateVar('dataLinkLangTable', $nameLinkLangTable);
        $this->view->setTemplateVar('active', $this->request->linktbl);
        
        
        
        
        $titleTblName = $this->model->rowSelectFieldWhere('t_title', 'fmw_control_table', 't_name = ?', array($this->request->tbl));
        $this->view->setTitle($titleTblName[t_title]." | Onero Technology ");
        
        $desckTable = array(
            't_title' => $titleTblName[t_title],
            't_name' => $this->request->tbl
        );
        $this->view->setTemplateVar('desckTable', $desckTable);
        
        
        
        if($this->request->linktbl){$whereTable = $this->request->linktbl; }else{$whereTable = $this->request->tbl;}
        $this->view->setTemplateVar('whereTable', $whereTable);
        
        $nameIdntField = $this->model->allSelectFieldWhere('field_name', 'fmw_control_fields', 'field_idnt = ? AND field_table = ? ORDER BY field_order ASC ', array('1', $whereTable));
        if($nameIdntField !=''){

        for ($i = 0; $i < count($nameIdntField); $i++) {
            $listFieldIdnt[] = implode(',', $nameIdntField[$i]);
        }

        $perpage = 15;
        $start_pos = $this->pagenav->pagesLinks($perpage, $whereTable, $this->request->page);
        if($start_pos < 0){$start_pos = 0;}
        $listFieldIdntString = implode(',', $listFieldIdnt);
        $dataTable = $this->model->allSelectField('id,' . $listFieldIdntString, $whereTable . ' LIMIT ' . $start_pos . ', ' . $perpage . '');
        if(!empty($dataTable)){
            foreach ($dataTable as $value) {
                $dataTableTr .='<tr><td> id - ';
                foreach ($value as $val) {
                    $comma = '';
                    if ($val != '') {
                        $comma = ', ';
                    }
                    $dataTableTr .= $val . $comma;
                }
                $dataTableTr = chop($dataTableTr, ', ');
                $dataTableTr .='</td><td> 
                    <div class="tools ">
                        <a class="marginTools" href="/control/datatable/action/?tbl=' . $whereTable . '&editid=' . $value[id] . '"><i class="fa fa-edit"></i></a>
                         <a href="?tbl=' . $whereTable . '&deleteid=' . $value[id] . '"><i class="fa fa-trash-o"></i></a>
                    </div>
                </td></tr>';
            }
        }
        
     
        $this->view->setTemplateVar('dataTableTr', $dataTableTr);
        $this->pagenav->createLinksPages('fmw_site_page', 'pagination-sm no-margin pull-right');

        $this->view->setTemplateVar('pageLink', $this->pagenav->showLinksPages());
       }  else {
           $this->view->setTemplateVar('errorSelectField', $this->view->getLang(ERROR_NO_FIELD));
       }
    }
    
    
    
    
    

    function action_action() {
              

        if ($this->request->adddatatable) {
            unset($_POST['adddatatable']);
				foreach($_POST as $key => $value){
					if (preg_match('/\d{2}\.\d{2}\.\d{4}\s\d{2}\:\d{2}/', $value) || preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $value)) {
						 $_POST[$key] = date('Y-m-d H:i:s', strtotime($value));
					}
				}
            $this->introDataTable($this->request->tbl, $_POST);
        }
        if ($this->request->savedatatable) {
            unset($_POST['savedatatable']);
				foreach($_POST as $key => $value){
					if (preg_match('/\d{2}\.\d{2}\.\d{4}\s\d{2}\:\d{2}/', $value) || preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $value)) {
						 $_POST[$key] = date('Y-m-d H:i:s', strtotime($value));
					}
				}
            $this->updateDataTable($this->request->tbl, $_POST, 'id = :id', array('id' => $this->request->editid));
        }


        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_datatable_action', CNTRL_DIR_TPL);

        $actionBotton = 'adddatatable';


        if ($this->request->editid) {
            $dataTableSql = $this->model->rowSelectWhere($this->request->tbl, 'id = ?', array($this->request->editid));
            $actionBotton = 'savedatatable';
        }


        $selectFieldTable = $this->model->allSelectWhere('fmw_control_fields', 'field_table =? ORDER BY field_order ASC', array($this->request->tbl));
        $nameTable = $this->model->rowSelectFieldWhere('t_title', 'fmw_control_table', 't_name = ? ', array($this->request->tbl));
        $namePage = $nameTable['t_title'];
        $this->view->setTitle($namePage." | Onero Technology ");
        $structurePage = array();

        foreach ($selectFieldTable as $value) {
            $required = '';
            $typeEditor = '';
            $checked = '';
            $radio = '';
            if ($value[field_valid] == '1') {
                $required = 'required';
            }
            if ($value[field_type_edit] != '') {
                $typeEditor = $value[field_type_edit];
            }
            
            if ($value[field_default] == 'on'  && $dataTableSql[$value[field_name]] == '' ) {
                $checked = 'checked';
            }
            
            if ($dataTableSql[$value[field_name]] == 'on' ) {
                $checked = 'checked';
            }

            if ($value[field_type] == 'text') {
                $js = '';
                if($value[field_for_alias] != '' && $dataTableSql[$value[field_name]] == '' ){
                    $js = 'onkeyup="translit(this, '.$value[field_for_alias].')"';
                }
                $structurePage[] = '
                <div class="form-group">
                    <label for="input_' . $value[field_name] . '">' . $value[field_title] . '</label>
                    <input '.$js.' type="text" name="' . $value[field_name] . '" class="form-control" id="input_' . $value[field_name] . '" placeholder="' . $value[field_title] . '" ' . $required . ' value="' . $dataTableSql[$value[field_name]] . '">
                </div>
                ';
            }
            if ($value[field_type] == 'textarea') {
                $structurePage[] = '
                <div class="form-group">
                    <label>' . $value[field_title] . '</label>
                    <textarea class="form-control ' . $typeEditor . '" rows="3" id="textarea_' . $value[field_name] . '" name="' . $value[field_name] . '" placeholder="' . $value[field_title] . '" ' . $required . '>' . $dataTableSql[$value[field_name]] . '</textarea> 
                </div>
               ';
            }
            if ($value[field_type] == 'checkbox') {
                $hiddCheckbox = '';
                $hiddCheckbox =  '<input ' . $checked . ' type="hidden" id="checkbox_' . $value[field_name] . '" class="form-control"    name="' . $value[field_name] . '" value="0">';
                $structurePage[] = '
                <div class="form-group" >
                    '.$hiddCheckbox.'
                  <input '. $checked . ' type="checkbox" id="checkbox_' . $value[field_name] . '" class="form-control"    name="' . $value[field_name] . '" value="on">
                   <label  for="checkbox_' . $value[field_name] . '">' . $value[field_title] . '</label>
                </div>
               ';
            }
            if ($value[field_type] == 'select') {
                $selectArr = explode(',', $value[field_default]);
                
                foreach ($selectArr as $valueSelect) {
                   $select = '';
                   if($dataTableSql[$value[field_name]] == $valueSelect){$select = 'selected';}
                   $optionSelect .=  '<option '.$select.' value="'.$valueSelect.'">'.$valueSelect.'</option>';
                }
                
                $structurePage[] = '
                <label for="select_' . $value[field_name] . '">' . $value[field_title] . '</label>
                        <select class="form-control" name="' . $value[field_name] . '" id="select_' . $value[field_name] . '">
							<option value=""></option>
                            ' . $optionSelect . '
                 </select>
                ';
            }
            if ($value[field_type] == 'date') {
                $structurePage[] = '
                <div class="form-group">
                    <label for="date_' . $value[field_name] . '">' . $value[field_title] . '</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right calendar_' . $value[field_default] . '" id="date_' . $value[field_name] . '" name="' . $value[field_name] . '" value="' . $dataTableSql[$value[field_name]] . '"/>
                    </div>
                </div>
               ';
            }
            if ($value[field_type] == 'file') {
                   $delImg = '';
                if ($dataTableSql[$value[field_name]] != '') {
                    $delImg = ' <button type="button" class="close delImgFinder"  aria-hidden="true">×</button>';
                    $dataTableImg = '<img id="img" src="' . $dataTableSql[$value[field_name]] . '">
                    <input name="' . $value[field_name] . '" type="hidden" class = "hidSrc" value="' . $dataTableSql[$value[field_name]] . '">';
                } else {
                    $dataTableImg = '<div id="clickHere">'.$this->view->getLang(CTRL_CLICK_UPD_PHOTO).'</div>';
                }

                $structurePage[] = '
                <div class="form-group">
                    <label for="file_' . $value[field_name] . '">' . $value[field_title] . '</label>
                    <div class="input-group">
                       <div id="' . $value[field_name] . '" class="imgFinder" onclick="openKCFinder(this)">' . $dataTableImg . '</div>
                    '.$delImg .'
                    </div>
                </div>
               ';
            }

            if ($value[field_type] == 'link') {
                $fieldLink = '';
                $valField = $value[field_link_field];
                if ($valField != "id") {
                    $fieldLink = ',' . $valField;
                }
                $link = $this->model->allSelectField('id ' . $fieldLink . '', $value[field_link_table]);



				if(!empty($link)){		
					$optionList = '';
					foreach ($link as $valueLink) {
						$select = '';
						if ($valueLink[id] == $dataTableSql[$value[field_name]]) {
							$select = 'selected';
						}
						$optionList .= "<option $select value='$valueLink[id]'>$valueLink[$valField]</option>";
					}
				}
                $structurePage[] = '
                    <div class="form-group" >
                        <label for="linkselect_' . $value[field_name] . '">' . $value[field_title] . '</label>
                        <select class="form-control" name="' . $value[field_name] . '" id="linkselect_' . $value[field_name] . '">
							<option value=""></option>
                            ' . $optionList . '
                        </select>
                    </div>
                   ';
            }
        }

        $this->view->setTemplateVar('namePage', $namePage);
        $this->view->setTemplateVar('actionBotton', $actionBotton);
        $this->view->setTemplateVar('structurePage', $structurePage);
    }

    function introDataTable($table, $data) {
        $this->model->insert($table, $data);
    }

    function updateDataTable($table, $data, $where, $dataWhere) {
        $this->model->updateArr($table, $data, $where, $dataWhere);
    }
    
}
