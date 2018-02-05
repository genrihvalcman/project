<?php

class Table_Control extends ControlController {

    function __construct() {
        parent::__construct();
        $this->authUser();
        
    }

    function action_index() {
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_table', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_LIST_TABLE).' | Onero Technology');
        if ($this->request->save_table) {
            foreach ($this->request->t_name as $key => $value) {

                if ($value != '') {
                    if ($this->request->t_active[$key] == 'on') {
                        $t_active = 1;
                    } else {
                        $t_active = 0;
                    }
                    if ($this->request->t_show[$key] == 'on') {
                        $t_show = 1;
                    } else {
                        $t_show = 0;
                    }
                    $dataUpdate = array($key, $value, $t_active, $t_show, $this->request->t_icon[$key], $key);
                    $dataIsert = array('t_name' => $key, 't_title' => $value, 't_active' => $t_active, 't_show' => $t_show, 't_icon' => $this->request->t_icon[$key]);

                    $checkTable = $this->model->rowSelectWhere('fmw_control_table', 't_name = ?', array($key));

                    if ($checkTable != '') {
                        $this->model->updateData('fmw_control_table', 't_name = ?, t_title = ?, t_active = ?,  t_show = ?, t_icon = ?', 't_name = ?', $dataUpdate);
                    } else {
                        $this->model->insert('fmw_control_table', $dataIsert);
                    }
                }
            }
        }
        if ($this->request->save_table_setting) {
          $t_table_link = '';
          $t_lang_link = '';
          
          if($this->request->t_table_link){
           $t_table_link = implode(',', $this->request->t_table_link);   
          }
          
          if($this->request->t_lang_link){
           $t_lang_link = implode(',', $this->request->t_lang_link);   
          }
          
         $this->model->updateData('fmw_control_table', 't_table_link = ?, t_lang_link = ?, t_controller = ?, t_action = ?', 't_name = ?', array($t_table_link, $t_lang_link, $this->request->nameController, $this->request->nameAction, $this->request->nametable));
        }

        $allTable = $this->model->select('show tables');

        $tablesArray = array();
        $dataTableArray = array();

        foreach ($allTable as $table) {
            foreach ($table as $value) {
                $tablesArray[] = $value;
            }
        }

        foreach ($tablesArray as $value) {
            $dataTableControl = $this->model->allSelectWhere('fmw_control_table', 't_name = ?', array($value));
            $dataTableArray[] = $dataTableControl;
        }

        for ($i = 0; $i < count($tablesArray); $i++) {
            $dataTable[$tablesArray[$i]] = $dataTableArray[$i];
        }

       
        $this->view->setTemplateVar('dataTable', $dataTable);
        $this->menuControl();
    }

