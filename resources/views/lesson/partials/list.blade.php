@forelse($lessons as $lesson)
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label>{{ __('Lesson') }}</label>
            <a href="https://studio.youtube.com/video/{{ $lesson->idVideo }}/edit"
               style="cursor:pointer" target="_blank"><i class="fab fa-youtube"></i><span>{{ __('Open') }}</span></a>
        </div>
        <input type="text" class="form-control" value="{{ $lesson->title }}"
               readonly>
    </div>
@empty
    <h4>{{ __('Empty') }}</h4>
@endforelse
