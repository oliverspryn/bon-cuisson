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
	import flash.display.MovieClip;
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
	 * Set the thumb and arrows' distance from the side of the container
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var distanceFromSide:Number = 3;
	
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
	 * Set the vertical position of the scollbar
	 *
	 * Acceptable values are either "left" or "right" (default)
	 *
	 * @access     public
	 * @var        String
	*/
	
		public var position:String = "right";
		
	/**
	 * Set the width of the thumb
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var thumbWidth:Number = 7;
		
	/**
	 * Modified by the class, for application reference
	 * ----------------------------------------------------------------------------
	*/
	
	/**
	 * Hold the percentage that the thumb has been scrolled on its
	 * track
	 *
	 * Values will lie between 0 and 1
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var scrollPercent:Number = 0;
	
	/**
	 * Class usage only
	 * ----------------------------------------------------------------------------
	*/
	
	/**
	 * Globalize a private reference to the container
	 *
	 * @access     private
	 * @var        MovieClip
	*/
		private var container:MovieClip;
		
	/**
	 * Globalize a private instance of the down arrow button
	 *
	 * @access     private
	 * @var        Sprite
	*/
		private var downButton:Sprite;
		
	/**
	 * Globalize a private reference to the stage
	 *
	 * @access     private
	 * @var        Stage
	*/
		private var stageRef:Stage;
		
	/**
	 * Globalize a private reference to the target object that will be scrolled
	 *
	 * @access     private
	 * @var        MovieClip
	*/
		private var target:MovieClip;
		
	/**
	 * Globalize a private instance of the thumb that is created in the 
	 * constructor to allow interaction with this object
	 *
	 * @access     private
	 * @var        Sprite
	*/
		private var thumb:Sprite;
		
	/**
	 * Globalize a private instance of the up arrow button
	 *
	 * @access     private
	 * @var        Sprite
	*/
		private var upButton:Sprite;
		
	/**
	 * The offset created between the vertical distance of the thumb
	 * from the top of the stage and the position of the pointer on the
	 * thumb
	 *
	 * @access     private
	 * @var        Number
	*/
		private var yOffest:Number;
		
	/**
	 * Globalize the original y-position of the target
	 *
	 * @access     private
	 * @var        Number
	*/
		private var yTarget:Number;

	/**
	 * CONSTRUCTOR
	 *
	 * This method performs the following actions:
	 *  - [1] globalizes a reference to the target object, container, and stage
	 *  - [2] create the thumb to the correct size and location
	 *  - [3] adds MOUSE_OVER and MOUSE_DOWN event listeners to the thumb
	 *  - [4] the thumb is added to the stage
	 *
	 * @param      Stage       stageRef   The stage object from the main application
	 * @access     public
	 * @return     void
	*/
		public function Scroller(target:MovieClip, container:MovieClip, stage:Stage):void {
		//Globalize a reference to the target object, container, and stage
			this.target = target;
			this.container = container;
			this.stageRef = stage;
			
		//Obtain the original y-position of the content
			this.yOffest = this.container.y;
			
		/*
		 * Calculate the required height of the thumb
		 *
		 * Calculation proceeds as follows:
		 *  - find the heights of the container and target
		 *  - create a ratio of the container height / content height
		 *  - if this ratio is less than 1, a scroller is needed
		 *  - using the calculated ratio, multiply it by the height of the
		 *    container
		*/
		
			var height:Number = this.container.height / this.target.height;
			
			if (height < 1) {
				height *= this.container.height;
				
			//Don't let this scroller get too small :)
				if (height <= 30) {
					height = 30;
				}
				
			//Create a thumb
				this.thumb = new Sprite();
				this.thumb.alpha = this.normalAlpha;
				this.thumb.graphics.beginFill(this.color);
				this.thumb.graphics.drawRoundRect(0, 0, this.thumbWidth, height, this.thumbWidth);
				this.thumb.graphics.endFill();
				
			//On which side should it go?
				switch (this.position) {
					case "left" : 
						this.thumb.x = this.container.x + this.distanceFromSide;
						this.thumb.y = this.container.y;
						break;
						
					case "right" : 
					default : 
						this.thumb.x = this.container.x + this.container.width - (this.thumbWidth + this.distanceFromSide);
						this.thumb.y = this.container.y;
						break;
				}
				
			//Add the needed event listeners
				this.thumb.addEventListener(MouseEvent.MOUSE_OVER, mouseOverThumbHandler);
				this.thumb.addEventListener(MouseEvent.MOUSE_DOWN, mouseDownThumbHandler);
				
			//Create the up arrow
				this.upButton = new Sprite();
				this.upButton.alpha = this.normalAlpha;
				this.upButton.graphics.beginFill(this.color);
				
			//On which side should it go?
				switch (this.position) {
					case "left" : 
						this.upButton.graphics.moveTo(this.container.x + this.container.width - ((this.thumbWidth / 2) + this.distanceFromSide),
													  this.container.y);
						this.upButton.graphics.lineTo(this.container.x + this.container.width - this.distanceFromSide,
													  this.container.y);
						break;
						
					case "right" : 
					default : 
						this.upButton.graphics.moveTo(this.container.x + this.container.width - ((this.thumbWidth / 2) + this.distanceFromSide),
													  this.container.y + this.distanceFromSide);
						this.upButton.graphics.lineTo(this.container.x + this.container.width - this.distanceFromSide,
													  this.container.y + this.distanceFromSide + this.thumbWidth);
						this.upButton.graphics.lineTo(this.container.x + this.container.width - this.thumbWidth - this.distanceFromSide,
													  this.container.y + this.distanceFromSide + this.thumbWidth);
						this.upButton.graphics.lineTo(this.container.x + this.container.width - ((this.thumbWidth / 2) + this.distanceFromSide),
													  this.container.y + this.distanceFromSide);
						break;
				}
				
				this.upButton.graphics.endFill();
				
			//Create the down arrow
				this.downButton = new Sprite();
				this.downButton.alpha = this.normalAlpha;
				this.downButton.graphics.beginFill(this.color);
				
			//On which side should it go?
				switch (this.position) {
					case "left" : 
						this.upButton.graphics.moveTo(this.container.x + this.container.width - ((this.thumbWidth / 2) + this.distanceFromSide),
													  this.container.y);
						this.upButton.graphics.lineTo(this.container.x + this.container.width - this.distanceFromSide,
													  this.container.y);
						break;
						
					case "right" : 
					default : 
						this.downButton.graphics.moveTo(this.container.x + this.container.width - (this.thumbWidth + this.distanceFromSide),
														this.container.y + this.container.height - (this.thumbWidth + this.distanceFromSide));
						this.downButton.graphics.lineTo(this.container.x + this.container.width - this.distanceFromSide,
														this.container.y + this.container.height - (this.thumbWidth + this.distanceFromSide));
						this.downButton.graphics.lineTo(this.container.x + this.container.width - ((this.thumbWidth / 2) + this.distanceFromSide),
														this.container.y + this.container.height - this.distanceFromSide);
						this.downButton.graphics.lineTo(this.container.x + this.container.width - (this.thumbWidth + this.distanceFromSide),
														this.container.y + this.container.height - (this.thumbWidth + this.distanceFromSide));
						break;
				}
				
				this.downButton.graphics.endFill();
				
			//Add the created objects to the container and bring it to the front
				this.stageRef.addChild(this.thumb);
				this.stageRef.addChild(this.upButton);
				this.stageRef.addChild(this.downButton);
				this.stageRef.setChildIndex(this.thumb, this.stageRef.numChildren - 1);
			}
		}
		
	/**
	 * Transition the thumb into the hover state and listen for a mouse
	 * down event
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseOverThumbHandler(e:MouseEvent):void {			
		//Perform the transition to the hover state view
			TweenMax.to(this.thumb, 0.25, {
							alpha : this.hoverAlpha
						});
						
		//Undo the transition that was performed above when a MOUSE_OUT (and no MOUSE_UP) or MOUSE_UP
		//event occurs
			this.thumb.addEventListener(MouseEvent.MOUSE_OUT, mouseOutThumbHandler);
			this.stageRef.addEventListener(MouseEvent.MOUSE_UP, mouseUpThumbHandler);
		}
		
	/**
	 * If the thumb has been moused no long has a pointer over it return
	 * it to the normal state, that is, if there the user does not have
	 * the mouse down
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseOutThumbHandler(e:MouseEvent):void {
			if (!e.buttonDown) {
				TweenMax.to(this.thumb, 0.25, {
								alpha : this.normalAlpha
							});
			}
		}
		
	/**
	 * Calculate the original offset of the thumb with respect to the 
	 * position of the stage. Also, now that the mouse is down, add an
	 * event to listen for movement
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseDownThumbHandler(e:MouseEvent):void {
		//Calculate the original y-offset of the thumb...
			this.yOffest = this.stageRef.mouseY - this.thumb.y;
			
		//... to move the thumb up or down
			this.stageRef.addEventListener(MouseEvent.MOUSE_MOVE, mouseMoveThumbHandler);
		}
		
	/**
	 * Stop the vertical scrolling of the thumb when the mouse is released,
	 * return the thumb to the normal state, and remove the MOUSE_MOVE
	 * event listener
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseUpThumbHandler(e:MouseEvent):void {
		//Return the thumb back to the normal state
			TweenMax.to(this.thumb, 0.25, {
							alpha : this.normalAlpha
						});
			
		//Stop listening for movement
			this.stageRef.removeEventListener(MouseEvent.MOUSE_MOVE, mouseMoveThumbHandler);
		}
		
	/**
	 * Update the vertical position of the thumb, and don't let it go
	 * above or below the container. Also update the percentage that
	 * the thumb has scrolled on its track
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseMoveThumbHandler(e:MouseEvent):void {
			this.thumb.y = this.stageRef.mouseY - this.yOffest;
			
		//Don't let the thumb go to high...
			if (this.thumb.y < this.container.y) {
				this.thumb.y = this.container.y;
			}
			
		//... or too low :)
			if (this.thumb.y + this.thumb.height > this.container.y + this.container.height) {
				this.thumb.y = this.container.y + this.container.height - this.thumb.height;
			}
			
		//Update the position of the thumb
			e.updateAfterEvent();
			
		//Calculate the percentage that the thumb has scrolled
			var avaliableScrollRegion:Number = this.container.height - this.thumb.height;
			this.scrollPercent = (this.thumb.y - this.container.y) / avaliableScrollRegion;
			
		/*
		 * Update the position of the target
		 *	
		 * Calculation proceeds as follows:
		 *  - find the y-position of the container
		 *  - find the height of the target and subtract that from the 
		 *    height of the container (which is always smaller if a scroller
		 *    is present). This prevents the bottom of the target from 
		 *    scrolling up to where the top of the target was located before
		 *    the user used the scrollbar, whenever the thumb is moved to the
		 *    bottom
		 *  - multiply this value by the scroll percentage value
		 *  - subtract the multiplied value from the y position of the 
		 *    container
		*/
			this.target.y = this.container.y - ((this.target.height - this.container.height) * this.scrollPercent);
		}
	}
}