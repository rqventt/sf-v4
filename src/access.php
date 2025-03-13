<?php
if (isset($_COOKIE['id'])) {
    header("Location: profile.php");
    exit();
}

session_start();
function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
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
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-[url('resources/lib-bg.jpg')] text-cabin text-white flex">
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
                <li><a href="" class="flex items-center gap-8 pl-5 py-2 hover:opacity-60 duration-200 ease-linear">
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
    </header>
    <!-- ================================================== MAIN ================================================== -->
    <main>
        <?php
            $error = $_SESSION['log-error'] ?? $_SESSION['reg-error'] ?? $_SESSION['fpw-error'] ?? '';
            if ($error) {
                echo "<script>console.log(" . $error . ")</script>";
                echo "<div class='absolute top-5 left-1/2 -translate-x-1/2 p-2 w-100 h-10 rounded-xl bg-[#7f1d1d] select-none z-5 animate-downfadeinout'>" . $error . "</div>";
            }
            session_unset();
        ?>
        <!-- LOGIN -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 w-110 h-140 rounded-3xl backdrop-blur-md brightness-125" id="log-content">
            <form action="login.php" method="post" class="h-full flex flex-col justify-between gap-2" id="login-form">
                <h2 class="py-5 text-center text-3xl font-semibold">LOGIN</h2>
                <div class="flex flex-col gap-2">
                    <span class="relative flex flex-col">
                        <label for="lemail">UMak Email Address:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M170-114q-56.72 0-96.36-40.14Q34-194.27 34-250v-460q0-55.72 39.64-95.86T170-846h620q56.72 0 96.36 40.14T926-710v460q0 55.73-39.64 95.86Q846.72-114 790-114H170Zm310-274 310-200v-122L480-508 170-710v122l310 200Z"/></svg>
                        <input type="email" name="lemail" id="lemail" placeholder="juan.delacruz@umak.edu.ph" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none"> 
                    </span>
                    <span class="relative flex flex-col">
                        <label for="lpass">Password:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M250-32q-55.98 0-95.99-40.01Q114-112.03 114-168v-379q0-57.38 40.01-96.69Q194.02-683 250-683h4v-51q0-96 66.19-163T480-964q93.62 0 159.81 67T706-734v51h4q55.97 0 95.99 39.31Q846-604.38 846-547v379q0 55.97-40.01 95.99Q765.97-32 710-32H250Zm230.16-239q35.84 0 60.34-25.16 24.5-25.17 24.5-60.5Q565-392 540.34-417t-60.5-25q-35.84 0-60.34 25.02-24.5 25.01-24.5 60.14 0 35.54 24.66 60.69t60.5 25.15ZM390-683h180v-51q0-39.33-26.12-66.67-26.12-27.33-64-27.33Q442-828 416-800.67q-26 27.34-26 66.67v51Z"/></svg>
                        <input type="password" name="lpassword" id="lpassword" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none">
                        <span class="absolute right-2 bottom-2 showpw">
                            <a onclick="showpw('login')" class="hidden" id="ltoshowpw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M480.18-311Q559-311 614-366.18q55-55.17 55-134Q669-579 613.82-634q-55.17-55-134-55Q401-689 346-633.82q-55 55.17-55 134Q291-421 346.18-366q55.17 55 134 55Zm-.12-101q-36.64 0-62.35-25.65T392-499.94q0-36.64 25.65-62.35T479.94-588q36.64 0 62.35 25.65T568-500.06q0 36.64-25.65 62.35T480.06-412ZM480-157q-163 0-294.5-95T-5-500q59-153 190.5-248T480-843q163 0 294.5 95T965-500q-59 153-190.5 248T480-157Z"/></svg>
                            </a>
                            <a onclick="showpw('login')" class="" id="ltohidepw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M783-27 628-181q-33 12-69.5 18t-78.5 6q-163 0-294-92.5T-5-500q19-52 51.5-101t71.5-90L11-798l74-74 771 772-73 73ZM480-311q5 0 10-.5t10-1.5L291-520v20q0 80 54.5 134.5T480-311Zm333 29L657-438q7-14 9.5-31.5T669-500q0-80-54.5-134.5T480-689q-15 0-31.5 3t-30.5 8L289-807q42-17 91.5-26.5T480-843q162 0 292.5 92T965-500q-23 64-64 120.5T813-282ZM549-547l-30-29q7-1 12.5.5t9.5 6.5q4 4 6.5 10t1.5 12Z"/></svg>
                            </a>
                        </span>
                        <a onclick="forgetpw()" class="absolute right-0 -bottom-6 text-sm cursor-pointer select-none">Forgot your password?</a>
                    </span>
                </div>
                <div class="py-5 flex flex-col items-center gap-1 select-none">
                    <input type="submit" class="py-1 w-30 rounded-lg bg-green-900 text-sm cursor-pointer hover:opacity-80 active:scale-95" name="login">
                    <i>Don't have an acccount? <a onclick="changelogmode()" class="cursor-pointer hover:opacity-80">Register</a></i>
                </div>
            </form>
        </div>

        <!-- REGISTRATION -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 w-110 h-140 rounded-3xl backdrop-blur-md brightness-125 hidden" id="reg-content">
            <form action="login.php" class="w-full flex flex-col justify-between gap-2" id="regis-form">
                <h2 class="py-5 text-center text-3xl font-semibold">REGISTRATION</h2>
                <div>
                    <span class="relative flex flex-col">
                        <label for="rname">Name:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M172-34q-57.12 0-96.56-39.44Q36-112.88 36-170v-419q0-57.13 39.44-96.56Q114.88-725 172-725h144v-88q0-51.13 31.44-82.56Q378.88-927 430-927h100q51.13 0 82.56 31.44Q644-864.13 644-813v88h144q57.13 0 96.56 39.44Q924-646.13 924-589v419q0 57.12-39.44 96.56Q845.13-34 788-34H172Zm63-187h248v-20q0-18.48-10.5-34.24Q462-291 445-298q-21-10-42.5-14.5T359-317q-22 0-43 4.5T274-298q-17.58 7.14-28.29 22.59T235-241v20Zm326-60h164v-66H561v66Zm-201.5-66q26.5 0 44.5-18.5t18-45q0-26.5-18.04-44.5T359-473q-26 0-44.5 18.04T296-410q0 26 18.5 44.5t45 18.5ZM561-403h164v-67H561v67ZM442-640h76v-161h-76v161Z"/></svg>
                        <input type="text" name="rname" id="rname" placeholder="Juan Dela Cruz" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none">
                    </span>
                    <span class="relative flex flex-col">
                        <label for="rusername">Username:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M480.16-502Q395-502 336.5-561T278-704.5q0-84.5 58.34-142.5t143.5-58q85.16 0 143.66 57.89T682-704q0 84-58.34 143t-143.5 59ZM114-86v-159q0-46.77 23.79-84.47Q161.58-367.16 201-387q66-34 136.17-51 70.18-17 142.55-17Q554-455 624-438t135 50q39.42 19.69 63.21 57.11T846-245.05V-86H114Z"/></svg>
                        <input type="text" name="rusername" id="rusername" placeholder="Juan" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none">
                    </span class="relative flex flex-col">
                    <span class="relative flex flex-col">
                        <label for="remail">UMak Email Address:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M170-114q-56.72 0-96.36-40.14Q34-194.27 34-250v-460q0-55.72 39.64-95.86T170-846h620q56.72 0 96.36 40.14T926-710v460q0 55.73-39.64 95.86Q846.72-114 790-114H170Zm310-274 310-200v-122L480-508 170-710v122l310 200Z"/></svg>
                        <input type="email" name="remail" id="remail" placeholder="juan.delacruz@umak.edu.ph" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none">
                    </span>
                    <span class="relative flex flex-col">
                        <label for="rpassword">Password:</label>
                        <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M250-32q-55.98 0-95.99-40.01Q114-112.03 114-168v-379q0-57.38 40.01-96.69Q194.02-683 250-683h4v-51q0-96 66.19-163T480-964q93.62 0 159.81 67T706-734v51h4q55.97 0 95.99 39.31Q846-604.38 846-547v379q0 55.97-40.01 95.99Q765.97-32 710-32H250Zm230.16-239q35.84 0 60.34-25.16 24.5-25.17 24.5-60.5Q565-392 540.34-417t-60.5-25q-35.84 0-60.34 25.02-24.5 25.01-24.5 60.14 0 35.54 24.66 60.69t60.5 25.15ZM390-683h180v-51q0-39.33-26.12-66.67-26.12-27.33-64-27.33Q442-828 416-800.67q-26 27.34-26 66.67v51Z"/></svg>
                        <input type="password" name="rpassword" id="rpassword" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none">
                        <span class="absolute right-2 bottom-2 showpw">
                            <a onclick="showpw('register')" class="hidden" id="rtoshowpw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M480.18-311Q559-311 614-366.18q55-55.17 55-134Q669-579 613.82-634q-55.17-55-134-55Q401-689 346-633.82q-55 55.17-55 134Q291-421 346.18-366q55.17 55 134 55Zm-.12-101q-36.64 0-62.35-25.65T392-499.94q0-36.64 25.65-62.35T479.94-588q36.64 0 62.35 25.65T568-500.06q0 36.64-25.65 62.35T480.06-412ZM480-157q-163 0-294.5-95T-5-500q59-153 190.5-248T480-843q163 0 294.5 95T965-500q-59 153-190.5 248T480-157Z"/></svg>
                            </a>
                            <a onclick="showpw('register')" id="rtohidepw">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M783-27 628-181q-33 12-69.5 18t-78.5 6q-163 0-294-92.5T-5-500q19-52 51.5-101t71.5-90L11-798l74-74 771 772-73 73ZM480-311q5 0 10-.5t10-1.5L291-520v20q0 80 54.5 134.5T480-311Zm333 29L657-438q7-14 9.5-31.5T669-500q0-80-54.5-134.5T480-689q-15 0-31.5 3t-30.5 8L289-807q42-17 91.5-26.5T480-843q162 0 292.5 92T965-500q-23 64-64 120.5T813-282ZM549-547l-30-29q7-1 12.5.5t9.5 6.5q4 4 6.5 10t1.5 12Z"/></svg>
                            </a>
                        </span>
                    </span>
                </div>
                <div class="py-5 flex flex-col items-center gap-1 select-none">
                    <input type="submit" class="py-1 w-30 rounded-lg bg-green-900 text-sm cursor-pointer hover:opacity-80 active:scale-95">
                    <i>Already have an account? <a onclick="changelogmode()" class="cursor-pointer hover:opacity-80">Login</a></i>
                </div>
            </form>
        </div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 w-110 h-140 rounded-3xl backdrop-blur-md brightness-125 flex-col justify-between hidden" id="fpwdiv">
            <a class="absolute top-5 right-5 cursor-pointer" onclick="forgetpw()">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </a>
            <form action="" class="h-full flex flex-col justify-between gap-2" id="fpw-form">
                <h2 class="py-5 text-center text-3xl font-semibold">Forgot Password?</h2>
                <span class="relative flex flex-col">
                    <label for="femail">UMak Email Address:</label>
                    <input type="text" name="femail" id="femail" required class="pl-7 py-1 bg-black/30 border-1 border-gray-500 rounded-lg text-gray-300/80 font-sans outline-none">
                    <svg class="absolute left-1.5 bottom-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed"><path d="M170-114q-56.72 0-96.36-40.14Q34-194.27 34-250v-460q0-55.72 39.64-95.86T170-846h620q56.72 0 96.36 40.14T926-710v460q0 55.73-39.64 95.86Q846.72-114 790-114H170Zm310-274 310-200v-122L480-508 170-710v122l310 200Z"/></svg>
                </span>
                <div class="py-5 flex flex-col items-center gap-1 select-none" >
                    <input type="submit" name="fpw" class="py-1 w-30 rounded-lg bg-green-900 text-sm cursor-pointer hover:opacity-80 active:scale-95">
                </div>
            </form>
        </div>
        <!--
        <div class="absolute top-5 left-1/2 -translate-x-1/2 p-2 w-100 h-10 rounded-xl bg-[#7f1d1d] select-none z-5 ">
            Error occured
        </div>
        -->
        <script>
            const loginform = document.getElementById('log-content');
            const regisform = document.getElementById('reg-content');

            function changelogmode() {
                loginform.classList.toggle('hidden');
                loginform.classList.toggle('flex');
                regisform.classList.toggle('hidden');
                regisform.classList.toggle('flex');
            }

            const ltoshowpw = document.getElementById('ltoshowpw');
            const ltohidepw = document.getElementById('ltohidepw');
            const lpassword = document.getElementById('lpassword');
            const rtoshowpw = document.getElementById('rtoshowpw');
            const rtohidepw = document.getElementById('rtohidepw');
            const rpassword = document.getElementById('rpassword');

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

            const fpwdiv = document.getElementById('fpwdiv');

            function forgetpw() {
                fpwdiv.classList.toggle('hidden');
                fpwdiv.classList.toggle('flex');
                loginform.classList.toggle('hidden');
                loginform.classList.toggle('flex');
            }

            const admin = document.querySelector('a[href="admin.php"]');
            const role = document.cookie.match(/role=([^;]+)/)?.[1];
            if (!role || role === "regular") admin?.classList.add("hidden");
        </script>
    </main>
</body>
</html>