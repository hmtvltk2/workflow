<?php

namespace app\modules\contrib\workflow;

class Transition extends \Yii\base\Component
{
    public $to;
    public $trigger;
    public $conditions = [];

    public function __construct($to, $trigger, $conditions)
    {
        $this->to  = $to;
        $this->trigger = $trigger;
        $this->conditions = $conditions;

        $this->on($this->trigger, 'handleTrigger');
    }

    private function handleTrigger()
    {
        if ($this->checkConditions()) {
            $event = new ChangeActivityEvent();
            $event->activityName = $this->to;
            $this->trigger(Workflow::CHANGE_ACTIVITY, $event);
        }
    }

    private function checkConditions()
    {
        foreach ($this->conditions as $condition) {
            if (!call_user_func($condition)) {
                return false;
            }
        }

        return true;
    }
}
