@extends('layouts.app')

@section('content')
    <div class="reviews-c">
        <div class="container">
            <h3 class="bd-word mb-5"><span class="bd-letter">L</span>e mie recensioni</h3>
            @forelse ($reviews->sortByDesc('created_at') as $review)
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
                            {{ $review->text_review }}
                        </p>
                        <small>Inviata da <strong>{{ $review->author }}</strong></small><br>
                        <small>Scritta il {{ $review->created_at->format('d-m-Y') }} alle ore
                            {{ $review->created_at->format('g:i') }} </small>
                    </div>
                </div>
            @empty
                <div>Nessuna recensione</div>
            @endforelse
            {{ $reviews->links() }}
        </div>
    </div>
    <x-footer />
@endsection

<style>

.bd-word {
        text-transform: uppercase;
        letter-spacing: .4rem;
        font-size: 1.7rem;
    }

.bd-letter {
        color: white;
        background-color: rgba(0, 0, 0, 0.4);
        padding-left: .4rem;
        margin-right: .2rem;
        border: 1px solid black;
    }

    .reviews-c {
        background-image: url('/images/bg-admin.png'),
        linear-gradient(rgba(255, 255, 255, 0.1),rgba(255, 255, 255, 0.1));
        background-size: 100%;
        background-blend-mode: overlay;
        padding-top: 3.6rem;
        margin-top: -1.7rem;
    }

    .review {
        background-color: rgba(255, 255, 255, 0.5);
        padding: 2rem 3rem;
    }

    .reviewNull {
        min-height: 50vh;
    }
</style>
