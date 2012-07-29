package valueObjects {
	[Bindable]
	public class MenuVO {
		public var id:int;
		public var visible:Boolean;
		public var position:int;
		public var URL:String;
		public var type:String;
		public var title:String;
		public var content:String;
		public var category:String;
		
		public function MenuVO() {
			//Nothing to do!
		}
	}
}