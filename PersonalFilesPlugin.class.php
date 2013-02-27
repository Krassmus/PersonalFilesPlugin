<?php


class PersonalFilesPlugin extends StudIPPlugin implements SystemPlugin {
    
    public function __construct() {
        parent::__construct();
        $nav = new AutoNavigation($this->getDisplayName(), PluginEngine::getURL($this, array(), "galery"));
        Navigation::addItem("/profile/personal_files", $nav);
    }
    
    public function galery_action() {
        $user_id = Request::get("username") 
            ? get_userid(Request::get("username")) 
            : $GLOBALS['user']->id;
        $template = $this->getTemplate("galery.php");
        $template->set_attribute("files", StudipDocument::findBySQL("Seminar_id = ? ORDER BY name ASC", array($user_id)));
        $template->set_attribute('assets', $this->getPluginURL()."/assets");
        echo $template->render();
    }
    
    protected function getDisplayName() {
        return _("Dateien");
    }
    
    protected function getTemplate($template_file_name, $layout = "without_infobox") {
        if (!$this->template_factory) {
            $this->template_factory = new Flexi_TemplateFactory(dirname(__file__)."/templates");
        }
        $template = $this->template_factory->open($template_file_name);
        if ($layout) {
            if (method_exists($this, "getDisplayName")) {
                PageLayout::setTitle($this->getDisplayName());
            } else {
                PageLayout::setTitle(get_class($this));
            }
            $template->set_layout($GLOBALS['template_factory']->open($layout === "without_infobox" ? 'layouts/base_without_infobox' : 'layouts/base'));
        }
        return $template;
    }
    
}