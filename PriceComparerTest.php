<?php 
namespace tests;

require 'vendor/autoload.php';

require 'yii2-app-basic/vendor/autoload.php';
//require 'yii2-app-basic/vendor/yiisoft/yii2/Yii.php';

require 'PriceComparer.php';


/**
 * проверочный класс для PriceComparer 
 * */
class PriceComparerTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * забыли указать dt 
	 * */
	public function testRequireParamDt()
	{
		$this->expectException(\yii\base\InvalidParamException::class);
		$v=new PriceComparer(['t0'=>3]);
	}

	/**
	 * забыли указать t0 
	 * */
	public function testRequireParamT0()
	{
		$this->expectException(\yii\base\InvalidParamException::class);
		$v=new PriceComparer(['dt'=>3]);	
	}

	/**
	 * задали t0 значение 0 
	 * */
	public function testSetT0ToZero()
	{
		$this->expectException(\yii\base\InvalidParamException::class);
		$v=new PriceComparer(['dt'=>3,'t0'=>0]);
	}

	/**
	 * проверка сравнения .. 
	 * @dataProvider diffTestorDataProvider
	 * */
	public function testDiff($dt,$t0,$t1,$diff,$am)
	{
		$v=new PriceComparer(['dt'=>$dt,'t0'=>$t0,'t1'=>$t1]);
		$this->assertEquals($diff,$v->diff());
		$this->assertEquals($am,$v->amount);


	}

	/**
	 * провайдер данных 
	 * */
	public function diffTestorDataProvider()
	{
		return [
				// dt,t0,t1,diff,amount
			[4,99,96,true,3.125],
			[4,49,96,false,48.958],
			[40,149,96,false,55.208],
			[40,149,140,true,6.429],
		];
	}
}