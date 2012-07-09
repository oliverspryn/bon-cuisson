package com.forwardfour.boncussion {
	import flash.display.Stage;
	import flash.events.EventDispatcher;
	import flash.text.TextField;
	
	import com.greensock.*;
	import com.greensock.easing.*;

	public class MenuLink extends EventDispatcher {
	/**
	 * Configuration
	 * -----------------------------
	*/
		
		public var animateDuration:Number = 1;  // The amount of time requried to animate a link into view
		public var color:uint = 0xFFFFFF;       // The color of the text
		public var label:String;                // The text which will be displayed
		public var x:Number;                    // The x-coordinate position of the label
		public var y:Number;                    // The y-coordinate position of the label
		
	/**
	 * End configuration
	 * -----------------------------
	*/
		
	//Globalize a reference to the stage		
		private var place:Stage;
		
	//Globalize a reference to the text field
		private var text:TextField;
		
		public function MenuLink(place:Stage):void {
			this.place = place;
		}
		
		public function build():void {
		//Create the text field
			this.text = new TextField();
			this.text.alpha = 0;
			this.text.text = this.label;
			this.text.textColor = this.color;
			this.text.x = this.x;
			this.text.y = this.y - 20; //Subtract 20px, since this will slide into place when created
			
		//Add it to the stage
			this.place.addChild(this.text);
			
		//Transition it into view
			TweenMax.to(this.text, animateDuration, {
							alpha : 1,
							ease : Bounce.easeOut,
							y : this.y
						});
		}
	}
}
