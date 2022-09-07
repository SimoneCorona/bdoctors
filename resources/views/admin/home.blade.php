@extends('layouts.dashboard')


@section('content')
    <div>
        <div class="user d-flex my-4 pt-2 py-4 container">
            <div class="row">
                <div class="user-avatar me-5 col-auto">

                    @if ($user->photo)
                        <li class="avatar list-unstyled">
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}">
                        </li>
                    @else
                        <li class="avatar list-unstyled">
                            <img src="{{ asset('img/img-not-found.png') }}" alt="img-not-found">
                        </li>
                    @endif
                    <div class="mt-4">
                        <div class="py-3">
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active" href="{{ route('guest.home', 'doctor/' . $user->slug) }}">
                                    <i class="fa-solid fa-address-card me-2"></i>
                                    <strong>Il tuo profilo pubblico</strong>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active" href="{{ route('admin.users.edit') }}">
                                    <i class="fa-solid fa-pen me-2"></i>
                                    <strong>Modifica profilo</strong>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active" href="{{ route('admin.messages.index') }}">
                                    <i class="fa-solid fa-comments me-2"></i>
                                    <strong>Messaggi</strong>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active" href="#reviews">
                                    <i class="fa-solid fa-comments me-2"></i>
                                    <strong>Recensioni</strong>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active" href="#stats">
                                    <i class="fa-solid fa-ranking-star me-2"></i>
                                    <strong>Le mie statistiche</strong>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active" href="{{ route('admin.users.sponsor') }}">
                                    <i class="fa-solid fa-circle-dollar-to-slot me-2"></i>
                                    <strong>Sponsorizzazione</strong>
                                </a>
                            </li>
                        </div>
                    </div>

                </div>

                <div class="user-info col-12 col-lg-6">
                    <li class="list-unstyled mb-3">
                        <h2>{{ $user->name }} {{ $user->surname }}</h2>
                    </li>
                    <li class="list-unstyled text-light">
                        @foreach ($user->specialties as $specialty)
                            <span class="rounded-pill bg-primary px-3 py-1 me-2 text-light">
                                {{ $specialty->specialty_name }}
                            </span>
                        @endforeach
                    </li>
                    <li class="list-unstyled mt-3"><strong>Indirizzo: </strong>{{ $user->address }}</li>
                    <li class="list-unstyled"><strong>Numero di tel.:</strong>{{ $user->phone_number }}</li>
                    <li class="list-unstyled"><strong>Email: </strong>{{ $user->email }}</li>
                    <li class="list-unstyled mt-4">
                        <h3>Il mio Curriculum Vitae:</h3>
                    </li>
                    <li class="list-unstyled">{{ $user->cv ? $user->cv : "Nessun CV" }}</li>
                </div>
            </div>
        </div>

        {{-- Wrapper reviews e Messaggi --}}
        <div class=" mb-4 container">
            <div class="row">
                {{-- Wrapper Reviews --}}
                <div id="reviews" class="col-12 col-lg-6 reviews my-3 pe-5 border-end border-dark">
                    <h3 class="mb-3">Le tue recensioni:</h3>
                    @forelse ($user->reviews->sortByDesc('created_at') as $review)
                        <div class="review mb-4">
                            <div>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @elseif($i > $review->rating)
                                        <i class="fa-solid fa-star text-muted"></i>
                                    @endif
                                @endfor
                                <p class='my-2'>
                                    {{ strlen($review->text_review) < 10 ? $review->text_review : substr($review->text_review, 0, 50) . "..."  }}
                                </p>
                                <small>Inviata da <strong>{{ $review->author }}</strong></small><br>
                                <small>Scritta il {{ $review->created_at->format('d-m-Y') }} alle ore
                                    {{ $review->created_at->format('g:i') }} </small>
                            </div>
                        </div>
                    @empty
                        <div>Nessuna recensione</div>
                    @endforelse
                </div>
                {{-- Wrapper messages --}}
                <div id="messages" class="messages col-12 col-md-8 col-lg-6  my-3  ">
                    <h3 class="mb-3">I tuoi messaggi:</h3>
                    @forelse ($user->messages->sortByDesc('created_at') as $message)
                        <div class="message mb-4">
                            <div class="mb-1">
                                <div class="p-0 my-2">
                                    {{ strlen($message->text_message) < 10 ? $message->text_message : substr($message->text_message, 0, 50) . "..."  }}
                                </div>
                                <div class="p-0">
                                    <strong>Email: </strong><a
                                        href="{{ 'mailto:' . $message->email }}">{{ $message->email }}</a>
                                </div>
                                <small>Inviato da <strong>{{ $message->author }}</strong></small><br>
                                <small>Scritto il {{ $message->created_at->format('d-m-Y') }} alle ore
                                    {{ $message->created_at->format('g:i') }} </small>
                            </div>
                        </div>
                    @empty
                        <div>Nessun messaggio</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Wrapper statistic --}}
        <div id="stats" class="border-top py-2 border-dark">
            <script src="{{ asset('chart.js/chart.js') }}"></script>
            <h3>Le mie statistiche</h3>
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <script>
                // import Chart from 'chart.js/auto';
                const review_stats = @json($review_stats);
                const labels = [];
                const monthlyAvgs = [];
                const monthlyReviewCount = [];
                const maxYearStats = Object.keys(review_stats).reduce(function (a, b) {
                    return Math.max(a, b);
                }, -Infinity).toString();
                for (const key in review_stats[maxYearStats]['months']) {
                    // console.log(review_stats[maxYearStats].months, key)
                    labels.push(key);
                    monthlyAvgs.push(review_stats[maxYearStats]['months'][key]['review_avg']);
                    monthlyReviewCount.push(review_stats[maxYearStats]['months'][key]['review_count']);
                    
                }
                

                const labelsX = [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                ];

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Media voti',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: monthlyAvgs,
                        yAxisID: 'left-y-axis'
                    },{
                        label: 'Numero recensioni',
                        backgroundColor: 'rgb(84, 136, 233)',
                        borderColor: 'rgb(84, 136, 233)',
                        data: monthlyReviewCount,
                        yAxisID: 'right-y-axis'
                    },
                ]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {scales: {
                        'left-y-axis': {
                            type: 'linear',
                            position: 'left'
                        },
                        'right-y-axis': {
                            type: 'linear',
                            position: 'right'
                        }
                    }}
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            </script>
        </div>
    </div>
@endsection



<style scoped>

    .user {
        border-bottom: 1px solid black;
    }

    /* Foto tonda */
    .avatar {
        border: 1px solid black;
        border-radius: 50%;
        overflow: hidden;
    }

    .avatar img {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }

    /* Sezione messaggi e recensioni ricevute */
    .message,
    .review {
        border-radius: 15px 0 15px 15px;
        border: 1px solid black;
    }

    .message div,
    .review div {
        padding: .5rem 1.5rem;
    }
</style>
