<?php

final class Util
{


	public static function validateMobile($mobile)
	{
		return preg_match("#^1[358]\d{9}$#", $mobile);
	}

	/**
	 * 把数字索引的二维数组结果集，转换为以某个字段为索引的数组
	 *
	 * @param array     $arrData    
	 * @param string    $strKey     字段名
	 *
	 * @return array
	 */
	public static function toKeyIndexed($arrData, $strKey)
	{
		if (!is_array($arrData)) {
			return array();
		}

		$arrRet = array();

		foreach ($arrData as $val) {

			if ($val instanceof CActiveRecord) {

				try {
					$key = $val->$strKey;
					$arrRet[$key] = ($val->getAttributes());
				} catch (Exception $e) {}

			} else if (isset($val[$strKey])) {

				$key = $val[$strKey];
				$arrRet[$key] = $val;
			}
		}

		return $arrRet;
	}

	/**
	 * 返回二维数组或对象中某个key的所有值
	 * @param  array  $objs
	 * @param  string $id
	 * @return array
	 */
	public static function objs2ids(array $objs, $id)
	{
		$arrIds = array();

		foreach($objs as $obj) {
			if ($obj instanceof CActiveRecord) {
				$arrIds[] = $obj->$id;
			} else if (is_array($obj)) {
				$arrIds[] = $obj[$id];
			}
		}

		return $arrIds;
	}

	public static function models2Arr(array $models)
	{
		$arrResult = array();

		foreach ($models as $model) {
			if ($model instanceof CActiveRecord) {
				
				$arrTmp = $model->getAttributes();
				$arrResult[] = array_filter($arrTmp, function($field){
				    return $field !== null;
				});

			} else {
				return $models;
			}
		}

		return $arrResult;
	}


	public static function criteria2Sql(CDbCriteria $criteria, $tableName)
	{
		$strSql = sprintf("SELECT %s FROM %s %s WHERE %s",
				$criteria->select,
				$tableName.' '.$criteria->alias,
				$criteria->join,
				$criteria->condition
			);
		
		if ($criteria->order) {
			$strSql .= " ORDER BY {$criteria->order}";
		}
		
		if ($criteria->limit >= 0 && $criteria->offset >= 0) {
			$strSql .= " LIMIT {$criteria->offset}, {$criteria->limit}";
		}

		return $strSql;
	}

	// 将数组中某一列进行implode
	static public function implodeByColumn($glue,$colname,$data)
	{
		$str = '';
		foreach ($data as $v) {
			if(!isset($v[$colname])) continue;
			$str .= $glue.$v[$colname];
		}
		return ltrim($str,$glue);
	}
}
