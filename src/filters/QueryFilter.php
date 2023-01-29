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

    abstract protected function getCallbacks();

    public function apply(ActiveQuery $q){
        foreach ($this->getCallbacks() as $name => $callback){
            if(isset($this->params[$name])){

               return call_user_func_array($callback,[$q, $this->params[$name]]);
            }
        }
    }

}
