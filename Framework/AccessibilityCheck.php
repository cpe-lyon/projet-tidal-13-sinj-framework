<?php

namespace Framework;

class AccessibilityCheck {
    private $html;
    public array $mappingViews;

    public function __construct(array $mappingViews, $html)
    {
        $this->mappingViews = $mappingViews;
        $this->html = $html;
    }

    public function is_picture_alt_exists() {
        preg_match_all('/<img(.*?)>/s',$this->html, $match);

        for ($i=0; $i < count($match[0]); $i++) { 
            preg_match('/alt="(.*?)"/s', $match[0][$i], $alt);
            preg_match('/src="(.*?)"/s', $match[0][$i], $src);
            if(count($alt) ==0){
                $this->debug_to_console("WARNING : no alt attribute on image with src=".$src[1]);
            }
        }
    }

    public function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('" . $output . "' );</script>";
    }
}
?>