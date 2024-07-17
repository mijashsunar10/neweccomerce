<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        @foreach($product as $pro) 
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="uploads/{{$pro->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  {{$pro->title}}
                </h6>
                <h6>
                  Price
                  <span>
                   {{$pro->price}} 
                  </span>
                </h6>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-danger" href="{{url('product_details',$pro->id)}}">Details</a>
                {{-- <a class="btn btn-primary" href="{{url('add_cart',$pro->id)}}">Add to Cart</a> --}}
                <form action="{{ route('cart.add', $pro->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  {{-- <button class="btn btn-primary" type="submit">Add to Cart</button> --}}
                   <input type="submit" class="btn btn-primary" value="Add to Cart">
                </form>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        @endforeach
        
      </div>
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div>
    </div>
  </section>