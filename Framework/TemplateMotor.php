<?php
namespace Framework;
include("../Config/config.php");

class TemplateMotor {

    public array $mappingViews;

    public function __construct(array $mappingViews)
    {
        $this->mappingViews = $mappingViews;
    }

    public function HTMLrendering($result) {
        /* Checking if the view name exists in the views mapping array. 
        * If it does, it gets the html name from the views mapping, 
        * gets the html string from the html file, 
        * replaces the %APP_NAME% with the string "test" and then echoes the html in order to display it. 
        */
        if( array_key_exists($result->getName(), $this->mappingViews) ) {
            $name = $this->mappingViews[$result->getName()];

            //APP_NAME manager
            $htmlName = $name['html'];
            $template = file_get_contents("../template.html");

            //A modifier pour un truc générique
            //$html = str_replace("%APPNAME%", APPNAME, $template);
            $html = $this->replaceConstantReference($template);
            $css = "";

            // if css scripts exist, include it
            if( !empty( $name['css'] ) ) {
                $cssArray = $name['css'];
                
                foreach($cssArray as $cssName){
                    $css .= '<link rel="stylesheet" href="./style/css/'.$cssName.'">';
                }
            }
            $html = str_replace("%CSS%", $css, $html); 
            
            $headjs = "";
            // if head js scripts exist, include it
            if( !empty( $name['js']['headjs'] ) ) {
                $jsArray = $name['js']['headjs'];
                
                foreach($jsArray as $jsName) {
                    $headjs .= '<script type="text/javascript" src="./scripts/'.$jsName.'"></script>';
                }
            }
            $html = str_replace("%HEADJS%", $headjs, $html); 
            
            //APP
            $content = file_get_contents("../Views/".$htmlName);
            $values = $result->getValues();
            $content = $this->replaceConstantReference($content);
            $content = $this->replaceAbstractTag($content,$result,$values);
            $content = $this->replaceAbstractReference($content,$result,$values);
            

            $html = str_replace("%DATA%", $content, $html);

            $bottomjs = "";
            // if bottom js scripts exist, include it
            if( !empty( $name['js']['bottomjs'] ) ) {
                $jsArray = $name['js']['bottomjs'];
                
                foreach($jsArray as $jsName) {
                    $bottomjs .= '<script type="text/javascript" src="./scripts/'.$jsName.'"></script>';
                }
            }
            $html = str_replace("%BOTTOMJS%", $bottomjs, $html);

            return $html;
        }
    }

    protected function replaceConstantReference(string $content) {
        $constants = get_defined_constants(true);
        
        foreach($constants["user"] as $key => $value) {
            $content = str_replace("%".$key."%", $value, $content);
        }
        return $content;
    }

    protected function replaceAbstractReference(string $content, $result, $values){
        preg_match_all('/%(.*?)%/s', $content, $match);

        foreach($match[1] as $value) {
            if(!empty($values[$value])){
                $content = str_replace('%'.$value.'%', $values[$value], $content);
            }else{
                $content = str_replace('%'.$value.'%', "NOT_FOUND", $content);
            }
        }
        return $content;
    }

    protected function replaceAbstractTag(string $content, $result, $values) {
        preg_match('/<sinj-for source="(.*?)" element="(.*?)">(.*?)<\/sinj-for>/s', $content, $match);
        $source = $match[1];
        $element = $match[2];
        $data = $match[3];

        $test = "";
        foreach($values[$source] as $value) {
            $test = $test.str_replace('%'.$element.'%', $value, $data);
        }
        $content = str_replace($match[0], $test, $content);
        return $content;
    }

    


}
?>