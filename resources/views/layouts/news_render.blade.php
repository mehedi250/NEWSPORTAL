

@foreach($news as $post)
<div class="col-md-4 py-4">
    <div class="shadow">
        <div class="w-100 image-box">
            <img src="{{asset($post->image)}}" alt="" class="w-100">
        </div>
        <div class="p-2">
            <h5>{{$post->title}}</h5>
            <div class="row">
                <div class="col-md-6">
            
                    @php
                    echo date('d F, Y', strtotime($post->date))
                    @endphp
                
                </div>
                <div class="col-md-6 text-end">
                    {{$post->comments->count()}} Comments
                </div>
            </div>
            
            <p>
            <a class="text-decoration-none" href="{{route('news.catagory',$post->catagory->id)}}">{{$post->catagory->name}}</a>
            </p>

            <div>
            <?php 
                $your_string = strip_tags($post->content); 
                $your_char_string = substr($your_string, 0, 100); 
            ?>
                <p>{{ $your_char_string }}</p>
                <a href="{{route('news.view', $post->id)}}">Read More</a>
            </div>    
        </div> 
    </div>
</div>
@endforeach
