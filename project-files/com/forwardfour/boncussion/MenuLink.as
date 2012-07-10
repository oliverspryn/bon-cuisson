package com.forwardfour.boncussion {
	import flash.display.Shape;
	import flash.display.Sprite;
	import flash.display.Stage;
	import flash.events.Event;
	import flash.events.EventDispatcher;
	import flash.events.MouseEvent;
	import flash.text.Font;
	import flash.text.TextField;
	import flash.text.TextFormat;
	import flash.text.TextFormatAlign;
	
	import com.greensock.*;
	import com.greensock.easing.*;

	public class MenuLink extends EventDispatcher {
	/**
	 * Configuration
	 * -----------------------------
	*/
		
		public var animateDuration:Number = 1;  // The amount of time requried to animate a link into view
		public var color:uint = 0xFFFFFF;       // The color of the text and bordering line underneith
		public var fontSize:int = 25;           // The size of the 
		public var label:String;                // The text which will be displayed
		public var x:Number;                    // The x-coordinate position of the label
		public var y:Number;                    // The y-coordinate position of the label
		
	/**
	 * Event dispatcher usage
	 * -----------------------------
	*/
	
		public static const MOUSE_OVER = "menuItemMousedOver";
	
	/**
	 * Generator
	 * -----------------------------
	*/
		
	//Globalize a reference to the stage		
		private var place:Stage;
		
	//Globalize a reference to the text field container
		private var container:Sprite;
		
		public function MenuLink(place:Stage):void {
			this.place = place;
		}
		
		public function build():void {
		//Create a container sprite so that the buttonMode property can be used
			this.container = new Sprite();
			this.container.buttonMode = true;
			this.container.mouseChildren = false;
			
		//Create the text field
			var customFont:Font = Font(new LogoFont());
			var format:TextFormat = new TextFormat();
			format.align = TextFormatAlign.CENTER;
			format.font = customFont.fontName;
			format.size = this.fontSize;
		
			var text:TextField = new TextField();
			text.name = "text";
			text.alpha = 0;
			text.defaultTextFormat = format;
			text.height = this.fontSize + 3;
			text.selectable = false;
			text.text = this.label;
			text.textColor = this.color;
			text.x = this.x;
			text.y = this.y - 20; //Subtract 20px, since this will slide into place when created
			
		//Create a line underneith the text
			var line:Shape = new Shape();
			line.alpha = 0;
			line.graphics.lineStyle(1, this.color);
			line.graphics.moveTo(this.x, this.y + this.fontSize + 7);
			line.graphics.lineTo(this.x + 100, this.y + this.fontSize + 7);
			
		//Add them to the stage
			this.container.addChild(text);
			this.container.addChild(line);
			this.place.addChild(container);
			
		//Transition the text into view
			TweenMax.to(text, this.animateDuration, {
							alpha : 1,
							ease : Bounce.easeOut,
							y : this.y
						});
						
		//Transition the line into view
			TweenMax.to(line, this.animateDuration, {
							alpha : 1,
							ease : Linear.easeNone
						});
						
		//Listen for roll over and roll outs
			this.container.addEventListener(MouseEvent.MOUSE_OVER, mouseOverHandler);
			this.container.addEventListener(MouseEvent.MOUSE_OUT, mouseOutHandler);
		}
		
	//Handle the mouseover event
		private function mouseOverHandler(e:MouseEvent):void {
			var sprite:Sprite = Sprite(e.currentTarget);
			
		//Dispatch a mouse over notification event
			dispatchEvent(new Event(MenuLink.MOUSE_OVER));
			
		//Slide the TEXT up a bit
			TweenMax.to(sprite.getChildByName("text"), this.animateDuration, {
							alpha : 1,
							ease : Bounce.easeOut,
							y : this.y - 20
						});
		}
		
	//Handle the mouseout event
		private function mouseOutHandler(e:MouseEvent):void {
			//Eek
			
		}
	}
}
