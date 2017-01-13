@component('layout')
    <h1 class="title">New Snippet</h1>

    @include('partials.errors')
    <form action="/snippets" method="POST">
        {{ csrf_field() }}

        @if ($snippet->id)
            <input type="hidden" name="forked_slug" value="{{ $snippet->slug }}">
        @endif

        <div class="control">
            <label for="title" class="label">Title:</label>

            <input type="text" id="title" name="title" class="input" value="{{ old('title') }} {{ $snippet->title }}">
        </div>

        <div class="control">
            <label for="channel" class="label">Channel:</label>
            <select name="channel" id="channel" class="input" onchange="change()">
                <option value="0">Select a channel</option>
                @foreach($channels as $channel)
                    @if (old('title') == $channel)
                        <option value="{{ $channel->id }}" selected>{{ $channel->name }}</option>
                    @else
                        <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="control">
            <label for="body" class="label">Body:</label>
            
            <textarea id="body" name="body" class="textarea">{{ $snippet->body }} {{ old('body') }}</textarea>
        </div>
        <div class="g-recaptcha"
             data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
        </div>
        <div class="control">
            <button class="button is-primary">Publish Snippet</button>
        </div>
    </form>

    {{-- Just a quick script to allow for pressing the "tab" key in textareas. --}}
    @slot ('footer')
    <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            CodeMirror.modeURL = "/codemirror/mode/%N/%N.js";
            let editor = CodeMirror.fromTextArea(document.getElementById("body"), {
                matchBrackets: true,
                lineNumbers: true,
                lineWrapping: true,
                theme: "material"
            });
            function updateTextArea() {
                editor.save();
            }
            editor.on('change', updateTextArea);
            function change() {
                var modeInput = $("#channel").find("option:selected").text().toLowerCase();
                var val = modeInput, m, mode, spec;
                if (m = /.+\.([^.]+)$/.exec(val)) {
                    var info = CodeMirror.findModeByExtension(m[1]);
                    if (info) {
                        mode = info.mode;
                        spec = info.mime;
                    }
                } else if (/\//.test(val)) {
                    var info = CodeMirror.findModeByMIME(val);
                    if (info) {
                        mode = info.mode;
                        spec = val;
                    }
                } else {
                    mode = spec = val;
                }
                if (mode) {
                    editor.setOption("mode", spec);
                    CodeMirror.autoLoadMode(editor, mode);
                } else {
                    alert("Could not find a mode corresponding to " + val);
                }
            }
            $('.delete').click(function(e){
                e.preventDefault();
                $('div.notification').slideUp(300);
            });
            document.querySelector('#body').addEventListener('keydown', function(e) {
                if (e.keyCode === 9) { // tab was pressed
                    // get caret position/selection
                    let val = this.value,
                        start = this.selectionStart,
                        end = this.selectionEnd;

                    // set textarea value to: text before caret + tab + text after caret
                    this.value = val.substring(0, start) + '\t' + val.substring(end);

                    // put caret at right position again
                    this.selectionStart = this.selectionEnd = start + 1;

                    e.preventDefault();
                }
            });
        </script>
    @endslot    
@endcomponent
