package com.forwardfour.events {
	import com.forwardfour.utils.ModuleBase;
	
	import flash.events.Event;
	
	public class NetworkEvent extends Event {
	//These attributes are the destinctive features of this class which will store custom information about the dispatched event
		public var data:Object;
		public var headers:Object;
		public var statusCode:int;
		public var triggeredObject:ModuleBase;
		public var URL:String;
		
	//The constructor must call the super constructor
		public function MenuEvent(type:String, bubbles:Boolean = false, cancelable:Boolean = false) {
			super(type, bubbles, cancelable);
		}
		
	//A clone() method is required for all custom event classes
		public override function clone():Event {
			return new NetworkEvent(type, bubbles, cancelable);
		}
		
	//A toString() method is also requried for all custom event classes
		public override function toString():String {
			return super.formatToString("NetworkEvent", "type", "bubbles", "cancelable", "eventPhase");
		}
	}
}