package com.forwardfour {
	/**
	 * Configure the application from a single configuration class, set all of its
	 * instance variable as bindable expressesions, and do not allow this class to 
	 * be extended
	 */
	
	[Bindable]
	final public class Config {
		public var menuHoverTransitionDuration:int = 500;     //The amount of time for the hover light to show/hide, in milliseconds
		public var menuInitDuration:int = 1000;              //The amount of time for the menu background to show, in milliseconds
		public var menuItemDuration:int = 150;                //The amount of time for each menu item to show, in milliseconds
		public var menuPointerTransitionDuration:int = 500;  //The duration of the menu arrow transitions, in milliseconds
		public var menuPointerSize:int = 10;                 //The size of the arrow on the menu
		public var scrollBarColor:uint = 0x666666;           //The chrome color of scrollbars
		public var showFlexBusyCursor:Boolean = false;       //Whether the Flex busy cursor should show during network activity
		public var transitionDuration:int = 1000;            //The duration of a page transition, in milliseconds
		public var transitionLength:int = 20;                //The number of pixels that a page will slide during a transition
		
		public var address:String = "118 Edgewood Road";
		public var by:String = "Dawn";
		public var companyName:String = "Bon Cuisson";
		public var email:String = "dawn@boncuisson.com";
		public var phone:String = "724-841-0747";
		
		public function Config() {
			//Nothing to do!
		}
	}
}