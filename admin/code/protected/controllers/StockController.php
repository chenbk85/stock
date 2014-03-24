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
		if(!empty($_REQUEST['ids'])) {
			$ids = trim($_REQUEST['ids'],',');
			$ids = explode(",",$ids);
			setcookie("stock_user_query", $_REQUEST['ids'], time()+3600*24*365);
		} else {
			$ids = isset($_COOKIE["stock_user_query"]) ? $_COOKIE["stock_user_query"] : '';
			$ids = trim($ids,',');
			$ids = explode(",",$ids);
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
}


