<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
  <head>
    
    <style>
      label{
        display: inline-block;
        width: 200px;
      }
    </style>

    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      
      @include('admin.navbar')

      <div class="container-fluid page-body-wrapper">
        <div class="container" align="center" style="padding-top: 50px;">
          @if (session()->has('message'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">x</button>
              {{ session()->get('message') }}
            </div> 
          @endif
          <form action="{{ url('upload_doctor') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="padding: 15px;">
              <label>Doctor Name</label>
              <input type="text" name="name" placeholder="Write the name" style="color: black">
            </div>
            <div style="padding: 15px;">
              <label>Phone</label>
              <input type="text" name="number" placeholder="Write the number" style="color: black">
            </div>
            <div style="padding: 15px;">
              <label>Speciality</label>
              <select name="speciality" style="color: black;">
                <option>--Select--</option>
                <option value="Skin">Skin</option>
                <option value="Heart">Heart</option>
                <option value="Eye">Eye</option>
                <option value="Nose">Nose</option>
              </select>
            </div>
            <div style="padding: 15px;">
              <label>Room No.</label>
              <input type="text" name="room" placeholder="Write the room number" style="color: black">
            </div>
            <div style="padding: 15px;">
              <label>Doctor Image</label>
              <input type="file" name="image">
            </div>
            <div style="padding: 15px;">
              <input class="btn btn-success" type="submit" name="submit">
            </div>
          </form>
        </div>
      </div>
    <!-- container-scroller -->
      @include('admin.script')
  </body>
</html>
</x-app-layout>