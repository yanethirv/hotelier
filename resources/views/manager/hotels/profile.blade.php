<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hotel Profile</title>
    
    <style>
/* =============================================================
   GENERAL STYLES
 ============================================================ */
body {
    font-family: 'Open Sans', sans-serif;
    line-height:30px;
}

.pad-top-botm {
    padding-bottom:10px;
    padding-top:10px;
}
h4 {
    text-transform:uppercase;
    color: #1e429f;
}
/* =============================================================
   PAGE STYLES
 ============================================================ */

.contact-info span {
    font-size:14px;
    padding:0px 50px 0px 50px;
}

.contact-info hr {
    margin-top: 0px;
    margin-bottom: 0px;
}

.client-info {
    font-size:18px;
}

.ttl-amts {
    text-align:right;
    padding-right:50px;
}

b {
    color: #3a3939
}

h2 {
    color: #3a3939
    font-size:22px;
}


.w3-card-4,.w3-hover-shadow:hover{box-shadow:0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19)}

.w3-container,.w3-panel{padding:0.01em 16px}.w3-panel{margin-top:8px;margin-bottom:8px}

.w3-light-grey,.w3-hover-light-grey:hover,.w3-light-gray,.w3-hover-light-gray:hover{color:#000!important;background-color:#f1f1f1!important}

.w3-left{float:left!important}.w3-right{float:right!important}

.w3-margin-left{margin-left:16px!important}.w3-margin-right{margin-right:16px!important}


</style>
</head>

<body>
    <div class="container">
        <div class="row pad-top-botm ">
           <div class="col-lg-6 col-md-6 col-sm-6 ">
              <!--<img src="assets/img/logo.jpg" style="padding-bottom:20px;"> -->
              <img src="{{ asset('storage/'.$hotel->logo) }}" style="width: 100px; height: 100px">
           </div>
        </div>

        <div class="row pad-top-botm client-info">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h2>HOTEL DETAILS</h2>
                <h4><strong>General</strong></h4>
                <b>Name: </b>{{ $hotel->name }}
                <br>
                <b>Room Range: </b>{{ $hotel->roomRange->name }}
                <br>
                <b>Category: </b>{{ $hotel->category->name }}
                <br>
                <b>Description: </b>{{ $hotel->description }}</p>
                <br>
                <b>Stars: </b> {{ $hotel->stars }}
                <br>
                <b>Opening Date :</b> {{ $hotel->opening_date }}
                <br>
                <b>Floor Number :</b> {{ $hotel->floor_number }}
                <br>
                <b>Experiences :</b>    @foreach($experiences as $value)
                                            {{$value->name}}, 
                                        @endforeach
                <br>
                <b>Amenities :</b>      @foreach($amenities as $value)
                                            {{$value->name}}, 
                                        @endforeach  
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4><strong>Social</strong></h4>
                <b>Instagram: </b>{{ $hotel->instagram }}
                <br>
                <b>Facebook: </b>{{ $hotel->facebook }}</p>
                <br>
                <b>LinkedIn: </b> {{ $hotel->linkedin }}
                <br>
                <b>Youtube: </b> {{ $hotel->youtube }}
                <br>
                <b>Twitter :</b> {{ $hotel->twitter }}
            </div>
        </div>

        <div class="row client-info">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4><strong>Contact</strong></h4>
                <b>Front Desk Phone: </b>{{ $hotel->frontdesk_phone }}
                <br>
                <b>Reservation Phone: </b>{{ $hotel->reservation_phone }}</p>
                <br>
                <b>Front Desk Email: </b> {{ $hotel->frontdesk_email }}
                <br>
                <b>Reservation Email: </b> {{ $hotel->reservation_email }}
                <br>
                <b>Billing Contact Email :</b> {{ $hotel->billing_email }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4><strong>Location</strong></h4>
                <b>Country: </b>{{ $hotel->country->name }}
                <br>
                <b>State: </b>{{ $hotel->state }}</p>
                <br>
                <b>City: </b> {{ $hotel->city }}
                <br>
                <b>Address: </b> {{ $hotel->address }}
            </div>
        </div>
    </div>
</body>
</html>