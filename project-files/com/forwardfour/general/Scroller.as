/**
 * Flash UI Framework Tools
 * 
 * LICENSE
 * 
 * By viewing, using, or actively developing this application in any way, you are
 * henceforth bound the license agreement, and all of its changes, set forth by
 * ForwardFour Innovations. The license can be found, in its entirety, at this 
 * address: http://forwardfour.com/license.
 * 
 * @copyright  Copyright (c) 2012 and Onwards, ForwardFour Innovations
 * @license    http://forwardfour.com/license    [Proprietary/Closed Source]  
*/

package com.forwardfour.general {
	import flash.display.Sprite;
	import flash.display.Stage;
	import flash.events.MouseEvent;
	
	import com.greensock.TweenMax;

/**
 * Create a scroller to view content which is too large to display on screen
 *
 * @author     Oliver Spryn
 * @category   General
 * @package    com.forwardfour.general
 * @version    1.0
*/

	public class Scroller {
		
	/**
	 * Configuration
	 * ----------------------------------------------------------------------------
	*/
	
	/**
	 * Set the color of the thumb and scroll arrows
	 *
	 * Prefix the hexadecimal value with a "0x"
	 *
	 * @access     public
	 * @var        uint
	*/
	
		public var color:uint = 0xFFFFFF;
		
	/**
	 * Set the alpha property of the thumb when the mouse is hovering
	 * over the thumb, track, or arrows
	 *
	 * Acceptable values lie between 0 and 1
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var hoverAlpha:Number = 1;
		
	/**
	 * Set the alpha property of the thumb when the mouse is not 
	 * hovering over the thumb, track, or arrows
	 *
	 * Acceptable values lie between 0 and 1
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var normalAlpha:Number = 0.5;
		
	/**
	 * Globalize a private reference to the stage
	 *
	 * @access     private
	 * @var        Stage
	*/
		private var stageRef:Stage;
		
	/**
	 * Globalize a private instance of the thumb that is created in the 
	 * constructor to allow interaction with this object
	 *
	 * @access     private
	 * @var        Sprite
	*/
		private var thumb:Sprite;

		public function Scroller(stageRef:Stage) {
		//Globalize a reference to the stage
			this.stageRef = stageRef;
			
		//Create a thumb
			this.thumb = new Sprite();
			this.thumb.alpha = this.normalAlpha;
			this.thumb.graphics.beginFill(this.color);
			this.thumb.graphics.drawRoundRect(0, 0, 7, 300, 7);
			this.thumb.graphics.endFill();
			this.thumb.x = 100;
			this.thumb.y = 100;
			
			this.thumb.addEventListener(MouseEvent.MOUSE_OVER, mouseOverThumbHandler);
			
			stageRef.addChild(this.thumb);
		}
		
		private function mouseOverThumbHandler(e:MouseEvent):void {
		//Listen for a MOUSE_OUT and MOUSE_DOWN events
			this.thumb.addEventListener(MouseEvent.MOUSE_OUT, mouseOutThumbHandler);
			this.thumb.addEventListener(MouseEvent.MOUSE_DOWN, mouseDownThumbHandler);
			
		//Perform the transition to the hover state view
			TweenMax.to(this.thumb, 0.25, {
							alpha : this.hoverAlpha
						});
		}
		
		private function mouseDownThumbHandler(e:MouseEvent) {
			this.thumb.y = this.stageRef.mouseY - this.thumb.y;
			e.updateAfterEvent();
		}
		
		private function mouseOutThumbHandler(e:MouseEvent):void {
			TweenMax.to(this.thumb, 0.25, {
							alpha : this.normalAlpha
						});
		}

	}
	
}
