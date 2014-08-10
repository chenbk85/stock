<?php

class SiteController extends BackController
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->layout = '';
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
        $this->layout = '';
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
        $this->layout = '';
		$this->render("video");
	}

    // feedback index
    public function actionFeedback()
    {        
        if(!empty($_REQUEST['nickname'])&&!empty($_REQUEST['content'])&&!empty($_REQUEST['email'])) {
            $feedback = new Feedback;
            $feedback->uid     = $this->userid;
            $feedback->name    = $_REQUEST['nickname'];
            $feedback->email   = $_REQUEST['email'];
            $feedback->message = $_REQUEST['content'];
            $ret = $feedback->save();
        }
        $feeds = Feedback::model()->findAll("1=1 order by ctime desc limit 5");

        $this->render("feedback",array('feeds'=>$feeds));
    }

    // json save
    public function actionSaveFeedback()
    {
        if(empty($_REQUEST['nickname'])||empty($_REQUEST['content'])||empty($_REQUEST['email'])) {
            exit;
        }
        $feedback = new Feedback;
        $feedback->uid     = $this->userid;
        $feedback->name    = $_REQUEST['nickname'];
        $feedback->email   = $_REQUEST['email'];
        $feedback->message = $_REQUEST['content'];
        $ret = $feedback->save();
        if($ret===true) $this->jsonOut(0,"ok");
        else $this->jsonOut(1,"db error");
    }

    public function actionGetFeedback()
    {
        $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
        $num = 5;

        $start = $page*$num+1;
        $feeds = Feedback::model()->findAll("1=1 order by ctime desc limit {$start},$num");
        $ret = Util::models2Arr($feeds);
        if($ret===false) $this->jsonOut(1,"db error");
        else $this->jsonOut(0,"ok",$ret);
    }

}
