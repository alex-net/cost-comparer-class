# cost-comparer-class
По заданию надо сделать класс который будет сравнивать два числа 
( цены) и проверять на сколько текущая отличается от предыдущей .. 
для этих целей есть три входных параметра .. два числа (текущее (T0) 
и предыдущее (T1) ).. и допустимое отклонение в % для этих чисел .. 
.. я так понял раз отклонение у нас в % то речь идёт об относительном 
отклонении .. которое вычисляется как d=abs(T1-T0)/T0*100% при этом 
если у нас при подстановке T1 и T0 в формулу получилось число большее 
того, что задано во входных данных .. то функция diff должна вернуть 
false .. в противном случае .. отклонение будем меньше заданного 
и возвращается true .. 
Если учитывать что предыдущего числа может не быть то в этом случае .. 
предыдущее значение пусть даже в конструкторе или в методе init() мы 
принимаем равным текущему .. и тогда у нас метод diff . вернёт true 
... потому что отклонение между двумя одинаковыми числами равно 0 .. 
Тогда в качестве результата у нас будет рассчитанное отклонение .. 
которое можно получить из метода .. getAmount() ...

также можно дописать метод setCurrent() установки текущего значения .. 
при этом .. текущее значение будет перемещаться на место предыдущего 
. ..а в текущее будем попадать новое значение ..
