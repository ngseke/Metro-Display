<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Document</title>
  <?php include 'style.php'?>
</head>

<body>
  <div id="display" class="container-fluid px-0">
    <!-- 頂部區塊 -->
    <div class="container-fluid top-area py-4">
      <div class="row justify-content-between align-items-center">
        <!-- 終點站 區塊 -->
        <div class="col-4 col-lg-6 terminal-area">
          <div class="row no-gutters">
            <div class="col-6 col-lg-3 text-center">
              <span class="label " v-bind:class="GetAniClass('CH', 'fade')">終  點</span>
              <span class="label" v-bind:class="GetAniClass('EN', 'fade')" style="margin-top:-2.5rem">To</span>
            </div>
            <div class="col-6 col-lg-9">
              <div class="box" v-bind:class="GetAniClass('CH', 'fade')" >
                <span class="badge badge-dark name CH px-3"
                v-bind:style="GetLineColorStyle(stations[currSta].ColorCode, stations[currSta].TextColorCode)"><span>{{GetTerminal('CH')}}</span></span>
              </div>
              <div class="box" v-bind:class="GetAniClass('EN', 'fade')" style="margin-top:-2.745rem">
                <span class="badge badge-dark name EN px-4"
                v-bind:style="GetLineColorStyle(stations[currSta].ColorCode, stations[currSta].TextColorCode)"><span>{{GetTerminal('EN')}}</span></span>
              </div>
            </div>
          </div>
        </div>
        <!-- 車號 區塊 -->
        <div class="col-5 col-lg-3 car-num-area text-right">
          <span class="label ch" v-bind:class="GetAniClass('EN', 'fade')">Car No.</span>
          <span class="badge badge-dark badge-pill num">{{carNum}}</span>
          <span class="label ch mr-5"  v-bind:class="GetAniClass('CH', 'fade')" style="letter-spacing:.3rem;">號車</span>
        </div>
      </div>
      <div class="row align-items-center">
        <!-- 主車站編號 區塊 -->
        <div class="col-4 main-sta-num-area">
          <div class="row align-items-center ">
            <div class="col-8 text-center" >
              <span class="label" v-bind:class="GetAniClass('CH', 'fade')">下一站</span>
              <span class="label" v-bind:class="GetAniClass('EN', 'fade')" style="margin-top:-3.5rem">Next</span>
            </div>
            <div class="col text-left">
              <span class="num badge"
              style="min-width:4.5rem;"
              v-bind:style="GetLineColorStyle(stations[currSta].ColorCode, stations[currSta].TextColorCode)">
              {{stations[currSta].Color}}<br>{{GetNum(stations[currSta].Num)}}
            </span>
          </div>
        </div>
      </div>

      <!-- 主車站文字 區塊 -->
      <div class="col-8 main-sta-area">
        <div class="box" style="overflow:hidden;">
          <span class="name CH" v-bind:class="GetAniClass('CH')" v-bind:style="GetMainStaStyle('CH')">
            {{GetCurrSta('CH')}}
          </span>
          <span class="name EN" v-bind:class="GetAniClass('EN')" v-bind:style="GetMainStaStyle('EN')">
            <span class="text" v-bind:style="'transform:scaleX('+GetScaleX()+')'">{{GetCurrSta('EN')}}</span>
          </span>
          <span class="name JP" v-bind:class="GetAniClass('JP')">
            <span class="text" style="transform:scaleX(.65);">{{GetCurrSta('JP')}}</span>
          </span>
          <span class="name KR" v-bind:class="GetAniClass('KR')">
            <span class="text" style="transform:scaleX(1);">{{GetCurrSta('KR')}}</span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <!-- 中間顏色分割線 -->
  <div class="row divide-line" v-bind:style="GetLineColorStyle(stations[currSta].ColorCode, stations[currSta].TextColorCode)"></div>

  <!-- 底部區塊 -->
  <div class="btm-area">

  </div>
  <!-- 控制器 -->
  <div>

    <button @click="ToggleStaLang(1)" type="button" class="btn btn-secondary">切換語言</button>
    <select v-model="color" @change="ChangeColor()" class="form-control d-inline-block" style=" width:5rem;">
      <template v-for="l in lines">
        <option :value="l.Color">{{l.Color}}</option>
      </template>
    </select>
    <div class="btn-group">
      <button @click="Toggle(-1)" type="button" class="btn btn-secondary"><</button>
      <button @click="Toggle(1)" type="button" class="btn btn-secondary">></button>
      <input v-model="currSta" @keyup.left="Toggle(-1)" @keyup.right="Toggle(1)">
    </div>
  </div>
