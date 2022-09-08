@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-3">Le tue recensioni:</h3>
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

    <x-footer />
@endsection

<style lang="scss" scoped>
    .review {
        border: solid;
        padding: 1rem;
    }

    .reviewNull {
        min-height: 50vh;
    }
</style>
