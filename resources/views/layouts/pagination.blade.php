@if($totalPage>1)
<button class="btn btn-outline-primary" id="pageBtnPrevious" onClick="fetchFunction('p');">previous</button> 
@for($i=0; $i<$totalPage; $i++)
<button class="btn btn-outline-primary" id="pageBtn{{$i}}" onClick="fetchFunction({{$i}});">{{$i+1}}</button>
@endfor
<button class="btn btn-outline-primary" id="pageBtnNext" onClick="fetchFunction('n');">Next</button>
@endif