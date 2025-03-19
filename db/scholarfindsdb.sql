-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 19, 2025 at 02:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarfindsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(4) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(10) NOT NULL DEFAULT 'regular' COMMENT 'regular, admin, superadmin',
  `username` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `personalization` text NOT NULL DEFAULT '01-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `archived`, `role`, `username`, `name`, `email`, `password`, `personalization`) VALUES
(1, 0, 'superadmin', 'Renzjan', 'Renzjan Moncinilla', 'renzjan.moncinilla@umak.edu.ph', 'dev01@umak', 'RJ-'),
(2, 0, 'superadmin', 'Andrei', 'Paul Andrei Valencia', 'paul.valencia@umak.edu.ph', 'dev02@umak', ''),
(3, 0, 'superadmin', 'Dhanica', 'Ma. Dhanica Ballesteros', 'ma.ballesteros@umak.edu.ph', 'dev03@umak', ''),
(4, 0, 'superadmin', 'Lilxianaze', 'Lilxianaze Garcia', 'lilxianaze.garcia@umak.edu.ph', 'dev04@umak', ''),
(5, 0, 'superadmin', 'Superadmin Faculty', 'sa@umak', 'sa@umak', 'sa@umak', ''),
(6, 0, 'admin', 'Admin Faculty', 'a@umak', 'a@umak', 'a@umak', ''),
(7, 1, 'regular', 'Renzjan', 'Renzjan Moncinilla', 'renzjan.m@umak.edu.ph', '$2y$10$FCmmeOiwJGkaI6pw85K4TOG.MiBr3Zu/bx8yfCryahgdP9iWvbV/O', '01-'),
(8, 0, 'regular', 'Renzjan', 'Renzjan Moncinilla', 'renzjan@umak.edu.ph', 'BIyL3T0HvevAvw93EaJiLnZ2ek5GeU9BMTNHK3h2YTRCWUtsRlE9PQ==', '01-');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_backup`
--

CREATE TABLE `accounts_backup` (
  `user_id` int(4) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(10) NOT NULL DEFAULT 'regular' COMMENT 'regular, admin, superadmin',
  `username` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `personalization` text NOT NULL DEFAULT '01-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theses`
--

