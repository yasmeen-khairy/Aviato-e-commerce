@include('home.header')
<link rel="stylesheet" href={{asset("admin/assets/css/profileStyle.css")}}>
@include('home.bar')


<section class="user-dashboard page-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="list-inline dashboard-menu text-center">
         	<li><a  href="{{route('orders')}}">Orders</a></li>
          <li><a class="active" href="{{route('profile')}}">Profile Details</a></li>
        </ul>
        <div class="dashboard-wrapper dashboard-user-profile">
          <div class="media">
            <div class="pull-left text-center" href="#!">
            {{-- profile image --}}
           
          
              <div class="avatar-upload">
                  <div class="avatar-edit">
                    <form action="{{route('changeProfileImage' , ['id'=>$users->id])}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type='file' name="image" id="imageUpload" />
                      <label style="    background-color: forestgreen;" for="imageUpload"></label>
                  </div>
                  <div class="avatar-preview">
                      <div id="imagePreview" style="background-image: url('{{asset('storage/profileImage/'.$users->image)}}');">
                      </div>
                  </div>

                  <button style="margin-top: 10px" class="btn btn-success" type="submit">save</button>
  
                </form>
              </div>					
            </div>
            <div class="media-body">
              <ul style="margin-top: 106px" class="user-profile-list">
                <li><span>Full Name:</span>{{$users->username}}</li>
                <li><span>E-mail:</span>{{$users->email}}</li>
				       @if($address)
                <li><span>Adress:</span>{{$address->address}}</li>
                <li><span>City:</span>{{$address->city}}</li>
			       	@endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('home.footer')
@include('home.script')
<script src='{{asset("admin/assets/js/ajax.js")}}'></script>
