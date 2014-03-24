<?php

class SiteController extends Controller
{
    public $layout = '';//"application.modules.main.views.layouts.frame_without_leftnav";

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        //var_dump("asfd");exit;
        $userInfo = Login::getLoginInfo();
        $roleInfo = Role::model()->find('rid=:id',array(':id'=>$userInfo['rid']));
        $params = Yii::app()->getParams();
        $rid = $params['rid'];
        if ($roleInfo['rid'] == $rid['admin']) //如果是管理员
        {
            $this->redirect('/main/user/list');
        }
        elseif ($roleInfo['rid'] == $rid['normaluser'])   //普通登录用户
        {
            $this->redirect('/stock/whole');  
        }
        elseif ($roleInfo['rid'] == $rid['visitor'])   //游客
        {
            $this->redirect('/stock/whole');
        } else {
            $this->redirect('/stock/whole');
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

	public function actionVideo()
	{
		$this->render("video");
	}

}
