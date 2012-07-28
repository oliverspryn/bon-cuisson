package com.forwardfour {
/**
 * Configure the application from a single configuration class, set all of its
 * instance variable as bindable expressesions, and do not allowthis class to 
 * be extended
*/
	
	[Bindable]
	final public class Config {
		public var appColor:uint = 0x141414;                 //Set the background color of the main application
		public var scrollBarColor:uint = 0x666666;           //Set the chrome color of scrollbars
		public var showFlexBusyCursor:Boolean = false;       //Set whether the Flex busy cursor should show during network activity
		public var transitionDuration:int = 1000;            //Set the duration of a page transition, in milliseconds
		public var transitionLength:int = 20;                //Set the number of pixels that a page will slide during a transition
		
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