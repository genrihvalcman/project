<?php

class UPDFile {

    function uploadFile($felisname = 'myfile', $path = DIR_USER_FILE_R,  $types = '', $prefix = '', $maxsize = '') {
        $output_dir = $path;
        if (isset($_FILES[$felisname])) {
            $ret = '';
            $err = array();

            if ($_FILES[$felisname]["error"] == 0) {
                $ext = substr($_FILES[$felisname]['name'], 1 + strrpos($_FILES[$felisname]['name'], "."));
                $info = pathinfo($_FILES[$felisname]['name']); 
                $filename = basename($_FILES[$felisname]['name'],'.'.$info['extension']);
                if ($maxsize !== '' && $_FILES[$felisname]["size"] > $maxsize) {
                    $err['errsize'] = '1';
                }
                if ($types !== '' && !in_array($ext, $types)) {
                    $err['errtypes'] = '1';
                }
                if (empty($err)) {
                    if (!is_array($filename)) {
                        if($prefix !== ''){
                           $filename = $prefix.$filename;
                        }
                        $fileName = $filename.'.'.$ext;
                        move_uploaded_file($_FILES[$felisname]["tmp_name"], $output_dir . $fileName);
                        $ret = $fileName;
                    } else {  //Multiple files
                        $fileCount = count($filename);
                        for ($i = 0; $i < $fileCount; $i++) {
                            $fileName = $filename[$i];
                            move_uploaded_file($_FILES[$felisname]["tmp_name"][$i], $output_dir . $fileName);
                            $ret = $fileName;
                        }
                    }
                    return $ret;
                }else{
                    return 'ошибка типа или размера';
                }
            }else{
                return 'ошибка загрузки';
            }
        }
    }

}
