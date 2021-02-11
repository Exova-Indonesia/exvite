<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        body{
            margin-bottom: 20px;
        }
        #fotoprofile{
            width: 190px;
            border: 4px solid deepskyblue;
        }

        #profiledua {
            width: 120px; 
            border: 2px solid deepskyblue; 
            margin:auto;
        }

        #container {
            border-radius: 40px;
            box-sizing: border-box;
        }

        #navigator {
            border-radius: 20px;
            display: flex;
            justify-content: center;
        }

        #premium {
            width: 80px; height: 
            30px; 
            border: 2px solid deepskyblue;  
            border-radius: 5px;
            line-height: 25px;
            margin-right: -25px;
        }

        #userprofile{
            margin-left: 20px;
        }

        #userhelo1{
            font-size: 25px;
        }

        #userhelo2{
            font-size: 40px;
        }


        #isicon {
            display: flex;
            justify-content: center;
        }

        #navigator button.active{
            background-color: orange;
            
        }

        #akundua{
            display: flex;
        }

        #garis{
                width:125px; 
                height:5px; 
                background-color: #eee;
                border-radius: 2px;
                margin-top: 17px;
                margin-left: 10px;
            }
        


        
        @media only screen and (max-width: 600px) {
            #userhelo{
                font-size: 35px;
            }

            #akundua{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            #fotoprofile{
                width: 160px;
                border: 4px solid deepskyblue;
                margin-top: 10px;
            }

            #userhelo1{
                font-size: 153%;
            }

            #userhelo2{
                font-size: 220%;
            }
            #isi{
                padding-bottom: 50px;
            }
            #ontentifikasi{
                margin-bottom: 15px;
                order: 2;
                margin-top: -25px;
            }

            #navigator{
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }

            #navigator button.active{
                background-color: orange;
                
            }

            #akun {
                order: 1;
            }

            #notifikasi {
                order: 4;
            }


            #exwallet {
                order: 3;
                margin-bottom: 10px;
            }

            #garis {
                width: 93px;
                
            }

            
           
        }


      

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (width: 768px) {
            #userprofile {
                margin-left: 150px;
            }

            #userhelo{
                font-size: 25px;
            }

            #userhelo1{
                font-size: 20px;
            }
            #profiledua {
                width: 90px;
            }

            #userhelo2{
                font-size: 25px;
                margin-top: 10px;
            }

            #garis{
                margin-top: 13px;
                width: 100px;
            }

           
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (width: 992px) {
           

        }

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (width: 1200px) {

        }

        
    </style>

