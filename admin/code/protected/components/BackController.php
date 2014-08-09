<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BackController extends Controller
{

				
    public $layout = 'application.modules.main.views.layouts.metronic';//"application.modules.main.views.layouts.frame_without_leftnav";

    public $islogin=0;
    public $userid=0;
    public $visitorrid=0;
	public $userInfo = array();
    public $requesturl = '';
	
    // 页面title
    public $actionName=0;

    protected function jsonOut($code,$msg,$data=array())
    {
        echo json_encode(array(
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ));
        exit;
    }


    protected function beforeAction($action)
    {
    	//header("Cache-Control: no-cache, must-revalidate");
    	date_default_timezone_set('PRC');	
    	//return true;
        // 登陆
        preg_match("/(^.*?)\?|(^.*)/",$_SERVER['REQUEST_URI'],$matchs);
        //var_dump($matchs);exit;
        $requestUrl = empty($matchs[1]) ? $matchs[2] : $matchs[1];
        
        //echo $requestUrl;exit;
        // 页面title
        $actionInfo = Action::model()->find("route=:route",array(':route'=>$requestUrl));
        //var_dump($actionInfo);exit;
        if (!empty($actionInfo))
        {
        	$this->actionName = $actionInfo['aname'];
        }
        
        //var_dump($_SERVER['REQUEST_URI']);exit;

        $closeUser = Yii::app()->params['close_user'];

        // 登陆限制
        if( $closeUser || (
            preg_match('|^/main/user/logout|',$_SERVER['REQUEST_URI']) 
            || preg_match('|^/main/user/resetpwdemail|',$_SERVER['REQUEST_URI']) 
            || preg_match('|^/main/user/resetpwd|',$_SERVER['REQUEST_URI']) 
            || preg_match('|^/main/user/login|',$_SERVER['REQUEST_URI']) 
            || preg_match('|^/main/user/register|',$_SERVER['REQUEST_URI'])
            || preg_match('|^/site/index|',$_SERVER['REQUEST_URI']) 
            || $requestUrl=='/site/error'
            || $requestUrl=='/'
            //|| $requestUrl=='/main/user/initsystem'
        )) 
        {
            return true;
        }

         // get user info
        $userInfo = Login::getLoginInfo();
        //var_dump($userInfo);exit;
        $url = urlencode($_SERVER['REQUEST_URI']);
        //var_dump($url);exit;
        //if(empty($userInfo)) $this->redirect('/main/user/login?url='.$url);
        if(empty($userInfo)) {
            // 游客登录
            $visitorId = Yii::app()->params['visitor_id'];
            Login::logins("股民",Login::pwdEncry("12345"));
            $this->userid=$visitorId;
            $userInfo = User::model()->getUserWithRole("uid=:id",array(':id'=>$visitorId));
            $userInfo = $userInfo[0];
            $this->userInfo = $userInfo;      
        }

        $this->islogin = $userInfo['uid'] != Yii::app()->params['visitor_id'];
        $this->visitorrid = $userInfo['rid'];
        $this->userid = $userInfo['uid'];
        $this->userInfo = $userInfo;   
        $this->requesturl=$_SERVER['REQUEST_URI'];

        // 权限限制
        if(!Privilege::hasPrivilege($userInfo['uid'],$requestUrl))
        {
            return false;
        }

        return true;
    }

}