CREATE TABLE `theses` (
  `thesis_id` int(4) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `published_date` varchar(7) NOT NULL,
  `course` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `adviser` varchar(100) NOT NULL,
  `abstract` varchar(1500) NOT NULL,
  `keywords` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theses`
--

INSERT INTO `theses` (`thesis_id`, `archived`, `published_date`, `course`, `title`, `authors`, `adviser`, `abstract`, `keywords`) VALUES
(1, 0, '2018', 'BSCS-AD', 'A QUEUING THEORY ANALYSIS IMPROVEMENT MEASURE FOR OUTPATIENT DEPARTMENT PROCESS', 'Arduo, Jonathan R.-et al.', 'Mansueto, Christian Michael M.', '', ''),
(2, 0, '2018', 'BSCS-AD', 'A STUDY ON THE EFFICIENCY OF WAVELET PITCH ESTIMATION ALGORITHM', 'Romero, Nichole John T.-et al.', 'Mansueto, Christian Michael M.', '', ''),
(3, 0, '2018', 'BSCS-AD', 'AN ALGORITHM ANALYSIS FOR OPTIMIZED SEARCH IN LOCATION INTELLIGENT SYSTEM', 'Sunga, Pushyaida Aira C.-et al.', 'Pahayahay, Alexander B.', '', ''),
(4, 0, '2018', 'BSCS-AD', 'AN ANALYSIS OF ASYNCTASK THREAD POOLING IN A MOBILE INTEGRATED ENVIRONMENT', 'Teves, Romel M.-et al.', 'Asejo, Nelson R.', '', ''),
(5, 0, '2018', 'BSCS-AD', 'An Analysis of Dijkstra\'s Algorithm in a Navigation App for Visually Impaired Person', 'Marayan, Hazel S.-et al.', 'Congzon, Janice Pola D., MIT', '', ''),
(6, 0, '2018', 'BSCS-AD', 'AN ANALYSIS OF K-MEANS ALGORITHM FOR FILE TRANSFER IN A WIRELESS ENVIRONMENT', 'Aguero, Al John T.-et al.', 'Diampoc, Lester G.', '', ''),
(7, 0, '2018', 'BSCS-AD', 'AN ANALYSIS OF LINEAR CONGRUENTIAL GENERATOR FOR PSEUDO RANDOM GENERATION OF QUESTIONNAIRES OF THE ALZH AID APP', 'Nilo, Kyle Harley L.-et al.', 'Asejo, Nelson R.', '', ''),
(8, 0, '2018', 'BSCS-AD', 'COMPARATIVE ANALYSIS OF MYSQL AND FIREBASE IN A MOBILE APPLICATION', 'Velasquez, John Darnel D.-et al.', 'Asejo, Nelson R.', '', ''),
(9, 0, '2018', 'BSCS-AD', 'NAIVE FORECASTING ALGORITHM ANALYSIS FOR STUDENT GRADE PREDICTION', 'Panti, Enrique Jimmar C.-et al.', 'Alar, Hernan S.', '', ''),
(10, 0, '2018', 'BSCS-AD', 'QUEUEING THEORY ANALYSIS AS AN IMPROVEMENT MEASURE FOR ORDERING PROCESSES', 'Villaver, Ray Vincent Phillip D.-et al.', 'Cortez, Rex Jayson T.', '', ''),
(11, 0, '2018', 'BSCS-AD', 'SCHEDULE OPTIMIZATION OF EDUCATOR\'S ACTIVITIES THROUGH EVOLUTIONARY PROGRAMMING', 'Labrador, Aldwin B.-et al.', 'Alar, Hernan S.', '', ''),
(12, 0, '2018', 'BSCS-AD', 'THE EFFICIENCY OF CONVOLUTIONAL NEURAL NETWORKS FOR LEAF PATTERN RECOGNITION', 'Bigcal, Richard N.-et al.', 'Dr. Sabado, Danilo C.', '', ''),
(13, 0, '2018', 'BSCS-AD', 'THE EFFICIENCY OF DELTA TIME RENDER UPDATE IN AN ISOMETRIC MOBILE AND DESKTOP-BASED GAME APPLICATION', 'Galvan, Rosalie P.-et al.', 'Asejo, Nelson A.', '', ''),
(14, 0, '2018', 'BSCS-AD', 'THE EFFICIENCY OF HUB-BASED LABELING ALGORITHM FOR AN EMERGENCY RESPONSE MOBILE APPLICATION', 'Bacani, Sarah Joy J.-et al.', 'Dorin, Rommel L.', '', ''),
(15, 0, '2018', 'BSCS-AD', 'THE EFFICIENCY OF IMPLEMENTING A* ALGORITHM FOR ENEMY AI PATHFINDING IN A VIRTUAL REALITY GAME', 'Dulay, Kennyjay O.-et al.', 'Mansueto, Christian Michael M.', '', ''),
(16, 0, '2018', 'BSCS-AD', 'THE EFFICIENCY OF REAL-TIME CODE MERGING ALGORITHM FOR DISTRIBUTED PROGRAMMING', 'Taligatos, Kim Justine M.-et al.', 'Cortez, Rex Jayson T.', '', ''),
(17, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF GEOCALCULATOR: GEOMETRY AUTOMATIC CALCULATOR MOBILE APPLICATION', 'Manalo, Jemuel P.-et al.', 'Congzon, Janice Pola D., MIT', '', ''),
(18, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF PHASES.IO: A PROJECT MANAGEMENT TOOL WITH RESOURCE CONTROL REPOSITORY', 'Mojares, Ely Nell Jireh L. Jr.-et al.', 'Dr. Sabado, Danilo C.', '', ''),
(19, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF POT (Plant On Track): AN ARDUINO-BASED PLANT GROWTH MONITORING SYSTEM', 'Sanchez, Michelle Joy T.-et al.', 'Dr. Sabado, Danilo C.', '', ''),
(20, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF REVEAL: RIO DE JANEIRO VIRTUAL EXPERIENCE AND LEARNING MOBILE APPLICATION', 'Espinosa, Mhervin P.', 'Dr. Sabado, Danilo C.', '', ''),
(21, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF SIGNCON: A SIGN LANGUAGE-TO-SPEECH APPLICATION FOR MUTE PEOPLE', 'Pablo, Jerald Jon-et al.', 'Dr. Sabado, Danilo C.', '', ''),
(22, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF SIRKIT: A BASIC ELECTRICAL WIRING SIMULATOR ON ANDROID', 'Apuya, Jaybert Noli P. II-et al.', 'Congzon, Janice Pola D., MIT', '', ''),
(23, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF UMAK KONEK: AN ACADEMIC SOCIAL NETWORKING PLATFORM', 'Pangan, Jenree Robert S.-et al.', 'Congzon, Janice Pola D., MIT', '', ''),
(24, 0, '2018', 'BSCS-AD', 'DEVELOPMENT OF VAST: VIRTUAL APPLICATION FOR SOLAR SYSTEM TOUR', 'Gamboa, John Nichol C.-et al.', 'Dr. Sabado, Danilo C.', '', ''),
(25, 0, '2018', 'BSCS-AD', 'MULTIPLE INTELLIGENCES ASSESSMENT APPLICATION', 'De Leon, Richard V.-et al.', 'Congzon, Janice Pola D., MIT', '', ''),
(26, 0, '2018', 'BSCS-AD', 'THE DEVELOPMENT OF WEBEE: AN INTERACTIVE ANDROID LEARNING APPLICATION OF HTML LANGUAGE FOR KIDS', 'Retales, Eugene J.-et al.', 'Congzon, Janice Pola D., MIT', '', ''),
(27, 0, '2024-05', 'BSIT-NS', 'DEVELOPMENT OF FACILITIES AND EQUIPMENT MANAGEMENT SYSTEM FOR BARANGAY SANTOL', 'ABUNDO, PRECIOUS APPLE-DINI AY, JONALYN S.-TUSING, LAWRENCE JOHN P.', '', 'The capstone project titled \\\"Development of Facilities and Equipment Management System for Barangay Santol\\\" seeks to revolutionize asset management by addressing the urgent need for an efficient tracking and management system for barangay assets, encompassing buildings, equipment, and vehicles. The primary goal is to design and implement a robust, user-friendly system that empowers barangay officials to monitor assets, schedule maintenance, plan replacements, and optimize resource utilization with precision and ease. Through a thorough analysis, the project identifies existing challenges in the current asset management practices, aiming to not only resolve these issues but also proactively anticipate and mitigate potential risks associated with asset mismanagement, loss, or inefficiencies. Emphasizing user convenience, the system is designed to be intuitive and accessible, ensuring that it meets the practical needs of barangay officials. Integral to the system\\\'s architecture are stringent access control mechanisms grounded in the CIA Triad principles (Confidentiality, Integrity, and Availability), guaranteeing robust security to protect sensitive data and information input by users, thus fostering a secure and efficient asset management environment for Barangay Santol.', 'Asset inventory management, Threat Mitigation Approach, CIA Triad, Facilities and Equipment.'),
(28, 0, '2024-05', 'BSIT-NS', 'ASIAN HOSPITAL HEALTH DATA HUB: DEVELOPMENT OF RESEARCH INFORMATION SYSTEM FOR ASIAN HOSPITAL', 'BUENO, REVIN R.-GENERAO, JONAS G.-MEJILLANO, BEA BIANCA R.', '', 'The Hospital Research Information System is a web-based software application tailored for Asian Hospital aimed at modernizing and enhancing the research process within the institution. The Hospital Research Information System aims to digitize and optimize research workflows within Asian Hospital. By leveraging technology, the hospital aims to overcome challenges associated with manual processes. The research design for developing a research information system for Asian Hospital adopts a descriptive approach to address its research process challenges. The study begins with an introduction outlining the need for Enhanced effectiveness and optimized user satisfaction in the research process. A literature review explores successful implementations and challenges faced by similar systems in research settings providing insights to inform the de development process. The study evaluated the web systems functionality, reliability, usability, and security and the results showed that the web system has excellent performance and usability and is reliable and secure. Results of testing reveal that research is reliably recorded and kept in the database and the website is compatible with a range of devices and browsers assuring easy accessibility and operation. And lastly, the results of the evaluation that the Asian Hospital Health Data Hub has been effective in addressing the demands of Asian Hospital needs.', 'Hospital Research Information System, Asian Hospital Health Data Hub'),
(29, 0, '2024-04', 'BSCS-AD', 'CST HUB: A WEB-BASED APPLICATION SYSTEM FOR STYLE FORMATTING ANALYSIS OF UMAK CS THESIS MANUSCRIPT USING COMPOSITE RULE-BASED ALGORITHM', 'MHIKE LAURENCE N. LACONSAY-HENSON S. BUNAYOG-RAPHAEL JORREL H. DOCOT-CHASTINE JOY B. SANQUI-AIA A. VALLES', '', 'This study focuses on developing a system for style formatting analysis of UMak CS Thesis Manuscripts using Composite Rule-Based Algorithm by utilizing Python Libraries such as PyMuPDF, and Tesseract OCR. The system consists of calculating bounding boxes to check the formatting of CS thesis papers, providing a valuable tool for students and professors to efficiently review and reduce formatting errors. The method involves calculating PDF paper size, margins, spacings and defining fonts. Using Tesseract OCR and PyMuPDF, the system extracts text details, detects margins, and calculates text spacings. The model detects the errors by highlighting them with OpenCV specifically fonts, margins, and spacing. Despite difficulties in manual data extraction and time-consuming margin and spacing detection, the developed system proves useful in improving UMak CS Thesis Manuscript formatting, resulting with an overall accuracy rate of 90.66% across various formatting components specifically: margin, spacings, and font-related, with a potential for future refinements. Furthermore, the system evaluation reached an overall rating of 3.55, indicating a general acceptance among Computer Science (CS) students and professors.', 'Style Formatting Analysis, Formatting Errors, Composite Rule-based Algorithm, UMak CS Thesis Manuscripts, Text Extraction, Data extraction.'),
(30, 0, '2024-05', 'BSIT-NS', 'ENHANCING BUSINESS CONTINUITY THROUGH VIRTUALIZATION: UTILIZING CLOUD STORAGE AND SYNC FOR DISASTER RECOVERY', 'JOVERES, MICHELLE M.-MALINAO, FLORENCE B.-TAN, CHARLES VINCENT D.', '', 'This research synthesizes a network infrastructure design and configuration plan for Obanana Corp, integrating proactive security protocols and industry best practices. By meticulously addressing specific objectives, including the design of local and wide area networks, implementation of AWS services, and integration of disaster recovery measures, the study aims to enhance organizational resilience and operational efficiency. Proactive measures such as firewall security applications and access management protocols ensure robust network security across multiple floors of the PMI Tower. Rigorous testing and validation procedures validate the reliability and performance of the implemented infrastructure, paving the way for a smooth transition and minimal disruption to operations. By adopting these recommendations, Obana Corp can navigate future technological advancements effectively while safeguarding the integrity and security of its IT infrastructure. Overall, putting these steps into practice will greatly improve Obanana Corp\\\'s technology setup, ensuring strong security, better day-to-day operations, and a solid base for handling future tech changes.', 'Network Infrastructure, AWS Services, Disaster Recovery, Firewall Security Applications, Network Connection, GNS3, Firewall Configuration, Cloud Infra'),
(31, 0, '2024-05', 'BSIT-NS', 'DEVELOPMENT OF A WEB-BASED SEXUALITY EDUCATION PLATFORM FOR ADOLESCENTS', 'BENITEZ, TRIXIE MAY C.-GARCIA, JAHMEL ANDRE C.-GRAMATICA, JULIUS A.', '', 'This paper explores the development and evaluation of a web-based platform for sexuality education, aimed at addressing the lack of comprehensive sexuality education materials in educational institutions. Chapter 1 delves into the background of the issue, highlighting the challenges faced in implementing comprehensive sexuality education in the Philippines. Chapter 2 reviews related literature, providing insights from various studies on sexuality education, online resources, and the effectiveness of web-based programs. In Chapter 5, the study\\\'s findings, conclusions, and recommendations are presented. The findings indicate that the developed web-based platform performed well in terms of performance efficiency, usability, security, functionality, and maintainability, as evaluated based on ISO 25010 standards. Conclusions drawn from the study emphasize the importance of web-based tools in delivering comprehensive sexuality education and the need for continuous improvement in such platforms. Recommendations include adding a summative test and implementing a certification system to enhance student learning and engagement. Overall, this study contributes to addressing the challenges in providing comprehensive sexuality education through innovative technological solutions.', 'Web-based Sexuality Education, Sexuality Education Platform, Learning Management System'),
(32, 0, '2024-05', 'BSIT-NS', 'SAGIP ANI: NURTURING AGRICULTURAL PROSPERITY THROUGH AN E-COMMERCE WEB APPLICATION FOR MARKETING AGRICULTURAL PRODUCTS OF PAKISAMA CONFEDERATION', 'MALABANAN, JAMES B.-RANA, JOSIAH CALEB B.-SALUDES, RAZIA PRINCESS JOY T.', '', 'This study aims to develop a secure web-based e-commerce system for the Pambansang Kilusan ng mga Samahang Magsasaka confederation (PAKISAMA). The system will allow basic e-commerce transactions between customers and admins like purchasing and selling products while securing user data. Asides from the basic features and functionalities that are present on a typical e-commerce system, there are also security features implemented in this study. Security features that are included in this study is Multi-Factor Authentication and bcrypt. Multi-Factor Authentication is a standard security feature implemented on most systems and software applications, it works by verifying the authenticity of a user by requesting a unique one-time pin or OTP sent to their email account upon registering on the system. On the other hand, Bcrypt\\\'s purpose is to secure data stored in the backend of applications by using a cryptographic hash function that turns a user\\\'s password into a specific number characters unrecognizable to its original form. The system will be evaluated by using ISO 25010 Product Quality Model Evaluation that assesses a system or software application based on a specific criterion. In this study, the system will be evaluated based on its functionality suitability, interaction capability, reliability, security, and maintainability by three groups. Each group is composed of 10 individuals which are e-commerce platform users, PAKISAMA employees, and IT specialists. The results of t', 'Agriculture, E-commerce, Web Application, Bcrypt, PAKISAMA Confederation, Bcrypt, Security'),
(33, 0, '2024-05', 'BSIT-NS', 'VMEME: A SECURED CONTEMPORARY ART GALLERY', 'DUAL, MARIA PAMELLA B.-ERGUIZA, JENDAN KREMLIN C.-NIEVA, SABRINA JOY P.', '', 'The pandemic and technological advancements have propelled e-commerce and online sales to new heights, requiring businesses to adapt and establish a robust digital presence. MEME, an art gallery, recognized this shift but faced limitations with its outdated website. To address this, the researchers developed the MEME: A Contemporary Art Gallery e-commerce website, tailored to enhance their online reach and meet specific needs. The site encompasses essential e-commerce functionalities such as account management, favorites lists, customization options, and QR code payments, along with advanced features like automatic watermarking and artist\\\'s profile management. Ensuring quality and compliance, the website underwent evaluation by art enthusiasts and technology experts guided by the ISO 25010 standards, covering aspects like aesthetics, user experience, security, and accessibility. Employing a descriptive research approach guided by Bhat\\\'s framework, data was collected to understand visitor demographics, interests in contemporary art, and security preferences, enabling the gallery to better cater to its audience. The updated website is fully functional across major browsers, ensuring data security with password protection. It significantly improves on the previous version, seamlessly integrating core e-commerce tools like account management, order processing, and anti-plagiarism measures. Robust cybersecurity protocols, including QR code payments, OTP authentication, and anti-', 'Outdated website, Digital Presence, Ecommerce Website, Automated Watermarking'),
(34, 0, '2024-05', 'BSIT-NS', 'A PROPOSED WEB APPLICATION WITH CLOUD-BASED SECURITY FOR INTEGRATIVE LEARNING CONTENT-BASED SYSTEM FOR SENIOR HIGH SCHOOL STUDENTS OF PRESIDENT DIOSDA', 'ORMIDO, JOHN MARK M.-PAZ, JHET CHRISTIAN V-VIVO, SARAH ERICA D.', '', 'This paper helps you understand and know how to develop an online learning management system from the base with the cloud-based security that is reinforced for an additional layer of security for the system which can give peace of mind to the users of the developed project. With the help of the standards that we are utilizing and using nowadays such as AICC, SCORM, xAPI, and cmi5, the developers successfully developed an online learning management system which is for President Diosdado Macapagal High School, this project is addressing the issues of the users of the President Diosdado Macapagal High School like missing requirements, not accurate recordings, missing paper works and many more. Based on the of the results and summary of findings that has the researchers gathered from testing and interviews, the performance efficiency, the PDMHS-LMS gets a weighted average mean of 4.21, compatibility testing also gets a staggering value of 4.2 weighted average mean. In terms of usability, the PDMHS-LMS has the weighted average mean of 4.31, lastly, reliability, reliability gets a 4.20 weighted average mean. In conclusion the proposed technology PDMHS-LMS is effective and reliable as an alternative solution for the existing problems that is in the President Diosdado Macapagal High School, with this and backed-up by the research results from the interview and research that the researchers performed.', 'Learning management system, cloud security, database, administrator, ISO 25010, modules, dashboard, web-based application, server, database, switches,'),
(35, 0, '2024-05', 'BSIT-NS', 'DEVELOPMENT OF PropertEASE: \\\"A PROPERTY INFORMATION AND SECURITY MANAGEMENT SYSTEM\\\"', 'CHAVEZ, JAN AXCEL V.-GARCIA, MARY JOYCE D.-GARCIA, SHAINE MARIE C.', '', 'The real estate industry faces significant challenges in managing their property-related data. Golden Home Realty relies merely on spreadsheets, which are vulnerable and prone to human errors and Data breaches. As a result of manual input can have severe consequences, underscoring the critical importance of information security. In response, the development of PropertEASE: \\\"A property information and security management system\\\" emerges as a robust web application designed to address these complexities, and it ensures information confidentiality and privacy through multi-factor authentication via email verification, data encryption and system with its database for more secure data storage and quick and easy navigation, allowing them to manage their property information and security more efficiently. The development process involves phases such as planning, system design, development, testing, deployment, and ongoing maintenance. By adhering to these phases, PropertEASE aims to create a robust property information and security management system that meets user needs and delivers value. PropertEASE promises to benefit everyone in the real estate game. Golden Home Realty Dev. Inc. can streamline data management, employees can be more productive, and property owners gain peace of mind. Buyers, sellers, and tenants all win with accurate information and a smoother transaction process. By prioritizing trust and reliability, PropertEASE has the potential to revolutionize the real es', 'Information Security Management System, PropertEASE Management.'),
(36, 0, '2024-05', 'BSIT-NS', 'Development of IntelliCam: An Information Management System to Secure Closed-Circuit Television Data', 'ARABACA, WOODY ALLENS G.-BALTAZAR, JOHN AARON R.-CARLOS JR., DELFIN A.', '', 'In the contemporary landscape of surveillance technology, Closed-Circuit Television (CCTV) systems are vital for security in various sectors. This study investigates the vulnerabilities and challenges facing CCTV systems in Barangays Pitogo, Pembo, and West Rembo. Through interviews, concerns such as data overwriting, the need for Two-Factor Authentication (2FA), cloud-based storage vulnerabilities, the importance of a digitally auditable trail, and violence prevention measures are uncovered. A proposed solution aims to address these issues with a tailored approach for each barangay, leveraging advanced security measures and contemporary technologies. The study\\\'s significance lies in strengthening CCTV system security, providing stakeholders like local government, barangay officials, law enforcement, disaster risk reduction offices, and community residents with increased safety and security. The methodology, incorporating Design Thinking and adhering to ISO 25010 standards, ensures the reliability of assessing system pertormance. This literature review also explores the critical aspects of Design Thinking, its integration into organizational culture, its significance in design education, and theoretical foundations, particularly within the constructivist learning theory framework. Ultimately, this research enhances surveillance infrastructure, benefiting both current and future community stakeholders.', 'Closed-Circuit Television (CCTV), Two-Factor Authentication. Cloud-based Storage. Violence prevention, Disaster Risk Reduction, Design Thinking, ISO 2'),
(37, 0, '2024-05', 'BSIT-NS', 'RISE AND THRIVE: A WEB-BASED PLATFORM TO PROMOTE KALINGA CULTURE, PRODUCTS, AND SERVICES', 'ARIAGA, MA. ANGELICA C.-COLLADO, MARIECOLLE G.-LINESES, KENNETH O.-PIOJO, RAINLYN', '', 'In an age marked by digital connectivity and global trade, the potential of e-commerce to uplift marginalized communities is evident. This study focuses on the development of an e-commerce platform for the indigenous population of Kalinga, Philippines, aimed at promoting their rich cultural heritage and empowering their economic endeavors. The proposed platform, Rise and Thrive, seeks to address the challenges faced by indigenous entrepreneurs, including limited market access and authenticity issues, by providing a dedicated marketplace with features designed to prioritize authenticity, cultural significance, and data security. The significance of this research lies in its pioneering launch of an e-commerce platform tailored specifically for the indigenous population of Kalinga, Philippines. it is for economic empowerment and cultural preservation, the platform offers Kalinga immediate benefits in expanding market reach and connecting with a global audience. By fostering sales growth and positioning Kalinga as a cultural hub, the platform attracts tourism and reinforces the authenticity of indigenous offerings, aside from that it uses technologies such as PHP, HTML, CSS, JavaScript, and MySQL, the platform incorporates measures in security and a payment method to ensure user confidence. Testing and evaluation based on ISO 25010 criteria ensure the platform\\\'s functionality and adherence to standards of confidentiality, integrity, non-repudiation, and accountability. The study', 'Kalinga, E-Commerce, Indigenous Products, Kalinga Culture, Indigenous Website'),
(38, 0, '2024-05', 'BSIT-NS', 'THE DEVELOPMENT OF HIVESTOCK: AN ENHANCED SOLUTION FOR THE INVENTORY MANAGEMENT SYSTEM (IMS) OF NIKKA TRADING', 'BARRAMEDA, GINALYN M.-JIMENEZ, CHARINA M.-LABANIEGO, ANGELINE MARIE D.', '', 'The capstone project, \\\"The Development of HiveStock: An Enhanced Solution for the Inventory Management System of Nikka Trading, \\\" is a direct response to the urgent need for a more effective inventory management system. The current system, characterized by manual procedures, obsolete software, and limited visibility, is not only outdated but also poses significant challenges for Nikka Trading. The review of related literature strengthens the proposed study by providing a comprehensive understanding of the current state of knowledge in the field. The study used a descriptive research design to thoroughly examine the project\\\'s objectives and scope, which involved a comprehensive analysis of existing research on inventory management systems, technological advancements, and recent industry developments. Moreover, the evaluation results with a high rating indicate that the system could meet the following ISO 25010 standards, such as its usability and compatibility. With an average total rating of 3.89, interpreted as \\\"Acceptable\\\" in terms of functionality, reliability, performance efficiency, usability, compatibility, security, maintainability, and portability. manual inventory management processes and decentralized spreadsheet reliance further compound the issue, introducing errors and hindering operational efficiency. The proposed solution, a modern inventory management system, offers real-time visibility, streamlined supply chain operations, and strategic integration with ', 'inventory management system, data entry, logistics, technology'),
(39, 0, '2024-05', 'BSIT-NS', 'AN ENHANCED WIDE AREA NETWORK INFRASTRUCTURE FOR DOST CENTRAL OFFICE: OPTIMIZED FIREWALL AND SYSTEM NETWORK DEPLOYMENT', 'CANONCE, EDRIAN T.-DELICA, CEDRIC JOHN C.-LAGASCA, KAYE M.', '', 'The technology has evolved on how information are exchanged and WANs are the backbone of this interconnected world. However, the complexity of WANs also shows on how organizations expose their security challenges. This research focuses on the development, evaluation and testing of the \\\"Enhanced Wide Area Network Infrastructure for DOST Central Office: Optimized Firewall and System Network Development\\\". The goal was to design an improved wide-area network infrastructure with VPN, redundancy, scalability, and quality of service control. Employing a Descriptive Approach research design, the research incorporated Likert scales administered to IT Professionals. Positive evaluations from the participants emphasized the proposed network infrastructure\\\'s satisfactory in terms of functionality, reliability, usability and security. Therefore, the researchers concluded based on the results, that the proposed network infrastructure function works as intended: access switch, core switch, router and firewall are integrated well. With a total mean score of 4.1 out of 5, the proposed network infrastructure demonstrates that the functionality, reliability and usability of the network infrastructure was rated satisfactory. Overall, these results and findings indicate that the proposed network infrastructure is functional, reliable, usable and secure, making it an effective solution for transferring encrypted data between two DOST branches, offers redundancy, and has a successful connectivit', 'enhanced wide area network infrastructure, WAN, access switch, core switch, router, firewall, IPSec tunnel, redundancy, scalability, VPN, DOST');

-- --------------------------------------------------------

--
-- Table structure for table `theses_backup`
--

CREATE TABLE `theses_backup` (
  `thesis_id` int(4) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `published_date` varchar(7) NOT NULL,
  `course` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `adviser` varchar(100) NOT NULL,
  `abstract` varchar(1500) NOT NULL,
  `keywords` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `theses`
--
ALTER TABLE `theses`
  ADD UNIQUE KEY `published_date` (`published_date`,`course`,`title`,`authors`,`adviser`,`keywords`,`abstract`) USING HASH,
  ADD KEY `thesis_id` (`thesis_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `theses`
--
ALTER TABLE `theses`
  MODIFY `thesis_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
