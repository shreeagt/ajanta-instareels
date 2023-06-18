<!DOCTYPE html>
<html dir="ltr" lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.87.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- CSRF Token -->
      @stack('title')
      <!-- css file -->
      <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
      <link rel="stylesheet" href="{{asset('theme/css/dashbord_navitaion.css')}}">
      <!-- Responsive stylesheet -->
      <link rel="stylesheet" href="{{asset('theme/css/responsive.css')}}">
      <!-- Favicon -->
      <link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
      <link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" />
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
   </head>

   <style>
    .banner-wrapper{
    /* background-color: rgb(0, 0, 0); */
    position: relative;
    background-image: url('/assets/images/video_homebanner.png');
    background-repeat: no-repeat;
    background-position-y: center;
    background-position-x: center;
    background-size: cover;
    height: 100vh;
    display: flex;
    align-items: center;
    z-index: 0;
    }

    .banner_text  {
    border-radius: 20px;
    background: rgba(255,255,255,0.3);
    padding: 20px;
    margin:40px;
}

    .banner-wrapper::before{
      display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: -1;
        background-color: rgba(0, 0, 0, 0.15);
        padding: 0;
        width: 100%;
        content: '';
    }

    .file-input {
  height: 100%;
  padding: 0.375rem 0.75rem;
}

.video-upload-box {
  width: 300px;
  height: 200px;
  border: 2px dashed #ccc;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.drop-area {
  position: relative;
  width: 100%;
  height: 100%;
}

.file-input {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  top:0;
  cursor: pointer;
}

   </style>
   <body>
      <div class="banner-wrapper">
         <div class="container">
            <div class="row justify-content-center align-items-center">
              <div class="col-lg-6">
                <div class="img-shree-cover">
                   <img src="/img/office/shree-agt-final.png" style="-webkit-animation: bounceHero 5s ease-in-out infinite;" class="img-fluid" alt="">
                </div>
             </div>

               <div class="col-lg-6">
                  <div class="col-lg-12">
                     <div class="banner_text ">
                        <h1> Hello  Dr.<span style="color:brown">Ravi Tiwari</span><br>Please Upload your video<span class="red" style="color:red">.</span> </h1>
                        <form>
            
                           <div class="video-upload-box">
                              <div class="drop-area">
                                <div class="text-center">
                                  <i class="bi bi-cloud-upload"></i>
                                  <h5 class="mb-3">Drag and drop a video file here</h5>
                                  <p class="text-muted">or</p>
                                  <button class="btn btn-primary">Choose File</button>
                                </div>
                                <input type="file" class="file-input" id="videoInput" accept="video/*">
                              </div>
                            </div>

                            
                           {{-- <div class="input-group mb-3">
                              <input type="file" class="form-control file-input" id="videoInput" accept="video/*">
                              <label class="input-group-text" for="videoInput">Choose Video (Max 2MB)</label>
                            </div> --}}
                            
                           <button type="submit" class="btn btn-primary mt-3">Submit</button>
                         </form>
                     </div>
                  </div>
               </div>
      
            </div>
         </div>
      </div>
   </body>
</html>