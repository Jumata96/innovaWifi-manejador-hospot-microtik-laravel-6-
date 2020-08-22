@extends('layouts2.app')
@section('titulo','Inicio')

@section('container')
	<!--start container-->
          <div class="container">
            <!--card stats start-->
            <div id="card-stats">
              <div class="row">
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">add_shopping_cart</i>
                        <p>Orders</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">690</h5>
                        <p class="no-margin">New</p>
                        <p>6,00,00</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">perm_identity</i>
                        <p>Clients</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">1885</h5>
                        <p class="no-margin">New</p>
                        <p>1,12,900</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">timeline</i>
                        <p>Sales</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">80%</h5>
                        <p class="no-margin">Growth</p>
                        <p>3,42,230</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">attach_money</i>
                        <p>Profit</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">$890</h5>
                        <p class="no-margin">Today</p>
                        <p>$25,000</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--card stats end-->
            <!--yearly & weekly revenue chart start-->
            <div id="sales-chart">
              <div class="row">
                <div class="col s12 m8 l8">
                  <div id="revenue-chart" class="card">
                    <div class="card-content">
                      <h4 class="header mt-0">REVENUE FOR 2017
                        <span class="purple-text small text-darken-1 ml-1">
                          <i class="material-icons">keyboard_arrow_up</i> 15.58 %</span> <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                      </h4>
                      <div class="row">
                        <div class="col s12">
                          <div class="yearly-revenue-chart">
                            <canvas id="thisYearRevenue" class="firstShadow" height="350"></canvas>
                            <canvas id="lastYearRevenue" height="350"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m4 l4">
                  <div id="weekly-earning" class="card">
                    <div class="card-content">
                      <h4 class="header m-0">Earning
                        <i class="material-icons right grey-text lighten-3">more_vert</i>
                      </h4>
                      <p class="no-margin grey-text lighten-3 medium-small">Mon 15 - Sun 21</p>
                      <h3 class="header">$899.39
                        <i class="material-icons deep-orange-text text-accent-2">arrow_upward</i>
                      </h3>
                      <canvas id="monthlyEarning" class="" height="150"></canvas>
                      <div class="center-align">
                        <p class="lighten-3">Total Weekly Earning</p>
                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">View Full</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--yearly & weekly revenue chart end-->
            <!-- Member online, Currunt Server load & Today's Revenue Chart start -->
            <div id="daily-data-chart">
              <div class="row">
                <div class="col s12 m4 l4">
                  <div class="card pt-0 pb-0">
                    <div class="padding-2 ml-2">
                      <span class="new badge gradient-45deg-light-blue-cyan gradient-shadow mt-2 mr-2">+ 42.6%</span>
                      <p class="mt-2 mb-0">Members online</p>
                      <p class="no-margin grey-text lighten-3">360 avg</p>
                      <h5>3,450</h5>
                    </div>
                    <div class="row">
                      <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                        <canvas id="custom-line-chart-sample-one" class="center"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m4 l4">
                  <div class="card pt-0 pb-0">
                    <div class="padding-2 ml-2">
                      <span class="new badge gradient-45deg-purple-deep-orange gradient-shadow mt-2 mr-2">+ 12%</span>
                      <p class="mt-2 mb-0">Current server load</p>
                      <p class="no-margin grey-text lighten-3">23.1% avg</p>
                      <h5>+2500</h5>
                    </div>
                    <div class="row">
                      <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                        <canvas id="custom-line-chart-sample-two" class="center"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m4 l4">
                  <div class="card pt-0 pb-0">
                    <div class="padding-2 ml-2">
                      <span class="new badge gradient-45deg-amber-amber gradient-shadow mt-2 mr-2">+ $900</span>
                      <p class="mt-2 mb-0">Today's revenue</p>
                      <p class="no-margin grey-text lighten-3">$40,512 avg</p>
                      <h5>$ 22,300</h5>
                    </div>
                    <div class="row">
                      <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                        <canvas id="custom-line-chart-sample-three" class="center"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Member online, Currunt Server load & Today's Revenue Chart start -->
            <!-- ecommerce product start-->
            <div id="ecommerce-product">
              <div class="row">
                <div class="col s12 m4">
                  <div class="card">
                    <div class="card-content  center">
                      <h6 class="card-title font-weight-400 mb-0">Apple Watch</h6>
                      <img src="images/cards/watch.png">
                      <p>
                        <b>The Apple Watch</b>
                      </p>
                      <p>One day only exclusive sale on our marketplace</p>
                    </div>
                    <div class="card-action border-non center">
                      <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan box-shadow">$ 999/-</a>
                    </div>
                  </div>
                </div>
                <div class="col s12 m4">
                  <div class="card">
                    <div class="card-content">
                      <span class="card-title center-align">Music</span>
                      <img src="images/cards/headphones-2.png">
                    </div>
                    <div class="card-action pt-0">
                      <p class="">Default Quality</p>
                      <div class="chip">
                        192kb
                        <i class="close material-icons">close</i>
                      </div>
                      <div class="chip">
                        320kb
                        <i class="close material-icons">close</i>
                      </div>
                    </div>
                    <div class="card-action pt-0">
                      <p class="">Save Video Quality</p>
                      <div class="switch">
                        <label>
                          Off
                          <input type="checkbox">
                          <span class="lever"></span>
                          On
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m4">
                  <div class="card">
                    <div class="card-content center">
                      <h6 class="card-title font-weight-400 mb-0">iPhone</h6>
                      <img src="images/cards/iphonec.png">
                      <p>
                        <b>The Apple iPhone X</b>
                      </p>
                      <p>One day only exclusive sale on our marketplace</p>
                    </div>
                    <div class="card-action border-non center">
                      <a class="waves-effect waves-light btn gradient-45deg-red-pink box-shadow">$ 299/-</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ecommerce product end-->
              <!-- ecommerce offers start-->
              <div id="ecommerce-offer">
                <div class="row">
                  <div class="col s12 m3">
                    <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3">
                      <div class="card-content center">
                        <img src="images/icon/apple-watch.png" class="width-40 border-round z-depth-5">
                        <h5 class="white-text lighten-4">50% Off</h5>
                        <p class="white-text lighten-4">On apple watch</p>
                      </div>
                    </div>
                  </div>
                  <div class="col s12 m3">
                    <div class="card gradient-shadow gradient-45deg-red-pink border-radius-3">
                      <div class="card-content center">
                        <img src="images/icon/printer.png" class="width-40 border-round z-depth-5">
                        <h5 class="white-text lighten-4">20% Off</h5>
                        <p class="white-text lighten-4">On Canon Printer</p>
                      </div>
                    </div>
                  </div>
                  <div class="col s12 m3">
                    <div class="card gradient-shadow gradient-45deg-amber-amber border-radius-3">
                      <div class="card-content center">
                        <img src="images/icon/laptop.png" class="width-40 border-round z-depth-5">
                        <h5 class="white-text lighten-4">40% Off</h5>
                        <p class="white-text lighten-4">On apple macbook</p>
                      </div>
                    </div>
                  </div>
                  <div class="col s12 m3">
                    <div class="card gradient-shadow gradient-45deg-green-teal border-radius-3">
                      <div class="card-content center">
                        <img src="images/icon/bowling.png" class="width-40 border-round z-depth-5">
                        <h5 class="white-text lighten-4">60% Off</h5>
                        <p class="white-text lighten-4">On any game</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ecommerce offers end-->
              <!-- //////////////////////////////////////////////////////////////////////////// -->
            </div>
            <!--end container-->
        
@endsection