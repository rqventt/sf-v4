<?php
    if (!isset($_COOKIE['role']) || $_COOKIE['role'] == "regular" ) {
        header("Location: index.html");
        exit();
    }

    session_start();
    require_once 'config.php';

    // Fetch theses data
    $theses_sql = "SELECT thesis_id, archived, published_date, course, title, authors, abstract, keywords FROM theses";
    $theses_result = $conn->query($theses_sql);
    $theses = [];
    $accounts_sql = "SELECT user_id, archived, role, username, name, email, password, personalization FROM accounts";
    $accounts_result = $conn->query($accounts_sql);
    $accounts = [];

    while ($row = $theses_result->fetch_assoc()) {
        $theses[] = $row;
    }

    while ($row = $accounts_result->fetch_assoc()) {
        $accounts[] = $row;
    }

    $data = [
        "theses" => $theses,
        "accounts" => $accounts
    ];

    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("data.json", $json_data);
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
    <!-- ================================================== MAIN ================================================== -->
    <main class="ml-25 m-5 p-15 w-[calc(100vw-80px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl bg-off-white z-2 text-black drag-none">
        <h1 class="mb-3 text-3xl font-bold text-dirty-brown select-none">Admin</h1>
        <div class="relative">      
            <input type="radio" name="tb" id="thesestb" checked class="peer/thesestb" hidden>
            <label for="thesestb" class="absolute text-dirty-brown font-bold text-xl opacity-60 peer-checked/thesestb:opacity-100 peer-checked/thesestb:underline peer-checked/thesestb:decoration-3 peer-checked/thesestb:underline-offset-6 duration-300 select-none cursor-pointer z-5">Theses</label>
            <input type="radio" name="tb" id="userstb" class="peer/userstb" hidden>
            <label for="userstb" class="absolute left-19 text-dirty-brown font-bold text-xl opacity-60 peer-checked/userstb:opacity-100 peer-checked/userstb:underline peer-checked/userstb:decoration-3 peer-checked/userstb:underline-offset-6 duration-300 select-none cursor-pointer z-5 <?php echo $_COOKIE["role"] !== "superadmin" ? "hidden" : ""; ?>">Users</label>

            <!-- ================================================== THESES TABLE ================================================== -->
            <div id="all-ths" class="relative w-full h-160 hidden flex-col gap-2.5 peer-checked/thesestb:flex">
                <div class="mt-10 flex justify-end gap-5">
                    <div class="flex items-center text-sm italic opacity-80 select-none">
                        <p>Showing table with <span id="tpage-info"></span> results</p>
                    </div>
                    <div class="px-2.5 py-1.5 rounded-md flex items-center gap-3 bg-lgreen">
                        <input type="text" placeholder="Search" id="tsearch-box" class="px-4 w-50 rounded-md bg-slgreen text-sm outline-none">
                        <select id="tsearch-category" class="px-4 w-30 rounded-md bg-slgreen text-sm select-none outline-none">
                            <option value="" class="text-disabled">Search by</option>
                            <option value="title">Title</option>
                            <option value="published_date">Date</option>
                            <option value="course">Course</option>
                            <option value="authors">Authors</option>
                            <option value="keywords">Keywords</option>
                        </select>
                        <span class="flex items-center gap-2">
                            <input type="checkbox" id="tarchive-mode" class="peer">
                            <label for="tarchive-mode" class="text-sm opacity-80 peer-checked:opacity-100 select-none cursor-pointer">Archived Data</label>
                        </span>
                    </div>
                </div>
                <div class="flex justify-end">
                    <input type="checkbox" id="tcreator" hidden class="peer">
                    <label for="tcreator" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer select-none">Append Data</label>
                    <label for="tcreator" class="fixed top-0 left-0 w-screen h-screen bg-black opacity-40 hidden peer-checked:block z-4"></label>
                    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-10 w-120 bg-slgreen rounded-3xl shadow-2xl shadow-black/70 hidden peer-checked:block z-5">
                        <div class="relative w-full h-full flex flex-col justify-between">
                            <label for="tcreator" class="absolute -top-5 -right-5 p-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                            </label>
                            <span class="py-5 flex flex-col gap-2 select-none">
                                <h1 class="text-2xl font-bold text-center select-none">Append Thesis Data</h1>
                                <p class="text-justify text-sm leading-none"><b>Note:</b> Use a <b>plus (+)</b> for authors and a <b>comma (,)</b> for keywords to separate data properly.</p>
                            </span>
                            
                            <form action="cms.php" method="post" class="w-full flex flex-col *:relative *:flex *:flex-col gap-2.5">
                                <span>
                                    <input type="text" name="title" id="title" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none">
                                    <label for="title" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Title</label>
                                </span>
                                <span>
                                    <input type="text" name="authors" id="authors" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none">
                                    <label for="authors" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Author/s</label>
                                </span>
                                <span>
                                    <textarea type="text" name="abstract" id="abstract" required class="peer px-2 py-1.5 w-full h-42 resize-none rounded-md border-2 border-dirty-brown text-sm outline-none"></textarea>
                                    <label for="abstract" class="absolute top-2.5 left-2 px-1 py-0.5 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Abstract</label>
                                </span>
                                <span>
                                    <input type="text" name="keywords" id="keywords" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none">
                                    <label for="keywords" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Keywords</label>
                                </span>
                                <span class="flex-row! gap-2 *:relative *:w-1/2 *:flex *:flex-col">
                                    <span>
                                        <select name="course" id="course" required class="px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none text-[#464644] valid:text-black">
                                            <option value="" disabled selected>Select here</option>
                                            <option class="text-black" value="BSIT-NS">BSIT-NS</option>
                                            <option class="text-black" value="BSCS-AD">BSCS-AD</option>
                                        </select>
                                        <label for="course" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none -translate-y-4 text-xs">Course</label>
                                    </span>
                                    <span>
                                        <input type="month" name="pdate" id="pdate" required class="px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none text-[#464644] valid:text-black">
                                        <label for="pdate" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none -translate-y-4 text-xs">Published Date</label>
                                    </span>
                                </span>
                                <span class="py-5 flex flex-col items-center justify-center gap-1 select-none">
                                <i class="text-sm">You are currently assigning new data with an ID of <b id="new-ths-id"></b>.</i>
                                <button type="submit" name="new-thesis" class="px-8 py-1 rounded-md bg-lgreen text-sm font-semibold hover:opacity-90 active:scale-95 duration-100 cursor-pointer">Submit</button>
                            </span>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="w-full border-separate border-spacing-1 table-fixed text-sm">
                    <thead>
                        <tr class="*:rounded-md *:bg-lgreen *:py-0.5 *:whitespace-nowrap *:select-none">
                            <th class="w-[14%]">Modify</th>
                            <th class="w-[8%]">ID</th>
                            <th class="w-[8%]">Pub Date</th>
                            <th class="w-[10%]">Course</th>
                            <th class="w-[20%]">Title</th>
                            <th class="w-[10%]">Authors</th>
                            <th class="w-[20%]">Abstract</th>
                            <th class="w-[10%]">Keywords</th>
                        </tr>
                    </thead>
                    <tbody id="theses-container">
                    </tbody>
                </table>
                <div class="absolute bottom-0 w-full *:w-min-30">
                    <div class="relative w-full flex justify-between gap-2">
                        <div class="flex items-center *:flex *:items-center *:gap-2 text-sm select-none">
                            <span>
                                <input type="checkbox" id="ta-select-all">
                                <label for="ta-select-all">Select All</label>
                            </span>
                        </div>
                        <div class="absolute left-1/2 -translate-x-1/2 px-5 py-1 rounded-md flex items-center justify-center gap-2 bg-lgreen">
                            <button onclick="firstTSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z"/></svg></button>
                            <button onclick="previousTSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg></button>
                            <select id="tsets-per-page" class="px-4 w-auto rounded-md bg-slgreen text-sm select-none outline-none">
                                <option value="1">1</option>
                            </select>
                            <button onclick="nextTSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg></button>
                            <button onclick="lastTSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M383-480 200-664l56-56 240 240-240 240-56-56 183-184Zm264 0L464-664l56-56 240 240-240 240-56-56 183-184Z"/></svg></button>
                        </div>
                        <div class="flex items-center gap-2">
                            <button id="tretrieve" onclick="toggleThesesBulkAction('retrieve')" class="px-5 py-0.5 w-30 rounded-md bg-lgreen text-center text-sm disabled:opacity-70 disabled:cursor-not-allowed enabled:hover:opacity-80 enabled:active:scale-95 duration-50 enabled:cursor-pointer hidden">Retrieve</button>
                            <button id="tarchive" onclick="toggleThesesBulkAction('archive')" class="px-5 py-0.5 w-30 rounded-md bg-lgreen text-center text-sm disabled:opacity-70 disabled:cursor-not-allowed enabled:hover:opacity-80 enabled:active:scale-95 duration-50 enabled:cursor-pointer">Archive</button>
                            <button id="tdelete" onclick="toggleThesesBulkAction('delete')" class="px-5 py-0.5 w-30 rounded-md bg-lred text-center text-sm disabled:opacity-70 disabled:cursor-not-allowed enabled:hover:opacity-80 enabled:active:scale-95 duration-50 enabled:cursor-pointer hidden">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================================================== USERS TABLE ================================================== -->
            <div id="all-usr" class="w-full h-160 hidden flex-col gap-2.5 peer-checked/userstb:flex">
                <div class="mt-10 flex justify-end gap-5">
                    <div class="flex items-center text-sm italic opacity-80 select-none">
                        <p>Showing table with <span id="upage-info"></span> of results</p>
                    </div>
                    <div class="px-2.5 py-1.5 rounded-md flex items-center gap-3 bg-lgreen">
                        <input type="text" placeholder="Search" id="usearch-box" class="px-4 w-50 rounded-md bg-slgreen text-sm outline-none">
                        <select name="" id="usearch-category" class="px-4 w-30 rounded-md bg-slgreen text-sm select-none outline-none">
                            <option value="" class="text-disabled">Search by</option>
                            <option value="role">Role</option>
                            <option value="username">Username</option>
                            <option value="name">Name</option>
                            <option value="email">Email</option>
                        </select>
                        <span class="flex items-center gap-2">
                            <input type="checkbox" id="uarchive-mode" class="peer">
                            <label for="uarchive-mode" class="text-sm opacity-80 peer-checked:opacity-100 select-none cursor-pointer">Archived Data</label>
                        </span>
                    </div>
                </div>
                <div class="flex justify-end">
                    <input type="checkbox" id="ucreator" hidden class="peer">
                    <label for="ucreator" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer select-none">Append Data</label>
                    <label for="ucreator" class="fixed top-0 left-0 w-screen h-screen bg-black opacity-40 hidden peer-checked:block z-4"></label>
                    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-10 w-120 bg-slgreen rounded-3xl shadow-2xl shadow-black/70 hidden peer-checked:block z-5">
                        <div class="relative w-full h-full flex flex-col justify-between">
                            <label for="ucreator" class="absolute -top-5 -right-5 p-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                            </label>
                            <h1 class="py-5 text-2xl font-extrabold text-center select-none">Append User Data</h1>
                            <form action="" class="w-full flex flex-col *:relative *:flex *:flex-col gap-2.5">
                                <span>
                                    <input type="text" name="username" id="username" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none">
                                    <label for="username" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Username</label>
                                </span>
                                <span>
                                    <input type="text" name="name" id="name" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none">
                                    <label for="name" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Name</label>
                                </span>
                                <span>
                                    <input type="text" name="email" id="email" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none">
                                    <label for="email" class="absolute top-2.5 left-2 px-1 py-0.5 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">UMak Email Address</label>
                                </span>
                                <span>
                                    <input type="text" name="password" id="password" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none">
                                    <label for="password" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Password</label>
                                </span>
                                <span>
                                    <select name="access" id="access" required class="px-2 py-1.5 w-full rounded-md border-2 border-dirty-brown text-sm outline-none text-[#464644] valid:text-black">
                                        <option value="" disabled selected>Select here</option>
                                        <option class="text-black" value="regular">Regular</option>
                                        <option class="text-black" value="admin">Admin</option>
                                        <option class="text-black" value="superadmin">Super Admin</option>
                                    </select>
                                    <label for="course" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none -translate-y-4 text-xs">Role</label>
                                </span>
                                <span class="text-sm select-none">
                                    <b>The user can:</b>
                                    <ul class="pl-5 list-disc">
                                        <li class="text-[#464644] line-through" id="ua1">View Library</li>
                                        <li class="text-[#464644] line-through" id="ua2">View and Edit "Theses" Table</li>
                                        <li class="text-[#464644] line-through" id="ua3">View and Edit "Users" Table</li>
                                    </ul>
                                </span>
                                <span class="py-5 flex flex-col items-center justify-center gap-1 select-none">
                                    <i class="text-sm">You are currently assigning new data with an ID of <b id="new-usr-id"></b>.</i>
                                    <button type="submit" name="new-user" class="px-8 py-1 rounded-md bg-lgreen text-sm font-semibold hover:opacity-90 active:scale-95 duration-100 cursor-pointer">Submit</button>
                                </span>
                            </form>
                            <script>
                                document.getElementById('access').addEventListener('change', function() {
                                    const roles = {
                                        regular: ["ua2, ua3"],
                                        admin: ["ua3"],
                                        superadmin: []
                                    };
                                    document.querySelectorAll("#ua1, #ua2, #ua3, #ua4").forEach(el => el.className = '');
                                    roles[this.value].forEach(id => document.getElementById(id).className = "text-[#464644] line-through");
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <table class="w-full border-separate border-spacing-1 table-fixed text-sm">
                    <thead>
                        <tr class="*:rounded-md *:bg-lgreen *:py-0.5 *:whitespace-nowrap *:select-none">
                            <th class="w-[14%]">Modify</th>
                            <th class="w-[8%]">ID</th>
                            <th class="w-[8%]">Role</th>
                            <th class="w-[15%]">Username</th>
                            <th class="w-[15%]">Name</th>
                            <th class="w-[15%]">Email</th>
                            <th class="w-[15%]">Password</th>
                            <th class="w-[10%]">Personalization</th>
                        </tr>
                    </thead>
                    <tbody id="users-container">
                    </tbody>
                </table>
                <div class="absolute bottom-0 w-full *:w-min-30">
                    <div class="relative w-full flex justify-between gap-2">
                        <div class="flex items-center *:flex *:items-center *:gap-2 text-sm select-none">
                            <span>
                                <input type="checkbox" id="ua-select-all">
                                <label for="ua-select-all">Select All</label>
                            </span>
                        </div>
                        <div class="absolute left-1/2 -translate-x-1/2 px-5 py-1 rounded-md flex items-center justify-center gap-2 bg-lgreen">
                            <button onclick="firstUSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z"/></svg></button>
                            <button onclick="previousUSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg></button>
                            <select id="usets-per-page" class="px-4 w-auto rounded-md bg-slgreen text-sm select-none outline-none">
                                <option value="1">1</option>
                            </select>
                            <button onclick="nextUSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg></button>
                            <button onclick="lastUSet()"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#464644"><path d="M383-480 200-664l56-56 240 240-240 240-56-56 183-184Zm264 0L464-664l56-56 240 240-240 240-56-56 183-184Z"/></svg></button>
                        </div>
                        <div class="flex items-center gap-2">
                            <button id="uretrieve" onclick="toggleUsersBulkAction('retrieve')" class="px-5 py-0.5 w-30 rounded-md bg-lgreen text-center text-sm disabled:opacity-70 disabled:cursor-not-allowed enabled:hover:opacity-80 enabled:active:scale-95 duration-50 enabled:cursor-pointer hidden">Retrieve</button>
                            <button id="uarchive" onclick="toggleUsersBulkAction('archive')" class="px-5 py-0.5 w-30 rounded-md bg-lgreen text-center text-sm disabled:opacity-70 disabled:cursor-not-allowed enabled:hover:opacity-80 enabled:active:scale-95 duration-50 enabled:cursor-pointer">Archive</button>
                            <button id="udelete" onclick="toggleUsersBulkAction('delete')" class="px-5 py-0.5 w-30 rounded-md bg-lred text-center text-sm disabled:opacity-70 disabled:cursor-not-allowed enabled:hover:opacity-80 enabled:active:scale-95 duration-50 enabled:cursor-pointer hidden">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================================================== ACTION BOX ================================================== -->
        <div id="taction-box" class="absolute top-0 left-0 hidden">
            <div onclick="toggleThesisAction()" class="w-screen h-screen bg-black/40 z-15"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-10 w-100 h-50 rounded-2xl flex bg-off-white shadow-2xl text-black z-16 select-none">
                <form action="cms.php" method="post" class="relative w-full h-full flex flex-col items-center justify-center gap-">
                    <span class="mb-10 flex flex-col items-center *:leading-none">
                        <p id="ta-msg"></p>
                        <p id="ta-warning-msg" class="text-xs text-red-500"></p>
                    </span>
                    <input type="text" name="a-data" id="a-data" hidden>
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full flex justify-center gap-5">
                        <button type="button" onclick="toggleThesisAction()" class="px-5 py-0.5 rounded-md bg-lred text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Cancel</button>
                        <button type="submit" id="t-act" name="t-act" value="" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Proceed</button>
                    </span>
                </form>
            </div>
        </div>

        <div id="uaction-box" class="absolute top-0 left-0 hidden">
            <div onclick="toggleUserAction()" class="w-screen h-screen bg-black/40 z-15"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-10 w-100 h-50 rounded-2xl flex bg-off-white shadow-2xl text-black z-16 select-none">
                <form action="cms.php" method="post" class="relative w-full h-full flex flex-col items-center justify-center gap-">
                    <span class="mb-10 flex flex-col items-center *:leading-none">
                        <p id="ua-msg"></p>
                        <p id="ua-warning-msg" class="text-xs text-red-500"></p>
                    </span>
                    <input type="text" name="ua-data" id="ua-data" hidden>
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full flex justify-center gap-5">
                        <button type="button" onclick="toggleUserAction()" class="px-5 py-0.5 rounded-md bg-lred text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Cancel</button>
                        <button type="submit" id="a-act" name="a-act" value="" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Proceed</button>
                    </span>
                </form>
            </div>
        </div>

        <!-- ================================================== BULK ACTION BOX ================================================== -->
        <div id="tbulk-action-box" class="absolute top-0 left-0 hidden">
            <div onclick="toggleThesesBulkAction()" class="w-screen h-screen bg-black/40 z-15"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-10 w-120 h-70 rounded-2xl bg-off-white shadow-2xl text-black z-16 select-none">
                <form action="cms.php" method="post" class="relative w-full h-full flex flex-col items-center justify-between">
                    <span class="flex flex-col items-center *:leading-none">
                        <p id="tba-msg"></p>
                        <p id="tba-warning-msg" class="text-xs text-red-500"></p>
                    </span>
                    <span id="tba-selection" class="p-2.5 w-full h-30 rounded-xl flex items-center justify-center bg-zinc-200 border-1 border-zinc-300 select-text overflow-hidden text-ellipsis text-xs text-center">
                    </span>
                    <input type="text" name="ba-data" id="ba-data" hidden>
                    <span class="flex items-center gap-5">
                        <button type="button" onclick="toggleThesesBulkAction()" class="px-5 py-0.5 rounded-md bg-lred text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Cancel</button>
                        <button type="submit" id="t-bulk" name="t-bulk" value="" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Proceed</button>
                    </span>
                </form>
            </div>
        </div>

        <div id="ubulk-action-box" class="absolute top-0 left-0 hidden">
            <div onclick="toggleUsersBulkAction()" class="w-screen h-screen bg-black/40 z-15"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-10 w-120 h-70 rounded-2xl bg-off-white shadow-2xl text-black z-16 select-none">
                <form action="cms.php" method="post" class="relative w-full h-full flex flex-col items-center justify-between">
                    <span class="flex flex-col items-center *:leading-none">
                        <p id="uba-msg"></p>
                        <p id="uba-warning-msg" class="text-xs text-red-500"></p>
                    </span>
                    <span id="uba-selection" class="p-2.5 w-full h-30 rounded-xl flex items-center justify-center bg-zinc-200 border-1 border-zinc-300 select-text overflow-hidden text-ellipsis text-xs text-center">
                    </span>
                    <input type="text" name="uba-data" id="uba-data" hidden>
                    <span class="flex items-center gap-5">
                        <button type="button" onclick="toggleUsersBulkAction()" class="px-5 py-0.5 rounded-md bg-lred text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Cancel</button>
                        <button type="submit" id="u-bulk" name="u-bulk" value="" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Proceed</button>
                    </span>
                </form>
            </div>
        </div>

        <!-- ================================================== ALERTS ================================================== -->
        <?php
            $success = $_SESSION['success'] ?? '';
            $error = $_SESSION['error'] ?? '';
            
            if ($success) {
                echo "<div class='absolute top-10 left-1/2 -translate-x-1/2 p-2 px-5 w-100 rounded-xl border-2 bg-[#d9ead3] border-[#b6d7a8] text-[#274e13] select-none leading-none z-5 animate-downfadeinout delay-200'>" . $success . "</div>";  
            } else if ($error) {
                echo "<div class='absolute top-10 left-1/2 -translate-x-1/2 p-2 px-5 w-100 rounded-xl border-2 bg-[#e6b8af] border-[#dd7e6b] text-[#5b0f00] select-none leading-none z-5 animate-downfadeinout delay-200'>" . $error . "</div>";
            } 

            session_unset();
        ?>
    </main>
    <script>
        fetch('data.json').then(res => res.json()).then(json => (data = json, displaySets())).catch(console.error);

        let data = { theses: [] }, thesesPerPage = 15, selectedSet = 0, searchQuery = "", searchCategory = "", selectedThesis = [];
        const tarchiveMode = document.getElementById("tarchive-mode"), taSelectAll = document.getElementById("ta-select-all"), tsetsSelect = document.getElementById("tsets-per-page"),
        tarchive = document.getElementById("tarchive"), tretrieve = document.getElementById("tretrieve"), tdelete = document.getElementById("tdelete");

        [tarchiveMode, taSelectAll, tsetsSelect].forEach(el => el.addEventListener("change", e => {
            if (e.target === tarchiveMode) (selectedThesis = [], taSelectAll.checked = false, selectedSet = 0);
            if (e.target === tsetsSelect) selectedSet = +e.target.value - 1;
            if (e.target === taSelectAll) selectedThesis = taSelectAll.checked ? data.theses.filter(t => t.archived == tarchiveMode.checked).map(t => t.thesis_id) : [];
            displaySets();
        }));

        document.getElementById("theses-container").addEventListener("change", e => {
            if (!e.target.classList.contains("tcb")) return;
            selectedThesis = e.target.checked ? [...new Set([...selectedThesis, e.target.id])] : selectedThesis.filter(id => id != e.target.id);
            taSelectAll.checked = document.querySelectorAll('.tcb:checked').length === document.querySelectorAll('.tcb').length;
            tarchive.disabled = selectedThesis.length === 0;
            tretrieve.disabled = selectedThesis.length === 0;
            tdelete.disabled = selectedThesis.length === 0;

            console.log(selectedThesis);
        });

        function displaySets() {
            const tcontainer = document.getElementById("theses-container"), tpageInfo = document.getElementById("tpage-info");
            let filteredData = data.theses.filter(t => t.archived == tarchiveMode.checked && (!searchQuery || t[searchCategory]?.toLowerCase().includes(searchQuery.toLowerCase())));
            let totalSets = Math.ceil(filteredData.length / thesesPerPage);
            selectedSet = Math.max(0, Math.min(selectedSet, totalSets - 1));
            tsetsSelect.innerHTML = [...Array(totalSets)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("");
            tsetsSelect.value = selectedSet + 1;
            tarchive.classList.toggle('hidden', tarchiveMode.checked);
            tretrieve.classList.toggle('hidden', !tarchiveMode.checked);
            tdelete.classList.toggle('hidden', !tarchiveMode.checked);
            tarchive.disabled = selectedThesis.length === 0;
            tretrieve.disabled = selectedThesis.length === 0;
            tdelete.disabled = selectedThesis.length === 0;

            const lastThesisId = data.theses.length ? Math.max(...data.theses.map(t => t.thesis_id)) : 0;
            document.getElementById("new-ths-id").innerHTML = (lastThesisId + 1).toString().padStart(4, '0');

            tcontainer.innerHTML = filteredData.length ? filteredData.slice(selectedSet * thesesPerPage, (selectedSet + 1) * thesesPerPage).map(t => `
                <tr class="*:rounded-md *:bg-slgreen *:py-0.5 *:overflow-hidden *:text-ellipsis *:whitespace-nowrap">
                    <td class="flex items-center justify-center select-none overflow-visible!">
                        <input type="checkbox" class="tcb mx-1 cursor-pointer" id="${t.thesis_id}" ${selectedThesis.includes(t.thesis_id) ? "checked" : ""}>
                        ${tarchiveMode.checked? 
                        '<span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer" onclick="toggleThesisAction(\'retrieve\', \'' + t.thesis_id + '\');">↩️</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4 left-1/2 -translate-x-1/2 px-1 rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Retrieve</p>' +
                        '</span> <span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer" onclick="toggleThesisAction(\'delete\', \'' + t.thesis_id + '\');">🗑️</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4 left-1/2 -translate-x-1/2 px-1 rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Delete</p>' +
                        '</span>' : 
                        '<span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">✏️</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4  w-full rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Edit</p>' +
                        '</span>' +
                        '<span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer" onclick="toggleThesisAction(\'archive\', \'' + t.thesis_id + '\');">📥</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4 left-1/2 -translate-x-1/2 px-1 rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Archive</p>' +
                        '</span>'}
                    </td>
                    <td class="text-center">${t.thesis_id.toString().padStart(4, '0')}</td>
                    <td class="text-center">${t.published_date}</td>
                    <td class="text-center">${t.course}</td>
                    <td>${upperWords(t.title)}</td>
                    <td>${t.authors}</td>
                    <td>${t.abstract || "..."}</td>
                    <td>${t.keywords || "..."}</td>
                </tr>`).join("") : "<tr><td colspan='8' class='text-center'>No results found.</td></tr>";

            tpageInfo.textContent = totalSets === 0 ? `no${tarchiveMode.checked ? " archived" : ""}` : `${selectedSet + 1} of ${totalSets + (tarchiveMode.checked ? " archived" : "")} set/s of`;
        }

        ["first", "previous", "next", "last"].forEach((fn, i) => window[fn + "TSet"] = () => {
            selectedSet = [0, Math.max(0, selectedSet - 1), Math.min(selectedSet + 1, tsetsSelect.options.length - 1), tsetsSelect.options.length - 1][i];
            displaySets();
        });

        function toggleThesesBulkAction(action) {      
            const box = document.getElementById("tbulk-action-box");
            box.classList.toggle('hidden');

            document.getElementById("tba-msg").textContent = upperWords(action) + " selected theses?";
            document.getElementById("tba-warning-msg").textContent = action == "delete" ? "This action cannot be reverted!" : "";
            document.getElementById("tba-selection").textContent = selectedThesis.map(id => id.toString().padStart(4, '0')).join(', ');
            document.getElementById("ba-data").value = selectedThesis.join('-');
            document.getElementById("t-bulk").value = action;
        }

        function toggleThesisAction(action, id) {
            const box = document.getElementById("taction-box");
            box.classList.toggle('hidden');

            document.getElementById("ta-msg").innerHTML = upperWords(action) + " the thesis with an ID of <b>" + id.toString().padStart(4, '0') + "</b>?";
            document.getElementById("ta-warning-msg").textContent = action == "delete" ? "This action cannot be reverted!" : "";
            document.getElementById("a-data").value = id;
            document.getElementById("t-act").value = action;
        }

        fetch('data.json').then(res => res.json()).then(json => (userData = json, displayUsers())).catch(console.error);

        let userData = { accounts: [] }, usersPerPage = 15, userSelectedSet = 0, userSearchQuery = "", userSearchCategory = "", selectedUsers = [];
        const userArchiveMode = document.getElementById("uarchive-mode"), userSelectAll = document.getElementById("ua-select-all"), 
              userSetsSelect = document.getElementById("usets-per-page"), userArchive = document.getElementById("uarchive"), 
              userRetrieve = document.getElementById("uretrieve"), userDelete = document.getElementById("udelete");

        [userArchiveMode, userSelectAll, userSetsSelect].forEach(el => el.addEventListener("change", e => {
            if (e.target === userArchiveMode) (selectedUsers = [], userSelectAll.checked = false, userSelectedSet = 0);
            if (e.target === userSetsSelect) userSelectedSet = +e.target.value - 1;
            if (e.target === userSelectAll) selectedUsers = userSelectAll.checked ? userData.accounts.filter(u => u.archived == userArchiveMode.checked).map(u => u.user_id) : [];
            displayUsers();
        }));

        document.getElementById("users-container").addEventListener("change", e => {
            if (!e.target.classList.contains("ucb")) return;
            selectedUsers = e.target.checked ? [...new Set([...selectedUsers, e.target.id])] : selectedUsers.filter(id => id != e.target.id);
            userSelectAll.checked = document.querySelectorAll('.ucb:checked').length === document.querySelectorAll('.ucb').length;
            userArchive.disabled = selectedUsers.length === 0;
            userRetrieve.disabled = selectedUsers.length === 0;
            userDelete.disabled = selectedUsers.length === 0;
        });

        function displayUsers() {
            const userContainer = document.getElementById("users-container"), userPageInfo = document.getElementById("upage-info");
            let filteredUserData = userData.accounts.filter(u => u.archived == userArchiveMode.checked && (!userSearchQuery || u[userSearchCategory]?.toLowerCase().includes(userSearchQuery.toLowerCase())));
            let totalUserSets = Math.ceil(filteredUserData.length / usersPerPage);
            userSelectedSet = Math.max(0, Math.min(userSelectedSet, totalUserSets - 1));
            userSetsSelect.innerHTML = [...Array(totalUserSets)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("");
            userSetsSelect.value = userSelectedSet + 1;
            userArchive.classList.toggle('hidden', userArchiveMode.checked);
            userRetrieve.classList.toggle('hidden', !userArchiveMode.checked);
            userDelete.classList.toggle('hidden', !userArchiveMode.checked);
            userArchive.disabled = selectedUsers.length === 0;
            userRetrieve.disabled = selectedUsers.length === 0;
            userDelete.disabled = selectedUsers.length === 0;

            const lastUserId = userData.accounts.length ? Math.max(...userData.accounts.map(u => u.user_id)) : 0;
            document.getElementById("new-usr-id").innerHTML = (lastUserId + 1).toString().padStart(4, '0');

            userContainer.innerHTML = filteredUserData.length ? filteredUserData.slice(userSelectedSet * usersPerPage, (userSelectedSet + 1) * usersPerPage).map(user => `
                <tr class="*:rounded-md *:bg-slgreen *:py-0.5 *:overflow-hidden *:text-ellipsis *:whitespace-nowrap">
                    <td class="flex items-center justify-center select-none overflow-visible!">
                        <input type="checkbox" class="ucb mx-1 px-1" id="${user.user_id}" ${selectedUsers.includes(user.user_id) ? "checked" : ""}>
                        ${userArchiveMode.checked? 
                        '<span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer" onclick="toggleUserAction(\'retrieve\', \'' + user.user_id + '\');">↩️</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4 left-1/2 -translate-x-1/2 px-1 rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Retrieve</p>' +
                        '</span> <span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer" onclick="toggleUserAction(\'delete\', \'' + user.user_id + '\');">🗑️</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4 left-1/2 -translate-x-1/2 px-1 rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Delete</p>' +
                        '</span>' : 
                        '<span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">✏️</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4  w-full rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Edit</p>' +
                        '</span>' +
                        '<span class="relative">' +
                            '<button class="peer px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer" onclick="toggleUserAction(\'archive\', \'' + user.user_id + '\');">📥</button>' +
                            '<p class="hidden peer-hover:block absolute -top-4 left-1/2 -translate-x-1/2 px-1 rounded-sm bg-zinc-700 text-off-white text-xs text-center select-none">Archive</p>' +
                        '</span>'}
                    </td>
                    <td class="text-center">${user.user_id.toString().padStart(4, '0')}</td>
                    <td class="text-center">${user.role}</td>
                    <td>${user.username}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.password}</td>
                    <td>${user.personalization || "..."}</td>
                </tr>`).join("") : "<tr><td colspan='8' class='text-center'>No results found.</td></tr>";
            userPageInfo.textContent = totalUserSets === 0 ? `no${userArchiveMode.checked ? " archived" : ""}` : `${userSelectedSet + 1} of ${totalUserSets} set/s`;
        }

        ["first", "previous", "next", "last"].forEach((fn, i) => window[fn + "USet"] = () => {
            userSelectedSet = [0, Math.max(0, userSelectedSet - 1), Math.min(userSelectedSet + 1, userSetsSelect.options.length - 1), userSetsSelect.options.length - 1][i];
            displayUsers();
        });

        function toggleUsersBulkAction(action) {
            const box = document.getElementById("ubulk-action-box");
            box.classList.toggle('hidden');
            document.getElementById("uba-msg").textContent = upperWords(action) + " selected users?";
            document.getElementById("uba-warning-msg").textContent = action == "delete" ? "This action cannot be reverted!" : "";
            document.getElementById("uba-selection").textContent = selectedUsers.map(id => id.toString().padStart(4, '0')).join(', ');
            document.getElementById("uba-data").value = selectedUsers.join('-');
            document.getElementById("u-bulk").value = action;
        }

        function toggleUserAction(action, id) {
            const box = document.getElementById("uaction-box");
            box.classList.toggle('hidden');
            document.getElementById("ua-msg").innerHTML = upperWords(action) + " the user with an ID of <b>" + id.toString().padStart(4, '0') + "</b>?";
            document.getElementById("ua-warning-msg").textContent = action == "delete" ? "This action cannot be reverted!" : "";
            document.getElementById("ua-data").value = id;
            document.getElementById("u-act").value = action;
        }

        window.onload = () => {
            // Theses Data
            document.getElementById("tsets-per-page")?.addEventListener("change", e => { selectedSet = e.target.value - 1; displaySets(); });
            document.getElementById("tsearch-box")?.addEventListener("input", e => { searchQuery = e.target.value; selectedSet = 0; displaySets(); });
            document.getElementById("tsearch-category")?.addEventListener("change", e => { searchCategory = e.target.value; selectedSet = 0; displaySets(); });
            document.getElementById("tarchive-mode")?.addEventListener("change", e => {selectedSet = 0; displaySets(); });

            // Users Data
            document.getElementById("usets-per-page")?.addEventListener("change", e => { userSelectedSet = e.target.value - 1; displayUsers(); });
            document.getElementById("usearch-box")?.addEventListener("input", e => { userSearchQuery = e.target.value; userSelectedSet = 0; displayUsers(); });
            document.getElementById("usearch-category")?.addEventListener("change", e => { userSearchCategory = e.target.value; userSelectedSet = 0; displayUsers(); });
            document.getElementById("uarchive-mode")?.addEventListener("change", e => {userSelectedSet = 0; displayUsers(); });
        };

        const upperWords = str => str.replace(/\b\w/g, c => c.toUpperCase());
    </script>
</body>
</html>