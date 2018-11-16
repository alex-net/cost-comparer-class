<?php 
namespace app\components;

use yii\base\InvalidParamException;
/*
* Class PriceComparer = позволяет контролировать отклонение текущей цены t0 от предыдущей t1. 
* @package app\components\PriceComparer 
*
*  @property $dt int = допустимое отклонение цены 
*  @property $t0 int = текущая цена 
*  @property $t1 int = предыдущая цена
*  @property $dtres int = отклонение цены $t0 от цены $t1
*/
class PriceComparer extends \yii\base\BaseObject 
{
	/* 
	* допустимое отклонение 
	* @var int
	*/
	public $dt;
	/* 
	* текущая цена 
	* @var int
	*/
	public $t0;
	/* 
	* предыдущая цена 
	*  @var int
	*/
	public $t1;
	/* 
	* вычисленное отклонение = результат 
	* @var int
	*/
	private $_dtres;
		
	public function init() 
	{
		parent::init();
		if (!isset($this->dt))
			throw new InvalidParamException('Пропущен обязательный параметр dt');
		if (!isset($this->t0))
			throw new InvalidParamException('Пропущен обязательный параметр t0');
		if (empty$this->t0))
			throw new InvalidParamException('цена t0 не может быть равна 0');
				
		if (!isset($this->t1))
			$this->t1=$this->t0;
	}
	/* рассчитывает отклонение ... между ценами t1 и t0 и возвращает true, если рассчётное отклонение не превышает допустимое   */
	public function diff ()
	{
		if (empty($this->t0))
			throw new InvalidParamException('Неверная цена ');
		// вычислям отклонение ... 
		$this->_dtres= abs($this->t0-$this->t1)/$this->t1*100;
		return $this->_dtres<$this->dt;
	}
	/* возвращаем результат вычислений .. */
	public function getAmount ()
	{
		return $this->_dtres;
	}
	/* забрасываем новую текущую цену ..  с перестановкой цен */
	public function setCurrentPrice($t0)
	{
		if (empty($t0))
			throw new InvalidParamException('Неверная цена ');
		$this->t1=$this->t0;
		$this->t0=$t0;
	}
}
?>
