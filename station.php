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
  <div class="container mt-3">
    <div id="station" class="row">

      <div class="col-12" hidden>
        <ul class="list-group" >
          <li class="list-group-item" v-for="sta in stations">
            <span class="badge text-light" style="min-width:1.8rem" v-bind:style=" 'background:' + sta.ColorCode" >
              {{sta.Color}}<br>{{sta.Num}}
            </span>
            <span>{{sta.Name}}</span>
            <small>{{sta.Name_EN}}</small>
          </li>
        </ul>
      </div>

      <div class="col-3 my-1" v-for="sta in stations">
        <div class="card">
          <div class="card-body row" >
            <div class="col-2">
              <span class="badge text-light" style="min-width:1.8rem" v-bind:style=" 'background:' + sta.ColorCode" >
                {{sta.Color}}<br>{{sta.Num}}
              </span>
            </div>
            <div class="col">
              <div>{{sta.Name}}</div>
              <small>{{sta.Name_EN}}</small>
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
        stations: null
      },
      created:function(){
        this.GetStations();
      },
      methods:{
        GetStations: function(){     // 取得“商品類別Array”
          var self = this;
          $.get('get_station.php' , {ColorS: '', NumS: ''} ,
            function(data){
              self.stations = JSON.parse(data)
          });
        }
      }
    });
  </script>
</body>
</html>
