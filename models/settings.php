<?php 
// create a class that uses the settings.json file to get data
// {
// 	"name": "test_module",
// 	"version": "1.0",
// 	"depends": ["base"],
// 	"author": "Comprog Students",
// 	"description": "",
// 	"website": "http://www.yourcompany.com",
// 	"category": "Uncategorized",
// 	"init_xml": [],
// 	"demo_xml": [],
// 	"update_xml": ["test_module.xml"],
// 	"active": false,
// 	"installed": true,
// 	"Logo": "974275_bc498ba337e374eea52e63853af305dd.png",

//     "smtp" : {
//         "host": "smtp.gmail.com",
//         "port": "587",
//         "user": "marianolukkanit17@gmail.com",
//         "password": "<PASSWORD>"
//     },
//     "facebookAPI": {
//         "app_id": "1234567890",
//         "app_secret": "1234567890"
//     },
//     "googleAPI": {
//         "app_id": "1234567890",
//         "app_secret": "1234567890"
//     }

// }

Class Settings {
    public $settings;
    public function __construct($jsonPath = '../settings.json') {
        if (!file_exists($jsonPath)) {
            throw new Exception("Settings file not found");
        }
        $this->settings = json_decode(file_get_contents($jsonPath), true);
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
    public function getSMTP() {
        return $this->get('smtp');
    }
    public function getFacebookAPI() {
        return $this->get('facebookAPI');
    }
    public function getGoogleAPI() {
        return $this->get('googleAPI');
    }
    public function getVersion() {
        return $this->get('version');
    }
    public function updateSMTP($host, $port, $user, $password) {
        $this->set('smtp', [
            'host' => $host,
            'port' => $port,
            'user' => $user,
            'password' => $password
        ]);
    }
    public function updateFacebookAPI($app_id, $app_secret) {
        $this->set('facebookAPI', [
            'app_id' => $app_id,
            'app_secret' => $app_secret
        ]);
    }
    public function updateGoogleAPI($app_id, $app_secret) {
        $this->set('googleAPI', [
            'app_id' => $app_id,
            'app_secret' => $app_secret
        ]);
    }
    public function updateName($name) {
        $this->set('name', $name);
    }
    public function updateWebsiteEmail($email){
        $this->set('websiteEmail', $email);

    }
    public function updateTitle($title){
        $this->set('title', $title);
    }
    public function getName(){
        return $this->get('name');
    }
    // function that will update the Construct function which will change ../settings.json to /settings.json
}


?>