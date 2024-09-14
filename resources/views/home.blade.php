@extends('layouts.app')

@section('content')

<div id="viewport">
    <!-- Sidebar -->
    <div id="sidebar">
        <header>
            <p>@if(Auth::user()->role=="ADM")
                Admin
            @elseif(Auth::user()->role=="USER")
                User
            @endif, {{ Auth::user()->name }}</p>
        </header>
        <ul class="nav">
            @if(Auth::user()->role=="ADM")
                <li>
                    <a href="#" class="dashboard-link">
                        <i class="zmdi zmdi-laptop"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleSubMenu('settings-submenu', this)">
                        <i class="zmdi zmdi-settings"></i> Settings <span class="material-symbols-outlined arrow-icon">
                            arrow_drop_down
                            </span>
                    </a>
                    <ul id="settings-submenu" class="submenu" style="display: none;">
                        <li>
                            <a href="#" class="link project-managment-link">
                                <i class="zmdi zmdi-laptop"></i> Project Management
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link tech-managment-link">
                                <i class="zmdi zmdi-laptop"></i> Tech Management
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link user-managment-link">
                                <i class="zmdi zmdi-view-dashboard"></i> User Management
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(Auth::user()->role=="USER")
                <li>
                    <a href="#" class="projects-link">
                        <i class="zmdi zmdi-note"></i> Your Projects
                    </a>
                </li>
                <li>
                    <a href="#" class="notes-link">
                        <i class="zmdi zmdi-note"></i> Your Notes
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            confirmLogout();">
                    <i class="zmdi zmdi-sign-in"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <!-- Content -->
    <div id="content">
        
    </div>
    @section('scripts')
    <script>
        function toggleSubMenu(subMenuId, element) {
            var submenu = document.getElementById(subMenuId);
            var icon = element.querySelector('.arrow-icon');
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                icon.textContent = 'arrow_drop_up';
            } else {
                submenu.style.display = 'none';
                icon.textContent = 'arrow_drop_down';
            }
        }

        function loadSection(section) {
            $.ajax({
                url: '/' + section,
                type: 'GET',
                success: function(data) {
                    $('#content').html(data);
                },
                error: function() {
                    alert('An error occurred while loading the section.');
                }
            });
        }
        function confirmLogout() {
            Swal.fire({
                title: 'Logout',
                text: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

        $(document).ready(function() {
            $('.user-managment-link').click(function(e) {
                e.preventDefault();
                loadSection('user-managment');
            });

            $('.tech-managment-link').click(function(e) {
                e.preventDefault();
                loadSection('tech-managment');
            });

            $('.dashboard-link').click(function(e) {
                e.preventDefault();
                loadSection('dashboard');
            });

            $('.project-managment-link').click(function(e) {
                e.preventDefault();
                loadSection('project-managment');
            });

            $('.notes-link').click(function(e) {
                e.preventDefault();
                loadSection('notes');
            });

            $('.projects-link').click(function(e) {
                e.preventDefault();
                loadSection('projects');
            });
        });
    </script>
    @endsection
</div>

@endsection