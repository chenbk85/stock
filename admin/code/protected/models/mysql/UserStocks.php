<?php


class UserStocks extends MActiveRecord
{
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '`m-user-stock`';
    }
}