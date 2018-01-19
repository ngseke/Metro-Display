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
      <div class="row justify-content-between ">
        <!-- 終點站 區塊 -->
        <div class="col-4 col-lg-6 terminal-area" >
          <div class="row ">
            <div class="col-6 col-lg-3">
              <div class="box" >
                <div class="label" :class="GetAniClass('CH', 'fade')"><span>終 點</span></div>
                <div class="label" :class="GetAniClass('EN', 'fade')"><span>To</span></div>
              </div>
            </div>
            <div class="col-6 col-lg-6">
              <div class="box" >
                <span class="badge badge-dark name CH px-3" :style="GetLineColorStyle()" :class="GetAniClass('CH', 'fade')">
                  <span>{{GetTerminal('CH')}}</span>
                </span>
                <span class="badge badge-dark name EN px-4" :style="GetLineColorStyle()" :class="GetAniClass('EN', 'fade')">
                  <span>{{GetTerminal('EN')}}</span>
                </span>
                <span class="badge badge-dark name JP px-4" :style="GetLineColorStyle()" :class="GetAniClass('JP', 'fade')">
                  <span>{{GetTerminal('JP')}}</span>
                </span>
                <span class="badge badge-dark name KR px-4" :style="GetLineColorStyle()" :class="GetAniClass('KR', 'fade')">
                  <span>{{GetTerminal('KR')}}</span>
                </span>
              </div>
            </div>
            <div class="col-6 col-lg-3 text-left" >
            </div>
          </div>
        </div>
        <!-- 車號 區塊 -->
        <div class="col-5 col-lg-3 car-num-area">
          <div class="row no-gutters">
            <div class="col">
              <div class="box text-right">
                <span class="label EN" :class="GetAniClass('EN', 'fade')">
                  <span>Car No.</span>
                </span>
              </div>
            </div>
            <div class="col-auto">
              <span class="badge badge-dark badge-pill num">{{carNum}}</span>
            </div>
            <div class="col">
              <div class="box text-left">
                <span class="label CH" :class="GetAniClass('CH', 'fade')">
                  <span>號車</span>
                </span>
                <span class="label JP" :class="GetAniClass('JP', 'fade')">
                  <span>号車</span>
                </span>
                <span class="label KR" :class="GetAniClass('KR', 'fade')">
                  <span>호차</span>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row align-items-center">
        <!-- 主車站編號 區塊 -->
        <div class="col-4 main-sta-num-area">
          <div class="row align-items-center">
            <div class="col-8 text-center" >
              <div class="wrapper" style="height:4rem;">
                <div class="box" >
                  <div class="label" :class="GetAniClass('CH', 'fade')"><span>下一站</span></div>
                  <div class="label" :class="GetAniClass('EN', 'fade')"><span>Next</span></div>
                  <div class="label" :class="GetAniClass('JP', 'fade')"><span>つぎは</span></div>
                  <div class="label" :class="GetAniClass('KR', 'fade')"><span>다음은</span></div>
                </div>
              </div>
            </div>
            <div class="col text-left">
              <span class="num badge"
              :style="GetLineColorStyle()">
              {{stations[curr].Color}}<br>{{GetNum(stations[curr].Num)}}</span>
            </div>
          </div>
        </div>

        <!-- 主車站文字 區塊 -->
        <div class="col-8 main-sta-area">
          <div class="box" >
            <span class="name CH" :style="GetMainStaStyle('CH')" :class="GetAniClass('CH')">
              <span class="text" :style="GetMainStaTextStyle('CH')">{{GetCurr('CH')}}</span>
            </span>
            <span class="name EN" :style="GetMainStaStyle('EN')" :class="GetAniClass('EN')">
              <span class="text" :style="GetMainStaTextStyle('EN')">{{GetCurr('EN')}}</span>
            </span>
            <span class="name JP" :style="GetMainStaStyle('JP')" :class="GetAniClass('JP')">
              <span class="text" :style="GetMainStaTextStyle('JP')">{{GetCurr('JP')}}</span>
            </span>
            <span class="name KR" :style="GetMainStaStyle('KR')" :class="GetAniClass('KR')">
              <span class="text" :style="GetMainStaTextStyle('KR')">{{GetCurr('KR')}}</span>
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- 中間顏色分割線 -->
    <div class="divide-line" :style="GetLineColorStyle()"></div>

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
                <div class="name JP" v-show="IsSubStaShow('JP')" >
                  <span class="text" :style="GetSubStaTextStyle('JP',index)" v-html="GetSubStaName('JP',index-2)"></span>
                </div>
                <div class="name KR" v-show="IsSubStaShow('KR')" >
                  <span class="text" :style="GetSubStaTextStyle('KR',index)" v-html="GetSubStaName('KR',index-2)"></span>
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
        <div class="container" style=" height:3.4rem; margin-top:-3.4rem" :style="GetLineColorStyle()">
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
                    <span style="transform:translate(-1.5rem, .5rem)" v-if="IsSubStaShow('CH')">分</span>
                    <span style="transform:translate(-1.5rem, .5rem)" v-if="IsSubStaShow('EN')">Min</span>
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
                    <span class="text JP" v-if="IsSubStaShow('JP')">{{tran.TransferName}}線</span>
                    <span class="text KR" v-if="IsSubStaShow('KR')">{{tran.TransferName}}선</span>
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
      <div class="text-warning">
        {{mainStaLangPlayed}}
      </div>
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
          <a href="db.php" target="_blank" class="btn btn-warning">DB</a>
        </div>
      </div>
    </div>
  </div>

  <?php require_once 'js.php'?>
  <script src="js/display.js"></script>
</body>

</html>