    function action_fields() {
        $this->view->setMainTemplate('_index', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('tpl_fields', CNTRL_DIR_TPL);
        $this->view->setTitle($this->view->getLang(CTRL_SETUP_FIELD).' | Onero Technology');

        if ($this->request->save_fields) {

            foreach ($this->request->fieldName as $key => $value) {
               
                if (!empty($value)) {
                    $fieldDef = '';
                    $linkTable = '';
                    $linkField = '';
                    $fieldTypeEdit = '';
                    $fieldActive = 0;
                    $fieldIndt = 0;
                    $forAalias = $this->request->forAalias[$key];

                    $fieldTableName = $this->request->table_name;
                    $fieldName = $key;
                    $fieldTitle = $value;
                    
                    if ($this->request->fieldActive[$key] == 'on' && $this->request->fieldActive[$key] != '') {
                        $fieldActive = 1;
                    } 
                    
                    if ($this->request->fieldIndt[$key] == 'on' && $this->request->fieldIndt[$key] != '') {
                        $fieldIndt = 1;
                    }
                    
                    $fieldType = $this->request->fieldType[$key];
                    $fieldOrder = $this->request->fieldOrder[$key];


                    if ($this->request->fieldType[$key] == 'text') {
                        $fieldDef = $this->request->fieldDefText[$key];
                    }
                    
                    if ($this->request->fieldType[$key] == 'textarea') {
                        $fieldDef = $this->request->fieldDefTextarea[$key];
                        $fieldTypeEdit = $this->request->fieldTypeEdit[$key];
                    }
                    
                    
                    if ($this->request->fieldType[$key] == 'date' || $this->request->fieldType[$key] == 'datetime') {
                        $fieldDef = $this->request->fieldDataType[$key];
                    }
                    
                    if ($this->request->fieldType[$key] == 'checkbox' && $this->request->fieldCheckbox[$key] == 'on') {
                        $fieldDef = 'on';
                    }
                    
                    if ($this->request->fieldType[$key] == 'select') {
                        $fieldDef = $this->request->fieldSelect[$key];
                    }
                    
                    if ($this->request->fieldType[$key] == 'link') {
                        $fieldLink = explode('-', $this->request->fieldLink[$key]);
                        $linkTable = $fieldLink[0];
                        $linkField = $fieldLink[1];
                    }


                    if ($this->request->fieldCheckEmpty[$key] == 'on') {
                        $fieldEmpty = 1;
                    } else {
                        $fieldEmpty = 0;
                    }


                    $dataFields = array($fieldActive, $fieldIndt, $fieldTableName, $fieldName, $fieldTitle, $fieldType, $fieldDef, $linkTable, $linkField, $fieldEmpty, $fieldTypeEdit, $fieldOrder, $forAalias, $fieldTableName, $fieldName);

                    $checkFields = $this->model->rowSelectWhere('fmw_control_fields', 'field_table = ? AND field_name = ? ', array($fieldTableName, $fieldName));

                    if ($checkFields != '') {
                        $this->model->updateData('fmw_control_fields', 'field_active = ?, field_idnt = ?,  field_table = ?,  field_name = ?, field_title = ?, field_type = ?, field_default = ?, field_link_table = ?, field_link_field = ?, field_valid = ?, field_type_edit = ?,  field_order = ?, field_for_alias = ? ', 'field_table = ? AND field_name = ? ', $dataFields);
                    } else {
                        $dataFields = array('field_active' => $fieldActive, 'field_idnt' => $fieldIndt, 'field_table' => $fieldTableName, 'field_name' => $fieldName, 'field_title' => $fieldTitle, 'field_type' => $fieldType, 'field_default' => $fieldDef, 'field_link_table' => $linkTable, 'field_link_field' => $linkField, 'field_valid' => $fieldEmpty, 'field_type_edit' => $fieldTypeEdit,  'field_order' => $fieldOrder, 'field_for_alias' => $forAalias);
                        $this->model->insert('fmw_control_fields', $dataFields);
                    }
                }
            }
        }



        $listFields = $this->model->select('SHOW COLUMNS FROM ' . $this->request->table_name . '');

        $allTable = $this->model->select('show tables');
        $fieldsForTable = array();
        $table = array();
        $fieldsTable = array();

        foreach ($allTable as $key => $value) {
            foreach ($value as $val) {
                $table[] = $val;
                $fieldsForTable[] = $this->model->select('SHOW COLUMNS FROM ' . $val . '');
            }
        }

        for ($i = 0; $i < count($fieldsForTable); $i++) {
            $fieldsTable[$table[$i]] = $fieldsForTable[$i];
        }

        $activListFields = $this->model->allSelectWhere('fmw_control_fields', 'field_table = ?', array($this->request->table_name));

        $activFields = array();
        foreach ($listFields as $value) {
            if (!empty($activListFields)) {
                foreach ($activListFields as $activListValue) {
                    if ($activListValue[field_name] == $value['Field']) {
                        $activFields['field_active'] = $activListValue[field_active] = 1 ? $activFields[field_active] = 'display:block;' : $activFields[field_active] = 'display:none;';
                    }
                }
            }
        }


        $this->view->setTemplateVar('activFields', $activFields);
        $this->view->setTemplateVar('fieldsForTable', $fieldsTable);
        $this->view->setTemplateVar('listFields', $listFields);
        $this->view->setTemplateVar('activListFields', $activListFields);
    }
    
    function action_ajax() {
        $this->view->setMainTemplate('_ajax', CNTRL_DIR_TPL);
        $this->view->setInnerTemplate('_ajax', CNTRL_DIR_TPL);
        
        $datatable = $this->model->rowSelectWhere('fmw_control_table', 't_name = ?', array($this->request->nameTable));
   
        $this->view->setTemplateVar('json', $datatable);
        
        

    }

}