</head>
<body>

    <div class="container" id="container">
        <div class=" col-lg-11 col-md-12 col-sm-11 d-flex flex-wrap justify-content-center shadow p-3 bg-white mt-2" style="margin:auto;border-radius: 40px;
            box-sizing: border-box;">
              <div class="d-flex col-lg-3 col-md-2 col-sm-3">
                    <div class="text-center mt-1" id="premium">PREMIUM</div>
                    <img src="{{ ('img/joker.jpg') }}" alt="" class="rounded-circle"  id="fotoprofile">
                </div>
                <div class="column col-lg-4 col-md-5  col-sm-4 mt-2" id="userprofile">
                    <div class="row mt-5">
                        <p id="userhelo1">USER PROFILE</p> 
                        <div id="garis"></div>
                    </div>
                    <div style="margin-top: -30px;" class="row">
                        <p id="userhelo2">HI,PARA BUJANG</p>
                    </div>  
                </div>
        </div>
    </div>
    <!-- <div class="container p-2 mt-2 d-flex justify-content-center">
        <div class="col-lg-9 col-md-10 col-sm-10 pt-1 pb-1 bg-white shadow" id="navigator">
            <button class="tablinks ml-2 btn btn-primary btn-sm" onclick="openCity(event, 'akun')" id="defaultOpen">Akun premium</button>
            <button class="tablinks ml-2 btn btn-primary btn-sm" onclick="openCity(event, 'ontentifikasi')">Ontentifikasi</button>
            <button class="tablinks ml-2 btn btn-primary btn-sm" onclick="openCity(event, 'exwallet')">Exwallet</button>
            <button class="tablinks ml-2 btn btn-primary btn-sm" onclick="openCity(event, 'notifikasi')">Pengaturan</button> 
        </div>
    </div> -->
    <div class="container" id="isicon">
        <div class="col-lg-12 col-md-12 col-sm-10 mt-2 d-flex flex-wrap justify-content-center pt-1">
            <div class="col-lg-2 col-md-4 col-sm-2 overflow-auto tabcontent p-0 shadow" id="ontentifikasi" style="height: 400px;">
                <div class="card">
                    <div class="card-header text-center font-weight-bold" style="background-color: deepskyblue;">
                    Aktivasi Akun
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>

                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-4  p-0 tabcontent mb-5 shadow" id="akun" style="min-height: 400px;">
                <div class="card-header text-center font-weight-bold" style="background-color: deepskyblue;">
                    Tingkatkan Akun Anda Ke premium sekarang! <button type="button" class="btn btn-outline-warning btn-sm">gaskeun</button>
                </div>
                <div class="col-lg-11 col-md-12 col-sm-12 mt-2" id="akundua">
                    <div class="d-flex flex-column col-lg-6 col-md-6 col-sm-6 bg-white shadow text-center " style="border-radius: 3px;">
                            <img src="{{ ('img/joker.jpg') }}" class="rounded-circle mt-2" alt=""  id="profiledua">
                            <button  type="button"  class="btn btn-primary btn-sm mt-2" style="margin: auto;">Upload</button>
                        <div class="d-flex justify-content-between">
                            <p>xxxxx</p>
                            <p>xxxxx</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>xxxxx</p>
                            <p>xxxxx</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>xxxxx</p>
                            <p>xxxxx</p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-4 ml-1 shadow mb-4">
                        <form action="" class="mb-3">
                            <input class="form-control form-control-sm mt-2" type="text" placeholder="xxxx">
                            <input class="form-control form-control-sm mt-2" type="text" placeholder="xxxx">
                            <input class="form-control form-control-sm mt-2" type="text" placeholder="xxxxxx">
                            <input class="form-control form-control-sm mt-2" type="text" placeholder="xxxxxx">
                            <input class="form-control form-control-sm mt-2" type="text" placeholder="xxxxxxx">
                            <input class="form-control form-control-sm mt-2" type="text" placeholder="xxxxxxxx">
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-5 col-sm-3  ml-1 p-0 bg-white shadow tabcontent overflow-auto" id="exwallet" style="height: 400px;">
                <div class="card-header text-center font-weight-bold" style="background-color: deepskyblue;">
                    Exova Wallet!
                </div>
                <div class="d-flex col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-6 col-md-6 col-sm-6" style="border-radius: 3px;">
                        <p style="font-size: 12px;" class="font-weight-bold">Pendapatan</p>
                        <p style="font-size: 12px; margin-top:-15px">Rp.100.000.000</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6" style="border-radius: 3px;">
                        <p style="font-size: 12px;" class="font-weight-bold">Dana</p>
                        <p style="font-size: 12px; margin-top:-15px">Rp.100.000.000</p>
                    </div>
                </div>
                <div class="d-flex col-lg-12 col-md-12 col-sm-12">
                    <div class="col-md-8 shadow" style="border-radius: 4px;">
                        <p style="font-size: 12px;" class="font-weight-bold">Rekening Bank</p>
                        <p style="font-size: 12px; margin-top:-15px">BCA  | 190xxxxx|  takikun</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 shadow overflow-auto" style="border-radius: 4px;">
                        <p style="font-size: 10px;" class="font-weight-bold">Exwalet</p>
                        <p style="font-size: 8px; margin-top:-15px">Rp.100.000.000.000</p>
                    </div>
                </div>
                <div class="d-flex col-lg-12 col-md-12 col-sm-12 justify-content-center">
                    <div>
                        <p style="font-size: 15px;" class="font-weight-bold text-center">Total Saldo</p>
                        <p style="font-size: 20px; margin-top:-20px" class="text-center">xxxxxxxxx</p>
                    </div>
                </div>
                <div class="d-flex col-lg-12 col-md-12 col-sm-12 justify-content-center mb-5">
                    <div class="col-md-10 shadow">
                        <p class="font-weight-bold">Riwayat transaksi</p>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-5 col-sm-2 bg-white shadow ml-2 p-0 tabcontent" id="notifikasi" style="height: 400px">
                <div class="card-header text-center font-weight-bold" style="background-color: deepskyblue;">
                    Pengaturan
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-between">
                        <p  style="font-size: 15px;">Notifikasi</p>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-between">
                        <input class="form-control form-control-sm mt-2 " type="text" placeholder="ann">    
                        <div class="custom-control custom-switch mt-2 ml-3">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2"></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-between">
                        <p  style="font-size: 15px;">Ganti password set up email</p>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch3">
                            <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-between">
                        <input class="form-control form-control-sm mt-2" type="text" placeholder="">    
                        <div class="custom-control custom-switch mt-2 ml-3">
                            <input type="checkbox" class="custom-control-input" id="customSwitch4">
                            <label class="custom-control-label" for="customSwitch4"></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex justify-content-between">
                        <p  style="font-size: 15px;">Auntifikasi 2 faktor</p>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch5">
                            <label class="custom-control-label" for="customSwitch5"></label>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    

    
</body>
<script>

function myFunction(x) {
  if (x.matches) { 

    function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
             }
           
    
  } else {
   document.body.style.backgroundColor = ;
  }
}
    
var x = window.matchMedia("(min-width: 600px)")
    myFunction(x)
    x.addListener(myFunction)

 document.getElementById("defaultOpen").click(); 
    
</script>
</html>