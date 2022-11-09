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

    public function parse_html() {
        preg_match_all('|<[^>]+>(.*)</[^>]+>|U', $this->html, $match);
        var_dump($match[0]);
        while ($match[0] != NULL) {
            preg_match_all('|<[^>]+>(.*)</[^>]+>|U', $match, $match);
            var_dump($match[0]);
        }
    }

    public function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
}
?>