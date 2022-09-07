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
                    
                    @if (count($user->reviews) > 0)
                    @for ($h = 0; $h < min($user->reviews->sortByDesc('created-at')->count(),2); $h++)
                    <div class="review mb-4">
                        <div>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $user->reviews->sortByDesc('created_at')[$h]->rating)
                                    <i class="fa-solid fa-star text-warning"></i>
                                @elseif($i > $user->reviews->sortByDesc('created_at')[$h]->rating)
                                    <i class="fa-solid fa-star text-muted"></i>
                                @endif
                            @endfor
                            <p class='my-2'>
                                {{ strlen($user->reviews->sortByDesc('created_at')[$h]->text_review) < 10 ? $user->reviews->sortByDesc('created_at')[$h]->text_review : substr($user->reviews->sortByDesc('created_at')[$h]->text_review, 0, 50) . "..."  }}
                            </p>
                            <small>Inviata da <strong>{{ $user->reviews->sortByDesc('created_at')[$h]->author }}</strong></small><br>
                            <small>Scritta il {{ $user->reviews->sortByDesc('created_at')[$h]->created_at->format('d-m-Y') }} alle ore
                                {{ $user->reviews->sortByDesc('created_at')[$h]->created_at->format('g:i') }} </small>
                        </div>
                    </div>
                    @endfor
                    @else
                    <div>Nessuna recensione</div>
                    @endif
                    
                </div>
                {{-- Wrapper messages --}}
                <div id="messages" class="messages col-12 col-lg-6  my-3 pe-5 ">
                    <h3 class="mb-3">I tuoi messaggi:</h3>

                    @if (count($user->messages) > 0)
                    @for ($m = 0; $m < min($user->messages->sortByDesc('created-at')->count(),2); $m++)
                    <div class="review mb-4">
                        <div class=" ">
                            <div class="p-0 my-2">
                                {{ strlen($user->messages->sortByDesc('created_at')[$m]->text_message) < 10 ? $user->messages->sortByDesc('created_at')[$m]->text_message : substr($user->messages->sortByDesc('created_at')[$m]->text_message, 0, 50) . "..."  }}
                            </div>
                            <small>Inviata da <strong>{{ $user->messages->sortByDesc('created_at')[$m]->author }}</strong></small><br>
                            <small>Scritta il {{ $user->messages->sortByDesc('created_at')[$m]->created_at->format('d-m-Y') }} alle ore
                                {{ $user->messages->sortByDesc('created_at')[$h]->created_at->format('g:i') }} </small>
                        </div>
                    </div>
                    @endfor
                    @else
                    <div>Nessuna recensione</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Wrapper statistic --}}
        <div id="stats" class="container border-top border-dark">
            <script src="{{ asset('chart.js/chart.js') }}"></script>
            <h3>Le mie statistiche</h3>
            <div class="row justify-content-center">
                <div class="col-8">
                    <h4>Recensioni mensili</h4>
                    <canvas id="review-chart"></canvas>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <h4 class="mt-3">Messaggi mensili</h4>
                    <canvas id="message-chart"></canvas>
                </div>
            </div>
            <script>
                // import Chart from 'chart.js/auto';
                const reviewStats = @json($review_stats);
                const messageStats = @json($message_counter);
                const reviewLabels = [];
                const messageLabels = [];
                const monthlyAvgs = [];
                const monthlyReviewCount = [];
                const monthlyMessageCount = [];
                const maxYearReviewStats = Object.keys(reviewStats).reduce(function (a, b) {
                    return Math.max(a, b);
                }, -Infinity).toString();
                const maxYearMessageStats = Object.keys(messageStats).reduce(function (a, b) {
                    return Math.max(a, b);
                }, -Infinity).toString();

                for (const key in reviewStats[maxYearReviewStats]['months']) {
                    reviewLabels.push(key);
                    monthlyAvgs.push(reviewStats[maxYearReviewStats]['months'][key]['review_avg']);
                    monthlyReviewCount.push(reviewStats[maxYearReviewStats]['months'][key]['review_count']);
                    
                }

                for (const key in messageStats[maxYearMessageStats]['months']) {
                    messageLabels.push(key);
                    monthlyMessageCount.push(messageStats[maxYearMessageStats]['months'][key]['review_count']);
                    
                }

                const reviewData = {
                    labels: reviewLabels,
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

                const reviewConfig = {
                    type: 'bar',
                    data: reviewData,
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

                const messageData = {
                    labels: messageLabels,
                    datasets: [{
                        label: 'Numero messaggi',
                        backgroundColor: 'rgb(104, 212, 82)',
                        borderColor: 'rgb(104, 212, 82)',
                        data: monthlyReviewCount,
                    },
                ]
                };

                const messageConfig = {
                    type: 'bar',
                    data: messageData,
                    options: {}
                };

                const reviewChart = new Chart(
                    document.getElementById('review-chart'),
                    reviewConfig
                );

                const messageChart = new Chart(
                    document.getElementById('message-chart'),
                    messageConfig
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
