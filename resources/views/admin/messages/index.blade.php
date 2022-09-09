@extends('layouts.app')

@section('content')
    <div class="messages-c">
        <div class="container d-flex flex-column">
            <h3 class="bd-word mb-3 pb-5"><span class="bd-letter">I</span> miei messaggi</h3>
            @forelse ($messages->sortByDesc('created_at') as $message)
                <div class="message mb-4">
                    <div class="mb-1">
                        <div class="p-0 my-2">
                            {{ $message->text_message }}
                        </div>
                        <div class="p-0">
                            <strong>Email: </strong><a href="{{'mailto:'.$message->email}}">{{ $message->email }}</a>
                        </div>
                        <small>Inviato da <strong>{{ $message->author }}</strong></small><br>
                        <small>Scritto il {{ $message->created_at->format('d-m-Y') }} alle ore
                            {{ $message->created_at->format('g:i') }} </small>
                    </div>
                </div>
            @empty
            <div class="messageNull">Nessun messaggio</div>
            @endforelse
            {{ $messages->links() }}
          </div>
          <x-footer />
    </div>
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

    .messages-c {
        background-image: url('/images/bg-admin.jpg'),
        linear-gradient(rgba(255, 255, 255, 0.3),rgba(255, 255, 255, 0.3));
        background-size: 100%;
        background-blend-mode: overlay;
        padding-top: 3.6rem;
        margin-top: -1.7rem;
    }

    .message {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 2rem 3rem;
    }

    .messageNull{
        min-height: 50vh;
    }
</style>
