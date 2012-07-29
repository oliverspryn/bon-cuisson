package com.forwardfour.events {
	import flash.events.Event;
	
	public class ComponentStateEvent extends Event {
	//The constructor must call the super constructor
		public function ComponentStateEvent(type:String, bubbles:Boolean = false, cancelable:Boolean = false) {
			super(type, bubbles, cancelable);
		}
		
	//A clone() method is required for all custom event classes
		public override function clone():Event {
			return new ComponentStateEvent(type, bubbles, cancelable);
		}
		
	//A toString() method is also requried for all custom event classes
		public override function toString():String {
			return super.formatToString("ComponentStateEvent", "type", "bubbles", "cancelable", "eventPhase");
		}
	}
}