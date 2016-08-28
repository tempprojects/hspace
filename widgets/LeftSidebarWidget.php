<?php 
namespace app\widgets;
use  yii\base\Widget;


class LeftSidebarWidget extends Widget{
    public function init()
    {
        parent::init();
    }
    public function run()
    {
        return $this->render('leftsidebar');
    }
}