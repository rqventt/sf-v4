<?php
    session_start();
    if (!isset($_COOKIE['id'])) {
        $_SESSION['log-error'] = 'Error: Unauthorized access! Please login first.';
        header("Location: access.php");
        exit();
    }

    require_once 'config.php';

    $dp = substr($_COOKIE['personalization'], 0, 2);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Finds</title>
    <link rel="shortcut icon" href="resources/sf-logo.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
    <script>
        let data = { theses: [] }, thesesPerPage = 12, selectedSet = 0, searchQuery = "", searchCategory = "title"; let selectedYears = []; let filteredYears = []; let defaultSet = true;

        fetch('data.json')
            .then(res => res.json())
            .then(jsonData => { data = jsonData; displaySets(); updateYears('default'); updateFilters();})
            .catch(err => console.error("Error retrieving data:", err));         
    </script>
</head>
<body class="bg-[url('resources/lib-bg.jpg')] font-nunito text-white flex">
<div class="fixed inset-0 bg-black/50 h-full z-0 max-tablet:hidden"></div>
    <!-- DESKTOP SIDE NAVIGATIONS -->
    <header class="group fixed top-0 left-0 pt-10 pb-10 w-20 hover:w-60 duration-500 ease-out h-screen flex max-tablet:hidden flex-col justify-between bg-ash/85 backdrop-blur-md shadow-[var(--around-shadow-md)] select-none text-off-white z-10">
        <div class="w-full h-35">
            <img src="resources/umak.svg" alt="UMak Logo" class="mt-3 ml-3.5 size-12 inline-block">
            <img src="resources/ccis.svg" alt="CCIS Logo" class="mt-3 ml-3.5 size-12 inline-block">  
            <img src="resources/sf-logo.svg" alt="Scholar Finds Logo" class="mt-3 ml-3.5 size-12 inline-block">
            <a href="index.html" class="outline-none"><h1 class=" m-3.5 whitespace-nowrap overflow-hidden text-3xl opacity-0 group-hover:opacity-100 duration-500 font-semibold">Scholar Finds</h1></a>
        </div>
        <nav>
            <ul class="flex flex-col gap-2">
                <li><a href="index.html" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-w-8 w-8">
                        <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg> 
                    <p class="text-lg overflow-hidden text-clip">Home</p>
                </a></li>
                <li><a href="about.html" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-w-8 w-8">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                        <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>                       
                    <p class="text-lg overflow-hidden text-clip">About</p>
                </a></li>
                <li><a href="contact.html" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-w-8 w-8">
                        <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                    </svg>                      
                    <p class="text-lg overflow-hidden text-clip">Contact</p>
                </a></li>
                <li><a href="library.php" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-w-8 w-8">
                        <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
                    </svg>                      
                    <p class="text-lg overflow-hidden text-clip">Library</p>
                </a></li>
            </ul>
        </nav>
        <menu class="flex flex-col gap-2">
            <li><a href="bookmarks.html" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-w-8 w-8">
                    <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>
                <p class="text-lg overflow-hidden text-clip">Bookmarks</p>
            </a></li>
            <li><a href="profile.php" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">                  
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-w-8 w-8">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>  
                <p class="text-lg overflow-hidden text-clip">Profile</p>
            </a></li>
            <li><a href="admin.php" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-w-8 w-8">
                    <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                    <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                    <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                    <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
                  </svg>                  
                <p class="text-lg overflow-hidden text-clip">Admin</p>
            </a></li>
        </menu>
        <script>
            const admin = document.querySelector('a[href="admin.php"]');
            const role = document.cookie.match(/role=([^;]+)/)?.[1];
            if (!role || role === "regular") admin?.classList.add("hidden");
        </script> 
    </header>
    <!-- MOBILE NAVIGATION-->
    <nav class="tablet:hidden z-50">
        <div onclick="toggleNav()" class="fixed right-0 top-50 pl-2.5 rounded-l-full bg-dirty-brown">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#eeeeee" class="p-1.5 size-8.5 cursor-pointer">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </div>
        <div onclick="toggleNav()" id="overlay" class="fixed top-0 left-0 w-screen h-screen bg-black/50 hidden"></div>
        <div id="mob-nav" class="fixed top-0 right-0 pt-20 overflow-clip w-70 h-screen bg-off-white hidden flex-col animate-header font-semibold text-dirty-brown **:select-none">
            <div onclick="toggleNav()" class="absolute top-5 right-5">
                <svg class="size-9" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#585345"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </div>
            <h1 class="px-7.5 text-2xl font-bold">Scholar Finds</h1>
            <hr class="my-5 w-full opacity-30 *:active:bg-neutral-300">
            <div class="w-full *:px-7.5 *:py-1 *:flex *:items-center *:gap-2 *:active:bg-neutral-300">
                <a href="index.html" class="block w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" /></svg>Home</a>
                <a href="about.html" class="block w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z" /> </svg>About</a>
                <a href="contact.html" class="block w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z" clip-rule="evenodd" /> </svg>Contact</a>
            </div>
            <hr class="my-5 w-full opacity-30 *:active:bg-neutral-300">
            <div class="w-full *:px-7.5 *:py-1 *:flex *:items-center *:gap-2 *:active:bg-neutral-300">
                <a href="library.php" class="block w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path d="M10.75 16.82A7.462 7.462 0 0 1 15 15.5c.71 0 1.396.098 2.046.282A.75.75 0 0 0 18 15.06v-11a.75.75 0 0 0-.546-.721A9.006 9.006 0 0 0 15 3a8.963 8.963 0 0 0-4.25 1.065V16.82ZM9.25 4.065A8.963 8.963 0 0 0 5 3c-.85 0-1.673.118-2.454.339A.75.75 0 0 0 2 4.06v11a.75.75 0 0 0 .954.721A7.506 7.506 0 0 1 5 15.5c1.579 0 3.042.487 4.25 1.32V4.065Z" /> </svg>Library</a>
                <a href="bookmarks.html" class="block w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 0 0 1.075.676L10 15.082l5.925 2.844A.75.75 0 0 0 17 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0 0 10 2Z" clip-rule="evenodd" /> </svg>Bookmarks</a>
                <a href="profile.php" class="block w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" /> </svg>Profile</a>
               
            </div>
            <hr class="my-5 w-full opacity-30 *:active:bg-neutral-300">
            <div class="w-full *:px-7.5 *:py-1 *:flex *:items-center *:gap-2 *:active:bg-neutral-300">
                <a href="" class="block w-full text-red-700"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd" /> <path fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z" clip-rule="evenodd" /> </svg>Logout</a>
                <a href="admin.php" class="block w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"> <path fill-rule="evenodd" d="M10 1c3.866 0 7 1.79 7 4s-3.134 4-7 4-7-1.79-7-4 3.134-4 7-4Zm5.694 8.13c.464-.264.91-.583 1.306-.952V10c0 2.21-3.134 4-7 4s-7-1.79-7-4V8.178c.396.37.842.688 1.306.953C5.838 10.006 7.854 10.5 10 10.5s4.162-.494 5.694-1.37ZM3 13.179V15c0 2.21 3.134 4 7 4s7-1.79 7-4v-1.822c-.396.37-.842.688-1.306.953-1.532.875-3.548 1.369-5.694 1.369s-4.162-.494-5.694-1.37A7.009 7.009 0 0 1 3 13.179Z" clip-rule="evenodd" /> </svg>Admin</a>
            </div>
        </div>
        <!-- SCRIPT -->
        <script>
            const mobNav = document.getElementById("mob-nav");
            const overlay = document.getElementById("overlay");
    
            function toggleNav() {
                mobNav.classList.toggle("hidden");
                mobNav.classList.toggle("flex");
                overlay.classList.toggle("hidden");
            }
        </script> 
    </nav>
    <!-- ================================================== MAIN ================================================== -->
    <main class="relative z-2 w-screen">
        <div id="library" class="ml-25 m-5 p-15 w-[calc(100vw-135px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl flex flex-col bg-off-white text-dirty-brown drag-none z-1
        max-tablet:m-0 max-tablet:p-10 max-phone:p-8 max-tablet:w-full max-tablet:min-h-screen max-tablet:rounded-none">
            <div class="w-full flex justify-between items-center">
                <!-- SEARCH / FILTER -->
                <div class="relative flex items-center gap-2.5 max-big-phone:gap-1">
                    <span class="relative select-none">
                        <svg class="absolute top-1/2 -translate-y-1/2 left-2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#585345"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                        <input id="search-box" placeholder="Search for a thesis book..." class="px-5 pl-8 py-1 max-tablet:w-60 max-big-phone:w-55 max-phone:w-48 w-80 border-2 rounded-2xl border-dirty-brown max-tablet:text-sm max-phone:text-xs text-dirty-brown outline-none">
                    </span>
                    <div class="relative flex gap-2.5">
                        <!-- MOBILE SELECTION OPENER -->
                        <div id="mb-selection" onclick="openSelection('mobile', this)" class="p-1 rounded-md tablet:hidden bg-dirty-brown text-off-white">
                            <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><!-- Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE --><path fill="currentColor" d="M11 20q-.425 0-.712-.288T10 19v-6L4.2 5.6q-.375-.5-.112-1.05T5 4h14q.65 0 .913.55T19.8 5.6L14 13v6q0 .425-.288.713T13 20z"/></svg>
                        </div>

                        <!-- DESKTOP SELECTION OPENER -->
                        <div id="sb-selection" onclick="openSelection('desktop', this)" class="w-45 h-9 max-tablet:hidden rounded-2xl border-2 border-dirty-brown text-sm select-none cursor-pointer">
                            <!-- SEARCH CATEGORY -->
                            <span class="size-full flex items-center justify-center gap-1">
                                Search by: <b id="sby-selected">Title</b>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icon from IonIcons by Ben Sperry - https://github.com/ionic-team/ionicons/blob/main/LICENSE --><path d="M128 192l128 128 128-128z" fill="currentColor"/></svg>
                            </span> 
                        </div>
                        <div id="pd-selection" onclick="openSelection('desktop', this)" class="w-45 h-9 max-tablet:hidden rounded-2xl border-2 border-dirty-brown text-sm select-none cursor-pointer">
                            <!-- PUBLISHED DATE -->
                            <span class="size-full flex items-center justify-center gap-1">
                                Year: <b id="spdate-selected">All</b>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icon from IonIcons by Ben Sperry - https://github.com/ionic-team/ionicons/blob/main/LICENSE --><path d="M128 192l128 128 128-128z" fill="currentColor"/></svg>
                            </span> 
                        </div>
                        <div id="ic-selection" onclick="openSelection('desktop', this)" class="w-45 h-9 max-tablet:hidden rounded-2xl border-2 border-dirty-brown text-sm select-none cursor-pointer">
                            <!-- INCLUSIONS -->
                            <span class="size-full flex items-center justify-center gap-1">
                                Include: <b id="include-selected">Default</b>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icon from IonIcons by Ben Sperry - https://github.com/ionic-team/ionicons/blob/main/LICENSE --><path d="M128 192l128 128 128-128z" fill="currentColor"/></svg>
                            </span> 
                        </div>

                        <script>
                            function openSelection(selection, element) {
                                const filters = document.getElementById('all-filters');
                                const sc = document.getElementById('sc-filter');
                                const pd = document.getElementById('pd-filter');
                                const ic = document.getElementById('ic-filter');
                                const triggerId = element?.querySelector('b')?.id;

                                if (selection === 'mobile') {
                                    filters.classList.toggle('hidden');
                                    filters.classList.toggle('grid');
                                    [sc, pd, ic].forEach(el => el?.classList.remove('invisible'));
                                } else if (selection === 'desktop') {
                                    filters.classList.remove('hidden');
                                    filters.classList.add('grid');

                                    const filterMap = {
                                        'sby-selected': sc,
                                        'spdate-selected': pd,
                                        'include-selected': ic,
                                    };

                                    const selectedFilter = filterMap[triggerId];

                                    if (selectedFilter && !selectedFilter.classList.contains('invisible')) {
                                        selectedFilter.classList.add('invisible');
                                    } else {
                                        [sc, pd, ic].forEach(el => el?.classList.add('invisible'));
                                        selectedFilter?.classList.remove('invisible');
                                    }
                                }
                            }

                            window.addEventListener('resize', () => {
                                const filters = document.getElementById('all-filters');
                                const [sc, pd, ic] = [document.getElementById('sc-filter'), document.getElementById('pd-filter'), document.getElementById('ic-filter')];
                                
                                if (window.innerWidth > 1200) {
                                    filters.classList.remove('hidden');
                                    filters.classList.add('grid');
                                    [sc, pd, ic].forEach(el => el?.classList.add('invisible'));
                                } else {
                                    filters.classList.add('hidden');
                                    filters.classList.remove('grid');
                                    [sc, pd, ic].forEach(el => el?.classList.remove('invisible'));
                                }
                            });


                        </script>

                        <!-- FILTERS -->
                        <div id="all-filters" class="absolute top-0 left-1/2 -translate-x-1/2 translate-y-8 p-2 w-max tablet:w-142.5 hidden grid-cols-2 tablet:grid-cols-3 gap-2 tablet:gap-2.5 max-tablet:bg-neutral-200 max-tablet:border max-tablet:border-neutral-400 rounded-md max-tablet:drop-shadow-lg text-xs z-1 **:select-none">
                            <!-- SEARCH CATEGORY -->
                            <div id="sc-filter" class="tablet:bg-neutral-200 tablet:border tablet:border-neutral-400 rounded-md tablet:p-2 tablet:drop-shadow-lg invisible">
                                <b class="tablet:hidden">Search By:</b>
                                <div class="grid grid-cols-[auto_1fr] items-center gap-0.5">
                                    <input type="radio" name="sby" id="stitle" checked>
                                    <label for="stitle" class="pl-1">Title</label>
                                    <input type="radio" name="sby" id="sauthors">
                                    <label for="sauthors" class="pl-1">Authors</label>
                                    <input type="radio" name="sby" id="skeywords">
                                    <label for="skeywords" class="pl-1">Keywords</label>
                                </div>
                            </div>
                            
                            <!-- PUBLISHED DATE -->
                            <div id="pd-filter" class="max-tablet:row-span-2 tablet:bg-neutral-200 tablet:border tablet:border-neutral-400 rounded-md tablet:p-2 tablet:drop-shadow-lg invisible">
                                <b class="tablet:hidden">Year:</b>
                                <div class="flex gap-3" id="pdate-selection">
                                </div>
                            </div>

                            <!-- INCLUSIONS -->
                            <div id="ic-filter" class="tablet:bg-neutral-200 tablet:border tablet:border-neutral-400 rounded-md tablet:p-2 tablet:drop-shadow-lg invisible">
                                <b class="tablet:hidden">Include:</b>
                                <div class="grid grid-cols-[auto_1fr] items-center gap-0.5">
                                    <input type="checkbox" name="include" id="noinfo">
                                    <label for="noinfo" class="pl-1">No Information</label>
                                </div>
                            </div>
                        </div>
                        <script>
                            const sbySelected = document.getElementById('sby-selected');

                            function updateFilters() {
                                document.querySelectorAll('input[name$=sby], input[name$=include]').forEach(input => {
                                    input.addEventListener('change', () => {
                                        if (input.name == 'sby') {
                                            searchCategory = input.id.substring(1);
                                            displaySets();
                                            sbySelected.innerText = searchCategory.charAt(0).toUpperCase() + searchCategory.slice(1);
                                            return;
                                        }

                                        if (input.name == 'include') {
                                            if (input.id == 'noinfo' && input.checked) {
                                                defaultSet = false;
                                                updateYears('no-info');
                                                displaySets();
                                            } else {
                                                defaultSet = true;
                                                updateYears('default');
                                                displaySets();
                                            }
                                            
                                            selectedYears = [];
                                            document.getElementById('include-selected').innerText = defaultSet ? "Default" : "All";
                                            document.getElementById('spdate-selected').innerText = "All";
                                            return;
                                        }
                                    });
                                });
                            }

                            function updateYears(inclusion) {
                                const allYears = [...new Set(data.theses.map(thesis => thesis.published_date.substring(0, 4)))];
                                
                                if (inclusion == 'no-info') {
                                    filteredYears = allYears;
                                } else if (inclusion == 'default') {
                                    filteredYears = allYears.filter(year => 
                                        data.theses.some(thesis => 
                                            thesis.published_date.startsWith(year) && thesis.abstract?.trim() !== ""
                                        )
                                    );
                                }

                                const half = Math.ceil(filteredYears.length / 2);
                                const firstHalf = filteredYears.slice(0, half);
                                const secondHalf = filteredYears.slice(half);

                                document.getElementById('pdate-selection').innerHTML = `
                                    <div class="grid grid-cols-[auto_1fr] items-center gap-0.5 tablet:flex-1">
                                        ${firstHalf.map(year => `
                                            <input type="checkbox" name="spdate" id="s${year}">
                                            <label for="s${year}" class="pl-1">${year}</label>
                                        `).join('')}
                                    </div>
                                    <div class="grid grid-cols-[auto_1fr] items-center gap-0.5 tablet:flex-1">
                                        ${secondHalf.map(year => `
                                            <input type="checkbox" name="spdate" id="s${year}">
                                            <label for="s${year}" class="pl-1">${year}</label>
                                        `).join('')}
                                    </div>
                                `;

                                document.querySelectorAll('input[name=spdate]').forEach(input => {
                                    input.addEventListener('change', () => {
                                        if (input.checked) {
                                            selectedYears.push(input.id.substring(1));
                                        } else {
                                            selectedYears = selectedYears.filter(year => year !== input.id.substring(1));
                                        }

                                        document.getElementById('spdate-selected').innerText = 
                                            selectedYears.length === filteredYears.length ? "All" :
                                            selectedYears.length === 1 ? selectedYears[0] :
                                            selectedYears.length ? `${selectedYears.length} selected` : "All";

                                        displaySets();
                                    });
                                });                                
                            }
                        </script>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <div>

                    </div>
                    <button class="hover:opacity-70 duration-200 cursor-pointer">
                        <img src="resources/dp/01.svg" alt="" class="size-12.5 max-tablet:size-10 max-phone:size-7.5  border-2 rounded-full select-none">
                    </button>
                </div>
            </div>
                
            <h2 class="pt-10 pb-2.5 text-2xl font-bold max-phone:text-lg select-none">Categories</h2>
            <div class="pb-10 h-38 max-phone:h-30 flex gap-2.5 font-semibold max-phone:text-xs select-none *:flex *:flex-col *:items-center *:justify-end *:relative *:cursor-pointer *:drop-shadow-md *:w-20 max-phone:*:w-15"> 
                <label for="category-all" class="group">
                    <input type="radio" name="lib-category" id="category-all" hidden checked class="peer">
                    <img src="resources/book-all.svg" alt="" class="absolute top-0 group-hover:-translate-y-2 duration-200 size-20 max-phone:size-15">
                    <p class="opacity-60 decoration-2 underline-offset-4 peer-checked:underline peer-checked:opacity-100 duration-200">All</p>
                </label>
                <label for="category-cs" class="group">
                    <input type="radio" name="lib-category" id="category-cs" hidden class="peer">
                    <img src="resources/book-cs.svg" alt="" class="absolute top-0 group-hover:-translate-y-2 duration-200 size-20 max-phone:size-15">
                    <p class="opacity-60 decoration-2 underline-offset-4 peer-checked:underline peer-checked:opacity-100 duration-200">BSCS</p>
                </label>
                <label for="category-it" class="group">
                    <input type="radio" name="lib-category" id="category-it" hidden class="peer">
                    <img src="resources/book-it.svg" alt="" class="absolute top-0 group-hover:-translate-y-2 duration-200 size-20 max-phone:size-15">
                    <p class="opacity-60 decoration-2 underline-offset-4 peer-checked:underline peer-checked:opacity-100 duration-200">BSIT</p>
                </label>
                <label for="category-others" class="group">
                    <input type="radio" name="lib-category" id="category-others" hidden class="peer">
                    <img src="resources/book-others.svg" alt="" class="absolute top-0 group-hover:-translate-y-2 duration-200 size-20 max-phone:size-15">
                    <p class="opacity-60 decoration-2 underline-offset-4 peer-checked:underline peer-checked:opacity-100 duration-200">Others</p>
                </label>
            </div>
            <div>
                <!-- CONTROLS -->
                <div class="mb-2.5 flex justify-between items-center **:select-none">
                    <h2 class="text-2xl font-bold max-phone:text-lg">Library</h2>
                    <div class="flex items-center gap-2 text-sm">
                        <i id="page-info" class="max-big-phone:hidden">
                            Showing 1 out of 1 set of results
                        </i>
                        <select id="set-per-page" class="px-10 max-phone:px-5 py-0.5 max-phone:py-0 rounded-xl bg-neutral-200 disabled:cursor-not-allowed border border-neutral-400 max-phone:text-xs outline-none cursor-pointer">
                            <option value="1">1</option>
                        </select>
                        <div class="px-5 max-phone:px-2 py-0.5 rounded-xl flex items-center gap-2 bg-neutral-200 border border-neutral-400">
                            <input type="radio" name="view" id="grid-view" hidden checked class="peer/gv">
                            <input type="radio" name="view" id="list-view" hidden class="peer/lv">
                            <label for="grid-view" class="opacity-40 peer-checked/gv:opacity-100 cursor-pointer">
                                <svg class="size-5 max-phone:size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><!-- Icon from MingCute Icon by MingCute Design - https://github.com/Richard9394/MingCute/blob/main/LICENSE --><g fill="#585345" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M9 13a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2zm10 0a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2zM9 3a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm10 0a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/></g></svg>
                            </label>
                            <label for="list-view" class="opacity-40 peer-checked/lv:opacity-100 cursor-pointer">
                                <svg class="size-5 max-phone:size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><!-- Icon from MingCute Icon by MingCute Design - https://github.com/Richard9394/MingCute/blob/main/LICENSE --><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M7 13a2 2 0 0 1 1.995 1.85L9 15v3a2 2 0 0 1-1.85 1.995L7 20H4a2 2 0 0 1-1.995-1.85L2 18v-3a2 2 0 0 1 1.85-1.995L4 13zm9 4a1 1 0 0 1 .117 1.993L16 19h-4a1 1 0 0 1-.117-1.993L12 17zm4-4a1 1 0 1 1 0 2h-8a1 1 0 1 1 0-2zM7 3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm9 4a1 1 0 0 1 .117 1.993L16 9h-4a1 1 0 0 1-.117-1.993L12 7zm4-4a1 1 0 0 1 .117 1.993L20 5h-8a1 1 0 0 1-.117-1.993L12 3z"/></g></svg>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- LIST VIEW -->
                <div id="library-list" class="h-auto hidden flex-col gap-2.5">
                </div>
                
                <!-- GRID VIEW -->
                <div id="library-grid" class="grid grid-cols-[repeat(auto-fit,minmax(520px,1fr))] max-tablet:grid-cols-[repeat(auto-fit,minmax(440px,1fr))] max-big-phone:flex flex-col flex-wrap gap-5">
                </div>
            </div>
        </div>

        <!-- FULL VIEW -->
        <div id="full-view" class="ml-25 m-5 p-15 w-[calc(100vw-135px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl hidden flex-col bg-off-white text-dirty-brown drag-none z-1
        max-tablet:m-0 max-tablet:p-0 max-tablet:pb-10 max-tablet:w-full max-tablet:min-h-screen max-tablet:rounded-none">
            <div class="pb-2 max-tablet:py-2 max-tablet:px-10">
                <button onclick="view()" class="flex items-center gap-2.5 font-semibold text-lg max-tablet:text-sm cursor-pointer hover:opacity-60 duration-200">
                    <svg class="size-6 max-tablet:size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><!-- Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE --><path fill="currentColor" d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12t.063-.375t.212-.325l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12t-.288.713T19 13z"/></svg>
                    Return to Library
                </button> 
            </div>  

            <!-- BANNER -->
            <div id="banner" class="relative w-full h-100 max-tablet:h-70 max-big-phone:h-45 rounded-3xl max-tablet:rounded-none bg-linear-135/oklch flex gap-10 max-tablet:gap-5">
            </div>

            <!-- INFORMATION -->
            <div id="information" class="mt-25 max-big-phone:mt-15 max-tablet:px-10 w-full flex flex-col gap-10">
            </div>
        </div>
    </main>
    
    <script>
        let gridView = document.getElementById("grid-view");
        let listView = document.getElementById("list-view");
        const gridContainer = document.getElementById("library-grid");
        const listContainer = document.getElementById("library-list");

        window.onload = () => {
            document.getElementById("set-per-page")?.addEventListener("change", e => { selectedSet = e.target.value - 1; displaySets(); });
            document.getElementById("search-box")?.addEventListener("input", e => { searchQuery = e.target.value; selectedSet = 0; displaySets(); });

            gridView.addEventListener("change", () => {
                displaySets();
                gridContainer.classList.remove("hidden");
                gridContainer.classList.add("max-big-phone:flex");
                gridContainer.classList.add("grid");
                listContainer.classList.remove("flex");
                listContainer.classList.add("hidden");
            });

            listView.addEventListener("change", () => {
                displaySets();
                listContainer.classList.remove("hidden")
                listContainer.classList.add("flex");
                gridContainer.classList.remove("max-big-phone:flex")
                gridContainer.classList.remove("grid");
                gridContainer.classList.add("hidden");
            });
        };

        let searchCourse = () => true;

        document.querySelectorAll("[name='lib-category']").forEach(r =>
            r.addEventListener("change", e => {
                searchCourse = book => 
                    e.target.id === "category-it" ? book.course === "BSIT-NS" :
                    e.target.id === "category-cs" ? book.course === "BSCS-AD" :
                    e.target.id === "category-others" ? book.course !== "BSIT-NS" && book.course !== "BSCS-AD" :
                    true;
                
                selectedSet = 0;
                displaySets();
            })
        );
  
        function displaySets() {
            const isGrid = gridView.checked;
            const container = isGrid ? gridContainer : listContainer;
            const pageInfo = document.getElementById("page-info");
            container.innerHTML = "";

            let filteredData = data.theses?.filter(item =>
                (!searchQuery || item[searchCategory.toLowerCase()]?.toLowerCase().includes(searchQuery.toLowerCase())) &&
                (!searchCourse || searchCourse(item)) &&
                (selectedYears.length === 0 || selectedYears.includes(item.published_date.substring(0, 4))) &&
                (defaultSet ? item.abstract?.trim() !== "" : true)
            ) || [];

            let totalSets = Math.ceil(filteredData.length / thesesPerPage)
            selectedSet = Math.max(0, Math.min(selectedSet, totalSets - 1));
            const tsetsSelect = document.getElementById("set-per-page");
            let prevValue = Number(tsetsSelect.value) || 1;
            tsetsSelect.innerHTML = [...Array(totalSets)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("");
            tsetsSelect.value = prevValue <= totalSets ? prevValue : (totalSets > 0 ? totalSets : "1");

            let thesesSlice = filteredData.slice(selectedSet * thesesPerPage, (selectedSet + 1) * thesesPerPage);

            container.innerHTML = thesesSlice.map(item => {
                let darkColor = item.course == "BSCS-AD" ? "*:bg-violet-900" : item.course == "BSIT-NS" ? "*:bg-sky-900" : "*:bg-yellow-800";                         
                let gradient = item.course == "BSCS-AD" ? "from-violet-900 via-purple-400 to-violet-700" : item.course == "BSIT-NS" ? "from-sky-900 via-sky-400 to-sky-800" : "from-yellow-800 via-yellow-500 to-amber-700";
                
                if (isGrid) {
                    return `
                        <div class="relative px-2.5 w-full h-45 max-tablet:h-36 max-phone:h-30 grid grid-cols-[125px_1fr] max-tablet:grid-cols-[100px_1fr] max-phone:grid-cols-[80px_1fr] gap-2.5 text-off-white">
                            <div class="absolute bottom-0 w-full h-35 max-tablet:h-30 max-phone:h-25 rounded-xl bg-linear-135/oklch ${gradient} drop-shadow-lg z-1"></div>
                            <div onclick="view(${item.thesis_id})" class="absolute bottom-0 w-full h-35 max-tablet:h-30 max-phone:h-25 rounded-xl bg-black/40 z-2"></div>
                            <button onclick="view(${item.thesis_id})" class="relative z-3">
                                <img src="resources/${item.course == "BSCS-AD" ? "book-cs" : item.course == "BSIT-NS" ? "book-it" : "book-others"}.svg" alt="" class="absolute top-0 cursor-pointer select-none hover:-translate-y-2 duration-200">
                            </button>
                            <div class="relative pt-12.5 max-tablet:pt-7.5 flex flex-col items-start gap-1 max-phone:gap-0.5 font-semibold max-tablet:text-sm max-phone:text-xs max-phone:leading-3 leading-4 z-3">
                                ${item.course.trim() !== "BSCS-AD" && item.course.trim() !== "BSIT-NS" ? `<i class="px-2 rounded-full bg-yellow-800 text-xs select-none">${item.course}</i>` : ""}
                                <h3>${item.title}</h3>
                                <ul class="flex flex-wrap gap-0.5 max-big-phone:hidden text-xs *:px-2 *:rounded-full ${darkColor}">
                                    ${item.authors.split("-").map(author => `<li>${author.trim()}</li>`).join("")}
                                </ul>
                                <p class="absolute bottom-2.5 right-0 font-normal flex items-center gap-1 text-sm max-tablet:text-xs">${item.abstract?.trim() == "" ? '<span class="px-2 rounded-full bg-red-900 text-xs select-none">(No information available)</span>' : ''}${item.published_date}</p>
                            </div>
                        </div>
                    `;
                } else {
                    return `
                        <div class="group w-full p-2.5 h-30 max-big-phone:h-27.5 rounded-xl shadow-lg bg-neutral-100 border border-neutral-300 hover:border-dirty-brown/70 flex gap-2.5 cursor-pointer">
                            <div onclick="view(${item.thesis_id})" class="relative w-20 max-big-phone:w-17 h-full">
                                <img src="resources/${item.course == "BSCS-AD" ? "book-cs" : item.course == "BSIT-NS" ? "book-it" : "book-others"}.svg" alt="" class="absolute top-0 left-0 group-hover:-translate-y-2.5 duration-300 h-full drop-shadow-lg select-none">
                            </div>
                            <div class="flex-1 flex flex-col items-start justify-center cursor-auto select-text" onmousedown="event.stopPropagation()">
                                ${item.course.trim() !== "BSCS-AD" && item.course.trim() !== "BSIT-NS" ? `<i class="max-big-phone:mb-0.5 px-2 rounded-full bg-yellow-800/80 text-xs text-off-white select-none">${item.course}</i>` : ""}
                                <h3 class="font-semibold text-lg leading-4 max-big-phone:text-sm max-big-phone:leading-3">${item.title}</h3>
                                <i class="leading-4 max-big-phone:text-xs">${item.authors.split("-").map(author => author.replace("-", " "))}</i>
                                <p class="text-sm max-big-phone:text-xs leading-3">May 2024</p>
                            </div>
                        </div>
                    `;
                }
            }).join("");

            if (pageInfo) pageInfo.textContent = totalSets != 0 ? `Showing ${selectedSet + 1} of ${totalSets} set/s of results` : "No results found";
            tsetsSelect.disabled = totalSets == 0;
        }

        function view(thesis_id) {
            document.getElementById("full-view").classList.toggle("hidden");
            const library = document.getElementById("library");
            library.classList.toggle("hidden");
            library.classList.toggle("flex");

            if (!thesis_id) {
                return;
            }
            
            const banner = document.getElementById("banner");
            const information = document.getElementById("information");

            let item = data.theses.find(item => item.thesis_id == thesis_id);

            let darkColor = item.course == "BSCS-AD" ? "bg-violet-900" : item.course == "BSIT-NS" ? "bg-sky-900" : "bg-yellow-800";                         
            let gradient = item.course == "BSCS-AD" ? "from-violet-900 via-purple-400 to-violet-700" : item.course == "BSIT-NS" ? "from-sky-900 via-sky-400 to-sky-800" : "from-yellow-800 via-yellow-500 to-amber-700";

            banner.className = `relative w-full h-100 max-tablet:h-70 max-big-phone:h-45 rounded-3xl max-tablet:rounded-none bg-linear-135/oklch ${gradient} flex gap-10 max-tablet:gap-5`;
            banner.innerHTML = `
                <div class="absolute top-0 size-full rounded-3xl max-tablet:rounded-none bg-black/25 z-1"></div>
                <button onclick="view()" class="relative ml-10 max-big-phone:ml-5 w-80 max-tablet:w-50 max-big-phone:w-30 z-2">
                    <img src="resources/${item.course == "BSCS-AD" ? "book-cs" : item.course == "BSIT-NS" ? "book-it" : "book-others"}.svg" alt="" class="absolute top-10 hover:-translate-y-5 duration-300 drop-shadow-xl select-none cursor-pointer">
                </button>
                <div class="relative flex-1 mr-10 max-big-phone:mr-5 h-full flex flex-col justify-center text-off-white z-2">
                    <p class="italic text-xl max-tablet:text-base max-big-phone:text-xs leading-5 max-tablet:leading-4 max-big-phone:leading-3">${item.course == "BSCS-AD" ? "Bachelor of Science in Computer Science" : item.course == "BSIT-NS" ? "Bachelor of Science in Information Technology" : item.course == "BSCNA" ? "Bachelor of Science in Computer Network Administration" : item.course}</p>
                    <h1 class="font-bold text-3xl max-tablet:text-lg max-big-phone:text-sm leading-7 max-tablet:leading-5 max-big-phone:leading-3.5">${item.title}</h1>
                    <ul class="mt-1 flex flex-wrap gap-1 max-big-phone:hidden text-sm max-tablet:text-xs *:px-2 *:rounded-full *:${darkColor}">
                        Authors:
                        ${item.authors.split("-").map(author => `<li>${author.trim()}</li>`).join("")}
                    </ul>
                    <p class="absolute bottom-5 right-0 max-big-phone:bottom-2.5 max-big-phone:-right-2.5 max-tablet:text-sm max-big-phone:text-xs">${item.published_date}</p>
                    <div class="absolute top-5 right-0 max-big-phone:top-2.5 max-big-phone:-right-2.5 *:select-none max-tablet:scale-80 max-big-phone:scale-60">
                        <input type="radio" name="bm" id="bmoff" hidden checked class="peer/bmoff">
                        <input type="radio" name="bm" id="bmon" hidden class="peer/bmon">
                        <label for="bmon" class="hidden peer-checked/bmoff:block cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from MingCute Icon by MingCute Design - https://github.com/Richard9394/MingCute/blob/main/LICENSE --><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="#eeeeee" d="M4 5a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v16.028c0 1.22-1.38 1.93-2.372 1.221L12 18.229l-5.628 4.02c-.993.71-2.372 0-2.372-1.22zm3-1a1 1 0 0 0-1 1v15.057l5.128-3.663a1.5 1.5 0 0 1 1.744 0L18 20.057V5a1 1 0 0 0-1-1z"/></g></svg>
                        </label>
                        <label for="bmoff" class="hidden peer-checked/bmon:block cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from MingCute Icon by MingCute Design - https://github.com/Richard9394/MingCute/blob/main/LICENSE --><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="#eeeeee" d="M4 5a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v16.028c0 1.22-1.38 1.93-2.372 1.221L12 18.229l-5.628 4.02c-.993.71-2.372 0-2.372-1.22z"/></g></svg>
                        </label>
                    </div>
                </div>
            `;

            information.innerHTML = item.abstract?.trim() == "" ? "<div class='text-center'>No information available.</div>" : `
                <div>
                    <h2 class="border-l-4 pl-2.5 font-bold text-2xl max-tablet:text-xl">Abstract</h2>
                    <p class="mt-2.5 text-justify text-lg max-tablet:text-base leading-5 max-tablet:leading-4">
                        ${item.abstract}
                    </p>
                </div>
                <div>
                    <h2 class="border-l-4 pl-2.5 font-bold text-2xl max-tablet:text-xl">Keywords</h2>
                    <p class="mt-2.5 text-justify text-lg max-tablet:text-base leading-5 max-tablet:leading-4">
                        ${item.keywords}
                    </p>
                </div>
                <div>
                    <h2 class="border-l-4 pl-2.5 font-bold text-2xl max-tablet:text-xl">Citation</h2>
                    <div class="relative mt-2.5 p-5 bg-neutral-200 border border-neutral-400 rounded-xl text-lg max-tablet:text-sm leading-5 max-tablet:leading-4 max-phone:*:break-all">
                        <span class="pl-10 -indent-10 font-serif">
                            University of Makati. (2025, March 10). College of Computing and Information Sciences - University of Makati. https://www.umak.edu.ph/academics/college/ccis/
                        </span>
                        <button class="absolute top-2.5 right-2.5 cursor-pointer active:scale-90 duration-200 hover:opacity-60 outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><!-- Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE --><path fill="#585345" d="M9 18q-.825 0-1.412-.587T7 16V4q0-.825.588-1.412T9 2h9q.825 0 1.413.588T20 4v12q0 .825-.587 1.413T18 18zm-4 4q-.825 0-1.412-.587T3 20V6h2v14h11v2z"/></svg>
                        </button>
                    </div>
                </div>
            `;
        } 
    </script>
</body>

</html>