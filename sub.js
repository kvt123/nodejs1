var mqtt= require('mqtt');
var client = mqtt.connect("mqtt://broker.hivemq.com");

//// my sql
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
