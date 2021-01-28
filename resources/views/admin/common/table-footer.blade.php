@if(count($results))

<div class="row">
    <div class="col-5">
            @if($results->count())              
              	Showing {{$results->firstItem()}} to {{$results->lastItem()}} of {{ $results->total() }} entries
            @endif
    </div> 
    <div class="col-7">
    {{ $results->links() }}          
    </div>    
</div>
@endif


