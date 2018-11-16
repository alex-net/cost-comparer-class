<?php 
namespace app\components;

use yii\base\InvalidParamException;
/*
класс позволяет контролировать отклонение текущей цены t0 от предыдущей t1. 
*/
class PriceComparer extends \yii\base\BaseObject 
{
	/* допустимое отклонение */
	public $dt;
	/* текущая цена*/
	public $t0;
	/* предыдущая цена */
	public $t1;
	/* вычисленное отклонение = результат */
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
