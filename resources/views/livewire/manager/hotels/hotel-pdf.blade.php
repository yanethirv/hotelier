<!DOCTYPE html>
<html>
<head>
    <title>Title From OnlineWebTutorBlog</title>
    
    <style>
        

/* =============================================================
   GENERAL STYLES
 ============================================================ */
body {
    font-family: 'Open Sans', sans-serif;
    font-size:16px;
    line-height:30px;
}
.pad-top-botm {
    padding-bottom:40px;
    padding-top:60px;
}
h4 {
    text-transform:uppercase;
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
    font-size:15px;
}

.ttl-amts {
    text-align:right;
    padding-right:50px;
}
    </style>
</head>
<body>             
    <div class="container">
        <div class="row pad-top-botm ">
            <div class="col-lg-6 col-md-6 col-sm-6 ">
                <img src="{{ asset('storage/'.$logo) }}" style="width: 100px; height: 100px">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <br>
                <strong>{{ $name }}</strong>
                <br>
                <i>Address :</i> {{ $address }}
                <br>
                
                <br>
                {{ $country_id }}
            </div>
        </div>
        <div class="row text-center contact-info">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <hr>
                <span>
                    <strong>Email : </strong>  brian@brianbossierdesign.com 
                </span>
                <span>
                    <strong>Call : </strong>  +1-623-777-9044 
                </span>
                    <span>
                    <strong>Fax : </strong>  +012340-908- 890 
                </span>
                <hr>
            </div>
        </div>
        <div class="row pad-top-botm client-info">
            <div class="col-lg-6 col-md-6 col-sm-6">
            <h4>  <strong>Client Information</strong></h4>
                <strong> Classy Client</strong>
                <br>
                        <b>Address :</b> 111 , their street name,
                    <br>
                    United States.
                <br>
                <b>Call :</b> +1-908-567-0987
                    <br>
                <b>E-mail :</b> info@clientdomain.com
            </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                
                    <h4>  <strong>Payment Details </strong></h4>
                <b>Bill Amount :  990 USD </b>
                    <br>
                    Bill Date :  01th August 2014
                    <br>
                    <b>Payment Status :  Paid </b>
                    <br>
                    Delivery Date :  10th August 2014
                    <br>
                    Purchase Date :  30th July 2014
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>STYLE</th>
                                        <th>COLOR</th>
                                        <th>Quantity.</th>
                                        <th>Unit Price</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>SHOE DESIGN 2</td>
                                        <td>BLACK</td>
                                        <td>3</td>
                                        <td>$435 USD</td>
                                        <td>$1,305 USD</td>
                                    </tr>
                                    <td>SHOE DESIGN 1</td>
                                        <td>Website Design</td>
                                        <td>3</td>
                                        <td>$435 USD</td>
                                        <td>$1,305 USD</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Hosting Domains</td>
                                        <td>2</td>
                                        <td>100 USD</td>
                                        <td>200 USD</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                    </div>
                <hr>
                <div class="ttl-amts">
                    <h5>  Total Amount : 900 USD </h5>
                </div>
                <hr>
                    <div class="ttl-amts">
                        <h5>  Tax : 90 USD ( by 10 % on bill ) </h5>
                </div>
                <hr>
                    <div class="ttl-amts">
                        <h4> <strong>Bill Amount : 990 USD</strong> </h4>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <strong> Important: </strong>
               <ol>
                    <li>
                      This is an electronic generated invoice so doesn't require any signature.
  
                   </li>
                   <li>
                       Please read all terms and polices on  www.yourdomaon.com for returns, replacement and other issues.
  
                   </li>
               </ol>
               </div>
           </div>
        <div class="row pad-top-botm">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <hr>
                <a href="#" class="btn btn-primary btn-lg">Print Invoice</a>
                &nbsp;&nbsp;&nbsp;
                    <a href="#" class="btn btn-success btn-lg">Download In Pdf</a>
    
            </div>
        </div>
   </div>                
   {{-- <div style="text-align: center;">
       <img src="{{ asset('storage/'.$logo) }}" style="width: 100px; height: 100px">
    </div>
    <h1>Name: {{ $name }}</h1>
    <h3>Description: {{ $description }}</h3>
    <h3>Category: {{ $category_id }}</h3>
    --}} 
</body>
</html>