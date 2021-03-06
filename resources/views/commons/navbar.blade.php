<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Tasklist</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            @if (Auth::check())
            <ul class="navbar-nav">
                {{-- タスク作成ページへのリンク --}}
                <li class="nav-item">
                    {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'nav-link']) !!}
                </li>
            </ul> 
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    {{-- ユーザ一覧ページへのリンク --}}
                    {{-- <li class="nav-item"><a href="#" class="nav-link">Users</a></li>--}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            {{-- ユーザ詳細ページへのリンク --}}
                            {{-- <li class="nav-item">{!! link_to_route('users.index', 'Users', [], ['class' => 'nav-link']) !!}</li> --}}
                            <li class="nav-item dropdown">
                            {{-- ログアウトへのリンク --}}
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                @endif
           </ul>
        </div>
    </nav>
</header>