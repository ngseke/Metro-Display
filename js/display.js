var vm = new Vue({
	el: "#display",
	data:{
		lines:[],
		stations: [],
		transfers: [],
		color: 'O',      // 當前路線顏色
		terminal: 0,      // 終點站編號 index
		direction: false,  // [行車方向] true:由小起點 false:由大起點
		carNum: 5,        // 車號
		curr: 0,      // 當前主車站 index
		mainStaLangPlayed: 0,
		mainStaLang: 0,                // 當前主車站語言
		mainStaLangTimer: null,        // 主車站語言計數器(自動切換語言)
		mainStaLangTimerDelay: 3000,   // 當前主車站語言Delay毫秒
		langList:['CH','EN'],          // 語言列表
		// ––––––––––––––––––––––––––––––––
		subStaLang: 1,      // 副車站語言
	},
	created:function(){
		this.GetLines();
		this.FetchStations();
		this.FetchTransfers();
	},
	mounted:function(){
		// 設置主車站Timer
		this.mainStaLangTimer = setInterval(() => {
			this.ToggleMainStaLang()
		}, this.mainStaLangTimerDelay);
	},
	methods:{
		ChangeColor:function() {
			this.FetchStations();
			this.FetchTransfers();
			this.curr=0;
		},
		ResetMainStaLang: function() {   // 重設主車站Timer
			clearInterval(this.mainStaLangTimer);
			this.mainStaLangTimer = setInterval(() => {
				this.ToggleMainStaLang()
			}, this.mainStaLangTimerDelay)
			this.mainStaLang=0;
			this.mainStaLangPlayed=0;
		},
		ToggleMainStaLang: function(d=1){ // 切換主車站語言狀態
			var state=this.mainStaLang;
			var length=this.langList.length;
			this.mainStaLang =(state+length+d) % length;
		},
		ToggleSubStaLang: function(d=1){ // 切換副車站語言狀態
			var state=this.subStaLang;
			var length=this.langList.length;
			this.subStaLang =(state+length+d) % length;
		},
		ToggleDirection: function(direction=null){ // 切換行駛方向
			this.direction = (direction==null) ? (!this.direction) : direction ;
			this.FetchStations();
			this.FetchTransfers();
		},
		Toggle: function(d=1){ // 切換車站
			var state=this.curr;
			var length=this.stations.length;
			this.curr = (state+length+d) % length;
			this.ResetMainStaLang();
		},
		GetAniClass:function(lang, type='flip'){ // 取得進入或離開動畫
			switch (type) {
				case 'flip':
				if(this.mainStaLangPlayed>=2){
					return (lang==this.langList[this.mainStaLang])
					? 'flip-enter' : 'flip-leave';
				}else {
					this.mainStaLangPlayed++;
					return '';
				}
				break;
				case 'fade':
				return (lang==this.langList[this.mainStaLang])
				? 'fade-in' : 'fade-out';
				break;
				default: return'';
			}
		},
		GetTerminalLabelStyle:function(lang){ // 取得終點Label margin-top負值
			if(!(lang=='CH')){
				var boxHeight = $('.terminal-area .label').outerHeight();
				return 'margin-top:-'+ boxHeight +'px;';
			}
		},
		GetTerminalBoxStyle:function(lang){ // 取得終點Box margin-top負值
			if(!(lang=='CH')){
				var boxHeight = $('.terminal-area .box .name').outerHeight();
				return 'margin-top:-'+ boxHeight +'px;';
			}
		},
		GetMainStaNumStyle:function(lang){ // 取得主車站編號Label margin-top負值
			if(!(lang=='CH')){
				var boxHeight = $('.main-sta-num-area .label').outerHeight();
				return 'margin-top:-'+ boxHeight +'px;';
			}
		},
		GetMainStaStyle:function(lang){ // 取得主站名margin-top負值
			if(!(lang=='CH')){
				var boxHeight = $('.main-sta-area .box .name').outerHeight();
				return 'margin-top:-'+ boxHeight +'px;';
			}
		},
		GetCurr:function(lang='CH'){
			var sta=this.stations[this.curr];
			switch (lang) {
				case 'CH': return sta.Name;
				case 'EN': return this.StripHTML(sta.Name_EN);
				default  : return '';
			}
		},
		GetSubSta:function(num){
			var stations=this.stations;
			var index=this.curr+num
			if (index>=0||index<stations.length) {
				return stations[this.curr+num];
			}else {
				return {};
			}
		},
		IsSubStaShow:function(lang='CH') {
			// console.log(this.langList);
			return (lang == this.langList[this.subStaLang]);
		},
		GetSubStaName:function(lang='CH', num){
			var stations=this.stations;
			var index=this.curr + num
			if (index>=0&&index<stations.length) {
				switch (lang) {
					case 'CH': return stations[index].Name;
					case 'EN': return stations[index].Name_EN;
					default  : return '';
				}
			}else {
				return '';
			}
		},
		GetSubStaNum:function(num){
			var stations=this.stations;
			var index=this.curr + num
			if (index>=0&&index<stations.length) {
				return (this.color+this.GetNum(stations[index].Num));
			}else {
				return '';
			}
		},
		GetSubStaTransfer:function(num){
			var stations=this.stations;
			var index=this.curr+num
			if (index>=0&&index<stations.length) {
				return stations[index].Transfer;
			}else {
				return [];
			}
		},
		GetTerminal:function(lang){
			var sta=this.stations[this.terminal];
			switch (lang) {
				case 'CH': return sta.Name;
				case 'EN': return sta.Name_EN;
				default  : return '';
			}
		},
		GetMainStaTextStyle:function(lang='EN'){ // 取得主車站的style (通常是scaleX, 根據div實際寬度)
			var originalWidth = $('.main-sta-area .box .name.'+lang+' .text').outerWidth();
			var BoxWidth = $('.main-sta-area .box').outerWidth();
			var percent = Math.min((BoxWidth / originalWidth), 1);
			return 'transform:scaleX('+ percent +')';
		},
		GetSubStaTextStyle:function(lang='EN',index=0){ // 取得副車站的style
			if(lang=='EN'){
				var originalWidth = $('.sub-sta-area .box'+ index +'  .name.'+lang+' span.text').innerWidth()+100;
				var realHeight = originalWidth * Math.sin(60/180*Math.PI);
				var BoxHeight = $('.sub-sta-area .row').outerHeight()-$('.sub-sta-area .row .num').outerHeight();
				// BoxHeight= $('.sub-sta-area .box'+ index +' .name.'+lang+'').outerHeight();
				var percent = Math.min((BoxHeight / realHeight), 1);
				return'transform:scaleX('+ percent +')';
			}else{
				return '';
			}
		},

		GetNum:function(num){ // 取得車站編號（個位數補0）
			return (num<10)?'0'+num.toString():num.toString();
		},
		GetLines: function(){    // 取得Stationss
			var self = this;
			$.ajax({
				url: 'get_line.php',
				data: { } ,
				success: function(data){
					self.lines = JSON.parse(data)
				},
				async: false
			});
		},
		FetchStations: function(){    // 取得Stations
			var self = this;
			$.ajax({
				url: 'get_station.php',
				data: { Color: this.color, Num: '', OrderBy: this.direction.toString()} ,
				success: function(data){
					self.stations = JSON.parse(data)
				},
				async: false
			});
		},
		FetchTransfers: function(){  // 取得Transfers
			var self = this;
			$.ajax({
				url: 'get_transfer.php',
				data: { Color: this.color },
				success: function(data){
					self.transfers = JSON.parse(data);
					self.AddTransfer();
				},
				async: false
			});
		},
		AddTransfer: function(){  // 結合車站與轉乘資料
			var stations = this.stations;
			stations.map((val) => {
				return val.Transfer = new Array();
			});
			stations.forEach((val) => {
				this.transfers.forEach((trans) => {
					if(val.Color==trans.Color && val.Num==trans.Num){
						val.Transfer.push(trans);
					}
				});
			});
		},
		GetLineColorStyle: function(bg,text){  // 取得路線顏色
			var style = 'background-color:' + bg + ';';
			style+= 'color:' + text + ';';
			return style;
		},
		StripHTML:function (input) {  // 清除String中html標籤(正規)
		  var output = '';
		  if(typeof(input)=='string'){
		      var output = input.replace(/(<([^>]+)>)/ig,"");
		  }
		  return output;
		},
	},
	computed:{
	}
});
