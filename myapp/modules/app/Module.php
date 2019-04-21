<?php
namespace app\modules\app;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->modules = [
            //TODO: Rename module name
            'example' => 'app\modules\app\example\Module'
            
        ];
    }
}