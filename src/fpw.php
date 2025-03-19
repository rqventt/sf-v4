<?php
if (isset($_COOKIE['id'])) {
    header("Location: profile.php");
    exit();
}

session_start();
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="h-[200vh] bg-[url('resources/lib-bg.jpg')] font-nunito text-white flex">
    <div class="fixed inset-0 bg-black/50 h-screen z-0"></div>
    <header class="group fixed pt-10 pb-10 w-20 hover:w-60 duration-500 ease-out h-screen flex flex-col justify-between bg-[#060d0d99] backdrop-blur-md shadow-[var(--around-shadow-md)] select-none z-10">
        <div class="w-full h-35">
            <span class="inline-block whitespace-nowrap transition-all duration-500 ease-out overflow-hidden"></span>
                <img src="resources/umak.svg" alt="UMak Logo" class="mt-3 ml-3.5 size-12 inline-block">
                <img src="resources/ccis.svg" alt="CCIS Logo" class="mt-3 ml-3.5 size-12 inline-block">  
                <img src="resources/sf-logo.svg" alt="Scholar Finds Logo" class="mt-3 ml-3.5 size-12 inline-block">
            </span>
            <a href="index.html" class="outline-none"><h1 class="m-3.5 whitespace-nowrap overflow-hidden text-3xl opacity-0 group-hover:opacity-100 duration-500 font-semibold">Scholar Finds</h1></a>
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
    <main>
        <?php
            $error = $_SESSION['fpw-error'] ?? '';
            if ($error) {
                echo "<div class='absolute top-5 left-1/2 -translate-x-1/2 p-2 w-100 h-10 rounded-xl bg-[#7f1d1d] select-none z-5 animate-downfadeinout'>" . $error . "</div>";
            }
            session_unset();
        ?>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 w-110 h-140 rounded-3xl bg-[#060d0d79] backdrop-blur-lg shadow-[var(--around-shadow-md)] flex-col justify-between animate-fadeIn" id="fpwdiv">
            <a class="absolute top-5 right-5 cursor-pointer" href="access.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </a>
            <form action="login.php" method="post" class="h-full flex flex-col justify-between gap-2 select-none" id="fpw-form">
                <h2 class="py-5 text-center text-3xl font-semibold">Forgot Password?</h2>
                <span class="relative flex flex-col">
                    <label for="femail">UMak Email Address:</label>
                    <input type="text" name="femail" id="femail" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none" autocomplete="off">
                    <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M170-114q-56.72 0-96.36-40.14Q34-194.27 34-250v-460q0-55.72 39.64-95.86T170-846h620q56.72 0 96.36 40.14T926-710v460q0 55.73-39.64 95.86Q846.72-114 790-114H170Zm310-274 310-200v-122L480-508 170-710v122l310 200Z"/></svg>
                </span>
                <div class="py-5 flex flex-col items-center select-none" >
                    <div id="captcha2" class="g-recaptcha scale-70" data-sitekey="6LfGZvUqAAAAAC3HdNLI0eRuIaaZR-PSpXrD6GRK"></div>
                    <input type="submit" name="fpw" class="py-1 w-30 rounded-lg bg-green-900 text-sm cursor-pointer hover:opacity-80 active:scale-95">
                </div>
            </form>
        </div>
    </main>
</body>
</html>