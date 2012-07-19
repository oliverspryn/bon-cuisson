package com.forwardfour.boncuisson {
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.ProgressEvent;
	import flash.events.TimerEvent;
	import flash.utils.Timer;
	
	import mx.events.FlexEvent;
	import mx.preloaders.SparkDownloadProgressBar;
	import mx.utils.OnDemandEventDispatcher;
	
	public class Preloader extends SparkDownloadProgressBar {
		private var customPreloader:BonCuissonPreloader;
		
		public function Preloader() {
			super();
			
			this.customPreloader = new BonCuissonPreloader();
			super.addEventListener(Event.ADDED_TO_STAGE, onAddedHandler);
			super.addChild(this.customPreloader);
		}
		
		private function onAddedHandler(e:Event):void {
			this.customPreloader.x = stage.stageWidth / 2;
			this.customPreloader.y = 300;
		}
		
		override public function set preloader(value:Sprite):void {
			value.addEventListener(ProgressEvent.PROGRESS, onProgressHandler);
			value.addEventListener(FlexEvent.INIT_COMPLETE, onInitCompleteHandler);
		}
		
		private function onProgressHandler(e:ProgressEvent):void {
			this.customPreloader.percentage = (e.bytesLoaded / e.bytesTotal) * 100;
		}
		
		private function onInitCompleteHandler(e:FlexEvent):void {
			var timer:Timer = new Timer(2000, 1);
			timer.addEventListener(TimerEvent.TIMER_COMPLETE, initApp);
			timer.start();
		}
		
		private function initApp(e:TimerEvent):void {
			super.dispatchEvent(new Event(Event.COMPLETE));
		}
	}
}