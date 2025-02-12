<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Default Title'; ?></title>
    <link rel="stylesheet" href="./assets/src/output.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <nav class="bg-white" x-data="{ isOpen: false, isOn: false }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type=" button" @click="isOn = !isOn"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex shrink-0 items-center">
                        <img class="h-8 w-auto"
                            src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                            alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="/uasweb?page=dashboard"
                                    class="rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Dashboard</a>
                            <a href="/uasweb?page=dashboard-product"
                                class="rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Products</a>
                            <a href="/uasweb?page=dashboard-order"
                                class="rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Orders</a>
                        </div>
                    </div>
                </div>
                <?php
                if(isset($_SESSION['user'])) {
                ?>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                        <h2><?php echo $_SESSION['user']['email']; ?></h2>

                        <div class="relative ml-3">
                            <div>
                                <button type="button" @click="isOpen = !isOpen"
                                    class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="size-8 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                </button>
                            </div>

                            <?php if($_SESSION['user']['role'] == "admin") { ?>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <a href="/uasweb" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-0">Home</a>
                                    <a href="/uasweb/?page=dashboard" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-1">Dashboard</a>
                                    <form action="/uasweb/?page=logout" method="POST">
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-2">Sign out</button>
                                    </form>
                                </div>
                            <?php }  else {?>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <a href="/uasweb" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-0">Home</a>
                                    <a href="/uasweb/?page=order" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-1">My Orders</a>
                                    <form action="/uasweb/?page=logout" method="POST">
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-2">Sign out</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php
               } else {
               ?>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <a href="/uasweb?page=login" class="font-semibold text-indigo-600 hover:text-indigo-500 px-5">Login</a>
                        <a href="/uasweb?page=register"
                            class="font-semibold text-indigo-600 hover:text-indigo-500">Register</a>
                    </div>
               <?php
               }
               ?>
            </div>
        </div>

        <div class="sm:hidden" id="mobile-menu" x-show="isOn">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                    aria-current="page">Dashboard</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
            </div>
        </div>
    </nav>