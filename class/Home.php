<?php 

class Home{
    protected $f3;
    function __construct() {
        $this->f3 = \Base::instance();
    }
    function getFonts(){
        if($this->f3->get("SERVER_WINDOWS")) {
            $folder = str_replace('\\\\', '\\', $this->f3->get("FOLDER_WINDOWS"));
            } else {
            $folder = "./".$this->f3->BASE."/font";
            } 
		

        $files = [];
        foreach (glob($folder."/*.ttf") as $filename) {
        $filename = str_replace(["$folder/",".ttf"],"",$filename);
        $files[$filename] = ucfirst($filename);
        }
        return $files;
        }
        function getBackgrounds(){
            $folder = $this->f3->get("IMAGES");
            $files = [];
            foreach (glob($folder."*.jpg") as $filename) {
            $filename = str_replace(["$folder"],"",$filename);
            $files[$filename] = ($filename);
            }
            return $files;
            }   
    function show(){
        $fonts = $this->getFonts();
        $backgrounds = $this->getBackgrounds();
        $this->f3->set("sys_fonts", $fonts);
        $this->f3->set("sys_backgrounds", $backgrounds);

        echo \Template::instance()->render('index.html');
    }
}
?>