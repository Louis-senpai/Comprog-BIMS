<?php 
require_once '../vendor/autoload.php';
Class officers extends MysqliDb{



    protected $tablename = 'officers';

    public function __construct($conn) {
        parent::__construct($conn);
        
    }

    // get all officers
    public function getAllOfficers()
    {
        $result = $this->get($this->tablename);
        return $result;
    }
    // delete officer
    public function deleteOfficer($id)
    {
        $result = $this->delete($this->tablename, array('id' => $id));
        return $result;
    }



}
?>