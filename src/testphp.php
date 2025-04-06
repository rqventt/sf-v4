<?php
    session_start();
    if (!isset($_COOKIE['id'])) {
        $_SESSION['log-error'] = 'Error: Unauthorized access! Please login first.';
        header("Location: access.php");
        exit();
    }

    require_once 'config.php';

    $sql = "SELECT thesis_id, archived, published_date, course, title, authors, abstract, keywords FROM theses";
    $result = $conn->query($sql);

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
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-[url('resources/lib-bg.jpg')] font-nunito text-white flex">
    <div class="fixed inset-0 bg-black/50 h-full z-0 max-tablet:hidden"></div>
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
    <nav class="tablet:hidden z-50">
        <input type="checkbox" hidden id="menu" class="peer">
        <label for="menu" class="fixed right-0 top-50 pl-2.5 rounded-l-full bg-dirty-brown">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#eeeeee" class="p-1.5 size-8.5 cursor-pointer">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </label>
        <label for="menu" class="fixed top-0 left-0 w-screen h-screen bg-black/50 hidden peer-checked:block"></label>
        <div class="fixed top-0 right-0 pt-20 overflow-clip w-70 h-screen bg-off-white hidden peer-checked:flex flex-col font-semibold text-lg text-dirty-brown animate-header **:select-none">
            <label for="menu" class="absolute top-5 right-5">
                <svg class="size-9" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#585345"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </label>
            <h1 class="px-7.5 text-2xl font-bold">Scholar Finds</h1>
            <hr class="my-5 w-full opacity-30 *:active:bg-neutral-300">
            <div class="w-full *:px-7.5 *:py-2 *:active:bg-neutral-300">
                <a href="index.html" class="block w-full">Home</a>
                <a href="about.html" class="block w-full">About</a>
                <a href="contact.html" class="block w-full">Contact</a>
            </div>
            <hr class="my-5 w-full opacity-30 *:active:bg-neutral-300">
            <div class="w-full *:px-7.5 *:py-2">
                <a href="library.php" class="block w-full">Library</a>
                <a href="bookmarks.html" class="block w-full">Bookmarks</a>
                <a href="profile.php" class="block w-full">Profile</a>
               
            </div>
            <hr class="my-5 w-full opacity-30 *:active:bg-neutral-300">
            <div class="w-full *:px-7.5 *:py-2">
                <a href="" class="block w-full text-red-700">Logout</a>
                <a href="admin.php" class="block w-full">Admin</a>
            </div>
        </div>
    </nav>
    
    <main class="relative z-2 w-screen">
        <div id="library" class="ml-25 m-5 p-15 w-[calc(100vw-135px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl flex flex-col bg-off-white text-dirty-brown drag-none z-1
        max-tablet:m-0 max-tablet:p-10 max-phone:p-8 max-tablet:w-full max-tablet:min-h-screen max-tablet:rounded-none">
            <div class="w-full flex justify-between items-center">
                <div class="relative flex items-center gap-5 max-big-phone:gap-1">
                    <span class="relative select-none">
                        <svg class="absolute top-1/2 -translate-y-1/2 left-2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#585345"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                        <input id="search-box" placeholder="Search for a thesis book..." class="px-5 pl-8 py-1 max-tablet:w-55 max-phone:w-48 w-80 border-2 rounded-2xl border-dirty-brown max-tablet:text-sm max-phone:text-xs text-dirty-brown outline-none">
                    </span>
                    <select id="search-filter" class="px-3 py-1 w-40 h-9 max-tablet:h-8 max-big-phone:hidden border-2 rounded-2xl border-dirty-brown max-tablet:text-sm text-dirty-brown outline-none select-none cursor-pointer">
                        <option value="title" class="text-disabled">Filter by:</option>
                        <option value="title">Title</option>
                        <option value="authors">Author</option>
                        <option value="published_date">Published Date</option>
                    </select>
                    <input type="checkbox" id="filter" hidden class="peer">
                    <label for="filter" id="mob-search-filter" class="hidden max-big-phone:block p-1 rounded-md bg-dirty-brown text-off-white">
                        <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><!-- Icon from Material Symbols by Google - https://github.com/google/material-design-icons/blob/master/LICENSE --><path fill="currentColor" d="M11 20q-.425 0-.712-.288T10 19v-6L4.2 5.6q-.375-.5-.112-1.05T5 4h14q.65 0 .913.55T19.8 5.6L14 13v6q0 .425-.288.713T13 20z"/></svg>
                    </label>
                    <div class="absolute z-1 top-8.5 right-0 hidden peer-checked:flex big-phone:hidden flex-col bg-neutral-200 p-2 rounded-md drop-shadow-md border border-neutral-300 text-xs *:flex *:items-center *:gap-2 **:select-none">
                        <p class="mb-1">Filter by:</p>
                        <span>
                            <input type="radio" name="mobile-search-filter" id="title-filter" class="peer size-2.5">
                            <label for="title-filter" class="flex-1 peer-checked:font-bold">Title</label>
                        </span>
                        <span>
                            <input type="radio" name="mobile-search-filter" id="authors-filter" class="peer size-2.5">
                            <label for="authors-filter" class="flex-1 peer-checked:font-bold">Author</label>
                        </span>
                        <span>
                            <input type="radio" name="mobile-search-filter" id="published_date-filter" class="peer size-2.5">
                            <label for="published_date-filter" class="flex-1 peer-checked:font-bold">Published Date</label>
                        </span>
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
                    <p class="opacity-60 decoration-2 underline-offset-4 peer-checked:underline peer-checked:opacity-100 duration-200">Other</p>
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
                <div id="library-list" class="h-auto hidden flex-col">
                </div>
                
                <!-- GRID VIEW -->
                <div id="library-grid" class="grid grid-cols-[repeat(auto-fit,minmax(520px,1fr))] max-tablet:grid-cols-[repeat(auto-fit,minmax(440px,1fr))] max-big-phone:flex flex-col flex-wrap gap-5">
                </div>
            </div>
        </div>

        <!-- FULL VIEW -->
        <div id="full-view" class="ml-25 m-5 p-15 w-[calc(100vw-135px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl hidden flex-col bg-off-white text-dirty-brown drag-none z-1
        max-tablet:m-0 max-tablet:p-0 max-tablet:pb-10 max-tablet:w-full max-tablet:min-h-screen max-tablet:rounded-none">
            <div class="mb-2 max-tablet:my-2 max-tablet:px-10">
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
        const selectFilter = document.getElementById("search-filter");
        const radioFilters = document.querySelectorAll("[name='mobile-search-filter']");

        selectFilter.onchange = () => document.getElementById(`${selectFilter.value}-filter`).checked = true;
        radioFilters.forEach(r => r.onchange = () => selectFilter.value = r.id.replace("-filter", ""));
        document.getElementById(`${selectFilter.value}-filter`).checked = true;

        window.addEventListener("resize", () => window.innerWidth > 700 && (document.getElementById("filter").checked = false));

        let gridView = document.getElementById("grid-view");
        let listView = document.getElementById("list-view");
        const gridContainer = document.getElementById("library-grid");
        const listContainer = document.getElementById("library-list");

        window.onload = () => {
            document.getElementById("set-per-page")?.addEventListener("change", e => { selectedSet = e.target.value - 1; displaySets(); });
            document.getElementById("search-box")?.addEventListener("input", e => { searchQuery = e.target.value; selectedSet = 0; displaySets(); });
            document.getElementById("search-filter")?.addEventListener("change", e => { searchCategory = e.target.value; selectedSet = 0; displaySets(); });
            document.querySelectorAll("[name='mobile-search-filter']").forEach(r => r.addEventListener("change", e => (searchCategory = e.target.id.replace("-filter", ""), selectedSet = 0, displaySets())));

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
  
        let data = { theses: [] }, thesesPerPage = 12, selectedSet = 0, searchQuery = "", searchCategory = "title";

        fetch('data.json')
            .then(res => res.json())
            .then(jsonData => { data = jsonData; displaySets(); })
            .catch(err => console.error("Error retrieving data:", err));
            
            function displaySets() {
            const isGrid = gridView.checked;
            const container = isGrid ? gridContainer : listContainer;
            const pageInfo = document.getElementById("page-info");
            container.innerHTML = "";
            let filteredData = data.theses?.filter(item => !searchQuery || item[searchCategory]?.toLowerCase().includes(searchQuery.toLowerCase())).filter(item => !searchCourse || searchCourse(item)) || [];
            let totalSets = Math.ceil(filteredData.length / thesesPerPage)
            selectedSet = Math.max(0, Math.min(selectedSet, totalSets - 1));
            const tsetsSelect = document.getElementById("set-per-page");
            let prevValue = Number(tsetsSelect.value) || 1;
            tsetsSelect.innerHTML = [...Array(totalSets)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("");
            tsetsSelect.value = prevValue <= totalSets ? prevValue : (totalSets > 0 ? totalSets : "1");

            let thesesSlice = filteredData.slice(selectedSet * thesesPerPage, (selectedSet + 1) * thesesPerPage);

            container.innerHTML = thesesSlice.map(item => {
                let darkColor = item.course == "BSCS-AD" ? "*:bg-violet-900" : item.course == "BSIT-NS" ? "*:bg-sky-900" : "*:bg-yellow-800";                         
                let gradient = item.course == "BSCS-AD" ? "from-violet-900 via-purple-400 to-violet-700" : item.course == "BSIT-NS" ? "from-sky-900 via-sky-400 to-sky-800" : "from-yellow-800 via-yellow-600 to-amber-700";
                
                if (isGrid) {
                    return `
                        <div class="relative px-2.5 w-full h-45 max-tablet:h-36 max-phone:h-30 grid grid-cols-[125px_1fr] max-tablet:grid-cols-[100px_1fr] max-phone:grid-cols-[80px_1fr] gap-2.5 text-off-white">
                            <div class="absolute bottom-0 w-full h-35 max-tablet:h-30 max-phone:h-25 rounded-xl bg-linear-135/oklch ${gradient} z-1"></div>
                            <div class="absolute bottom-0 w-full h-35 max-tablet:h-30 max-phone:h-25 rounded-xl bg-black/40 z-2"></div>
                            <button onclick="view(${item.thesis_id})" class="relative z-3">
                                <img src="resources/${item.course == "BSCS-AD" ? "book-cs" : item.course == "BSIT-NS" ? "book-it" : "book-others"}.svg" alt="" class="absolute top-0 cursor-pointer select-none hover:-translate-y-2 duration-200">
                            </button>
                            <div class="relative pt-12.5 max-tablet:pt-7.5 max-big-phone:pt-8 flex flex-col gap-1 font-semibold max-tablet:text-sm max-phone:text-xs max-phone:leading-3 leading-4 z-3">
                                <h3>${item.title}</h3>
                                <ul class="mt-1 flex flex-wrap gap-0.5 max-big-phone:hidden text-xs *:px-2 *:rounded-full ${darkColor}">
                                    ${item.authors.split("-").map(author => `<li>${author.trim()}</li>`).join("")}
                                </ul>
                                <p class="absolute bottom-2.5 right-0 font-normal text-sm max-tablet:text-xs">${item.published_date}</p>
                            </div>
                        </div>
                    `;
                } else {
                    return `
                        <div class="w-full py-2.5 h-30 flex gap-5 max-tablet:gap-3 border-b-2 border-dirty-brown/30">
                            <img src="resources/${item.course == "BSCS-AD" ? "book-cs" : item.course == "BSIT-NS" ? "book-it" : "book-others"}.svg" alt="" class="h-full">
                            <div class="flex-1 flex flex-col justify-center">
                                <h3 class="max-tablet:text-base max-phone:text-xs text-lg font-semibold leading-4 max-phone:leading-3">${item.title}</h3>
                                <i class="opacity-80 max-tablet:text-sm max-tablet:leading-4 max-phone:text-xs">${item.authors}</i>
                                <p class="font-normal text-sm max-phone:text-xs">${item.published_date}</p>
                            </div>
                            <button class="w-10 max-tablet:w-auto flex items-center justify-center hover:opacity-60 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#585345">
                                    <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z"/>
                                </svg>
                            </button>
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

            const banner = document.getElementById("banner");
            const information = document.getElementById("information");

            let item = data.theses.find(item => item.thesis_id == thesis_id);

            let darkColor = item.course == "BSCS-AD" ? "bg-violet-900" : item.course == "BSIT-NS" ? "bg-sky-900" : "bg-yellow-800";                         
            let gradient = item.course == "BSCS-AD" ? "from-violet-900 via-purple-400 to-violet-700" : item.course == "BSIT-NS" ? "from-sky-900 via-sky-400 to-sky-800" : "from-yellow-800 via-yellow-600 to-amber-700";

            banner.className = `relative w-full h-100 max-tablet:h-70 max-big-phone:h-45 rounded-3xl max-tablet:rounded-none bg-linear-135/oklch ${gradient} flex gap-10 max-tablet:gap-5`;
            banner.innerHTML = `
                <div class="absolute top-0 size-full rounded-3xl max-tablet:rounded-none bg-black/25 z-1"></div>
                <div class="relative ml-10 max-big-phone:ml-5 w-80 max-tablet:w-50 max-big-phone:w-30 z-2">
                    <img src="resources/${item.course == "BSCS-AD" ? "book-cs" : item.course == "BSIT-NS" ? "book-it" : "book-others"}.svg" alt="" class="absolute top-10 hover:-translate-y-5 duration-300 drop-shadow-xl select-none">
                </div>
                <div class="relative flex-1 mr-10 max-big-phone:mr-5 h-full flex flex-col justify-center text-off-white z-2">
                    <p class="italic text-xl max-tablet:text-base max-big-phone:text-xs leading-5 max-tablet:leading-4 max-big-phone:leading-3">${item.course == "BSCS-AD" ? "Bachelor of Science in Computer Science" : item.course == "BSIT-NS" ? "Bachelor of Science in Information Technology" : item.course}</p>
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