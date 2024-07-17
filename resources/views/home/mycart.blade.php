<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  @include('home.css')

  <style>
    .div_deg
    {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px;

    }

    table
    {
        border: 2px solid black;
        text-align: center;
        width: 800px;

    }

    th{
        border: 2px solid black;
        text-align: center;
        color: white;
        font: 20px;
        font-weight: bold;
        background-color: black;

    }
    td
    {
        border: 1px solid black;
    }

    .order_deg
    {
      padding-right:150px;
      /* margin-top: -200px;  */
    }

    label
    {
      display: inline-block;
      width: 150px;

    }
    .gap 
    {
      padding: 20px;
    }

    

  </style>
</head>
<body>
  <div class="hero_area">

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    <!-- slider section -->
    <!-- end slider section -->

  </div>
  <!-- end hero area -->

  <!-- shop section -->
  <!-- end shop section -->
  {{-- @foreach($cart as $cart)
  <br>
  {{$cart->product->title}}
  @endforeach --}}





  <div class="div_deg">

    <div class="order_deg">

      <form action="{{url('confirm_order')}}" method="POST">
        @csrf
  
        <div class="gap">
          <label for="name">User Name</label>
          <input type="text" name="name" id="" value="{{Auth::user()->name}}">
        </div>
  
        <div class="gap">
          <label for="rec_address">Address</label>
          <textarea name="address" id="" > {{Auth::user()->address}}</textarea>
  
        </div>
          
        <div class="gap">
          <label for="phone">Phone Number</label>
          <input type="text" name="phone" id="" value="{{Auth::user()->phone}}">
        </div>

        <input type="submit" class="btn btn-primary" value="Place Order">
          
        </form>
  
  </div>



  <table>
    <tr>
        <th>Product Title</th>
        <th>Price</th>
        <th>Image</th> 
        <th>Delete</th>
    </tr>


    <?php 

    $value=0;


    ?>
    @foreach($cart as $item)

    
    <tr>
        <td>{{$item->product->title}}</td>
        <td>{{$item->product->price}}</td>
        <td>
            <img width="150" src="/uploads/{{$item->product->image}}" >
        </td>
        <td>
          <a class="btn btn-danger btn-sm " href="#" role="button"> Remove</a>
        </td>
    </tr>


    <?php 
    $value = $value+$item->product->price;
    
    ?>
    @endforeach
  </table>   

 
 
  
  </div>

  <div  class="d-flex align-items-center justify-content-center">

    <h3>
    Total Price: {{ $value }}
    </h3>

  </div>
</div>








  <!-- contact section -->


  <br><br><br>

  <!-- end contact section -->


   

  <!-- info section -->
        @include('home.footer')
 

</body>

</html>