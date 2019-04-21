<?php

namespace app\modules\contrib\workflow;

class Workflow
{
    public $currentActivity;
    public $activities = [];

    public function __construct()
    {
        $this->on(self::CHANGE_ACTIVITY, 'changeActivity');
    }

    public function loadWorkflow($config)
    { }

    public function update()
    {
        $next = $this->currentActivity->next();
        if ($next == null) return;

        foreach ($this->activities as $activity) {
            if ($activity->code == $next) {
                $this->currentActivity = $activity;
                return;
            }
        }
    }
}
