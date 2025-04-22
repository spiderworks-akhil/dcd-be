@if(count($faq)>0)
<div class="accordion w-100" id="accordionFaq">
    @foreach($faq as $key=> $item)
            <div class="card faq-item-card" id="{{$item->id}}">
              <div class="card-header p-1" id="heading{{$item->id}}">
                <h2 class="m-0 float-left">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{ $item->question }}
                  </button>
                </h2>
              </div>
              <div id="collapse{{$item->id}}" class="collapse" aria-labelledby="heading{{$item->id}}" data-parent="#accordionFaq">
                <div class="card-body">
                  {!! $item->answer !!}
                </div>
              </div>
            </div>
    @endforeach
</div>
@endif