<?php

class Slider_Template_Generator {

    protected $templates;
    protected $category;
    protected $template_name;
    protected $ids;
    protected $name;

    public function __construct() {
        $this->templates = 'framework/templates/slider/';
    }

    public function show_templates($start_slug = "") {
        foreach (scandir(SSA_PATH . "/templates/") as $item) {
            if (preg_match("/.php/i", $item)) {
                echo $item;
            }
        }
    }

    public function set($key, $value) {
        $this->values[$key] = $value;
    }

    public function generate_output() {
        ob_start();
        if ($this->template_name != '') {
            include(SVSS_PATH . "/templates/" . $this->template_name . ".php");
        } else {
            die("Slider Template doesnt exist");
        }
        $var = ob_get_contents();
        ob_get_clean();
        return preg_replace('/^\s+|\n|\r|\s+$/m', '', $var);
    }

    public function parseIds() {
        return explode(",", $this->ids);
    }

    function getTemplates() {
        return $this->templates;
    }

    function getCategory() {
        return $this->category;
    }

    function getTemplate_Name() {
        return $this->template_name;
    }

    function setTemplates($templates) {
        $this->templates = $templates;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setTemplate_Name($template_name) {
        $this->template_name = $template_name;
    }

    function getIds() {
        return $this->ids;
    }

    function setIds($ids) {
        $this->ids = $ids;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

}
