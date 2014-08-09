<?php

class StockController extends BackController
{
	// 自选股列表
	protected $selfStockIds = array();

	protected function beforeAction($action)
    {
    	if(!parent::beforeAction($action)) return false;	

    	// 获取用户自选股id列表
    	$ids = $idret = array();
		if($this->userid==Yii::app()->params['visitor_id']) {
			// 游客
			$ids = isset($_COOKIE["stock_user_query"]) ? $_COOKIE["stock_user_query"] : '';
			$ids = trim($ids,',');
			$ids = explode(",",$ids);
		} else {
			$usestocks = UserStocks::model()->findAll("uid=:id",array(":id"=>$this->userid));
			if(!empty($usestocks)) {
				$ids = explode(",",$usestocks[0]['stocks']);
				//setcookie("stock_user_query", $usestocks[0]['stocks'], time()+3600*24*365);
			} else {
				$ids = isset($_COOKIE["stock_user_query"]) ? $_COOKIE["stock_user_query"] : '';
				$ids = trim($ids,',');
				$ids = explode(",",$ids);
			}
		}
		foreach($ids as $v) {
			if(!empty($v)) {
				$idret[] = trim($v);
			}
		}
		$this->selfStockIds = $idret;
		return true;
	}

	public function actionSelfStockDetail()
	{
		$stock = new SinaStock;
		$params['price_details'] = $stock->getRealPriceDetail($this->selfStockIds);
		$this->layout="application.modules.main.views.layouts.metronic_no_frame";
		$this->render("self_stock_detail",$params);
	}

	public function actionWhole()
	{
		$i=0;
		$params = array();
		$params['ids'] = '';
		$params['ex_ids'] = array(); 
		$params['price_details'] = array(); 

		// 用户信息
		$params['price_details']['market'] = array();
		$params['price_details']['self'] = array();
		$stock = new SinaStock;
		$params['price_details']['market'] = $stock->getMarketPriceDetail();
		if(!empty($this->selfStockIds)&&!empty($this->selfStockIds[0])) {
			// 获取用户自选股信息
			$params['ex_ids'] = $this->selfStockIds;
			$params['price_details']['self'] = $stock->getRealPriceDetail($this->selfStockIds);
			$idkeys = array_keys($params['price_details']['self']);
			$params['ids'] = implode(",", $idkeys);
			// 获取大盘信息
		}
		$this->render('whole',$params);
	}

	public function actionSaveChooseStocks() 
	{
		if(!isset($_REQUEST['ids']) || !preg_match("/^(\w|,)*$/", $_REQUEST['ids'])) {
			exit("error");
		}
		$ret = UserStocks::model()->findAll("uid=:id and groupname='默认'",array(':id'=>$this->userid));
		if(empty($ret)) {
			$model = new UserStocks;
			$model->uid = $this->userid;
			$model->stocks = $_REQUEST['ids'];
			$model->groupname = '默认';
			$model->save();
		} else {
			$model = $ret[0];
			$model->stocks = $_REQUEST['ids'];
			$model->save();
		}
	}
}


