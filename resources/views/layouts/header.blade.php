    <div id="loginInfo">
        <a href="/"><h3>Todo</h3></a>
        {{__('messages.languages')}}: <a href="/locale/ru">Русский</a> | <a href="/locale/en">English</a>
        <br><br>
        @auth
            {{__('messages.hello')}}, {{{Auth::user()->name}}} <br>

            @if(Auth::user()->isAdmin())
                <a href="/administration">{{__('messages.admin_stuff')}}</a>
                <br>
            @endif

            <a href="/archive">{{__('messages.archive')}}</a> <br>

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{__('messages.log_out')}}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endauth
        @guest
            <a href="/login">{{__('messages.log_in')}}</a> <br>
            <a href="/register">{{__('messages.register')}}</a>
        @endguest
    </div>