</div>



<?php require_once 'js.php'?>
<script type="text/javascript">
var vm = new Vue({
  el: "#display",
  data:{
    lines:[],
    stations: [],
    transfers: [],
    color: 'BL',      // 當前路線顏色
    terminal: 0,     // 終點站編號 index
    carNum:5,        // 車號
    currSta: 13,      // 當前主車站 index
    mainStaLang: 0,                // 當前主車站語言
    mainStaLangTimer: null,        // 主車站語言計數器(自動切換語言)
    mainStaLangTimerDelay: 1500,   // 當前主車站語言Delay毫秒
    mainStaLangList:['CH','EN'],   // 主車站語言列表
  },
  created:function(){
    this.GetLines();
    this.GetStations();
    this.GetTransfers();
  },
  mounted:function(){
    // 設置主車站Timer
    this.mainStaLangTimer = setInterval(() => {
      this.ToggleStaLang()
    }, this.mainStaLangTimerDelay);
  },
  methods:{
    ChangeColor:function() {
      this.GetStations();
      this.GetTransfers();
      this.currSta=0;
    },
    IsMainLangDisplay: function(lang){
      return (lang==this.mainStaLangList[this.mainStaLang]);
    },
    ResetMainStaLang: function() {   // 重設主車站Timer
      clearInterval(this.mainStaLangTimer);
      this.mainStaLangTimer = setInterval(() => {
        this.ToggleStaLang()
      }, this.mainStaLangTimerDelay)
    },
    ToggleStaLang: function(d=1){ // 切換主車站語言狀態
      var state=this.mainStaLang;
      var length=this.mainStaLangList.length;
      this.mainStaLang =(state+length+d) % length;
    },
    Toggle: function(d=1){ // 切換車站
      var state=this.currSta;
      var length=this.stations.length;
      this.currSta = (state+length+d) % length;
      this.ResetMainStaLang();
      this.mainStaLang=0;
    },
    GetAniClass:function(lang, type='flip'){ // 取得進入或離開動畫
      switch (type) {
        case 'flip':
        return (lang==this.mainStaLangList[this.mainStaLang])
        ? 'flip-enter'
        : 'flip-leave'
        case 'fade':
        return (lang==this.mainStaLangList[this.mainStaLang])
        ? 'fade-in'
        : 'fade-out'
        default: return'';
      }
    },
    GetMainStaStyle:function(lang){ // 取得主站名進入或離開style
      return '';
      if(lang==this.mainStaLangList[this.mainStaLang]){
        return 'transform-origin: top;\
        transform: scaleY(1);\
        opacity: 1;';
      }
      else{
        return 'transform-origin: bottom;\
        transform: scaleY(0); \
        opacity: 0;';
      }
    },
    GetCurrSta:function(lang){
      var sta=this.stations[this.currSta];
      switch (lang) {
        case 'CH': return sta.Name;
        case 'EN': return sta.Name_EN;
        default  : return '';
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
    GetScaleX:function(){
      var originalWidth = $('.main-sta-area .box .name.EN .text').outerWidth()-60;
      return Math.min((730 / originalWidth), 1);
    },
    GetNum:function(num){ // 取得車站編號（個位數補0）
      return (num<10)?'0'+num:num;
    },
    GetLines: function(){    // 取得Stations
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
    GetStations: function(){    // 取得Stations
      var self = this;
      $.ajax({
        url: 'get_station.php',
        data: { Color: this.color, Num: ''} ,
        success: function(data){
          self.stations = JSON.parse(data)
        },
        async: false
      });
    },
    GetTransfers: function(){  // 取得Transfers
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
    }
  },
  computed:{
  }
});
</script>

</body>

</html>
