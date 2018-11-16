<?php 
namespace app\components;

use yii\base\InvalidParamException;

class PriceComparer extends \yii\base\BaseObject 
{
	// допустимое отклонение 
	public $dt;
	// текущая цена
	public $t0;
	// предыдущая цена 
	public $t1;
	// вычисленное отклонение = результат 
	private $_dtres;
		
	public function init() 
	{
		parent::init();
		// ругаемся на отсутствие параметра dt
		if (!isset($this->dt))
			throw new InvalidParamException('Пропущен обязательный параметр dt');
		// ругаемся на отсутствие параметра t0
		if (!isset($this->t0))
			throw new InvalidParamException('Пропущен обязательный параметр t0');
		// проверяем t0 на 0 ... 
		if (empty$this->t0))
			throw new InvalidParamException('цена t0 не может быть равна 0');
				
		if (!isset($this->t1))
			$this->t1=$this->t0;
	}
	// рассчитываем отклонение ... 
	public function diff ()
	{
		// вычислям отклонение ... 
		$this->_dtres= abs($this->t0-$this->t1)/$this->t0*100;
		return $this->_dtres<$this->dt;
	}
	// возвращаем результат вычислений .. 
	public function getAmount ()
	{
		return $this->_dtres;
	}
	// забрасываем новую текущую цену ... 
	public function setCurrent($t0)
	{
		if (empty($t0))
			throw new InvalidParamException('Неверная цена ');
		$this->t1=$this->t0;
		$this->t0=$t0;
	}
}
?>
