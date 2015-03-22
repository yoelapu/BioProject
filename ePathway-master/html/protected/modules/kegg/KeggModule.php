<?php

class KeggModule extends CWebModule {
    
    public function init()
    {
        $this->setImport(array(
                'kegg.models.*',
                'kegg.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            return true;
        }
        else
            return false;
    }
}

?>
