@extends('master')
@section('content')
<link rel="stylesheet" href="{{url('/')}}/asset/css/flexslider.css" type="text/css" media="screen" />
<link href="{{url('/')}}/asset/css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="{{url('/')}}/asset/js/imagezoom.js"></script>
<script src="{{url('/')}}/asset/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="{{url('/')}}/asset/js/bootstrap-3.1.1.min.js"></script>
<style>
  .bootstrap-tab.animated.wow.slideInUp.animated {
    padding-left: 116px;
  }
  a#add-to-chart:focus {
    display: none;
  }
</style>


<!-- //banner-top -->
<!-- banner -->
<div class="page-head">
  <div class="container">
    <h3>Single</h3>
  </div>
</div>
<!-- //banner -->
<!-- single -->
<div class="single">
  <div class="container">
    <div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
      <div class="grid images_3_of_2">
        <div class="flexslider">
          <!-- FlexSlider -->
          <script>
// Can also be used with $(document).ready()
            $(window).load(function() {
              $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
              });
            });
          </script>

          <!-- //FlexSlider-->
          <ul class="slides">
            @if(file_exists("images/product/product-1-{$allpdt->id}.{$allpdt->picture1}"))
            <li data-thumb="{{url('/')}}/images/product/product-1-{{$allpdt->id}}.{{$allpdt->picture1}}">
              <div class="thumb-image"> <img src="{{url('/')}}/images/product/product-1-{{$allpdt->id}}.{{$allpdt->picture1}}" data-imagezoom="true" class="img-responsive"> </div>
            </li>
            @endif
            @if(file_exists("images/product/product-2-{$allpdt->id}.{$allpdt->picture2}"))
            <li data-thumb="{{url('/')}}/images/product/product-2-{{$allpdt->id}}.{{$allpdt->picture2}}">
              <div class="thumb-image"> <img src="{{url('/')}}/images/product/product-2-{{$allpdt->id}}.{{$allpdt->picture2}}" data-imagezoom="true" class="img-responsive"> </div>
            </li>
            @endif
            @if(file_exists("images/product/product-3-{$allpdt->id}.{$allpdt->picture3}"))
            <li data-thumb="{{url('/')}}/images/product/product-3-{{$allpdt->id}}.{{$allpdt->picture3}}">
              <div class="thumb-image"> <img src="{{url('/')}}/images/product/product-3-{{$allpdt->id}}.{{$allpdt->picture3}}" data-imagezoom="true" class="img-responsive"> </div>
            </li>
            @endif

          </ul>
          <div class="clearfix"></div>
        </div>	
      </div>
    </div>

    <div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
      <h3>{{$allpdt->title}}</h3>
      @php 
      $realprice = PriceCal($allpdt->price, $allpdt->vat, 0); 
      $discountprice = PriceCal($allpdt->price, $allpdt->vat, $allpdt->discount); 
      @endphp
      <p>
        <span class="item_price">৳ @php echo $discountprice  @endphp</span>
        @if ($discountprice != $realprice )
        <del>৳ @php echo $realprice @endphp</del>
        @endif

      <div class="rating1">
        <span class="starRating">
          <input id="rating5" type="radio" name="rating" value="5">
          <label for="rating5">5</label>
          <input id="rating4" type="radio" name="rating" value="4">
          <label for="rating4">4</label>
          <input id="rating3" type="radio" name="rating" value="3" checked="">
          <label for="rating3">3</label>
          <input id="rating2" type="radio" name="rating" value="2">
          <label for="rating2">2</label>
          <input id="rating1" type="radio" name="rating" value="1">
          <label for="rating1">1</label>
        </span>
      </div>
      @php




      //print_r(Session::get("pdtid"));
      //print_r(Session::get("qtyid"));
      $pdtid = Session::get("pdtid");
      $qtyid = Session::get("qtyid");

      if($pdtid){
      $index = array_search($allpdt->id,$pdtid);
      if($index !== FALSE){
      $value = $qtyid[$index];
      }else{
      $value = 1;
      }
      }else{
      $value= 1;
      }
      @endphp
      <div style="height:20px;"> </div>
      <div class="quantity"> 
        <div class="quantity-select">   
          {{csrf_field()}}
          <input type="hidden" id="ids" value="{{$allpdt->id}}"/>
          <div id="minus" class="entry value-minus">&nbsp;</div>
          <div id="entry" class="entry value"><span>{{$value}}</span></div>
          <div id="plus" class="entry value-plus active">&nbsp;</div>
        </div>
      </div>
      <div style="height:20px;"> </div>


      <div class="occasion-cart">
        <a href="#" id="add-to-chart" class="item_add hvr-outline-out button2">Add to cart</a>
        <a href="#" id="remove-chart" class="btn btn-danger" <?php echo(isset($index) && $index !== FALSE) ? "" : "style='display:none'" ?>>Remove</a>
      </div>

    </div>
    <div class="clearfix"> </div>

    <div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
      <div class="bs-examplebs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li>
          <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Reviews(1)</a></li>
          <li role="presentation" class="dropdown">
            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Information <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
              <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">cleanse</a></li>
              <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">fanny</a></li>
            </ul>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
            <h5>Product  Description</h5>
            <p>{{$allpdt->description}}</p>
          </div>
          <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
            <div class="bootstrap-tab-text-grids">
              <div class="bootstrap-tab-text-grid">
                <div class="bootstrap-tab-text-grid-left">
                  <img src="{{url('/')}}/asset/images/men3.jpg" alt=" " class="img-responsive">
                </div>
                <div class="bootstrap-tab-text-grid-right">
                  <ul>
                    <li><a href="#">Admin</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-share" aria-hidden="true"></span>Reply</a></li>
                  </ul>
                  <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis 
                    suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem 
                    vel eum iure reprehenderit.</p>
                </div>
                <div class="clearfix"> </div>
              </div>

              <div class="add-review">
                <h4>add a review</h4>
                <form>
                  <input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {
                          this.value = 'Name';
                        }" required="">
                  <input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {
                          this.value = 'Email';
                        }" required="">

                  <textarea type="text" onfocus="this.value = '';" onblur="if (this.value == '') {
                          this.value = 'Message...';
                        }" required="">Message...</textarea>
                  <input type="submit" value="SEND">
                </form>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
          </div>
          <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<script>
                      $(document).ready(function(e) {
                        $(document).on('click', '#minus', function(e) {
                          var qnt = $('#entry').text();
                          if (qnt > 1) {
                            qnt--;
                          }

                          $('#entry').text(qnt);
                        });
                        $(document).on('click', '#plus', function(e) {
                          var qnt = $('#entry').text();
                          qnt++;
                          $('#entry').text(qnt);
                        });
                        $(document).on('click', '#add-to-chart', function(e) {
                          var ids = $('#ids').val();
                          var qnt = $('#entry').text();
                          $.ajax({
                            type: 'POST',
                            url: "{{route('cart.add')}}",
                            data: {
                              'pid': ids,
                              'qty': qnt,
                              '_token': $('input[name=_token]').val()
                            },
                            success: function(data) {
                              alert(data['msg']);
                              if (data['status'] == 1) {
                                var qty = parseInt($('#simpleCart_quantity').text());
                                qty++;
                                $('#simpleCart_quantity').text(qty);

                                var html = "<div class='single-cart-item'>";
                                html += "<div class='pdt-image'><img src=\"{{url('/')}}/images/product/"+data['picture']+"\"/></div>";
                                html += "<div class='pdt-text'><h4>"+data['title']+"</h4></div>";
                                
                                html += "<span class='close-items' id='close-"+ids+"'>close</span></div>";

                                $(".cart-product-item").append(html);
                              }
                              $('#totalAmount').text(data['Total']);
                              $('#remove-chart').show();
                            }
                          });
                          return false;
                        });
                        
                        $("body").on("click", ".close-items", function() {
                          var ids = $(this).attr("id");
                          ids = ids.substr(6);
                          $(this).parent().parent().hide();
                          //alert(ids);
                        });
                        
                      });
</script>
<!-- //single -->
<!-- //product-nav -->

@php
/*
Session::flush("pdtid");
Session::flush("qtyid");
Session::flush("totalPrice");
Session::flush("stitle");
Session::flush("spicture");
*/
@endphp

@endsection