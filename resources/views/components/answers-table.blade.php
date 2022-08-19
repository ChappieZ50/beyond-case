<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Short Message</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created At</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Votes</th>
        <th class="text-secondary opacity-7"></th>
        <th class="text-secondary opacity-7"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($answers as $answer)
        <tr>
            <td>
                <div class="d-flex px-2 py-1">
                    <div>
                        <img src="{{asset('assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3" alt="">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$answer->user->name}}</h6>
                        <p class="text-xs text-secondary mb-0">{{$answer->user->email}}</p>
                    </div>
                </div>
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold">
                    {{\Illuminate\Support\Str::limit($answer->message,'15','...')}}
                </span>
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold">
                    {{$answer->duration}} seconds
                </span>
            </td>
            <td>
                <span class="text-secondary text-xs font-weight-bold">{{$answer->created_at}}</span>
            </td>
            <td class="align-middle text-center text-sm">
                @php $votes =  $answer->votes()->sum('vote','votes'); @endphp
                <span class="badge badge-sm bg-gradient-{{$votes < 0 ? 'danger' : 'success'}}">{{$votes}}</span>
            </td>
            <td class="align-middle">
                <a href="{{route('answer.show',['answer' => $answer->id])}}">
                    <i class="fas fa-eye text-primary text-lg opacity-10" style="font-size: 16px;"></i>
                </a>
            </td>
            @if(!$answer->voted)
                <td class="align-middle">
                    <div class="icon icon-shape bg-gradient-success cursor-pointer shadow text-center border-radius-md vote-plus" data-id="{{$answer->id}}">
                        <i class="ni ni-like-2 rotate text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                    <div class="icon icon-shape bg-gradient-danger cursor-pointer shadow text-center border-radius-md vote-minus" data-id="{{$answer->id}}">
                        <i class="ni ni-like-2 rotate-180 text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </td>
            @else
                <td class="align-middle">
                    @if($answer->positiveVote)
                        <i class="ni ni-like-2 rotate text-lg opacity-10 text-success" aria-hidden="true"></i>
                    @else
                        <i class="ni ni-like-2 rotate text-lg opacity-10 text-danger rotate-180" aria-hidden="true"></i>
                    @endif
                </td>
            @endif
        </tr>
    @empty
    @endforelse
    </tbody>
</table>

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('assets/js/vote.js')}}"></script>
@endpush
