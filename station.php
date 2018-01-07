<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include 'style.php'?>
  <title>All Stations</title>
</head>

<body>
  <div class="container my-3">
    <div id="station" class="row">
      <!-- <button type="button" name="button" v-on:click="AddTransfer()">Set Trans</button> -->

      <div class="col-4 my-1" v-for="sta in stations">
        <div class="card">
          <div class="card-body row" >
            <div class="col-2">
              <span class="badge " style="min-width:1.8rem" v-bind:style=" GetLineColorStyle(sta.ColorCode, sta.TextColorCode)" >
                {{sta.Color}}<br>{{sta.Num}}
              </span>
            </div>
            <div class="col">
              <h2 class="mb-1" style=" font-weight:500;">{{sta.Name}}</h2>
              <h6  style=" font-weight:500;">{{sta.Name_EN}}</h6>
              <p class="my-0 mt-2" v-for="tran in sta.Transfer">
                <span class="badge align-bottom" style="height:1.5rem;width:1.5rem;padding:.35rem 0;" v-bind:style="GetLineColorStyle(tran.TransferColorCode,tran.TransferTextColorCode)" >
                  {{tran.TransferColor}}
                </span> {{tran.TransferName}}線
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php require_once 'js.php'?>
  <script type="text/javascript">
    var vm = new Vue({
      el: "#station",
      data:{
        stations: null,
        transfers: null,
        color: 'BL'
      },
      created:function(){
        this.GetStations();
        this.GetTransfers();
        // $.get('db.php');
      },
      methods:{
        GetStations: function(){     // 取得Stations
          var self = this;
          $.ajax({
            url: 'get_station.php',
            data: { Color: this.color, Num: ''} ,
            success: function(data){
              self.stations = JSON.parse(data)
            },
            async: false
          });
          // $.get('get_station.php' , { Color: this.color, Num: ''} ,
          //   function(data){
          //     self.stations = JSON.parse(data)
          // });
        },
        GetTransfers: function(){  // 取得Transfers
          var self = this;
          $.ajax({
            url: 'get_transfer.php',
            data: { Color: this.color },
            success: function(data){
              self.transfers = JSON.parse(data)
            },
            async: false
          });
          this.AddTransfer();
          // $.get('get_transfer.php' , { Color: this.color } ,
          //   function(data){
          //     self.transfers = JSON.parse(data)
          // });

        },
        AddTransfer: function(){
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
        GetLineColorStyle: function(bg,text){
          var style = 'background-color:' + bg + ';';
          style+= 'color:' + text + ';';
          return style;
        }
      }
    });
  </script>
</body>
</html>
