var mqtt= require('mqtt');
var client = mqtt.connect("mqtt://broker.hivemq.com");

const express = require('express');
var cors = require('cors');
 const app= express();
//Tạo HTTP server listening ở port 3001
const server1 = app.listen(3001, () => {
console.log(`Express running → PORT ${server1.address().port}`);
});
 
//Xử lý route phương thức GET khi nhận dữ liệu điều khiển từ website với URL
//có dạng là: http://localhost:3001/control?RL={relay}&val={state}
//với {relay} là số thứ tự hoặc tên relay và {state} là trạng thái relay
app.get('/control', function (req, res) {
var led1 = req.query.LED1;
var led2 = req.query.LED2;
 if(led1=='1')
 {
console.log("1");
var cmd_str = "1";

 }
 if(led1=='0')
 {
console.log("0");
var cmd_str = "0";
 }
 if(led2=='1')
 {
console.log("2");
var cmd_str = "2";
 }
 if(led2=='0')
 {
console.log("3");
var cmd_str = "3";

 }
//Tạo chuỗi dữ liệu
//var cmd_str = "RL" + rl + val;
//var cmd_str =  "{\"led1\":\""+led1 +"\",\"led2\":\""+led2+"\"}";
//Publish đến thiết bị
 client.publish('set_kvt_123', cmd_str, function(err) {
 if (err) {
 res.send("FAILED");
 }
 else {
 res.send("OK");
 }
 });
})
////////////////////////////

var mysql= require('mysql')
var db= mysql.createConnection({
    host : 'localhost',
    user: 'kvt_123',
    password : "12345678",
    database : 'thuchanh'
})
db.connect(()=>{
    console.log('database connection.....')
})
// lấy thời gian
var today = new Date();//khai báo biến thời gian.
var h = today.getHours();//lấy dữ liệu ra
      var m = today.getMinutes();
      var s = today.getSeconds();
var gio=  h + ":" + m + ":" + s;
//ngay
var d = today.getDate();//lấy dữ liệu ra
      var mt = today.getMonth();
      var y = today.getFullYear();
var ngay=  y + "-" + mt + "-" + d;    
//////////////
client.on("connect",function(){
   client.subscribe("kvt_123");
   console.log("successfully");
});
client.on("message",function(topic,message){
    console.log(message.toString());
     var Obj = JSON.parse(message);
       var dbstat = 'insert into thuchanh1 set ?'
       var data = {
           ADC0 : Obj.adc0,
          ADC1 : Obj.adc1,
           LED1 : Obj.LED1,
           LED2 : Obj.LED2,
           Date : ngay,
           Time : gio
       }
       db.query(dbstat,data,(error,output)=>{
           if(error){
               console.log(error)

           }else{
               console.log('data saved to database!')
           }

       })
       
    /////////////////////////////////////
    
    // var Obj = JSON.parse(message);

    //   var sql = "INSERT INTO logs (nhietdo, doam, anhsang)"
    //   "VALUES ('"+Obj.nhietdo + "', '"+ Obj.doam + "', '"+ Obj.anhsang+ "')"
    //   db.query(sql, function (err, result) {
    //      if (err) throw err;
    //      console.log("Insert relay data successfull!"); 
    //      });

    //client.end()
})