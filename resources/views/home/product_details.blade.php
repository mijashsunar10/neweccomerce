<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  @include('home.css')

  <style>
    .detail-box 
    {
        padding: 15px;
    }
  </style>
</head>
<body>
  <div class="hero_area">

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    <!-- slider section -->
     {{-- @include('home.slider') --}}
    <!-- end slider section -->

  </div>
  <!-- end hero area -->

  <!-- prduct  section -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
         Poidcut Details
        </h2>
      </div>
      <div class="row">
       
        <div class="col-md-10">
          <div class="box">
                <div class="d-flex align-items-center justify-content-center" style="padding: 30px">
           
                <img  width="400" src="/uploads/{{$data->image}}" alt="">

            </div>
              <div class="detail-box ">
                <h6>
                  {{$data->title}}
                </h6>
                <h6>
                  Price
                  <span>
                   {{$data->price}} 
                  </span>
                </h6>
              </div>

              <div class="detail-box">
                <h6>Category:
                  <span>{{$data->category}}</span>
                </h6>
                <h6>
                 Available Quantity:
                  <span>
                   {{$data->quantity}} 
                  </span>
                </h6>
              </div>

              <div class="detail-box">
               <h6>
                {{$data->description}}
               </h6>
              </div>


              {{-- <div class="d-flex justify-content-center align-items-center">
                <a class="btn btn-danger" href="{{url('product_details',$pro->id)}}">Details</a>
              </div> --}}
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        
      </div>
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div>
    </div>
  </section>

  <!-- end product section -->







  <!-- contact section -->


  <br><br><br>

  <!-- end contact section -->


   

  <!-- info section -->
        @include('home.footer')
 

</body>

</html> 