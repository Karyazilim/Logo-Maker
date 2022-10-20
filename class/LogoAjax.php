<?php 
class LogoAjax 
{
    protected $f3;
    private $status_code = 400;
    private $status_message = [];

    public function __construct()
    {
        $this->f3 = \Base::instance();
        header('Content-type:application/json;charset=utf-8');
        header('Cache-Control: no-cache');
    }
    function getfont($font) {
        if($this->f3->get("SERVER_WINDOWS")) {
            $ff = str_replace('\\\\', '\\', $this->f3->get("FOLDER_WINDOWS"))."\\".$font;
            } else {
            $ff = $this->f3->BASE."/font/".$font;
            } 
    
            return $ff;
    }
    public function result()
    {
        http_response_code($this->status_code);
        echo json_encode($this->status_message);
        exit();
    }

    public function beforeRoute()
    {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            $this->status_message = ["status" => "error", "text" => "only ajax"];
            $this->result();
        }

    }

    function preview(){

        $file = $this->f3->get("IMAGES").$this->f3->get("POST.template");
        $domain = explode(".",$this->f3->get("POST.domain"));
        $text = $this->f3->get("POST.domain");
        $text2 = $this->f3->get("POST.price") != "" ? $this->f3->get("POST.price") : false;
        $font = $this->f3->get("POST.font");
        $size = $this->f3->get("POST.size");
        $yOffset = $this->f3->get("POST.offset");
        $color = $this->f3->get("POST.color");
        $xOffset = $this->f3->get("POST.poffset");

        $anchor = "center";

        $options = [
            "fontFile" => $this->getfont($font).".ttf",
            "size" => $size,
            "color" => $color,
            "anchor" => $anchor,
            "yOffset" => $yOffset
        ];
        if($text2) {

        $options2 = [
            "fontFile" => $this->getfont("d").".ttf",
            "size" => 80,
            "color" => "#ffffff",
            "anchor" => $anchor,
            "xOffset" => $xOffset,
            "yOffset" => 117
        ];        
        }

        $image = new \SimpleImage();
        try {
                
            $image->fromFile($file);
            $image->text($text, $options);
            if($text2) {
            $image->text($text2, $options2);
            }
            $this->status_code = 200;
            $this->status_message = ["status" => "success", "basecode" => $image->toDataUri('image/jpeg')];
         

          } catch(Exception $err) {
            $this->status_message = ["status" => "error", "error" => $err->getMessage()];
          }
          $this->result(); 

        
    }
}