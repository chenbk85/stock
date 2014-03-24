<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	public $weeks = array(1=>'星期一',2=>'星期二',3=>'星期三',
				4=>'星期四',5=>'星期五',6=>'星期六',7=>'星期日');
				
    public $layout='//layouts/column1';

    public $userid=0;
	public $userInfo = array();
	
    // 页面title
    public $actionName=0;



}
