<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MRT Display 1.0 Beta</title>
  <?php include 'style.php'?>
</head>

<body>
  <div id="display" class="container-fluid px-0">
    <!-- 頂部區塊 -->
    <div class="container-fluid top-area pt-4" >
      <div class="row justify-content-between align-items-center">
        <!-- 終點站 區塊 -->
        <div class="col-4 col-lg-6 terminal-area">
          <div  class="row no-gutters">
            <div class="col-6 col-lg-3 text-center">
              <span class="label" :class="GetAniClass('CH', 'fade')">終  點</span>
              <span class="label" :class="GetAniClass('EN', 'fade')" :style="GetTerminalLabelStyle('EN')">To</span>
            </div>
            <div class="col-6 col-lg-auto">
              <div class="box" :class="GetAniClass('CH', 'fade')" >
                <span class="badge badge-dark name CH px-3"
                :style="GetLineColorStyle(stations[curr].ColorCode, stations[curr].TextColorCode)"><span>{{GetTerminal('CH')}}</span></span>
              </div>
              <div class="box" :class="GetAniClass('EN', 'fade')" :style="GetTerminalBoxStyle('EN')">
                <span class="badge badge-dark name EN px-4"
                :style="GetLineColorStyle(stations[curr].ColorCode, stations[curr].TextColorCode)"><span>{{GetTerminal('EN')}}</span></span>
              </div>
              <div class="box" :class="GetAniClass('JP', 'fade')" :style="GetTerminalBoxStyle('JP')">
                <span class="badge badge-dark name JP px-3"
                :style="GetLineColorStyle(stations[curr].ColorCode, stations[curr].TextColorCode)"><span>{{GetTerminal('JP')}}ディンプー</span></span>
              </div>
              <div class="box" :class="GetAniClass('KR', 'fade')" :style="GetTerminalBoxStyle('KR')">
                <span class="badge badge-dark name KR px-3"
                :style="GetLineColorStyle(stations[curr].ColorCode, stations[curr].TextColorCode)"><span>{{GetTerminal('KR')}}딩푸</span></span>
              </div>
            </div>
            <div class="col-6 col-lg-3 text-left">
              <span class="label" :class="GetAniClass('JP', 'fade')">ゆき</span>
              <span class="label" :class="GetAniClass('KR', 'fade')" :style="GetTerminalLabelStyle('KR')">행</span>
            </div>
          </div>
        </div>
        <!-- 車號 區塊 -->
        <div class="col-5 col-lg-3 car-num-area text-right">
          <span class="label ch" :class="GetAniClass('EN', 'fade')">Car No.</span>
          <span class="badge badge-dark badge-pill num">{{carNum}}</span>
          <span class="label ch mr-5"  :class="GetAniClass('CH', 'fade')" style="letter-spacing:.3rem;">號車</span>
        </div>
      </div>
      <div class="row align-items-center">
        <!-- 主車站編號 區塊 -->
        <div class="col-4 main-sta-num-area">
          <div class="row align-items-center ">
            <div class="col-8 text-center" >
              <span class="label" :class="GetAniClass('CH', 'fade')">下一站</span>
              <span class="label" :class="GetAniClass('EN', 'fade')" :style="GetMainStaNumStyle('EN')">Next</span>
              <span class="label" :class="GetAniClass('JP', 'fade')" :style="GetMainStaNumStyle('JP')">つぎは</span>
              <span class="label" :class="GetAniClass('KR', 'fade')" :style="GetMainStaNumStyle('KR')">다음은</span>
            </div>
            <div class="col text-left">
              <span class="num badge" style="min-width:4.5rem;"
              :style="GetLineColorStyle(stations[curr].ColorCode, stations[curr].TextColorCode)">
              {{stations[curr].Color}}<br>{{GetNum(stations[curr].Num)}}</span>
            </div>
          </div>
        </div>

        <!-- 主車站文字 區塊 -->
        <div class="col-8 main-sta-area">
          <div class="box" style="overflow:hidden;">
            <span class="name CH" :class="GetAniClass('CH')" :style="GetMainStaStyle('CH')">
              <span class="text" :style="GetMainStaTextStyle('CH')">{{GetCurr('CH')}}</span>
            </span>
            <span class="name EN" :class="GetAniClass('EN')" :style="GetMainStaStyle('EN')">
              <span class="text" :style="GetMainStaTextStyle('EN')">{{GetCurr('EN')}}</span>
            </span>
            <span class="name JP" :class="GetAniClass('JP')" :style="GetMainStaStyle('JP')">
              <span class="text" :style="GetMainStaTextStyle('JP')">{{GetCurr('JP')}}</span>
            </span>
            <span class="name KR" :class="GetAniClass('KR')" :style="GetMainStaStyle('KR')">
              <span class="text" :style="GetMainStaTextStyle('KR')">{{GetCurr('KR')}}</span>
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- 中間顏色分割線 -->
    <div class="divide-line" :style="GetLineColorStyle(stations[curr].ColorCode, stations[curr].TextColorCode)"></div>

    <!-- 底部區塊 -->
    <div class="btm-area" >
      <!-- 副站名 -->
      <div class="container sub-sta-area">
        <div class="row name-area align-items-end">
          <template v-for="index in 7">
            <div class="col" :class="{'passed-sta':(index==1)}">
              <div class="box" :class="'box'+index" >
                <!-- 副站名CH -->
                <div class="name CH" v-show="IsSubStaShow('CH')">
                  <span class="text" :style="GetSubStaTextStyle('CH',index)">
                    {{GetSubStaName('CH',index-2)}}
                  </span>
                </div>
                <!-- 副站名EN-->
                <div class="name EN" v-show="IsSubStaShow('EN')" >
                  <span class="text" :style="GetSubStaTextStyle('EN',index)" v-html="GetSubStaName('EN',index-2)"></span>
                </div>
                <div class="num">{{GetSubStaNum(index-2)}}</div>
              </div>
            </div>
          </template>
        </div>
      </div>
      <!-- 軌道條(預計時間) -->
      <div class="container-fluid sub-sta-area position-relative"  style="z-index:1" >
        <div class="container" >
          <div class="row route-area align-items-center">
            <template v-for="index in 7" >
              <div class="col text-center" style="z-index:999">
                <div class="time-box rounded" :class="{'passed-sta':(index==1)}">
                  <span class="text" v-if="!(index==1)">{{index*2}}</span>
                </div>
              </div>
            </template>
          </div>
        </div>
        <div class="container" style=" height:3.4rem; margin-top:-3.4rem" :style="GetLineColorStyle(stations[curr].ColorCode, stations[curr].TextColorCode)">
          <div class="row">
            <template v-for="index in 7" style=" ">
              <div class="col my-0" style="height:3.4rem; z-index:5;">
                <!-- 灰塊 -->
                <div v-if="index==1" style="background:gray; height:100%; z-index:999; transform:translateX(0%)">
                  <div v-if="index==1" style="background:gray; height:100%; transform:translateX(-99%)"></div>
                </div>
                <!-- 藍塊 -->
                <div class="py-0 position-relative" v-if="index==7" style="background:white; transform:translateX(100%)">
                  <div class="position-absolute" style=" height:100%;z-index:999; display:flex;align-items:center;justify-content:center;">
                    <span style="transform:translateX(-1.5rem)">(分)</span>
                  </div>
                  <div class="my-0 route-arrow" style="z-index:100; transform:translateX(0)" :style="GetRouteArrowStyle()"></div>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>

      <!-- 轉乘資訊 -->
      <div class="container py-1">
        <div class="row trans-area">
          <template v-for="index in 7">
            <div class="col">
              <div class="trans" v-for="tran in GetSubStaTransfer(index-2)">
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <span class="badge line-icon " v-bind:style="GetLineColorStyle(tran.TransferColorCode,tran.TransferTextColorCode)" >
                      {{tran.TransferColor}}
                    </span>
                  </div>
                  <div class="col">
                    <span class="text CH" v-if="IsSubStaShow('CH')">{{tran.TransferName}}線</span>
                    <span class="text EN" v-if="IsSubStaShow('EN')">{{tran.TransferName_EN}} Line</span>
                  </div>
                </div>
              </div>
              <div class="trans" v-for="tran in GetSubStaTransferOther(index-2)">
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <span class="badge line-icon other" v-bind:style="'background:'+ tran.TransferColorCode" >
                      <img class="img-fluid" :src="tran.Icon">
                    </span>
                  </div>
                  <div class="col">
                    <span class="text CH" v-if="IsSubStaShow('CH')">{{tran.Name}}</span>
                    <span class="text EN" v-if="IsSubStaShow('EN')">{{tran.Name_EN}}</span>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
    <div style="height:5rem;">
    </div>
    <!-- 控制器 -->
    <div class="container my-3">
      <span hidden>{{timerCounter}}</span>
      <div class="card">
        <div class="card-body">
          <button @click="ToggleMainStaLang(1)" type="button" class="btn btn-dark">Toggle Main</button>
          <button @click="ToggleSubStaLang(1)" type="button" class="btn btn-dark">Toggle Sub</button>
          <button @click="ToggleDirection()" type="button" class="btn btn-dark">切換行車方向</button>
          <select v-model="color" @change="ResetSta()" class="form-control d-inline-block" style=" width:5rem;">
            <template v-for="l in lines">
              <option :value="l.Color">{{l.Color}}</option>
            </template>
          </select>
          <div class="btn-group">
            <button @click="Toggle(-1)" type="button" class="btn btn-dark"><</button>
            <button @click="Toggle(1)" type="button" class="btn btn-dark">></button>
            <input v-model="curr" @keyup.left="Toggle(-1)" @keyup.right="Toggle(1)">
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once 'js.php'?>
  <script src="js/display.js"></script>
</body>

</html>
