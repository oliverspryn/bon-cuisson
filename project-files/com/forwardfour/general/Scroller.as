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
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	
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
	 * Set the height of the up and down arrows
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var arrowHeight:Number = 7;
		
	/**
	 * Set the width of the up and down arrows
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var arrowWidth:Number = 7;
	
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
	 * Whether or not the class should add up or down arrows
	 *
	 * Defaults to true
	 *
	 * @access     public
	 * @var        Boolean
	*/
	
		public var includeArrows:Boolean = true;
		
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
	 * Set the distance of the thumb from the up and down arrows
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var thumbDistanceFromArrows:Number = 3;
		
	/**
	 * Set the width of the thumb
	 *
	 * @access     public
	 * @var        Number
	*/
	
		public var thumbWidth:Number = 7;
		
	/**
	 * Modified by the class, accessable by getter methods
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
	
		private var privateScrollPercent:Number = 0;
	
	/**
	 * Class usage only
	 * ----------------------------------------------------------------------------
	*/
	
	/**
	 * The number of pixels from the bottom of the stage that the thumb may 
	 * slide due to the placement of the container and padding enforced by
	 * the down arrow and configured padding from the edge of the container
	 *
	 * @access     private
	 * @var        Number
	*/
		private var bottom:Number;
	
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
	 * The number of pixels from the top and bottom of the container that the 
	 * thumb may slide, due to the presence of up and down arrows and the 
	 * configured distance from the edge of the cotainer
	 *
	 * @access     private
	 * @var        Number
	*/
		private var padding:Number;
		
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
	 * The number of pixels from the top of the stage that the thumb may 
	 * slide due to the placement of the container and padding enforced by
	 * the up arrow and configured padding from the edge of the container
	 *
	 * @access     private
	 * @var        Number
	*/
		private var top:Number;
		
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
		private var yOffset:Number;
		
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
	 * This method globalizes a references to the target object, container,
	 * and stage
	 *
	 * @param      MovieClip   target     The MovieClip which will be scrolled
	 * @param      MovieClip   container  The viewport movieclip, which masks the overflown content from target
	 * @param      Stage       stageRef   The stage object from the main application
	 * @access     public
	 * @return     void
	*/
		public function Scroller(target:MovieClip, container:MovieClip, stage:Stage):void {
		//Globalize a reference to the target object, container, and stage
			this.target = target;
			this.container = container;
			this.stageRef = stage;
		}
		
	/**
	 * A getter function which allows read-only access (to applications 
	 * using this class)to the private privateScrollPercent instance
	 * variable
	 *
	 * @access     public
	 * @return     Number
	*/
	
		public function get scrollPercent():Number {
			return this.privateScrollPercent;
		}
		
	/**
	 * This method performs the following actions:
	 *  - [1] checks if the configuration allows the use of arrows
	 *  - [2] checkes to see if a scroller is needed
	 *  - [3] if so, it creates the thumb according to configuration specs
	 *  - [4] creates an up arrow, if an arrow is set to be created
	 *  - [5] creates a down arrow, if an arrow is set to be created
	 *  - [6] attaches necessary event listeners
	 *  - [7] adds these objects to the stage
	 *  - [8] calculates the thumb's possible range of movement
	 *
	 * @access     public
	 * @return     void
	*/
		
		public function attach():void {
		//If no arrows are configured to be created, then set their sizing
		//parameters equal to zero for future calculations
			if (this.includeArrows == false) {
				this.arrowHeight = 0;
				this.thumbDistanceFromArrows = 0;
			}
			
		/**
		 * Generate the thumb
		 * ----------------------------------------------------------------------------
		*/
			
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
				this.thumb.name = "ScrollerUIThumb";
				
			//Place it on the stage
				switch (this.position) {
					case "left" : 
						this.thumb.x = this.container.x + this.distanceFromSide;
						this.thumb.y = this.container.y + this.distanceFromSide + this.arrowHeight + this.thumbDistanceFromArrows;
						break;
						
					case "right" : 
					default : 
						this.thumb.x = this.container.x + this.container.width - (this.thumbWidth + this.distanceFromSide);
						this.thumb.y = this.container.y + this.distanceFromSide + this.arrowHeight + this.thumbDistanceFromArrows;
						break;
				}
				
			/**
			 * Generate the up arrow
			 * ----------------------------------------------------------------------------
			*/
				
				if (this.includeArrows) {
				//Create the up arrow
					this.upButton = new Sprite();
					this.upButton.alpha = this.normalAlpha;
					this.upButton.name = "ScrollerUIUpArrow";
					this.upButton.graphics.beginFill(this.color);
					
				//Place it on the stage
					switch (this.position) {
						case "left" : 
							this.upButton.graphics.moveTo(this.container.x + (this.arrowWidth / 2) + this.distanceFromSide,
														  this.container.y + this.distanceFromSide);
							this.upButton.graphics.lineTo(this.container.x + this.arrowWidth + this.distanceFromSide,
														  this.container.y + this.distanceFromSide + this.arrowHeight);
							this.upButton.graphics.lineTo(this.container.x + this.distanceFromSide,
														  this.container.y + this.distanceFromSide + this.arrowHeight);
							this.upButton.graphics.lineTo(this.container.x + (this.arrowWidth / 2) + this.distanceFromSide,
														  this.container.y + this.distanceFromSide);
							break;
							
						case "right" : 
						default : 
							this.upButton.graphics.moveTo(this.container.x + this.container.width - ((this.arrowWidth / 2) + this.distanceFromSide),
														  this.container.y + this.distanceFromSide);
							this.upButton.graphics.lineTo(this.container.x + this.container.width - this.distanceFromSide,
														  this.container.y + this.distanceFromSide + this.arrowHeight);
							this.upButton.graphics.lineTo(this.container.x + this.container.width - this.arrowWidth - this.distanceFromSide,
														  this.container.y + this.distanceFromSide + this.arrowHeight);
							this.upButton.graphics.lineTo(this.container.x + this.container.width - ((this.arrowWidth / 2) + this.distanceFromSide),
														  this.container.y + this.distanceFromSide);
							break;
					}
					
					this.upButton.graphics.endFill();
				}
				
			/**
			 * Generate the down arrow
			 * ----------------------------------------------------------------------------
			*/
				
				if (this.includeArrows) {
				//Create the down arrow
					this.downButton = new Sprite();
					this.downButton.alpha = this.normalAlpha;
					this.downButton.name = "ScrollerUIDownArrow";
					this.downButton.graphics.beginFill(this.color);
					
				//Place it on the stage
					switch (this.position) {
						case "left" : 
							this.downButton.graphics.moveTo(this.container.x + this.distanceFromSide,
															this.container.y + this.container.height - (this.arrowHeight + this.distanceFromSide));
							this.downButton.graphics.lineTo(this.container.x + this.arrowWidth + this.distanceFromSide,
															this.container.y + this.container.height - (this.arrowHeight + this.distanceFromSide));
							this.downButton.graphics.lineTo(this.container.x + (this.arrowWidth / 2) + this.distanceFromSide,
															this.container.y + this.container.height - this.distanceFromSide);
							this.downButton.graphics.lineTo(this.container.x + this.distanceFromSide,
															this.container.y + this.container.height - (this.arrowHeight + this.distanceFromSide));
							break;
							
						case "right" : 
						default : 
							this.downButton.graphics.moveTo(this.container.x + this.container.width - (this.arrowWidth + this.distanceFromSide),
															this.container.y + this.container.height - (this.arrowHeight + this.distanceFromSide));
							this.downButton.graphics.lineTo(this.container.x + this.container.width - this.distanceFromSide,
															this.container.y + this.container.height - (this.arrowHeight + this.distanceFromSide));
							this.downButton.graphics.lineTo(this.container.x + this.container.width - ((this.arrowWidth / 2) + this.distanceFromSide),
															this.container.y + this.container.height - this.distanceFromSide);
							this.downButton.graphics.lineTo(this.container.x + this.container.width - (this.arrowWidth + this.distanceFromSide),
															this.container.y + this.container.height - (this.arrowHeight + this.distanceFromSide));
							break;
					}
					
					this.downButton.graphics.endFill();
				}
				
			/**
			 * Add the necessary event listeners, place the created objects on the stage,
			 * and perform some last minute calculations
			 * ----------------------------------------------------------------------------
			*/
				
			//Add the needed event listeners
				this.stageRef.addEventListener(MouseEvent.MOUSE_UP, mouseUpHandler);
				
				this.thumb.addEventListener(MouseEvent.MOUSE_OVER, mouseOverHandler);
				this.thumb.addEventListener(MouseEvent.MOUSE_OUT, mouseOutHandler);
				this.thumb.addEventListener(MouseEvent.MOUSE_DOWN, mouseDownThumbHandler);
				
				if (this.includeArrows) {
					this.upButton.addEventListener(MouseEvent.MOUSE_OVER, mouseOverHandler);
					this.upButton.addEventListener(MouseEvent.MOUSE_OUT, mouseOutHandler);
					this.upButton.addEventListener(MouseEvent.MOUSE_DOWN, mouseDownUpButtonHandler);
					
					this.downButton.addEventListener(MouseEvent.MOUSE_OVER, mouseOverHandler);
					this.downButton.addEventListener(MouseEvent.MOUSE_OUT, mouseOutHandler);
					this.downButton.addEventListener(MouseEvent.MOUSE_DOWN, mouseDownDownButtonHandler);
				}
				
			//Add the created objects to the container
				this.stageRef.addChild(this.thumb);
				
				if (this.includeArrows) {
					this.stageRef.addChild(this.upButton);
					this.stageRef.addChild(this.downButton);
				}
				
			//Calculate the thumb's range of movement
				this.padding = this.distanceFromSide + this.arrowHeight + this.thumbDistanceFromArrows;
				this.top = this.container.y + this.padding;
				this.bottom = this.container.y + this.container.height - this.padding - this.thumb.height;
			}
		}
		
	/**
	 * General event handlers
	 * ----------------------------------------------------------------------------
	*/
		
	/**
	 * Transition the thumb and arrows into the hover state
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseOverHandler(e:MouseEvent):void {
		//The items to tween will vary based on the configuration
			var transitionItems:Array = new Array(this.thumb);
			
			if (this.includeArrows) {
				transitionItems.push(this.upButton, this.downButton);
			}
			
		//Perform the transition to the hover state view
			TweenMax.allTo(transitionItems, 0.25, {
							alpha : this.hoverAlpha
						});
		}
		
	/**
	 * If no part of the scoller has has a pointer over it, return
	 * it to the normal state, that is, if there the user does not have
	 * the mouse down
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseOutHandler(e:MouseEvent):void {
			if (!e.buttonDown && !this.mouseOverScrollerElement()) {
			//The items to tween will vary based on the configuration
				var transitionItems:Array = new Array(this.thumb);
				
				if (this.includeArrows) {
					transitionItems.push(this.upButton, this.downButton);
				}
			
			//Return the thumb back to the normal state
				TweenMax.allTo(transitionItems, 0.25, {
								alpha : this.normalAlpha
							});
			}
		}
		
	/**
	 * Stop the vertical scrolling of the thumb and target when the 
	 * mouse is released, return the thumb and arrows to the normal
	 * state, and remove the event listeners that initiate scrolling
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseUpHandler(e:MouseEvent):void {
			if (!this.mouseOverScrollerElement()) {
			//The items to tween will vary based on the configuration
				var transitionItems:Array = new Array(this.thumb);
					
				if (this.includeArrows) {
					transitionItems.push(this.upButton, this.downButton);
				}
			
			//Return the thumb back to the normal state
				TweenMax.allTo(transitionItems, 0.25, {
								alpha : this.normalAlpha
							});
			
			}
			
		//Stop listening for movement
			this.stageRef.removeEventListener(MouseEvent.MOUSE_MOVE, mouseMoveThumbHandler);
			this.stageRef.removeEventListener(Event.ENTER_FRAME, scrollUpHandler);
			this.stageRef.removeEventListener(Event.ENTER_FRAME, scrollDownHandler);
		}
		
	/**
	 * Thumb event handlers
	 * ----------------------------------------------------------------------------
	*/
		
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
			this.yOffset = this.stageRef.mouseY - this.thumb.y;
			
		//... to move the thumb up or down
			this.stageRef.addEventListener(MouseEvent.MOUSE_MOVE, mouseMoveThumbHandler);
		}
		
	/**
	 * Update the vertical position of the thumb and target, and don't
	 * let the track go above or below the arrows (if any are present,
	 * use the container if no arrows are displaying). Also update the 
	 * percentage that the thumb has scrolled on its track.
	 *
	 * @param      MouseEvent  e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function mouseMoveThumbHandler(e:MouseEvent):void {
			this.thumb.y = this.stageRef.mouseY - this.yOffset;
			
		//Don't let the thumb go to high...
			if (this.thumb.y < top) {
				this.thumb.y = top;
			}
			
		//... or too low :)
			if (this.thumb.y > bottom) {
				this.thumb.y = bottom;
			}
			
		//Update the position of the thumb
			e.updateAfterEvent();
			
		//Calculate the percentage that the thumb has scrolled
			var avaliableScrollRegion:Number = this.container.height - this.thumb.height - (2 * padding);
			this.privateScrollPercent = (this.thumb.y - top) / avaliableScrollRegion;
			
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
			this.target.y = this.container.y - ((this.target.height - this.container.height) * this.privateScrollPercent);
		}
		
	/**
	 * Up arrow event handlers
	 * ----------------------------------------------------------------------------
	*/
	
		private function mouseDownUpButtonHandler(e:MouseEvent):void {
			this.stageRef.addEventListener(Event.ENTER_FRAME, scrollUpHandler);
		}
		
	/**
	 * Update the vertical position of the thumb and target, and don't
	 * let the track go above or below the arrows (if any are present,
	 * use the container if no arrows are displaying). Also update the 
	 * percentage that the thumb has scrolled on its track.
	 *
	 * @param      Event       e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function scrollUpHandler(e:Event):void {
		//Decrement the scroll percentage by 1 percent
			this.privateScrollPercent *= 100;
			this.privateScrollPercent -= 5;
			this.privateScrollPercent /= 100;
			
			if (this.privateScrollPercent < 0) {
				this.privateScrollPercent = 0;
			}
			
		//Update the position of the thumb
			var range:Number = this.bottom - this.top;
			this.thumb.y = this.top + (this.privateScrollPercent * range);
			
		//Don't let the thumb go to high...
			if (this.thumb.y < top) {
				this.thumb.y = top;
			}
			
		//... or too low :)
			if (this.thumb.y > bottom) {
				this.thumb.y = bottom;
			}
			
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
			this.target.y = this.container.y - ((this.target.height - this.container.height) * this.privateScrollPercent);
		}
	
	/**
	 * Down arrow event handlers
	 * ----------------------------------------------------------------------------
	*/
	
		private function mouseDownDownButtonHandler(e:MouseEvent):void {
			this.stageRef.addEventListener(Event.ENTER_FRAME, scrollDownHandler);
		}
		
	/**
	 * Update the vertical position of the thumb and target, and don't
	 * let the track go above or below the arrows (if any are present,
	 * use the container if no arrows are displaying). Also update the 
	 * percentage that the thumb has scrolled on its track.
	 *
	 * @param      Event       e          A reference to the event that was dispatched
	 * @access     private
	 * @return     void
	*/
		private function scrollDownHandler(e:Event):void {
		//Decrement the scroll percentage by 1 percent
			this.privateScrollPercent *= 100;
			this.privateScrollPercent += 5;
			this.privateScrollPercent /= 100;
			
			if (this.privateScrollPercent > 1) {
				this.privateScrollPercent = 1;
			}
			
		//Update the position of the thumb
			var range:Number = this.bottom - this.top;
			this.thumb.y = this.top + (this.privateScrollPercent * range);
			
		//Don't let the thumb go to high...
			if (this.thumb.y < top) {
				this.thumb.y = top;
			}
			
		//... or too low :)
			if (this.thumb.y > bottom) {
				this.thumb.y = bottom;
			}
			
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
			this.target.y = this.container.y - ((this.target.height - this.container.height) * this.privateScrollPercent);
		}
		
	/**
	 * Additional processing methods
	 * ----------------------------------------------------------------------------
	*/
		
		private function mouseOverScrollerElement():Boolean {
		//Create a point for testing whether or not the scroller lies underneith it
			var testPoint:Point = new Point(this.stageRef.mouseX, this.stageRef.mouseY);
			
		//Check for the names of the retrieved objects match the names given to scroller components
			var partNames:Array = new Array("ScrollerUIThumb", "ScrollerUIUpArrow", "ScrollerUIDownArrow");
			var objectsUnderPoint:Array = this.stageRef.getObjectsUnderPoint(testPoint);
			
			for (var i:int = 0; i <= objectsUnderPoint.length - 1; i ++) {
				if (partNames.indexOf(objectsUnderPoint[i].name) != -1) {
					testPoint = null;					
					return true;
				}
			}
			
			testPoint = null;
			return false;
		}
	}
}