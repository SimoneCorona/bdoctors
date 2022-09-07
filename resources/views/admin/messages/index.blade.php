@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column ">
      <h3 class="mb-3">I tuoi messaggi:</h3>
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
@endsection




<style lang="scss" scoped>
    .message {
        border: solid;
        padding: 1rem;
    }

    .messageNull{
        min-height: 50vh;
    }
</style>
