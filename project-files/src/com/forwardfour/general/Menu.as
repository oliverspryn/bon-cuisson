package com.forwardfour.general {
	import flash.ui.ContextMenu;
	import com.forwardfour.general.exceptions.ConfigurationNotSetError;
	import flash.ui.ContextMenuItem;
	
	public class Menu {
		public var items:Array;
		private var customMenu:ContextMenu;
		
		public function Menu() {
			this.customMenu = new ContextMenu();
			this.customMenu.hideBuiltInItems();
		}
		
		public function build():ContextMenu {
		//Verify that all of the configuration items has been set
			if (!(this.items is Array) || (this.items is Array && this.items.length == 0)) {
				throw new ConfigurationNotSetError("The Menu class expects the given input to be in the form of a non-empty array");
			}
			
		//Loop through the array of provided strings, and construct the context menu
			var menuItem:ContextMenuItem;
			var command:String;
			var text:String;
			
			for (var i:int = 0; i <= this.items.length - 1; i ++) {
				text = this.items[i];
				
			//Any special characters at the beginning of the string will tell us special commands
				command = text.substring(0, 1);
				
			//Build the menu item
				switch(command) {
					case "-" : 
						menuItem = new ContextMenuItem(text.substring(1, text.length));
						menuItem.enabled = false;
						break;
						
					case "=" : 
						menuItem = new ContextMenuItem(text.substring(1, text.length));
						menuItem.separatorBefore = true;
						break;
						
					case "*" : 
						menuItem = new ContextMenuItem(text.substring(1, text.length));
						menuItem.enabled = false;
						menuItem.separatorBefore = true;
						break;
						
					default : 
						menuItem = new ContextMenuItem(text);
						break;
				}
				
			//Add this item to the menu list
				this.customMenu.customItems.push(menuItem);
			}
			
			return this.customMenu;
		}
	}
}
