<?php

namespace App\Traits\ActivityLog;

use App\Activity;

trait ActivityLogTrait{

	protected static function bootActivityLogTrait(){
		
		if(auth()->guest()) return;

		foreach (static::recordEvents() as $event) {
			static::$event(function($model) use ($event){
				$model->recordActivity($event);
			});
		}
	}

	public function activityLogs(){

		return $this->morphMany(Activity::class,'subject','subject','subject_id');

	}

	protected function recordActivity($event){
		$this->activityLogs()->create([
			'type'	=> $this->getActivityType($event),
			'user_id'	=> auth()->id()

		]);

	}	

	protected static function recordEvents(){

		return ['created', 'deleted', 'updated'];

	}

	public function getActivityType($event){
		return $event.'_'.strtolower( (new \ReflectionClass($this))->getShortName());
	}

}