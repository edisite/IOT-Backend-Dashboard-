<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Origin
 *
 * @author edisite
 */
class Origin extends Admin_Controller {
    //put your code here
    private $mLatestSqlFile;
    private $mBackupSqlFiles;
    public function __construct() {
        parent::__construct();
        $sql_path = FCPATH;
        $files = preg_grep("/.(.csv)$/", scandir($sql_path.'dl/', SCANDIR_SORT_DESCENDING));
        $this->mBackupSqlFiles = $files;
//        $this->mLatestSqlFile = $sql_path.'/latest.sql';
       
        $this->mPageTitle = 'Utilities';
        $this->mViewData['backup_sql_files'] = $this->mBackupSqlFiles;
//        $this->mViewData['latest_sql_file'] = $this->mLatestSqlFile;
    }
    public function index() {
        $this->render('util/list_csv');
        
    }
}
