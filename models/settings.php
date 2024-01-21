<?php 
// create a class that uses the settings.json file to get data
// // {
//     "name": "test_module",
//     "version": "0.1",
//     "depends": ["base"],
//     "author": "test",
//     "description": "",
//     "website": "http://www.yourcompany.com",
//     "category": "Uncategorized",
//     "init_xml": [],
//     "demo_xml": [],
//     "update_xml": ["test_module.xml"],
//     "active": false,
//     "installed": true,
//     "Logo": "test_module.png"
// }
Class Settings {
    public $settings;
    public function __construct() {
        $this->settings = json_decode(file_get_contents('../settings.json'), true);
    }
    public function get($key) {
        return $this->settings[$key];
    }
    public function set($key, $value) {
        $this->settings[$key] = $value;
        file_put_contents('../settings.json', json_encode($this->settings));
    }
    public function getLogo() {
        return $this->get('Logo');
    }
}


?>