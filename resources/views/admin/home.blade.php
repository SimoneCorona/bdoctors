@extends('layouts.dashboard')

@section('content')
    <div class="admin text-dark">
        <div class="user container">
            <div class="row">
                <div class="avatar-c py-5 col-12 col-sm-5 col-xl-3 pb-5 d-flex justify-content-center bg-transp">
                    {{-- AVATAR UTENTE --}}
                    @if ($user->photo)
                        <div class="avatar list-unstyled">
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}">
                        </div>
                    @else
                        <div class="avatar list-unstyled">
                            <img src="{{ asset('img/img-not-found.png') }}" alt="img-not-found">
                        </div>
                    @endif
                    {{-- FINE AVATAR UTENTE --}}
                </div>

                <div class="col-sm-7 col-xl-3 bg-transp pt-5">
                    {{-- INFO UTENTE --}}
                    <ul class="user-info">
                        <li class="list-unstyled">
                            <h2>{{ $user->name }} {{ $user->surname }}</h2>
                        </li>
                        <li class="list-unstyled text-light">
                            @foreach ($user->specialties as $specialty)
                            <a class="link-btn px-3 py-1 me-2 text-light" href="{{ route('guest.home', 'search/' . $specialty->specialty_slug) }}"">
                                {{ $specialty->specialty_name }}
                            </a> 
                                {{-- <span class="border border-dark bg-fume  hover-dark px-3 py-1 me-2 text-light">
                                    
                                </span> --}}
                            @endforeach
                        </li>
                        <li class="list-unstyled mt-3 mb-3"><strong>Indirizzo<br></strong>{{ $user->address }}</li>
                        <li class="list-unstyled mb-3"><strong>Numero di telefono<br></strong>{{ $user->phone_number }}</li>
                        <li class="list-unstyled mb-3"><strong>Email<br></strong>{{ $user->email }}</li>
                    </ul>
                    <div class="services pt-3 ps-3 ms-3">
                        <h3 class="bd-word">Prestazioni</h3>
                        <p>{{ $user->services ? $user->services : "Nessua prestazione segnalata dal dottore" }}</p>
                    </div>
                    {{-- FINE INFO UTENTE --}}
                </div>

                <div class="cv-c col-sm-12 col-md-7 col-xl-3 ps-4 pt-5 pb-4 bg-transp">
                    {{-- CV UTENTE --}}
                    <div class="cv">
                        <h3 class="bd-word">Curriculum Vitae</h3>
                        <p>{{ $user->cv ? $user->cv : "Nessun CV" }}</p>
                    </div>
                    {{-- FINE CV UTENTE --}}
                </div>

                <div class="col-sm-12 col-md-5 col-xl-3 pe-4 pt-5 pb-4 bg-transp">
                    {{-- DASHBOARD UTENTE --}}
                    <div class="menu-icons-c">
                        <ul class="menu-icons text-end d-flex flex-column align-items-end">
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active d-flex" href="{{ route('admin.home') }}">
                                    <strong>Il tuo profilo</strong>
                                    <span class="menu-icon">
                                        <i class="fa-regular fa-user"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active d-flex" href="{{ route('admin.users.edit') }}">
                                    <strong>Modifica profilo</strong>
                                    <span class="menu-icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active d-flex" href="{{ route('admin.messages.index') }}">
                                    <strong>Messaggi</strong>
                                    <span class="menu-icon">
                                        <i class="fa-regular fa-message"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active d-flex" href="{{ route('admin.reviews.index') }}">
                                    <strong>Recensioni</strong>
                                    <span class="menu-icon">
                                        <span><i class="fa-regular fa-comments"></i></span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active d-flex" href="#stats">
                                    <strong>Le mie statistiche</strong>
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active d-flex" href="{{ route('admin.users.sponsor') }}">
                                    <strong>Sponsorizzazione</strong>
                                    <span class="menu-icon">
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item list-unstyled mb-2">
                                <a class="nav-link active d-flex" href="{{ route('guest.home', 'doctor/' . $user->slug) }}">
                                    <strong>Profilo pubblico</strong>
                                    <span class="menu-icon">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- FINE DASHBOARD UTENTE --}}
                </div>
            </div>
        </div>

        {{-- Wrapper reviews e Messaggi --}}
        <div class=" my-4 container">
            <div class="row">
                {{-- Wrapper Reviews --}}
                <div id="reviews" class="bg-transp col-12 col-lg-6 reviews my-3">
                    <h3 class="bd-word text-center mt-4 mb-3 pb-4">Le mie recensioni</h3>
                    
                    @if (count($user->reviews) > 0)
                    @for ($h = 0; $h < min($user->reviews->sortByDesc('created-at')->count(),2); $h++)
                    <div class="review border-top border-dark">
                        <div class="my-4">
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
                    <div class="text-end py-4 my-4">
                        <a class="link-btn" href="{{ route('admin.reviews.index') }}">Tutte le recensioni</a>
                    </div>
                    @else
                    <div class="text-center">Nessuna recensione</div>
                    @endif
                    
                </div>
                {{-- Wrapper messages --}}
                <div id="messages" class="messages bg-transp col-12 col-lg-6 my-3 py-4">
                    <h3 class="bd-word text-center mb-3 pb-4">I miei messaggi</h3>

                    @if (count($user->messages) > 0)
                    @for ($m = 0; $m < min($user->messages->sortByDesc('created-at')->count(),2); $m++)
                    <div class="message border-top border-dark py-4">
                        <div class=" ">
                            <div class="p-0 my-2">
                                {{ strlen($user->messages->sortByDesc('created_at')[$m]->text_message) < 10 ? $user->messages->sortByDesc('created_at')[$m]->text_message : substr($user->messages->sortByDesc('created_at')[$m]->text_message, 0, 50) . "..."  }}
                            </div>
                            <small>Inviato da <strong>{{ $user->messages->sortByDesc('created_at')[$m]->author }}</strong></small><br>
                            <small>Scritta il {{ $user->messages->sortByDesc('created_at')[$m]->created_at->format('d-m-Y') }} alle ore
                                {{ $user->messages->sortByDesc('created_at')[$h]->created_at->format('g:i') }} </small>
                        </div>
                    </div>
                    @endfor
                    <div class="text-end py-3 my-4">
                        <a class="link-btn" href="{{ route('admin.messages.index') }}">Tutti i messaggi</a>
                    </div>
                    @else
                    <div class="text-center">Nessun messaggio</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Wrapper statistic --}}
        <div id="stats" class="container bg-transp py-5 px-3">
            <script src="{{ asset('chart.js/chart.js') }}"></script>
            <h3 class="bd-word text-center mb-5">Le mie statistiche</h3>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h4 class="bd-word mt-5">Recensioni mensili</h4>
                    <canvas class="bg-light p-3 rounded-2 mb-3" id="review-chart"></canvas>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h4 class=" bd-word mt-5">Messaggi mensili</h4>
                    <canvas class="bg-light p-3 rounded-2 mb-3" id="message-chart"></canvas>
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

                for (const yearKey in reviewStats) {
                    for (const key in reviewStats[yearKey]['months']) {
                        reviewLabels.push(key);
                        monthlyAvgs.push(reviewStats[yearKey]['months'][key]['review_avg']);
                        monthlyReviewCount.push(reviewStats[yearKey]['months'][key]['review_count']);
                    }
                }

                for (const yearKey in messageStats) {
                    for (const key in messageStats[yearKey]['months']) {
                        messageLabels.push(key);
                        monthlyMessageCount.push(messageStats[yearKey]['months'][key]['review_count']);
                    }
                    
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
                            title: {
                                display: true,
                                text: 'Media voti',
                            },
                            type: 'linear',
                            position: 'left',
                            max:5,
                        },
                        'right-y-axis': {
                            title: {
                                display: true,
                                text: 'Numero recensioni',
                            },
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



<style>

    .hover-dark: {
        transition: .6s;
    }

    .hover-dark:hover {
        background-color: black;
        transition: .6s;
    }

    .bd-word {
        text-transform: uppercase;
        letter-spacing: .4rem;
        font-size: 1.1rem;
    }

    .link-btn {
        color: white;
        background-color: rgba(0, 0, 0, 0.4);
        text-transform: none;
        text-decoration: none;
        border: 1px solid black;
        padding: .5rem 1rem;
        font-size: .65rem;
        transition: .6s;
        font-size: .8rem;
    }

    .link-btn:hover {
        background-color: black;
        color: white;
        transition: .6s;
    }

    .bd-letter {
        color: white;
        background-color: rgba(0, 0, 0, 0.4);
        padding-left: .3rem;
        margin-right: .2rem;
        border: 1px solid black;
    }

    .bg-transp {
        background-color: rgba(255,255,255,0.5);
    }

    .bg-fume {
        background-color: rgba(0, 0, 0, 0.3);
    }
    .admin {
        background-image: url('/images/bg-admin.png'),
        linear-gradient(rgba(255, 255, 255, 0.1),rgba(255, 255, 255, 0.1));
        background-size: 100%;
        background-blend-mode: overlay;
        padding-top: 4rem;
    }

    .menu-icon {
        display: inline-block;
        color: white;
        background-color: rgba(0, 0, 0, 0.5);
        border: 1px solid black;
        width: 1.5rem;
        height: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: .6rem;
        transition: .6s;
        margin-bottom: .3rem;
    }

    .menu-icons li:hover .menu-icon {
        background-color: black;
        transition: .6s;
        transform: rotateY(180deg);
    }

    strong {
        text-transform: uppercase;
    }

    /* .user {
        border-bottom: 1px solid black;
    } */

    /* Foto tonda */
    .avatar {
        border: 1px solid black;
        border-radius: 50%;
        overflow: hidden;

    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cv p {
        max-height: 400px;
        overflow: auto;
    }

    /* Sezione messaggi e recensioni ricevute */
    /* .message,
    .review {
        border-radius: 15px 0 15px 15px;
        border: 1px solid black;
    } */

    /* .message div,
    .review div {
        padding: .5rem 1.5rem;
    } */

@media all and (max-width: 575px) {

    .avatar {
        width: 300px;
        height: 300px;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0;
    }

    .cv {
        padding: 2rem;
    }

    .menu-icons-c {
        display: flex;
        justify-content: center;
    }
}

@media all and (min-width: 577px) and (max-width: 768px) {


    .avatar {
        width: 170px;
        height: 170px;
    }

    .cv {
        display: flex;
        flex-direction: column;
        margin: 0 3rem;
    }

    .menu-icons-c {
        display: flex;
        justify-content: center;
    }

    .avatar-c {
        padding: 0 2rem;
    }
}

@media all and (min-width: 769px) and (max-width: 992px)  {
    .avatar {
        width: 270px;
        height: 270px;
    }
}

@media all and (min-width: 993px) and (max-width: 1199px) {
    .avatar {
        width: 350px;
        height: 350px;
    }
}

@media all and (min-width: 1200px) {
    .avatar {
        width: 200px;
        height: 200px;
    }
}
</style>
