package com.forwardfour.events {
	import com.forwardfour.utils.ModuleBase;
	
	import flash.events.Event;
	
	public class TransitionEvent extends Event {
	//These attributes are the destinctive features of this class which will store custom information about the dispatched event
		public var transitionDuration:int;
		public var transitionType:String;
		public var triggeredObject:ModuleBase;
		
	//Differentate the transition types
		public static const TRANSITION_IN:String = "transitionIn";
		public static const TRANSITION_OUT:String = "transitionOut";
		
	//The constructor must call the super constructor
		public function TransitionEvent(type:String, bubbles:Boolean = false, cancelable:Boolean = false) {
			super(type, bubbles, cancelable);
		}
		
	//A clone() method is required for all custom event classes
		public override function clone():Event {
			return new TransitionEvent(type, bubbles, cancelable);
		}
		
	//A toString() method is also requried for all custom event classes
		public override function toString():String {
			return super.formatToString("TransitionEvent", "type", "bubbles", "cancelable", "eventPhase");
		}
	}
}