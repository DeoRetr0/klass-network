   <style>
   .small-block{
    padding: 0; 
    margin: 0;
   }
   .small-photo{
    margin-bottom: 7px;
    margin-left: -7px;
    padding: 2px; 
    width: 63px;
   }
   .small-body{
    margin-bottom: -10px;
    margin-top: 10px;
   }

   .small-body h4{
    font-size: 20px;
    margin: 0px;
   }
   </style> 
    
    <div class="small-block media">
    <a href="{{route('profile.Perfil', ['username' =>$post->user->username])}}" class="pull-left">
        <img class="small-photo media-object" src="{{asset('uploads/avatars/'.$post->user->avatar)}}">
    </a>
    <div class="small-body media-body">
        <h4 class="media-heading"><a href="{{route('profile.Perfil', ['username' =>$post->user->username])}}">{{$post->user->getName()}}</a></h4>
        <h6 class="media-heading">{{'@'.$post->user->username}}</h6>
    </div>
    </div>

