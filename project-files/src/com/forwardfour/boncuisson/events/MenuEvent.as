package com.forwardfour.boncuisson.events {
	import flash.events.Event;
	
	public class MenuEvent extends Event {
	//These attributes are the destinctive features of this class which will store custom information about the dispatched event
		public var pageID:int;
		public var pageURL:String;
		public var menuIndex:uint;
		
	//The constructor must call the super constructor
		public function MenuEvent(type:String, bubbles:Boolean = false, cancelable:Boolean = false) {
			super(type, bubbles, cancelable);
		}
		
	//A clone() method is required for all custom event classes
		public override function clone():Event {
			return new MenuEvent(type, bubbles, cancelable);
		}
		
	//A toString() method is also requried for all custom event classes
		public override function toString():String {
			return super.formatToString("MenuEvent", "type", "bubbles", "cancelable", "eventPhase");
		}
	}
}