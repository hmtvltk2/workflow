<?php

namespace app\modules\contrib\workflow;

class Activity
{
    public $code;
    public $transitions = [];
    public $action;
    public $done  = false;

    public function __construct($code, $action, $transitions)
    {
        $this->code = $code;
        $this->action = $action;
        $this->transitions = $transitions;
    }

    public function next()
    {
        if ($this->done) {
            foreach ($this->transitions as $transition) {
                if (call_user_func($transition['condition'])) {
                    return $transition['to'];
                }
            }
        }
        $this->done = call_user_func($this->action);

        return null;
    }
}
