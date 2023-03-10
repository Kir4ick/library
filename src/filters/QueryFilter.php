<?php

namespace app\src\filters;

use yii\db\ActiveQuery;

abstract class QueryFilter
{
    protected array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    abstract protected function getCallbacks():array;

    final public function apply(ActiveQuery $q):ActiveQuery
    {
        foreach ($this->getCallbacks() as $name => $callback){
            if(isset($this->params[$name])){
                call_user_func_array($callback,[$q, $this->params[$name]]);
            }
        }
        return $q;
    }

}
