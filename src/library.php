<?php
    if (!isset($_COOKIE['id'])) {
        header("Location: access.php");
        exit();
    }

    session_start();
    require_once 'config.php';

    $sql = "SELECT thesis_id, published_date, course, title, authors, abstract, keywords FROM theses";
    $result = $conn->query($sql);

    $stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
    $stmt->bind_param("s", $_COOKIE['id']);
    $stmt->execute();
    $rresult = $stmt->get_result();

    if ($rresult->num_rows > 0) {
        $user = $rresult->fetch_assoc();

        $username = $user['username'];
        $personalization = $user['personalization'];
        $dp = substr($personalization, 0, 2);
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
<body class="relative bg-[url('resources/lib-bg.jpg')] text-cabin text-white flex">
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
    <main class="ml-25 m-5 p-15 w-[calc(100vw-135px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl flex flex-col bg-[#eeeeee] z-2 text-dirty-brown drag-none">
        <h1 class="mb-5 text-3xl font-bold text-[#585345] select-none">Library</h1>
        <div class="absolute top-15 right-15 flex flex-row-reverse gap-2.5 items-center text-dirty-brown font-bold text-lg select-none">
            <a href="profile.php"><img src="resources/dp/<?php echo $dp . ".svg";?>" alt="dp1" class="size-12 rounded-full border-2 border-dirty-brown cursor-pointer" draggable="false"></a>
            <p>Welcome <?php echo $username;?>!</p>
        </div>
        <div class="flex justify-between items-center">
            <form action="" id="search-form" class="flex items-center gap-5">
                <span id="srch" class="relative">
                    <svg class="absolute top-1/2 -translate-y-1/2 left-2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#585345"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    <input type="search" name="search" id="search" placeholder="Search for a thesis book..." class="px-5 pl-8 py-1 w-80 border-2 rounded-2xl border-[#585345] text-[#585345] outline-none">
                </span>
                <select name="sfilter" id="sfilter" class="px-5 py-1 w-50 h-9 border-2 rounded-2xl border-[#585345] text-[#585345] outline-none">
                    <option value="none">Filter by:</option>
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="keywords">Keywords</option>
                </select>
            </form>
        </div>
        <br class="select-none">

        <!-- RECENTS -->
        <div id="recents"> <!-- IF NO RECENTS THEN DON'T DISPLAY THIS DIV -->
            <h1 class="mb-5 text-2xl font-semibold text-[#585345] select-none">Recents</h1>
            <div class="grid grid-cols-[repeat(auto-fit,_495px)] gap-y-12">
                <!-- PHP CODE | FOR LOOP FOR USER RECENTS -->
                 
            </div>
        </div>
        <hr class="my-5 border-1 border-[#585345]">
        
        <!-- THESIS -->
        <div id="all-ths" class="text-gray-100">
            <h1 class="mb-5 text-2xl font-semibold text-[#585345] select-none">Library</h1>
            <div class="grid grid-cols-[repeat(auto-fit,_470px)] gap-y-12">
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $thesis_id = $row['thesis_id'];
                        $published_date = $row['published_date'];
                        $course = $row['course'] == "BSIT-NS" ? "Bachelor of Science in Information Technology (Network Security)" : "Bachelor of Science in Computer Science (Application Development)";
                        $title = stripslashes($row['title']);
                        $authors = $row['authors'];
                        $authorsList = explode("-", $row['authors']);
                        $abstract = !empty($row['abstract']) ? stripslashes($row['abstract']) : "No abstract available.";
                        $keywords = stripslashes($row['keywords']);
            ?>
                <!-- MINI VIEW -->
                <div class="relative w-110 h-45 mini-view" id="<?php echo 'mv' . $thesis_id;?>">
                    <div class="absolute w-full h-full flex ">
                        <div class="absolute bottom-0 w-full h-40 rounded-2xl bg-[#355e3b] shadow-2xl shadow-gray-400"></div>
                        <div class="w-35 h-full select-none z-3">
                            <img src="resources/book.svg" alt="book" onclick="toggleFullView('<?php echo 'fv' . $thesis_id;?>')" class="absolute top-2.5 ml-2.5 w-30 hover:-translate-y-2 duration-200 cursor-zoom-in" draggable="false">
                        </div>
                        <div class="pt-8 w-70 flex flex-col gap-2 justify-start z-3">
                            <h2 class="leading-none text-sm text-justify">
                                <?php echo ucwords(strtolower($title));?>
                            </h2>
                            <ul class="text-xs flex flex-wrap gap-1 *:px-3 *:rounded-xl *:bg-[#1b3a1a90] *:text-xs *:font-extralight *:opacity-85 *:select-all">
                                <?php
                                    foreach ($authorsList as $author) {
                                        if ($author == "et al.") {
                                            echo "<li>" . $author . "</li>";
                                        } else {
                                            echo "<li>" . ucwords(strtolower($author)) . "</li>";
                                        }
                                    }
                                ?>
                            </ul>
                            <p class="absolute bottom-2 right-3 text-xs opacity-80 select-none"><?php echo $published_date; ?></p>
                        </div>
                    </div>
                </div>
                <!-- FULL VIEW -->
                <div class="fixed top-0 left-0 ml-25 m-5 w-[calc(100vw-135px)] min-h-[calc(100vh-40px)] h-auto rounded-4xl bg-[#eeeeee] z-5 text-black hidden" id="<?php echo 'fv' . $thesis_id;?>"> <!-- FULL VIEW -->
                    <div class="absolute top-1/2 right-0 -translate-y-1/2 p-15 w-full h-[60vh] grid grid-cols-[25%_75%] bg-[#355e3b]">
                        <div class="relative w-auto h-full">
                            <img src="resources/book.svg" alt="big-book" onclick="toggleFullView('<?php echo 'fv' . $thesis_id;?>')" class="absolute hover:-translate-y-4 duration-200 drop-shadow-2xl select-none cursor-zoom-out" draggable="false">
                        </div>
                        <div class="ml-15 flex flex-col text-justify text-gray-300">
                            <h2 class="text-xl leading-5 font-bold"><?php echo $title;?></h2>
                            <p class="mt-1 select-none opacity-80 font-semibold"><?php echo $course . " | " . $published_date?></p>
                            <ul class="mt-2 flex flex-wrap gap-1.5 *:px-5 *:py-0.5 *:rounded-xl *:bg-[#1b3a1a90] *:text-sm ">
                                <?php
                                foreach ($authorsList as $author) {
                                    if ($author == "et al.") {
                                        echo "<li>" . $author . "</li>";
                                    } else {
                                        echo "<li>" . ucwords(strtolower($author)) . "</li>";
                                    }
                                }
                                ?>
                            </ul>
                            <hr class="mt-2.5 mb-5">
                            <p class="leading-5"><?php echo $abstract;?></p>
                            <br class="select-none">
                            <p><?php echo !empty($keywords) ? '<span class="font-bold">Keywords: </span>' . $keywords : "";?></p>
                        </div>
                        <button class="absolute top-5 right-5 p-2 rounded-2xl bg-[#1b3a1a90] hover:opacity-80 active:scale-95 duration-100 cursor-pointer" onclick="toggleFullView('<?php echo 'fv' . $thesis_id;?>')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#e8eaed"><path d="m259-174-84-85 220-221-220-221 84-85 221 221 221-221 84 85-220 221 220 221-84 85-221-221-221 221Z"/></svg>
                        </button>
                        <form class="absolute bottom-0 right-0 pb-5 pr-15 flex gap-2 *:bg-[#1b3a1a90] *:px-4 *:py-0.5 *:rounded-xl *:flex *:gap-1 *:items-center *:hover:opacity-80 *:active:scale-95 *:duration-100 *:select-none *:cursor-pointer text-gray-300 ">
                            <button type="button" onclick="">
                                <svg class="opacity-80" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#e8eaed"><path d="M360-240q-33 0-56.5-23.5T280-320v-480q0-33 23.5-56.5T360-880h360q33 0 56.5 23.5T800-800v480q0 33-23.5 56.5T720-240H360Zm0-80h360v-480H360v480ZM200-80q-33 0-56.5-23.5T120-160v-560h80v560h440v80H200Zm160-240v-480 480Z"/></svg>
                                Copy citation in APA format
                            </button>
                            <button>
                                <svg class="opacity-80" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#e8eaed"><path d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h480q33 0 56.5 23.5T800-800v640q0 33-23.5 56.5T720-80H240Zm0-80h480v-640h-80v280l-100-60-100 60v-280H240v640Zm0 0v-640 640Zm200-360 100-60 100 60-100-60-100 60Z"/></svg>
                                Bookmark this thesis
                            </button>
                        </form>
                    </div>
                </div>
            <?php
                    }
                }
            ?>
            </div>
        </div>
    </main>
    <script>
        const miniview = document.querySelectorAll(".mini-view");

        function toggleFullView(fvid) {
            document.getElementById(fvid).classList.toggle('hidden');
            miniview.forEach(item => {
                item.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>