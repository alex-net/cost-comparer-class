<?php
namespace tests;
require 'yii2-app-basic/vendor/autoload.php';
require  'yii2-app-basic/vendor/yiisoft/yii2/Yii.php';

use yii\base\InvalidParamException;
/**
 * Class PriceComparer = позволяет контролировать отклонение текущей цены t0 от предыдущей t1.  
 * 
 * @package tests\PriceComparer  
 * 
 * @property $dt int = допустимое отклонение цены 
 * @property $t0 int = текущая цена 
 * @property $t1 int = предыдущая цена
 * @property $dtres int = отклонение цены $t0 от цены $t1
 * 
 * @method float getAmount() = возвращает рассчётное отклонение 
 * @method void setCurrentPrice(int) задаёт значение для $t0 со сдвигом $t0 в $t1
 * */


class PriceComparer extends \yii\base\BaseObject 
{
	/**
	 *	@var int  $dt допустимое отклонение 
	 * */
	public $dt;
	/**
	 *  @var int $t0 текущая цена
	 * */
	public $t0;
	/**
	 *  @var int $t1 предыдущая цена
	 * */
	public $t1;
	/** 
	 * @var int $_dtres вычисленное отклонение = результат 
	 * @access private
	 * */
	private $_dtres;
		
	public function init() 
	{
		parent::init();
		if (!isset($this->dt))
			throw new InvalidParamException('Пропущен обязательный параметр dt');
		if (!isset($this->t0))
			throw new InvalidParamException('Пропущен обязательный параметр t0');
		if (empty($this->t0))
			throw new InvalidParamException('цена t0 не может быть равна 0');
				
		if (!isset($this->t1))
			$this->t1=$this->t0;
	}
	/**
	 * рассчитывает отклонение ... между ценами t1 и t0 
	 * 
	 * @return boolean true, если рассчётное отклонение не превышает допустимое
	 * */
	public function diff ()
	{
		if (empty($this->t0))
			throw new InvalidParamException('Неверная цена ');
		// вычислям отклонение ... 
		$this->_dtres= abs($this->t0-$this->t1)/$this->t1*100;
		return $this->_dtres<$this->dt;
	}
	/**
	 * возвращаем результат вычислений
	 * 
	 * @return float расчётное отклонение 
	 * */ 
	public function getAmount ()
	{
		return round($this->_dtres,3);
	}
	/**
	 * Обновляет текущую цену со сдвигом цен 
	 * 
	 * Текущая цена становится на место предыдущей, а новое значение становится текущей ценой
	 * 
	 * @param int ноая цена .. 
	 * @return void
	 * */
	public function setCurrentPrice($t0)
	{
		if (empty($t0))
			throw new InvalidParamException('Неверная цена ');
		$this->t1=$this->t0;
		$this->t0=$t0;
	}
}
?>
