<?php

class FormatModule extends CWebModule {

    public function init()
    {
        $this->setImport(array(
            'format.models.*',
            'format.components.*',
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
