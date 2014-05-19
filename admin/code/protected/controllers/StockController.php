<?php

class StockController extends BackController
{
	public function actionWhole()
	{
		$i=0;
		$params = array();
		$params['ids'] = '';
		$params['ex_ids'] = array(); 
		$params['price_details'] = array(); 
		/*
		if(!empty($_REQUEST['ids'])) {
			$ids = trim($_REQUEST['ids'],',');
			$ids = explode(",",$ids);
			setcookie("stock_user_query", $_REQUEST['ids'], time()+3600*24*365);
		} else {
			*/
		if($this->userid==Yii::app()->params['visitor_id']) {
			// 游客
			$ids = isset($_COOKIE["stock_user_query"]) ? $_COOKIE["stock_user_query"] : '';
			$ids = trim($ids,',');
			$ids = explode(",",$ids);
		} else {
			$usestocks = UserStocks::model()->findAll("uid=:id",array(":id"=>$this->userid));
			if(!empty($usestocks)) {
				$ids = explode(",",$usestocks[0]['stocks']);
				setcookie("stock_user_query", $usestocks[0]['stocks'], time()+3600*24*365);
			}
		}
		if(!empty($ids)&&!empty($ids[0])) {
			foreach($ids as $v) {
				if(!empty($v)) {
					$idret[] = trim($v);
				}
			}
			$params['ex_ids'] = $idret;
			$stock = new SinaStock;
			$params['price_details'] = $stock->getRealPriceDetail($idret);
			$idkeys = array_keys($params['price_details']);
			$params['ids'] = implode(",", $idkeys);
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


