<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
<<<<<<< HEAD
            <a href="{{route('admin.dashboard')}}">Festira</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin.dashboard')}}">Festira</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">MENU</li>
            <li class="dropdown active">
                <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Tableau de board</span></a>
=======
            <a href="{{route('admin.admin.dashboard')}}">{{$settings->site_name}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin.admin.dashboard')}}">{{$settings->site_name}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">MENU</li>
            <li class="{{ setActive(['admin.admin.dashboard']) }}">
                <a href="{{route('admin.admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Tableau de board</span></a>
>>>>>>> bdb5ef0 (projet final)
            </li>

            <li class="{{ setActive(['admin.banniere.*']) }}">
                <a class="nav-link" href="{{route('admin.banniere.index')}}"><i class="fas fa-images"></i> <span>Banniere</span></a>
            </li>

            <li class="{{ setActive(['admin.edition.*']) }}">
                <a class="nav-link" href="{{route('admin.edition.index')}}"><i class="fas fa-calendar"></i> <span>Edition</span></a>
            </li>

            <li class="dropdown {{ setActive([
                    'admin.standes.*',
                    'admin.stande.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-store"></i>
                    <span>Stande</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.standes.index']) }}"><a class="nav-link" href="{{route('admin.standes.index')}}">Réservation de stande</a></li>
                    <li class="{{ setActive(['admin.stande.valide']) }}"><a class="nav-link" href="{{route('admin.stande.valide')}}">Stande validés</a></li>
                    <li class="{{ setActive(['admin.stande.rejette']) }}"><a class="nav-link" href="{{route('admin.stande.rejette')}}">Stande rejetés</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive([
                    'admin.sponsort.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-handshake"></i>
                    <span>Sponsort</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.sponsort.index']) }}"><a class="nav-link" href="{{route('admin.sponsort.index')}}">Demande de sponsort</a></li>
                    <li class="{{ setActive(['admin.sponsort.valide']) }}"><a class="nav-link" href="{{route('admin.sponsort.valide')}}">Sponsort validés</a></li>
                    <li class="{{ setActive(['admin.sponsort.rejette']) }}"><a class="nav-link" href="{{route('admin.sponsort.rejette')}}">Sponsort rejetés</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive([
                    'admin.category.*',
                    'admin.posts.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i>
                    <span>Gestion d'Actualités</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link" href="{{route('admin.category.index')}}">Catégories</a></li>
                    <li class="{{ setActive(['admin.posts.*']) }}"><a class="nav-link" href="{{route('admin.posts.index')}}">Publication</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive([
                    'admin.category-document.*',
                    'admin.documents.*',
                    'admin.galleries.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Médiatheque</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category-document.*']) }}"><a class="nav-link" href="{{route('admin.category-document.index')}}">Catégories Document</a></li>
                    <li class="{{ setActive(['admin.documents.*']) }}"><a class="nav-link" href="{{route('admin.documents.index')}}">Document</a></li>
                    <li class="{{ setActive(['admin.galleries.*']) }}"><a class="nav-link" href="{{route('admin.galleries.index')}}">Galleries</a></li>
                </ul>
            </li>

            <li class="{{ setActive(['admin.users.*']) }}">
                <a class="nav-link" href="{{route('admin.users.index')}}"><i class="fas fa-user"></i> <span>Utilisateurs</span></a>
            </li>

            <li class="{{ setActive(['admin.setting.*']) }}">
                <a class="nav-link" href="{{route('admin.setting.index')}}"><i class="fas fa-pencil-ruler"></i> <span>Paramètre du site</span></a>
            </li>
        </ul>

    </aside>
</div>
