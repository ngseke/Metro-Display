<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Document</title>
  <?php include 'style.php'?>
</head>

<body>
  <div id="display" class="container">
    <!-- 頂部區塊 -->
    <div class="row top-area">
      <!-- 終點站 區塊 -->
      <div class="col-6 terminal-area">
        <div>
          <span class="label">終點：</span>
          <span class="badge badge-dark bg-color-blue">頂埔</span>
        </div>
      </div>
      <div class="col"></div>
      <!-- 車號 區塊 -->
      <div class="col-3 car-num-area text-right">
        <span class="badge badge-dark badge-pill">5</span>
        <span class="label ch">號車</span>
      </div>
    </div>
    <div class="row align-items-center">
      <!-- 主要車站編號 區塊 -->
      <div class="col-4 main-sta-num-area">
        <div class="row align-items-center ">
          <div class="col-8 text-right" >
            <span class="label">下一站</span>
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

      <!-- 主要車站文字 區塊 -->
      <div class="col-8 main-sta-area">
        <div class="box" style="overflow:hidden;">
          <span class="name CH" v-bind:class="GetMainStaClass('CH')" v-bind:style="GetMainStaStyle('CH')">
            {{GetCurrSta('CH')}}
          </span>
          <span class="name EN" v-bind:class="GetMainStaClass('EN')" v-bind:style="GetMainStaStyle('EN')">
            <span class="text" v-bind:style="'transform:scaleX('+GetScaleX()+')'">{{GetCurrSta('EN')}}</span>
          </span>
          <span class="name JP" v-bind:class="GetMainStaClass('JP')">
            <span class="text" style="transform:scaleX(.65);">{{GetCurrSta('JP')}}</span>
          </span>
          <span class="name KR" v-bind:class="GetMainStaClass('KR')">
              <span class="text" style="transform:scaleX(1);">{{GetCurrSta('KR')}}</span>
          </span>
        </div>
      </div>
      <button @click="ToggleStaLang(1)" type="button" name="button">換語言</button>
      <button @click="Toggle(-1)" type="button" name="button"><</button>
      <button @click="Toggle(1)" type="button" name="button">></button>
    </div>
    <!-- 中間顏色分割線 -->
    <div class="row divide-line bg-color-blue"></div>

    <!-- 底部區塊 -->
    <div class="row btm-area">


    </div>
  </div>
  <?php require_once 'js.php'?>
  <script type="text/javascript">
  var vm = new Vue({
    el: "#display",
    data:{
      stations: [],
      transfers: [],
      color: 'R',
      currSta: 0,
      mainStaLang: 0,
      mainStaLangTimer: null,
      mainStaLangTimerDelay: 2000,
      mainStaLangList:['CH','EN'],
    },
    created:function(){
      this.GetStations();
      this.GetTransfers();
    },
    mounted:function(){
      // 設置主要車站Timer
      this.mainStaLangTimer = setInterval(() => {
          this.ToggleStaLang()
      }, this.mainStaLangTimerDelay)
    },
    methods:{
      ResetMainStaLang: function() {   // 重設主要車站Timer
        clearInterval(this.mainStaLangTimer);
        this.mainStaLangTimer = setInterval(() => {
          this.ToggleStaLang()
        }, this.mainStaLangTimerDelay)
      },
      ToggleStaLang: function(d=1){ // 切換主要車站語言狀態
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
      GetMainStaClass:function(lang){ // 取得主要站名進入或離開動畫
        if(lang==this.mainStaLangList[this.mainStaLang]){
          return 'name-enter-active';
        }
        else{
          return 'name-leave-active';
        }
      },
      GetMainStaStyle:function(lang){ // 取得主要站名進入或離開style
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
        s=this.stations[this.currSta];
        switch (lang) {
          case 'CH': return s.Name;
          case 'EN': return s.Name_EN;
          default  : return '';
        }
      },
      GetScaleX:function(){
        var originalWidth = $('.main-sta-area .box .name.EN .text').outerWidth();
        return Math.min((730 / originalWidth), 1);
      },
      GetNum:function(num){ // 取得車站編號（個位數補0）
        return (num<10)?'0'+num:num;
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
