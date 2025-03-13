<?php
    if (!isset($_COOKIE['role']) || $_COOKIE['role'] == "regular" ) {
        header("Location: index.html");
        exit();
    }

    session_start();
    require_once 'config.php';

    // Fetch theses data
    $theses_sql = "SELECT thesis_id, published_date, course, title, authors, abstract, keywords FROM theses";
    $theses_result = $conn->query($theses_sql);
    $theses = [];
    $accounts_sql = "SELECT user_id, role, username, name, email, password, personalization FROM accounts";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Finds</title>
    <link rel="shortcut icon" href="resources/sf-logo.svg" type="image/x-icon">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="flex bg-[url('resources/lib-bg.jpg')] h-screen text-cabin text-white">
    <div class="absolute inset-0 bg-black/50 h-screen z-0"></div>
    <header class="group fixed pt-10 pb-10 w-20 hover:w-60 duration-500 ease-out h-screen flex flex-col justify-between bg-[#060d0d99] backdrop-blur-md shadow-[var(--around-shadow-md)] select-none z-10">
        <div class="w-full h-35">
            <span class="inline-block whitespace-nowrap transition-all duration-500 ease-out overflow-hidden"></span>
                <img src="resources/umak.svg" alt="UMak Logo" class="mt-3 ml-3.5 size-12 inline-block">
                <img src="resources/ccis.svg" alt="CCIS Logo" class="mt-3 ml-3.5 size-12 inline-block">  
                <img src="resources/sf-logo.svg" alt="Scholar Finds Logo" class="mt-3 ml-3.5 size-12 inline-block">
            </span>
            <a href=""><h1 class="m-3.5 whitespace-nowrap overflow-hidden text-3xl opacity-0 group-hover:opacity-100 duration-500 ">Scholar Finds</h1></a>
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
    </header>
    <!-- ================================================== MAIN ================================================== -->
    <main class="ml-25 m-5 p-15 w-[calc(100vw-80px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl bg-off-white z-2 text-black drag-none">
        <h1 class="mb-3 text-3xl font-bold text-dirty-brown select-none">Admin</h1>
        <div class="relative">      
            <input type="radio" name="tb" id="thesestb" checked class="peer/thesestb hidden">
            <label for="thesestb" class="absolute text-dirty-brown font-bold text-xl opacity-60 peer-checked/thesestb:opacity-100 peer-checked/thesestb:underline peer-checked/thesestb:decoration-3 peer-checked/thesestb:underline-offset-6 duration-300 select-none cursor-pointer">Theses</label>
            <input type="radio" name="tb" id="userstb" class="peer/userstb hidden">
            <label for="userstb" class="absolute left-18 text-dirty-brown font-bold text-xl opacity-60 peer-checked/userstb:opacity-100 peer-checked/userstb:underline peer-checked/userstb:decoration-3 peer-checked/userstb:underline-offset-6 duration-300 select-none cursor-pointer <?php echo $_COOKIE["role"] !== "superadmin" ? "hidden" : ""; ?>">Users</label>

            <div class="w-full min-h-[60vh] h-auto hidden flex-col gap-2.5 peer-checked/thesestb:flex">
                <div class="mt-10 flex justify-end gap-5">
                    <div class="flex items-center text-sm italic opacity-80 select-none">
                        <p>Showing table with <span id="tpage-info">1 out of 1</span> of results</p>
                    </div>
                    <div class="px-2.5 py-1.5 rounded-md flex items-center gap-3 bg-lgreen">
                        <select name="" id="tsets-per-page" class="px-4 w-auto rounded-md bg-slgreen text-sm select-none outline-none">
                            <option value="1">1</option>
                        </select>
                        <hr class="h-9/10 border-[#585345] border-1">
                        <input type="text" placeholder="Search" id="tsearch-box" class="px-4 w-50 rounded-md bg-slgreen text-sm outline-none">
                        <select name="" id="tsearch-category" class="px-4 w-30 rounded-md bg-slgreen text-sm select-none outline-none">
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
                    <label for="tcreator" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Append Data</label>
                    <label for="tcreator" class="fixed top-0 left-0 w-screen h-screen bg-black opacity-40 hidden peer-checked:block z-4"></label>
                    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-10 w-120 h-150 bg-slgreen rounded-md shadow-2xl shadow-black/70 hidden peer-checked:block z-5">
                        <div class="relative w-full h-full flex flex-col justify-between">
                            <label for="tcreator" class="absolute top-0 right-0 p-2 cursor-pointer">
                                X
                            </label>
                            <h1 class="py-5 text-2xl font-extrabold text-center select-none">Append Thesis Data</h1>
                            <form action="" class="w-full flex flex-col *:relative *:flex *:flex-col gap-2.5">
                                <span>
                                    <input type="text" name="title" id="title" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none">
                                    <label for="title" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Title</label>
                                </span>
                                <span>
                                    <input type="text" name="authors" id="authors" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none">
                                    <label for="authors" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Author/s</label>
                                </span>
                                <span>
                                    <textarea type="text" name="abstract" id="abstract" required class="peer px-2 py-1.5 w-full h-42 resize-none rounded-md border-2 border-black/70 text-sm outline-none"></textarea>
                                    <label for="abstract" class="absolute top-2.5 left-2 px-1 py-0.5 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Abstract</label>
                                </span>
                                <span>
                                    <input type="text" name="keywords" id="keywords" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none">
                                    <label for="keywords" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Keywords</label>
                                </span>
                                <span class="flex-row! gap-2 *:relative *:w-1/2 *:flex *:flex-col">
                                    <span>
                                        <select name="course" id="course" required class="px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none text-[#464644] valid:text-black">
                                            <option value="" disabled selected>Select here</option>
                                            <option class="text-black" value="bsit">BSIT-NS</option>
                                            <option class="text-black" value="bscs">BSCS-AD</option>
                                        </select>
                                        <label for="course" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none -translate-y-4 text-xs">Course</label>
                                    </span>
                                    <span>
                                        <input type="date" name="date" id="date" required class="px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none text-[#464644] valid:text-black">
                                        <label for="date" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none -translate-y-4 text-xs">Published Date</label>
                                    </span>
                                </span>
                            </form>
                            <span class="py-5 flex items-center justify-center">
                                <button class="px-8 py-1 rounded-md bg-lgreen text-sm font-semibold hover:opacity-90 active:scale-95 duration-100 cursor-pointer">Submit</button>
                            </span>
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
                        <tr class="*:rounded-md *:bg-slgreen *:py-0.5 *:overflow-hidden *:text-ellipsis *:whitespace-nowrap">
                            <td class="flex items-center justify-center gap-2 select-none">
                                <input type="checkbox" class="px-1" id="001">
                                <button type="button" class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#0f0f0f">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                    </svg>
                                </button>
                                <button type="button" class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#0f0f0f">
                                    <path d="m480-240 160-160-56-56-64 64v-168h-80v168l-64-64-56 56 160 160ZM200-640v440h560v-440H200Zm0 520q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm264 300Z"/>
                                    </svg>
                                </button>
                                <button type="button" class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#0f0f0f">
                                    <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                    </svg>
                                </button>
                            </td>
                            <td class="tid">01</td>
                            <td class="pdate">2025-05</td>
                            <td class="course">BSCS-AD</td>
                            <td class="title">TitleTitleTitleTitleTitleTitlTitleTitleTitleTitleTitleTitleeeeeeeeeeeeeeee</td>
                            <td class="authors">Authors</td>
                            <td class="abstract">Abstract</td>
                            <td class="keywords">Keywords</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end gap-2">
                    <button class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Archive Selected</button>
                    <button class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Archive All</button>
                </div>
            </div>
            <div class="w-full min-h-[60vh] h-auto hidden flex-col gap-2.5 peer-checked/userstb:flex">
                <div class="mt-10 flex justify-end gap-5">
                    <div class="flex items-center text-sm italic opacity-80 select-none">
                        <p>Showing table with <span id="upage-info">1 out of 1</span> of results</p>
                    </div>
                    <div class="px-2.5 py-1.5 rounded-md flex items-center gap-3 bg-lgreen">
                        <select name="" id="usets-per-page" class="px-4 w-auto rounded-md bg-slgreen text-sm select-none outline-none">
                            <option value="1">1</option>
                        </select>
                        <hr class="h-9/10 border-[#585345] border-1">
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
                    <label for="ucreator" class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Append Data</label>
                    <label for="ucreator" class="fixed top-0 left-0 w-screen h-screen bg-black opacity-40 hidden peer-checked:block z-4"></label>
                    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-10 w-120 h-150 bg-slgreen rounded-md shadow-2xl shadow-black/70 hidden peer-checked:block z-5">
                        <div class="relative w-full h-full flex flex-col justify-between">
                            <label for="ucreator" class="absolute top-0 right-0 p-2 cursor-pointer">
                                X
                            </label>
                            <h1 class="py-5 text-2xl font-extrabold text-center select-none">Append User Data</h1>
                            <form action="" class="w-full flex flex-col *:relative *:flex *:flex-col gap-2.5">
                                <span>
                                    <input type="text" name="username" id="username" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none">
                                    <label for="username" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Username</label>
                                </span>
                                <span>
                                    <input type="text" name="name" id="name" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none">
                                    <label for="name" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Name</label>
                                </span>
                                <span>
                                    <input type="email" name="email" id="email" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none">
                                    <label for="email" class="absolute top-2.5 left-2 px-1 py-0.5 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">UMak Email Address</label>
                                </span>
                                <span>
                                    <input type="text" name="password" id="password" required class="peer px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none">
                                    <label for="password" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none opacity-70 peer-valid:-translate-y-4 peer-valid:text-xs peer-valid:opacity-100 peer-focus:-translate-y-4 peer-focus:text-xs peer-focus:opacity-100 duration-200">Password</label>
                                </span>
                                <span>
                                    <select name="access" id="access" required class="px-2 py-1.5 w-full rounded-md border-2 border-black/70 text-sm outline-none text-[#464644] valid:text-black">
                                        <option value="" disabled selected>Select here</option>
                                        <option class="text-black" value="regular">Regular</option>
                                        <option class="text-black" value="admin">Admin</option>
                                        <option class="text-black" value="superadmin">Super Admin</option>
                                    </select>
                                    <label for="course" class="absolute top-2.5 left-2 px-1 bg-slgreen leading-none select-none -translate-y-4 text-xs">Role</label>
                                </span>
                                <span class="text-sm select-none">
                                    <p>The user can:</p>
                                    <ul class="pl-5 list-disc">
                                        <li class="text-[#464644] line-through" id="ua1">View Library</li>
                                        <li class="text-[#464644] line-through" id="ua2">View Databases</li>
                                        <li class="text-[#464644] line-through" id="ua3">Edit "Theses" Table</li>
                                        <li class="text-[#464644] line-through" id="ua4">Edit "Users" Table</li>
                                    </ul>
                                </span>
                            </form>
                            <span class="py-5 flex items-center justify-center">
                                <button class="px-8 py-1 rounded-md bg-lgreen text-sm font-semibold hover:opacity-90 active:scale-95 duration-100 cursor-pointer">Submit</button>
                            </span>
                            <script>
                                document.getElementById('access').addEventListener('change', function() {
                                    const roles = {
                                        regular: ["ua2", "ua3", "ua4"],
                                        admin: ["ua4"],
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
                        <tr class="*:rounded-md *:bg-slgreen *:py-0.5 *:overflow-hidden *:text-ellipsis *:whitespace-nowrap">
                            <td class="flex items-center justify-center gap-2 select-none">
                                <input type="checkbox" class="px-1" id="001">
                                <button type="button" class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#0f0f0f">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                    </svg>
                                </button>
                                <button type="button" class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#0f0f0f">
                                    <path d="m480-240 160-160-56-56-64 64v-168h-80v168l-64-64-56 56 160 160ZM200-640v440h560v-440H200Zm0 520q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm264 300Z"/>
                                    </svg>
                                </button>
                                <button type="button" class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#0f0f0f">
                                    <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                    </svg>
                                </button>
                            </td>
                            <td id="">ID</td>
                            <td id="">superadmin</td>
                            <td id="">Renzjan</td>
                            <td id="">Renzjan Moncinilla</td>
                            <td id="">renzjan.moncinilla@umak.edu.ph</td>
                            <td id="">hashedpassword</td>
                            <td id="">01AECD</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end gap-2">
                    <button class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Archive Selected</button>
                    <button class="px-5 py-0.5 rounded-md bg-lgreen text-sm hover:opacity-80 active:scale-95 duration-50 cursor-pointer">Archive All</button>
                </div>
            </div>
        </div>
        <!--
        <ul class="absolute top-5 left-1/2 -translate-x-1/2 p-2 px-5 w-100 rounded-xl border-2 bg-[#f8d7da] border-[#f5c6cb] text-[#7f1d1d] select-none leading-none z-5 animate-downfadeinout delay-200">
            <li>Error occured</li>
            <li>Fill up the field</li>
        </ul>
        <ul class="absolute top-5 left-1/2 -translate-x-1/2 p-2 px-5 w-100 rounded-xl border-2 bg-[#bbf7d0] border-[#c3e6cb] text-[#14532d] select-none leading-none z-5 animate-downfadeinout delay-200">
            <li>Success append</li>
        </ul>
                            -->
    </main>
    <script>
        let data = { theses: [] }, thesesPerPage = 15, selectedSet = 0, searchQuery = "", searchCategory = "";

        fetch('data.json')
            .then(res => res.json())
            .then(jsonData => { data = jsonData; displaySets(); })
            .catch(err => console.error("Error retrieving data:", err));

        function displaySets() {
            const tcontainer = document.getElementById("theses-container"), tpageInfo = document.getElementById("tpage-info");
            tcontainer.innerHTML = "";
            let filteredData = data.theses?.filter(item => !searchQuery || item[searchCategory]?.toLowerCase().includes(searchQuery.toLowerCase())) || [];
            let totalSets = Math.ceil(filteredData.length / thesesPerPage);
            selectedSet = Math.max(0, Math.min(selectedSet, totalSets - 1));
            const tsetsSelect = document.getElementById("tsets-per-page");
            let prevValue = tsetsSelect.value;
            tsetsSelect.innerHTML = [...Array(totalSets)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("");
            tsetsSelect.value = prevValue > 0 && prevValue <= totalSets ? prevValue : "1";

            let thesesSlice = filteredData.slice(selectedSet * thesesPerPage, (selectedSet + 1) * thesesPerPage);
            tcontainer.innerHTML = thesesSlice.length ? thesesSlice.map(item => `
                <tr class="*:rounded-md *:bg-slgreen *:py-0.5 *:overflow-hidden *:text-ellipsis *:whitespace-nowrap">
                    <td class="flex items-center justify-center gap-2 select-none">
                        <input type="checkbox" class="px-1" id="${item.thesis_id}">
                        <button class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">✏️</button>
                        <button class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">📥</button>
                        <button class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">🗑️</button>
                    </td>
                    <td class="tid">${item.thesis_id}</td>
                    <td class="pdate">${item.published_date}</td>
                    <td class="course">${item.course}</td>
                    <td class="title">${item.title}</td>
                    <td class="authors">${item.authors}</td>
                    <td class="abstract">${item.abstract || "N/A"}</td>
                    <td class="keywords">${item.keywords || "N/A"}</td>
                </tr>`).join("") : "<tr><td colspan='8' class='text-center'>No results found.</td></tr>";

                if (tpageInfo) tpageInfo.textContent = `${selectedSet + 1} of ${totalSets} set\/s`;
        }

        let udata = { accounts: [] }, uitemsPerPage = 15, uselectedSet = 0, usearchQuery = "", usearchCategory = "";

        fetch('data.json')
            .then(response => response.json())
            .then(json => { udata = json; udisplaySets(); })
            .catch(error => console.error("Error loading user data:", error));

        function udisplaySets() {
            const ucontainer = document.getElementById("users-container"), upageInfo = document.getElementById("upage-info");
            ucontainer.innerHTML = "";
            
            let ufilteredData = udata.accounts?.filter(item => 
                !usearchQuery || item[usearchCategory]?.toLowerCase().includes(usearchQuery.toLowerCase())) || [];

            let utotalSets = Math.ceil(ufilteredData.length / uitemsPerPage);
            uselectedSet = Math.max(0, Math.min(uselectedSet, utotalSets - 1));

            const usetsSelect = document.getElementById("usets-per-page");
            let uprevValue = usetsSelect.value;
            usetsSelect.innerHTML = [...Array(utotalSets)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("");
            usetsSelect.value = uprevValue > 0 && uprevValue <= utotalSets ? uprevValue : "1";

            let udataSlice = ufilteredData.slice(uselectedSet * uitemsPerPage, (uselectedSet + 1) * uitemsPerPage);
            ucontainer.innerHTML = udataSlice.length ? udataSlice.map(user => `
                <tr class="*:rounded-md *:bg-slgreen *:py-0.5 *:overflow-hidden *:text-ellipsis *:whitespace-nowrap">
                    <td class="flex items-center justify-center gap-2 select-none">
                        <input type="checkbox" class="px-1" id="user-${user.user_id}">
                        <button class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">✏️</button>
                        <button class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">📥</button>
                        <button class="px-1 opacity-65 hover:opacity-100 active:scale-95 cursor-pointer">🗑️</button>
                    </td>
                    <td>${user.user_id}</td>
                    <td>${user.role}</td>
                    <td>${user.username}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.password}</td>
                    <td>${user.personalization || "N/A"}</td>
                </tr>`).join("") : "<tr><td colspan='8' class='text-center'>No users found.</td></tr>";

            if (upageInfo) upageInfo.textContent = `${uselectedSet + 1} of ${utotalSets} set/s`;
        }

        window.onload = () => {
            // Theses Data
            document.getElementById("tsets-per-page")?.addEventListener("change", e => { selectedSet = e.target.value - 1; displaySets(); });
            document.getElementById("tsearch-box")?.addEventListener("input", e => { searchQuery = e.target.value; selectedSet = 0; displaySets(); });
            document.getElementById("tsearch-category")?.addEventListener("change", e => { searchCategory = e.target.value; selectedSet = 0; displaySets(); });

            // Users Data
            document.getElementById("usets-per-page")?.addEventListener("change", e => { uselectedSet = e.target.value - 1; udisplaySets(); });
            document.getElementById("usearch-box")?.addEventListener("input", e => { usearchQuery = e.target.value; uselectedSet = 0; udisplaySets(); });
            document.getElementById("usearch-category")?.addEventListener("change", e => { usearchCategory = e.target.value; uselectedSet = 0; udisplaySets(); });
        };

        const admin = document.querySelector('a[href="admin.php"]');
        const role = document.cookie.match(/role=([^;]+)/)?.[1];
        if (!role || role === "regular") admin?.classList.add("hidden");
    </script>
</body>
</html>