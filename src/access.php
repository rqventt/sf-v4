<?php
if (isset($_COOKIE['id'])) {
    header("Location: profile.php");
    exit();
}

session_start();
$activeForm = $_SESSION['activeForm'] ?? 'loginform';

function activeForm($form, $activeForm) {
    return $form === $activeForm ? "block" : "hidden";
}
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
    <main>
        <?php
            $error = $_SESSION['log-error'] ?? $_SESSION['reg-error'] ?? '';
            if ($error) {
                echo "<div class='absolute top-5 left-1/2 -translate-x-1/2 p-2 w-100 h-10 rounded-xl bg-[#7f1d1d] select-none z-5 animate-downfadeinout'>" . $error . "</div>";
            }

            session_unset();
        ?>
        <!-- LOGIN -->
        <div class="max-sm:scale-75 max-lg:scale-90 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 w-110 h-140 rounded-3xl bg-[#060d0d79] backdrop-blur-lg shadow-[var(--around-shadow-md)] animate-fadeIn <?php echo activeForm('loginform', $activeForm); ?>" id="log-content">
            <form action="login.php" method="post" class="h-full flex flex-col justify-between gap-2 select-none" id="login-form">
                <h2 class="py-5 text-center text-3xl font-semibold">Welcome back!</h2>
                <div class="flex flex-col gap-2">
                    <span class="relative flex flex-col">
                        <label for="lemail">Email Address:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M170-114q-56.72 0-96.36-40.14Q34-194.27 34-250v-460q0-55.72 39.64-95.86T170-846h620q56.72 0 96.36 40.14T926-710v460q0 55.73-39.64 95.86Q846.72-114 790-114H170Zm310-274 310-200v-122L480-508 170-710v122l310 200Z"/></svg>
                        <input type="email" name="lemail" id="lemail" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none" autocomplete="off"> 
                    </span>
                    <span class="relative flex flex-col">
                        <label for="lpass">Password:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M250-32q-55.98 0-95.99-40.01Q114-112.03 114-168v-379q0-57.38 40.01-96.69Q194.02-683 250-683h4v-51q0-96 66.19-163T480-964q93.62 0 159.81 67T706-734v51h4q55.97 0 95.99 39.31Q846-604.38 846-547v379q0 55.97-40.01 95.99Q765.97-32 710-32H250Zm230.16-239q35.84 0 60.34-25.16 24.5-25.17 24.5-60.5Q565-392 540.34-417t-60.5-25q-35.84 0-60.34 25.02-24.5 25.01-24.5 60.14 0 35.54 24.66 60.69t60.5 25.15ZM390-683h180v-51q0-39.33-26.12-66.67-26.12-27.33-64-27.33Q442-828 416-800.67q-26 27.34-26 66.67v51Z"/></svg>
                        <input type="password" name="lpassword" id="lpassword" required class="peer pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none" autocomplete="off" placeholder="  ">
                        <span class="showpw absolute right-2 bottom-2 cursor-pointer peer-placeholder-shown:hidden">
                            <a onclick="showpw('login')" class="hidden" id="ltoshowpw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M480.18-311Q559-311 614-366.18q55-55.17 55-134Q669-579 613.82-634q-55.17-55-134-55Q401-689 346-633.82q-55 55.17-55 134Q291-421 346.18-366q55.17 55 134 55Zm-.12-101q-36.64 0-62.35-25.65T392-499.94q0-36.64 25.65-62.35T479.94-588q36.64 0 62.35 25.65T568-500.06q0 36.64-25.65 62.35T480.06-412ZM480-157q-163 0-294.5-95T-5-500q59-153 190.5-248T480-843q163 0 294.5 95T965-500q-59 153-190.5 248T480-157Z"/></svg>
                            </a>
                            <a onclick="showpw('login')" class="" id="ltohidepw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M783-27 628-181q-33 12-69.5 18t-78.5 6q-163 0-294-92.5T-5-500q19-52 51.5-101t71.5-90L11-798l74-74 771 772-73 73ZM480-311q5 0 10-.5t10-1.5L291-520v20q0 80 54.5 134.5T480-311Zm333 29L657-438q7-14 9.5-31.5T669-500q0-80-54.5-134.5T480-689q-15 0-31.5 3t-30.5 8L289-807q42-17 91.5-26.5T480-843q162 0 292.5 92T965-500q-23 64-64 120.5T813-282ZM549-547l-30-29q7-1 12.5.5t9.5 6.5q4 4 6.5 10t1.5 12Z"/></svg>
                            </a>
                        </span>
                        <a href="fpw.php" class="absolute right-0 -bottom-6 text-sm italic cursor-pointer select-none hover:opacity-80">Forgot your password?</a>
                    </span>
                </div>
                <div class="pb-5 flex flex-col items-center gap-1 select-none">
                    <input type="submit" class="py-1 w-30 rounded-lg bg-green-900 text-sm cursor-pointer hover:opacity-80 active:scale-95" name="login" value="Login">
                    <i class="text-sm">Don't have an acccount? <a onclick="changelogmode()" class="text-[#32882a] font-bold cursor-pointer hover:opacity-80">Register now!</a></i>
                </div>
            </form>
        </div>

        <!-- REGISTRATION -->
        <div class="max-sm:scale-75 max-lg:scale-90 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 w-110 h-150 rounded-3xl bg-[#060d0d79] backdrop-blur-lg shadow-[var(--around-shadow-md)] animate-fadeIn <?php echo activeForm('regisform', $activeForm); ?>" id="reg-content">
            <form action="login.php" method="post" class="w-full h-full flex flex-col justify-between gap-2 select-none" id="regis-form">
                <h2 class="py-5 text-center text-3xl font-semibold select-none">Registration</h2>
                <div class="flex flex-col gap-2">
                    <span class="relative flex flex-col">
                        <label for="rname">Name:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M172-34q-57.12 0-96.56-39.44Q36-112.88 36-170v-419q0-57.13 39.44-96.56Q114.88-725 172-725h144v-88q0-51.13 31.44-82.56Q378.88-927 430-927h100q51.13 0 82.56 31.44Q644-864.13 644-813v88h144q57.13 0 96.56 39.44Q924-646.13 924-589v419q0 57.12-39.44 96.56Q845.13-34 788-34H172Zm63-187h248v-20q0-18.48-10.5-34.24Q462-291 445-298q-21-10-42.5-14.5T359-317q-22 0-43 4.5T274-298q-17.58 7.14-28.29 22.59T235-241v20Zm326-60h164v-66H561v66Zm-201.5-66q26.5 0 44.5-18.5t18-45q0-26.5-18.04-44.5T359-473q-26 0-44.5 18.04T296-410q0 26 18.5 44.5t45 18.5ZM561-403h164v-67H561v67ZM442-640h76v-161h-76v161Z"/></svg>
                        <input type="text" name="rname" id="rname" placeholder="Juan Dela Cruz" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none" autocomplete="off">
                    </span>
                    <span class="relative flex flex-col">
                        <label for="rusername">Username:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M480.16-502Q395-502 336.5-561T278-704.5q0-84.5 58.34-142.5t143.5-58q85.16 0 143.66 57.89T682-704q0 84-58.34 143t-143.5 59ZM114-86v-159q0-46.77 23.79-84.47Q161.58-367.16 201-387q66-34 136.17-51 70.18-17 142.55-17Q554-455 624-438t135 50q39.42 19.69 63.21 57.11T846-245.05V-86H114Z"/></svg>
                        <input type="text" name="rusername" id="rusername" placeholder="Juan" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none" autocomplete="off">
                    </span class="relative flex flex-col">
                    <span class="relative flex flex-col">
                        <label for="remail">Email Address:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M170-114q-56.72 0-96.36-40.14Q34-194.27 34-250v-460q0-55.72 39.64-95.86T170-846h620q56.72 0 96.36 40.14T926-710v460q0 55.73-39.64 95.86Q846.72-114 790-114H170Zm310-274 310-200v-122L480-508 170-710v122l310 200Z"/></svg>
                        <input type="email" name="remail" id="remail" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none" autocomplete="off">
                    </span>
                    <span class="relative flex flex-col">
                        <label for="rpassword">Password:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M250-32q-55.98 0-95.99-40.01Q114-112.03 114-168v-379q0-57.38 40.01-96.69Q194.02-683 250-683h4v-51q0-96 66.19-163T480-964q93.62 0 159.81 67T706-734v51h4q55.97 0 95.99 39.31Q846-604.38 846-547v379q0 55.97-40.01 95.99Q765.97-32 710-32H250Zm230.16-239q35.84 0 60.34-25.16 24.5-25.17 24.5-60.5Q565-392 540.34-417t-60.5-25q-35.84 0-60.34 25.02-24.5 25.01-24.5 60.14 0 35.54 24.66 60.69t60.5 25.15ZM390-683h180v-51q0-39.33-26.12-66.67-26.12-27.33-64-27.33Q442-828 416-800.67q-26 27.34-26 66.67v51Z"/></svg>
                        <input type="password" name="rpassword" id="rpassword" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[A-Z]).{8,}$" class="peer pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none" autocomplete="off" placeholder="  ">
                        <span class="showpw absolute right-2 bottom-2 cursor-pointer peer-placeholder-shown:hidden">
                            <a onclick="showpw('register')" class="hidden" id="rtoshowpw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M480.18-311Q559-311 614-366.18q55-55.17 55-134Q669-579 613.82-634q-55.17-55-134-55Q401-689 346-633.82q-55 55.17-55 134Q291-421 346.18-366q55.17 55 134 55Zm-.12-101q-36.64 0-62.35-25.65T392-499.94q0-36.64 25.65-62.35T479.94-588q36.64 0 62.35 25.65T568-500.06q0 36.64-25.65 62.35T480.06-412ZM480-157q-163 0-294.5-95T-5-500q59-153 190.5-248T480-843q163 0 294.5 95T965-500q-59 153-190.5 248T480-157Z"/></svg>
                            </a>
                            <a onclick="showpw('register')" id="rtohidepw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M783-27 628-181q-33 12-69.5 18t-78.5 6q-163 0-294-92.5T-5-500q19-52 51.5-101t71.5-90L11-798l74-74 771 772-73 73ZM480-311q5 0 10-.5t10-1.5L291-520v20q0 80 54.5 134.5T480-311Zm333 29L657-438q7-14 9.5-31.5T669-500q0-80-54.5-134.5T480-689q-15 0-31.5 3t-30.5 8L289-807q42-17 91.5-26.5T480-843q162 0 292.5 92T965-500q-23 64-64 120.5T813-282ZM549-547l-30-29q7-1 12.5.5t9.5 6.5q4 4 6.5 10t1.5 12Z"/></svg>
                            </a>
                        </span>
                        <div class="hidden peer-focus:block absolute left-7 -bottom-22 p-2 border-1 rounded-md bg-zinc-700 border-zinc-800 text-xs shadow-xl select-none z-10 animate-fadeIn">
                            <ul class="list-disc list-inside">
                                Password must contain:
                                <li id="con1">at least 8 characters</li>
                                <li id="con2">alphanumeric characters</li>
                                <li id="con3">at least one uppercase character</li>
                            </ul>
                        </div>
                    </span>
                </div>
                <div class="pb-5 flex flex-col items-center gap-1 select-none">
                    <div class="g-recaptcha scale-70" id="captcha1" data-sitekey="6LdIQ_UqAAAAAGrV2MqdRUY2QWN7dGJP3G9Q4NET"></div>
                    <input type="submit" class="py-1 w-30 rounded-lg bg-green-900 text-sm cursor-pointer hover:opacity-80 active:scale-95" name="register" value="Register">
                    <i class="text-sm">Already have an account? <a onclick="changelogmode()" class="text-[#32882a] font-bold cursor-pointer hover:opacity-80">Login here!</a></i>
                </div>
            </form>
        </div>
        <script>
            const loginform = document.getElementById('log-content');
            const regisform = document.getElementById('reg-content');

            function changelogmode() {
                loginform.classList.toggle('hidden');
                regisform.classList.toggle('hidden');
            }

            const ltoshowpw = document.getElementById('ltoshowpw');
            const ltohidepw = document.getElementById('ltohidepw');
            const lpassword = document.getElementById('lpassword');
            const rtoshowpw = document.getElementById('rtoshowpw');
            const rtohidepw = document.getElementById('rtohidepw');
            const rpassword = document.getElementById('rpassword');
            const con1 = document.getElementById('con1');
            const con2 = document.getElementById('con2');
            const con3 = document.getElementById('con3');

            function showpw(mode) {
                if (mode === 'login') {
                    if (lpassword.type === 'password') {
                        lpassword.type = 'text';
                        ltoshowpw.classList.add('hidden');
                        ltohidepw.classList.remove('hidden');
                    } else {
                        lpassword.type = 'password';
                        ltoshowpw.classList.remove('hidden');
                        ltohidepw.classList.add('hidden');
                    }
                } else if (mode === 'register') {
                    if (rpassword.type === 'password') {
                        rpassword.type = 'text';
                        rtoshowpw.classList.add('hidden');
                        rtohidepw.classList.remove('hidden');
                    } else {
                        rpassword.type = 'password';
                        rtoshowpw.classList.remove('hidden');
                        rtohidepw.classList.add('hidden');
                    }
                }
            }

            rpassword.addEventListener('input', () => {
                let tempPass = rpassword.value;

                let lengthPattern = /^.{8,}$/;
                let alphanumericPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\W]+$/;
                let uppercasePattern = /[A-Z]/; 

                lengthPattern.test(tempPass) ? con1.classList.add('line-through', 'opacity-50') : con1.classList.remove('line-through', 'opacity-50');
                alphanumericPattern.test(tempPass) ? con2.classList.add('line-through', 'opacity-50') : con2.classList.remove('line-through', 'opacity-50');
                uppercasePattern.test(tempPass) ? con3.classList.add('line-through', 'opacity-50') : con3.classList.remove('line-through', 'opacity-50');
            });


            const fpwdiv = document.getElementById('fpwdiv');

            function forgetpw() {
                fpwdiv.classList.toggle('hidden');
                fpwdiv.classList.toggle('flex');
                loginform.classList.toggle('hidden');
                loginform.classList.toggle('flex');
            }
        </script>
    </main>
</body>
</html>